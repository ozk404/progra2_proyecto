
from datetime import datetime, timedelta
from pprint import pprint
import re
from flask import Flask, request, jsonify, send_file, make_response
from dotenv import load_dotenv
from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow
from flask_cors import CORS
from functools import wraps
from jwt import encode, decode
from werkzeug.utils import secure_filename
import os
from sqlalchemy.orm import Session
from sqlalchemy import func
from io import BytesIO
import pathlib
import xlsxwriter
from sqlalchemy.exc import IntegrityError

from reportlab.lib.pagesizes import letter
from reportlab.lib import colors
from reportlab.lib.units import inch
from reportlab.pdfgen import canvas

CURRENT_PATH = pathlib.Path(__file__).parent.resolve()

host = "/backend"
app = Flask(__name__)
CORS(app)

# Conexión interna a MySQL
url = "mysql+pymysql://devuser:D3v_u53r#@mysql/HOTEL"
app.config["SQLALCHEMY_DATABASE_URI"] = url
app.config["SQLALCHEMY_TRACK_MODIFICATIONS"] = False
app.config["SECRET_KEY"] = os.environ.get('SECRET_KEY')

db = SQLAlchemy(app)
ma = Marshmallow(app)
session = Session(db.engine, future=True)

"""
Modelos y Esquemas
"""
class Usuario(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(100), nullable=False)
    correo = db.Column(db.String(100), unique=True, nullable=False)
    identificacion = db.Column(db.String(20), unique=True, nullable=False)
    telefono = db.Column(db.String(15), nullable=False)
    estado = db.Column(db.Integer)

    def __init__(self, nombre, correo, identificacion, telefono, estado):
        self.nombre = nombre
        self.correo = correo
        self.identificacion = identificacion
        self.telefono = telefono
        self.estado = estado


class Hotel(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(100), nullable=False)
    direccion = db.Column(db.String(200), nullable=False)
    telefono = db.Column(db.String(15), nullable=False)

    def __init__(self, nombre, direccion, telefono):
        self.nombre = nombre
        self.direccion = direccion
        self.telefono = telefono


class TipoHabitacion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(100), nullable=False)
    descripcion = db.Column(db.String(200), nullable=True)
    precio_noche = db.Column(db.Float, nullable=False)

    def __init__(self, nombre, descripcion, precio_noche):
        self.nombre = nombre
        self.descripcion = descripcion
        self.precio_noche = precio_noche


class Habitacion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    numero = db.Column(db.String(10), nullable=False)
    id_hotel = db.Column(db.Integer, db.ForeignKey('hotel.id'), nullable=False)
    id_tipo_habitacion = db.Column(db.Integer, db.ForeignKey('tipo_habitacion.id'), nullable=False)
    estado = db.Column(db.String(20), nullable=False)

    hotel = db.relationship('Hotel', backref=db.backref('habitaciones', lazy=True))
    tipo_habitacion = db.relationship('TipoHabitacion', backref=db.backref('habitaciones', lazy=True))

    def __init__(self, numero, id_hotel, id_tipo_habitacion, estado):
        self.numero = numero
        self.id_hotel = id_hotel
        self.id_tipo_habitacion = id_tipo_habitacion
        self.estado = estado


class Cliente(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(100), nullable=False)
    identificacion = db.Column(db.String(20), unique=True, nullable=False)
    correo = db.Column(db.String(100), nullable=True)
    telefono = db.Column(db.String(15), nullable=True)

    def __init__(self, nombre, identificacion, correo, telefono):
        self.nombre = nombre
        self.identificacion = identificacion
        self.correo = correo
        self.telefono = telefono


class Empleado(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(100), nullable=False)
    puesto = db.Column(db.String(50), nullable=False)
    id_hotel = db.Column(db.Integer, db.ForeignKey('hotel.id'), nullable=False)

    hotel = db.relationship('Hotel', backref=db.backref('empleados', lazy=True))

    def __init__(self, nombre, puesto, id_hotel):
        self.nombre = nombre
        self.puesto = puesto
        self.id_hotel = id_hotel


class Reservacion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    id_cliente = db.Column(db.Integer, db.ForeignKey('cliente.id'), nullable=False)
    id_empleado = db.Column(db.Integer, db.ForeignKey('empleado.id'), nullable=False)
    id_hotel = db.Column(db.Integer, db.ForeignKey('hotel.id'), nullable=False)
    fecha_reserva = db.Column(db.DateTime, nullable=False)
    total = db.Column(db.Float, nullable=False)

    cliente = db.relationship('Cliente', backref=db.backref('reservaciones', lazy=True))
    empleado = db.relationship('Empleado', backref=db.backref('reservaciones', lazy=True))
    hotel = db.relationship('Hotel', backref=db.backref('reservaciones', lazy=True))

    def __init__(self, id_cliente, id_empleado, id_hotel, fecha_reserva, total):
        self.id_cliente = id_cliente
        self.id_empleado = id_empleado
        self.id_hotel = id_hotel
        self.fecha_reserva = fecha_reserva
        self.total = total


class DetalleReservacion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    id_reservacion = db.Column(db.Integer, db.ForeignKey('reservacion.id'), nullable=False)
    id_habitacion = db.Column(db.Integer, db.ForeignKey('habitacion.id'), nullable=False)
    fecha_inicio = db.Column(db.Date, nullable=False)
    fecha_fin = db.Column(db.Date, nullable=False)

    reservacion = db.relationship('Reservacion', backref=db.backref('detalles', lazy=True))
    habitacion = db.relationship('Habitacion', backref=db.backref('reservaciones', lazy=True))

    def __init__(self, id_reservacion, id_habitacion, fecha_inicio, fecha_fin):
        self.id_reservacion = id_reservacion
        self.id_habitacion = id_habitacion
        self.fecha_inicio = fecha_inicio
        self.fecha_fin = fecha_fin



with app.app_context():
    db.create_all()


@app.route(host + "/", methods=["GET"])
def get_index():
    return jsonify("Sistema funcionando correctamente en el puerto 7000"), 200


# Crear un usuario
@app.route(host + '/usuarios', methods=['POST'])
def crear_usuario():
    datos = request.json
    nuevo_usuario = Usuario(
        nombre=datos['nombre'],
        correo=datos['correo'],
        identificacion=datos['identificacion'],
        telefono=datos['telefono'],
        estado=1
    )
    try:
        db.session.add(nuevo_usuario)
        db.session.commit()
        return jsonify({"message": "Usuario creado exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"message": "El correo o identificación ya existe"}), 400


# Leer todos los usuarios
@app.route(host + '/usuarios', methods=['GET'])
def obtener_usuarios():
    usuarios = Usuario.query.all()
    resultado = [
        {
            "id": usuario.id,
            "nombre": usuario.nombre,
            "correo": usuario.correo,
            "identificacion": usuario.identificacion,
            "telefono": usuario.telefono,
            "estado": usuario.estado
        } for usuario in usuarios
    ]
    return jsonify(resultado)


# Leer un usuario por ID
@app.route(host + '/usuarios/<int:id>', methods=['GET'])
def obtener_usuario(id):
    usuario = Usuario.query.get_or_404(id)
    resultado = {
        "id": usuario.id,
        "nombre": usuario.nombre,
        "correo": usuario.correo,
        "identificacion": usuario.identificacion,
        "telefono": usuario.telefono,
        "estado": usuario.estado
    }
    return jsonify(resultado)


# Actualizar un usuario
@app.route(host + '/usuarios/<int:id>', methods=['PUT'])
def actualizar_usuario(id):
    usuario = Usuario.query.get_or_404(id)
    datos = request.json
    usuario.nombre = datos.get('nombre', usuario.nombre)
    usuario.correo = datos.get('correo', usuario.correo)
    usuario.identificacion = datos.get('identificacion', usuario.identificacion)
    usuario.telefono = datos.get('telefono', usuario.telefono)
    usuario.estado = datos.get('estado', usuario.estado)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Usuario actualizado exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "El correo o identificación ya existe"}), 400


# Eliminar un usuario
@app.route(host + '/usuarios/<int:id>', methods=['DELETE'])
def eliminar_usuario(id):
    usuario = Usuario.query.get_or_404(id)
    db.session.delete(usuario)
    db.session.commit()
    return jsonify({"mensaje": "Usuario eliminado exitosamente"}, 200)





# Crear un hotel
@app.route(host + '/hoteles', methods=['POST'])
def crear_hotel():
    datos = request.json
    nuevo_hotel = Hotel(
        nombre=datos['nombre'],
        direccion=datos['direccion'],
        telefono=datos['telefono']
    )
    try:
        db.session.add(nuevo_hotel)
        db.session.commit()
        return jsonify({"mensaje": "Hotel creado exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al crear el hotel"}), 400


# Leer todos los hoteles
@app.route(host + '/hoteles', methods=['GET'])
def obtener_hoteles():
    hoteles = Hotel.query.all()
    resultado = [
        {
            "id": hotel.id,
            "nombre": hotel.nombre,
            "direccion": hotel.direccion,
            "telefono": hotel.telefono
        } for hotel in hoteles
    ]
    return jsonify(resultado)


# Leer un hotel por ID
@app.route(host + '/hoteles/<int:id>', methods=['GET'])
def obtener_hotel(id):
    hotel = Hotel.query.get_or_404(id)
    resultado = {
        "id": hotel.id,
        "nombre": hotel.nombre,
        "direccion": hotel.direccion,
        "telefono": hotel.telefono
    }
    return jsonify(resultado)


# Actualizar un hotel
@app.route(host + '/hoteles/<int:id>', methods=['PUT'])
def actualizar_hotel(id):
    hotel = Hotel.query.get_or_404(id)
    datos = request.json
    hotel.nombre = datos.get('nombre', hotel.nombre)
    hotel.direccion = datos.get('direccion', hotel.direccion)
    hotel.telefono = datos.get('telefono', hotel.telefono)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Hotel actualizado exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al actualizar el hotel"}), 400


# Eliminar un hotel
@app.route(host +  '/hoteles/<int:id>', methods=['DELETE'])
def eliminar_hotel(id):
    hotel = Hotel.query.get_or_404(id)
    db.session.delete(hotel)
    db.session.commit()
    return jsonify({"mensaje": "Hotel eliminado exitosamente"})


# Crear un cliente
@app.route(host + '/clientes', methods=['POST'])
def crear_cliente():
    datos = request.json
    nuevo_cliente = Cliente(
        nombre=datos['nombre'],
        identificacion=datos['identificacion'],
        correo=datos.get('correo'),
        telefono=datos.get('telefono')
    )
    try:
        db.session.add(nuevo_cliente)
        db.session.commit()
        return jsonify({"mensaje": "Cliente creado exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "La identificación ya existe"}), 400


# Leer todos los clientes
@app.route(host + '/clientes', methods=['GET'])
def obtener_clientes():
    clientes = Cliente.query.all()
    resultado = [
        {
            "id": cliente.id,
            "nombre": cliente.nombre,
            "identificacion": cliente.identificacion,
            "correo": cliente.correo,
            "telefono": cliente.telefono
        } for cliente in clientes
    ]
    return jsonify(resultado)


# Leer un cliente por ID
@app.route(host + '/clientes/<int:id>', methods=['GET'])
def obtener_cliente(id):
    cliente = Cliente.query.get_or_404(id)
    resultado = {
        "id": cliente.id,
        "nombre": cliente.nombre,
        "identificacion": cliente.identificacion,
        "correo": cliente.correo,
        "telefono": cliente.telefono
    }
    return jsonify(resultado)


# Actualizar un cliente
@app.route(host + '/clientes/<int:id>', methods=['PUT'])
def actualizar_cliente(id):
    cliente = Cliente.query.get_or_404(id)
    datos = request.json
    cliente.nombre = datos.get('nombre', cliente.nombre)
    cliente.identificacion = datos.get('identificacion', cliente.identificacion)
    cliente.correo = datos.get('correo', cliente.correo)
    cliente.telefono = datos.get('telefono', cliente.telefono)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Cliente actualizado exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "La identificación ya existe"}), 400


# Eliminar un cliente
@app.route(host + '/clientes/<int:id>', methods=['DELETE'])
def eliminar_cliente(id):
    cliente = Cliente.query.get_or_404(id)
    db.session.delete(cliente)
    db.session.commit()
    return jsonify({"mensaje": "Cliente eliminado exitosamente"})



# Crear un empleado
@app.route(host +'/empleados', methods=['POST'])
def crear_empleado():
    datos = request.json
    nuevo_empleado = Empleado(
        nombre=datos['nombre'],
        puesto=datos['puesto'],
        id_hotel=datos['id_hotel']
    )
    try:
        db.session.add(nuevo_empleado)
        db.session.commit()
        return jsonify({"mensaje": "Empleado creado exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al crear el empleado"}), 400


# Leer todos los empleados
@app.route(host +'/empleados', methods=['GET'])
def obtener_empleados():
    empleados = Empleado.query.all()
    resultado = [
        {
            "id": empleado.id,
            "nombre": empleado.nombre,
            "puesto": empleado.puesto,
            "id_hotel": empleado.id_hotel
        } for empleado in empleados
    ]
    return jsonify(resultado)


# Leer un empleado por ID
@app.route(host +'/empleados/<int:id>', methods=['GET'])
def obtener_empleado(id):
    empleado = Empleado.query.get_or_404(id)
    resultado = {
        "id": empleado.id,
        "nombre": empleado.nombre,
        "puesto": empleado.puesto,
        "id_hotel": empleado.id_hotel
    }
    return jsonify(resultado)


# Actualizar un empleado
@app.route(host +'/empleados/<int:id>', methods=['PUT'])
def actualizar_empleado(id):
    empleado = Empleado.query.get_or_404(id)
    datos = request.json
    empleado.nombre = datos.get('nombre', empleado.nombre)
    empleado.puesto = datos.get('puesto', empleado.puesto)
    empleado.id_hotel = datos.get('id_hotel', empleado.id_hotel)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Empleado actualizado exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al actualizar el empleado"}), 400


# Eliminar un empleado
@app.route(host + '/empleados/<int:id>', methods=['DELETE'])
def eliminar_empleado(id):
    empleado = Empleado.query.get_or_404(id)
    db.session.delete(empleado)
    db.session.commit()
    return jsonify({"mensaje": "Empleado eliminado exitosamente"})

# Crear un tipo de habitación
@app.route(host + '/tipo_habitacion', methods=['POST'])
def crear_tipo_habitacion():
    datos = request.json
    nuevo_tipo_habitacion = TipoHabitacion(
        nombre=datos['nombre'],
        descripcion=datos.get('descripcion'),
        precio_noche=datos['precio_noche']
    )
    try:
        db.session.add(nuevo_tipo_habitacion)
        db.session.commit()
        return jsonify({"mensaje": "Tipo de habitación creado exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al crear el tipo de habitación"}), 400


# Leer todos los tipos de habitación
@app.route(host + '/tipo_habitacion', methods=['GET'])
def obtener_tipos_habitacion():
    tipos = TipoHabitacion.query.all()
    resultado = [
        {
            "id": tipo.id,
            "nombre": tipo.nombre,
            "descripcion": tipo.descripcion,
            "precio_noche": tipo.precio_noche
        } for tipo in tipos
    ]
    return jsonify(resultado)


# Leer un tipo de habitación por ID
@app.route(host + '/tipo_habitacion/<int:id>', methods=['GET'])
def obtener_tipo_habitacion(id):
    tipo = TipoHabitacion.query.get_or_404(id)
    resultado = {
        "id": tipo.id,
        "nombre": tipo.nombre,
        "descripcion": tipo.descripcion,
        "precio_noche": tipo.precio_noche
    }
    return jsonify(resultado)


# Actualizar un tipo de habitación
@app.route(host + '/tipo_habitacion/<int:id>', methods=['PUT'])
def actualizar_tipo_habitacion(id):
    tipo = TipoHabitacion.query.get_or_404(id)
    datos = request.json
    tipo.nombre = datos.get('nombre', tipo.nombre)
    tipo.descripcion = datos.get('descripcion', tipo.descripcion)
    tipo.precio_noche = datos.get('precio_noche', tipo.precio_noche)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Tipo de habitación actualizado exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al actualizar el tipo de habitación"}), 400


# Eliminar un tipo de habitación
@app.route(host + '/tipo_habitacion/<int:id>', methods=['DELETE'])
def eliminar_tipo_habitacion(id):
    tipo = TipoHabitacion.query.get_or_404(id)
    db.session.delete(tipo)
    db.session.commit()
    return jsonify({"mensaje": "Tipo de habitación eliminado exitosamente"})


# Crear una habitación
@app.route(host + '/habitaciones', methods=['POST'])
def crear_habitacion():
    datos = request.json
    nueva_habitacion = Habitacion(
        numero=datos['numero'],
        id_hotel=datos['id_hotel'],
        id_tipo_habitacion=datos['id_tipo_habitacion'],
        estado=datos['estado']
    )
    try:
        db.session.add(nueva_habitacion)
        db.session.commit()
        return jsonify({"mensaje": "Habitación creada exitosamente"}), 201
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al crear la habitación"}), 400


# Leer todas las habitaciones
@app.route(host + '/habitaciones', methods=['GET'])
def obtener_habitaciones():
    habitaciones = Habitacion.query.all()
    resultado = [
        {
            "id": habitacion.id,
            "numero": habitacion.numero,
            "id_hotel": habitacion.id_hotel,
            "id_tipo_habitacion": habitacion.id_tipo_habitacion,
            "estado": habitacion.estado
        } for habitacion in habitaciones
    ]
    return jsonify(resultado)


# Leer una habitación por ID
@app.route(host + '/habitaciones/<int:id>', methods=['GET'])
def obtener_habitacion(id):
    habitacion = Habitacion.query.get_or_404(id)
    resultado = {
        "id": habitacion.id,
        "numero": habitacion.numero,
        "id_hotel": habitacion.id_hotel,
        "id_tipo_habitacion": habitacion.id_tipo_habitacion,
        "estado": habitacion.estado
    }
    return jsonify(resultado)


# Actualizar una habitación
@app.route(host + '/habitaciones/<int:id>', methods=['PUT'])
def actualizar_habitacion(id):
    habitacion = Habitacion.query.get_or_404(id)
    datos = request.json
    habitacion.numero = datos.get('numero', habitacion.numero)
    habitacion.id_hotel = datos.get('id_hotel', habitacion.id_hotel)
    habitacion.id_tipo_habitacion = datos.get('id_tipo_habitacion', habitacion.id_tipo_habitacion)
    habitacion.estado = datos.get('estado', habitacion.estado)

    try:
        db.session.commit()
        return jsonify({"mensaje": "Habitación actualizada exitosamente"})
    except IntegrityError:
        db.session.rollback()
        return jsonify({"error": "Error al actualizar la habitación"}), 400


# Eliminar una habitación
@app.route(host + '/habitaciones/<int:id>', methods=['DELETE'])
def eliminar_habitacion(id):
    habitacion = Habitacion.query.get_or_404(id)
    db.session.delete(habitacion)
    db.session.commit()
    return jsonify({"mensaje": "Habitación eliminada exitosamente"})


# Crear una reservación con detalle
@app.route(host +'/reservaciones', methods=['POST'])
def crear_reservacion():
    datos = request.json
    fecha_reserva = datetime.now()
    detalles = datos.get('detalles', [])

    for detalle in detalles:
        # Verificar que no exista otra reservación para la misma habitación, hotel y fecha
        reservacion_existente = DetalleReservacion.query.join(Reservacion).filter(
            Reservacion.id_hotel == datos['id_hotel'],
            DetalleReservacion.id_habitacion == detalle['id_habitacion'],
            DetalleReservacion.fecha_inicio <= detalle['fecha_fin'],
            DetalleReservacion.fecha_fin >= detalle['fecha_inicio']
        ).first()
        if reservacion_existente:
            return jsonify({"error": "La habitación ya está reservada en las fechas seleccionadas"}), 400

    # Crear la reservación
    nueva_reservacion = Reservacion(
        id_cliente=datos['id_cliente'],
        id_empleado=datos['id_empleado'],
        id_hotel=datos['id_hotel'],
        fecha_reserva=fecha_reserva,
        total=datos['total']
    )
    db.session.add(nueva_reservacion)
    db.session.flush()

    # Crear los detalles de la reservación
    for detalle in detalles:
        nuevo_detalle = DetalleReservacion(
            id_reservacion=nueva_reservacion.id,
            id_habitacion=detalle['id_habitacion'],
            fecha_inicio=datetime.strptime(detalle['fecha_inicio'], '%Y-%m-%d').date(),
            fecha_fin=datetime.strptime(detalle['fecha_fin'], '%Y-%m-%d').date()
        )
        db.session.add(nuevo_detalle)

    db.session.commit()
    return jsonify({"mensaje": "Reservación y detalles creados exitosamente"}), 201


# Obtener todas las reservaciones
@app.route(host +'/reservaciones', methods=['GET'])
def obtener_reservaciones():
    reservaciones = Reservacion.query.all()
    resultado = [
        {
            "id": reservacion.id,
            "id_cliente": reservacion.id_cliente,
            "id_empleado": reservacion.id_empleado,
            "id_hotel": reservacion.id_hotel,
            "fecha_reserva": reservacion.fecha_reserva.strftime('%Y-%m-%d'),  # Formato de fecha
            "total": reservacion.total,
            # Agregar los detalles directamente como campos
            **{"id_detalle": detalle.id for index, detalle in enumerate(reservacion.detalles)},
            **{"id_habitacion": detalle.id_habitacion for index, detalle in enumerate(reservacion.detalles)},
            **{"fecha_inicio": detalle.fecha_inicio.strftime('%Y-%m-%d') for index, detalle in enumerate(reservacion.detalles)},
            **{"fecha_fin": detalle.fecha_fin.strftime('%Y-%m-%d') for index, detalle in enumerate(reservacion.detalles)}
        } for reservacion in reservaciones
    ]
    return jsonify(resultado)




# Actualizar una reservación y sus detalles
@app.route(host +'/reservaciones/<int:id>', methods=['PUT'])
def actualizar_reservacion(id):
    reservacion = Reservacion.query.get_or_404(id)
    datos = request.json

    reservacion.id_cliente = datos.get('id_cliente', reservacion.id_cliente)
    reservacion.id_empleado = datos.get('id_empleado', reservacion.id_empleado)
    reservacion.id_hotel = datos.get('id_hotel', reservacion.id_hotel)
    reservacion.total = datos.get('total', reservacion.total)

    # Actualizar o agregar detalles
    if 'detalles' in datos:
        for detalle in datos['detalles']:
            detalle_existente = DetalleReservacion.query.filter_by(id=detalle['id']).first()
            if detalle_existente:
                detalle_existente.id_habitacion = detalle.get('id_habitacion', detalle_existente.id_habitacion)
                detalle_existente.fecha_inicio = datetime.strptime(detalle['fecha_inicio'], '%Y-%m-%d').date()
                detalle_existente.fecha_fin = datetime.strptime(detalle['fecha_fin'], '%Y-%m-%d').date()
            else:
                nuevo_detalle = DetalleReservacion(
                    id_reservacion=reservacion.id,
                    id_habitacion=detalle['id_habitacion'],
                    fecha_inicio=datetime.strptime(detalle['fecha_inicio'], '%Y-%m-%d').date(),
                    fecha_fin=datetime.strptime(detalle['fecha_fin'], '%Y-%m-%d').date()
                )
                db.session.add(nuevo_detalle)

    db.session.commit()
    return jsonify({"mensaje": "Reservación actualizada exitosamente"})


# Eliminar una reservación y sus detalles
@app.route(host + '/reservaciones/<int:id>', methods=['DELETE'])
def eliminar_reservacion(id):
    reservacion = Reservacion.query.get_or_404(id)
    DetalleReservacion.query.filter_by(id_reservacion=id).delete()
    db.session.delete(reservacion)
    db.session.commit()
    return jsonify({"mensaje": "Reservación eliminada exitosamente"})



# Endpoint para generar PDF de una reservación por ID
@app.route(host + '/reservacion/pdf/<int:id_reservacion>', methods=['GET'])
def generar_pdf_reservacion(id_reservacion):
    # Obtener la reservación por ID
    reservacion = Reservacion.query.get(id_reservacion)
    if not reservacion:
        return jsonify({"error": "Reservación no encontrada"}), 404

    # Obtener información relacionada (Cliente, Empleado y Hotel)
    cliente = Cliente.query.get(reservacion.id_cliente)
    empleado = Empleado.query.get(reservacion.id_empleado)
    hotel = Hotel.query.get(reservacion.id_hotel)

    # Crear un buffer para el PDF
    buffer = BytesIO()
    pdf = canvas.Canvas(buffer, pagesize=letter)

    # Estilo de encabezado
    pdf.setFont("Helvetica-Bold", 14)
    pdf.drawString(100, 750, f"Reservación Detallada")
    pdf.setFont("Helvetica", 12)
    pdf.setFillColor(colors.darkblue)
    pdf.drawString(100, 730, f"ID de Reservación: {reservacion.id}")

    # Información de la reservación
    pdf.setFillColor(colors.black)
    pdf.drawString(100, 710, f"Cliente: {cliente.nombre}")
    pdf.drawString(100, 690, f"Empleado: {empleado.nombre}")
    pdf.drawString(100, 670, f"Hotel: {hotel.nombre}")
    pdf.drawString(100, 650, f"Fecha de Reserva: {reservacion.fecha_reserva.strftime('%Y-%m-%d')}")
    pdf.drawString(100, 630, f"Total: ${reservacion.total:.2f}")

    # Estilo para detalles de reservación
    y_position = 600
    pdf.setFont("Helvetica-Bold", 12)
    pdf.setFillColor(colors.darkblue)
    pdf.drawString(100, y_position, "Detalles de la Reservación:")
    pdf.setFont("Helvetica", 10)

    # Iterar sobre los detalles de la reservación y agregar información al PDF
    for index, detalle in enumerate(reservacion.detalles, start=1):
        y_position -= 30
        habitacion = Habitacion.query.get(detalle.id_habitacion)
        pdf.setFillColor(colors.black)
        pdf.drawString(100, y_position, f"Detalle {index}:")
        pdf.drawString(120, y_position - 15, f"Habitación: {habitacion.numero} - {habitacion.tipo_habitacion.nombre}")
        pdf.drawString(120, y_position - 30, f"Fecha Inicio: {detalle.fecha_inicio.strftime('%Y-%m-%d')}")
        pdf.drawString(120, y_position - 45, f"Fecha Fin: {detalle.fecha_fin.strftime('%Y-%m-%d')}")
        y_position -= 60  # Espaciado entre detalles

    # Guardar y cerrar el PDF
    pdf.save()
    buffer.seek(0)

    # Devolver el PDF como respuesta
    return make_response(buffer.getvalue(), 200, {
        'Content-Type': 'application/pdf',
        'Content-Disposition': f'attachment; filename=reservacion_{id_reservacion}.pdf'
    })


if __name__ == "__main__":
    # app.run(host='0.0.0.0', port=7000)
    app.run(host='0.0.0.0', debug=True, port=7000)

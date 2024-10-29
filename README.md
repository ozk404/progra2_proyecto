# 🐍 Proyecto Final de Programación II - Sistema de Hoteles

Este proyecto es un sistema de hotelería diseñado para gestionar reservaciones de habitaciones en un hotel, con funcionalidades para registrar, gestionar y consultar clientes, empleados, habitaciones, y realizar reservaciones detalladas con fechas, costos y disponibilidad.

## Tabla de Contenidos
- [Características](#características)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Funciones Principales](#funciones-principales)
- [Ejemplo de Uso de la API](#ejemplo-de-uso-de-la-api)
- [Contribuciones](#contribuciones)
- [Licencia](#licencia)

---

## Características

Este sistema cumple con los siguientes requisitos de funcionalidad:

- **Registro de Usuarios**: Permite registrar credenciales de empleados con acceso al sistema.
- **Gestión de Hoteles**: Registra datos generales del hotel.
- **Clasificación de Habitaciones**: Clasifica cada habitación según su nivel de comodidad.
- **Gestión de Habitaciones**: Registra habitaciones disponibles en el hotel y su clasificación.
- **Registro de Clientes**: Permite registrar datos de personas que solicitan las habitaciones.
- **Gestión de Empleados**: Registra empleados que trabajan en el hotel.
- **Gestión de Reservaciones**: Crea reservaciones para clientes con detalles de fechas, costos y habitaciones.
- **Reportes**:
  - Búsqueda de Reservación con detalles de cliente, empleado, habitaciones, fechas y costos.
  - Verificación de Disponibilidad de Habitaciones con información de costos y tipo de habitación.

## Requisitos

Para ejecutar este proyecto, asegúrate de tener instalados los siguientes componentes:
- **Docker y Docker-Compose**
- **Python** 3.x
- **Flask** y **SQLAlchemy** para el backend de la API en Python.
- **PHP** para el manejo de ciertos formularios.
- **MySQL** o **PostgreSQL** para la base de datos.
- **JavaScript** con **AJAX** para la interactividad en el frontend.
- **Bootstrap** para el diseño y estilo de la interfaz de usuario.
- **reportlab** para la generación de reportes en formato PDF.

## Instalación

1. **Clona el repositorio** en tu máquina local:
   ```bash
   git clone https://github.com/tu_usuario/progra2_proyecto.git
   cd progra2_proyecto
   ```

2. **Monta el proyecto con docker** (solo basta con un comando):
   ```bash
    docker-compose up -d --build
   ```

3. **Listo! ahora ya puedes acceder a la interfaz web** a través de `http://127.0.0.1` en tu navegador.


## Funciones Principales

### Registro y Mantenimiento de Entidades

1. **Usuarios**: Registra credenciales de empleados con acceso al sistema.
2. **Hoteles**: Registra la información general del hotel, como nombre, ubicación y contacto.
3. **Tipos de Habitaciones**: Clasifica habitaciones según sus comodidades.
4. **Habitaciones**: Registra las habitaciones disponibles, el tipo de habitación y el estado.
5. **Clientes**: Permite registrar los datos generales de los clientes.
6. **Empleados**: Permite registrar y gestionar la información de los empleados del hotel.

### Gestión de Reservaciones

- **Reservación**: Registra los datos principales de la reservación, incluyendo el cliente, el empleado que gestiona la reserva, el hotel, y el costo total.
- **Detalle de Reservación**: Lista las habitaciones reservadas y las fechas de inicio y fin de la reserva.

### Generación de Reportes

#### Búsqueda de Reservación

Permite visualizar los detalles de cada reservación, incluyendo:

- Datos de cliente y empleado asignado.
- Detalles de la habitación y fechas de reserva.
- Costo total de la reserva.

#### Verificación de Disponibilidad de Habitaciones

Permite buscar habitaciones disponibles en el rango de fechas especificado y muestra el tipo de habitación con sus respectivos costos. Esto es útil para que los clientes y empleados puedan verificar la disponibilidad antes de confirmar una reservación.

## Ejemplo de Uso de la API

1. **Crear una Reservación**  
   Endpoint: `POST /reservaciones`  
   Datos requeridos:
   ```json
   {
       "id_cliente": 1,
       "id_empleado": 2,
       "id_hotel": 3,
       "detalles": [
           {
               "id_habitacion": 101,
               "fecha_inicio": "2024-10-10",
               "fecha_fin": "2024-10-15"
           }
       ],
       "total": 200.00
   }
   ```

2. **Generar PDF de una Reservación**  
   Endpoint: `GET /reservacion/pdf/<int:id_reservacion>`  
   Descripción: Devuelve un PDF con todos los detalles de la reservación, incluyendo cliente, hotel, empleado, habitaciones reservadas, y fechas.

## Contribuciones

Este proyecto está abierto a mejoras. Para contribuir, por favor:

1. Haz un fork del repositorio.
2. Crea una rama para tu funcionalidad (`git checkout -b feature/mi_funcionalidad`).
3. Realiza un pull request con tus cambios.

## Licencia

Este proyecto está bajo la licencia MIT.

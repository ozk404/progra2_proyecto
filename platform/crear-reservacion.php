<?php
session_start();

if (! (isset($_SESSION['user_email']))) {
    header("Location: login.php");
    die();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Crear - Hotel Mariano Gálvez</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">


    <!-- Otros enlaces y scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="/">
                                <i class="fas fa-tachometer-alt"></i>Inicio</a>

                        </li>
                        <li>
                            <a href="/usuarios.php">
                                <i class="fas fa-user"></i>Menu Usuarios</a>
                        </li>

                        <li>
                            <a href="/hoteles.php">
                                <i class="fas fa-home"></i>Menu Hoteles</a>
                        </li>
                        <li>
                            <a href="/tipohabitaciones.php">
                                <i class="fas fa-home"></i>Menu Habitaciones</a>
                        </li>
                        <li>
                            <a href="/tipohabitaciones.php">
                                <i class="fas fa-home"></i>Menu Tipo Habitación</a>
                        </li>
                        <li>
                            <a href="/clientes.php">
                                <i class="fas fa-user"></i>Menu Clientes</a>
                        </li>
                        <li>
                            <a href="/empleados.php">
                                <i class="fas fa-user"></i>Menu Empleados</a>
                        </li>
                        <li  class="active has-sub">
                            <a href="/reservaciones.php">
                                <i class="fas fa-refresh"></i>Menu Reservaciones</a>
                        </li>
                        <li>
                            <a href="/login.php?user_email_logout">
                                <i class="fas fa-power-off"></i>Cerrar Sesión</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->

            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <br>
                        <div class="col-12 text-center pb-5">
                            <h1>Bienvenido a la sección de Reservaciones</h1>
                            <h5>Aquí puede crear, a una Reservación dentro del Sistema</h5>
                            <br>
                            <a href="listado-reservaciones.php">⬅️ Ver el listado de Reservaciones </a>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <div class="card" style="text-align:center;border-radius:15px;align-items:center;">
                                    <div class="card-body">
                                        <form id="reservacionForm" class="row g-3">
                                            <!-- Información de la reservación principal -->
                                            <div class="col-12">
                                                <label for="id_cliente" class="form-label">Seleccionar Cliente</label>
                                                <select id="id_cliente" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione un cliente</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="id_empleado" class="form-label">Seleccionar Empleado</label>
                                                <select id="id_empleado" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione un empleado</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="id_hotel" class="form-label">Seleccionar Hotel</label>
                                                <select id="id_hotel" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione un hotel</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="fecha_reserva" class="form-label">Fecha de Reserva</label>
                                                <input type="date" required class="form-control" id="fecha_reserva">
                                            </div>
                                            <div class="col-12">
                                                <label for="total" class="form-label">Total</label>
                                                <input type="number" step="0.01" required class="form-control" id="total" placeholder="Total">
                                            </div>

                                            <!-- Detalle de la reservación -->
                                            <div class="col-12">
                                                <h5>Detalles de la Reservación</h5>
                                                <label for="id_habitacion" class="form-label">Habitación</label>
                                                <select id="id_habitacion" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione una habitación</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                                <input type="date" required class="form-control" id="fecha_inicio">
                                            </div>
                                            <div class="col-12">
                                                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                                <input type="date" required class="form-control" id="fecha_fin">
                                            </div>
                                            <div class="col-12 pt-4">
                                                <button type="submit" class="btn btn-primary">Crear Reservación</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

                            <script>
                                document.getElementById('reservacionForm').addEventListener('submit', function(event) {
                                    event.preventDefault();

                                    // Datos de la reservación principal
                                    const reservacionData = {
                                        id_cliente: document.getElementById('id_cliente').value,
                                        id_empleado: document.getElementById('id_empleado').value,
                                        id_hotel: document.getElementById('id_hotel').value,
                                        total: parseFloat(document.getElementById('total').value),
                                        detalles: [{
                                            id_habitacion: document.getElementById('id_habitacion').value,
                                            fecha_inicio: document.getElementById('fecha_inicio').value,
                                            fecha_fin: document.getElementById('fecha_fin').value,
                                        }]
                                    };

                                    console.log('Datos de la reservación:', reservacionData);

                                    // Realiza la solicitud POST para crear la reservación con detalles
                                    fetch('http://104.197.54.121/backend/reservaciones', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify(reservacionData),
                                        })
                                        .then(response => {
                                            if (!response.ok) throw new Error('Error en la respuesta del servidor');
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Reservación y detalles creados:', data);
                                            Swal.fire({
                                                title: 'Éxito!',
                                                text: 'Reservación y detalles creados correctamente.',
                                                icon: 'success',
                                                confirmButtonText: 'Aceptar'
                                            });
                                            document.getElementById('reservacionForm').reset();
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Ocurrió un error. Intenta nuevamente.',
                                                icon: 'error',
                                                confirmButtonText: 'Aceptar'
                                            });
                                        });
                                });

                                document.addEventListener('DOMContentLoaded', function() {
                                    // Cargar listas de clientes, empleados, hoteles, y tipos de habitación
                                    fetch('http://104.197.54.121/backend/clientes')
                                        .then(response => response.json())
                                        .then(data => {
                                            const clienteSelect = document.getElementById('id_cliente');
                                            data.forEach(cliente => {
                                                const option = document.createElement('option');
                                                option.value = cliente.id;
                                                option.textContent = cliente.nombre;
                                                clienteSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error al obtener clientes:', error));

                                    fetch('http://104.197.54.121/backend/empleados')
                                        .then(response => response.json())
                                        .then(data => {
                                            const empleadoSelect = document.getElementById('id_empleado');
                                            data.forEach(empleado => {
                                                const option = document.createElement('option');
                                                option.value = empleado.id;
                                                option.textContent = empleado.nombre;
                                                empleadoSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error al obtener empleados:', error));

                                    fetch('http://104.197.54.121/backend/hoteles')
                                        .then(response => response.json())
                                        .then(data => {
                                            const hotelSelect = document.getElementById('id_hotel');
                                            data.forEach(hotel => {
                                                const option = document.createElement('option');
                                                option.value = hotel.id;
                                                option.textContent = hotel.nombre;
                                                hotelSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error al obtener hoteles:', error));

                                    fetch('http://104.197.54.121/backend/habitaciones')
                                        .then(response => response.json())
                                        .then(data => {

                                            const tipoHabitacionSelect = document.getElementById('id_habitacion');
                                            data.forEach(tipo => {
                                                let textfinal = ""

                                                const option = document.createElement('option');
                                                option.value = tipo.id;
                                                fetch('http://104.197.54.121/backend/tipo_habitacion/' + tipo.id_tipo_habitacion)
                                                    .then(response => response.json())
                                                    .then(datax => {
                                                        option.textContent = tipo.numero + " - " + datax.nombre;
                                                    })

                                                option.textContent = tipo.numero + " - " + textfinal;

                                                tipoHabitacionSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error al obtener tipos de habitación:', error));
                                });
                            </script>


                            <div class="col"></div>

                        </div>

                    </div>


                </div>
                <p class="text-center mt-3 p-5">Este sistema fue creado con fines demostrativos por Oscar Morales Cuellar para la clase de Programación II (2024) del ingeníero Marco Culajay.</p>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <style>
        .zoom-menos {
            transition: 0.30s all ease-in-out;
        }

        .zoom-menos:hover {
            transform: scale(0.905);
            box-shadow: 0 0 11px rgba(33, 33, 33, 0.1);
        }
    </style>
</body>

</html>
<!-- end document-->
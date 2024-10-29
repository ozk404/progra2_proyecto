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

                        <li >
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
                        <li class="active has-sub">
                            <a href="/empleados.php">
                                <i class="fas fa-user"></i>Menu Empleados</a>
                        </li>
                        <li>
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
                            <h1>Bienvenido a la sección de Crear un nuevo Habitación</h1>
                            <h5>Aquí puede crear, a un Habitación del sistema</h5>
                            <br>
                            <a href="listado-habitaciones.php">⬅️ Ver el listado de Habitaciones </a>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <div class="card" style="text-align:center;border-radius:15px;align-items:center;">
                                    <div class="card-body">
                                        <form id="usuarioForm" class="row g-3">
                                            <div class="col-12">
                                                <label for="numero" class="form-label">Número</label>
                                                <input type="text" required class="form-control" id="numero" placeholder="22">
                                            </div>
                                            <div class="col-12">
                                                <label for="id_hotel" class="form-label">Seleccionar Hotel</label>
                                                <select id="id_hotel" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione un hotel</option>
                                                    <!-- Las opciones se llenarán mediante JavaScript -->
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="id_tipo_habitacion" class="form-label">Seleccionar Tipo de Habitación</label>
                                                <select id="id_tipo_habitacion" required class="form-control form-select">
                                                    <option value="" disabled selected>Seleccione un tipo de habitación</option>
                                                    <!-- Las opciones se llenarán mediante JavaScript -->
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="estado" class="form-label">Estado</label>
                                                <input type="text" required class="form-control" id="estado" placeholder="Disponible">
                                            </div>
                                            <div class="col-12 pt-4">
                                                <button type="submit" class="btn btn-primary">Crear</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

                            <script>
                                document.getElementById('usuarioForm').addEventListener('submit', function(event) {
                                    event.preventDefault(); // Evita el envío del formulario por defecto

                                    // Recoge los datos del formulario
                                    const numero = document.getElementById('nuero').value;
                                    const id_hotel = document.getElementById('id_hotel').value;
                                    const id_tipo_habitacion = document.getElementById('id_tipo_habitacion').value;
                                    const estado = document.getElementById('estado').value;



                                    // Crea el objeto para enviar
                                    const data = {
                                        numero: numero,
                                        id_hotel: id_hotel,
                                        id_tipo_habitacion: id_tipo_habitacion,
                                        estado: estado

                                    };

                                    // Realiza el POST usando fetch
                                    fetch('http://localhost/backend/habitaciones', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify(data),
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Error en la respuesta del servidor');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Éxito:', data);
                                            // Muestra un SweetAlert de éxito
                                            Swal.fire({
                                                title: 'Éxito!',
                                                text: data.message || 'Habitación creado correctamente.',
                                                icon: 'success',
                                                confirmButtonText: 'Aceptar'
                                            });
                                            // Limpia el formulario si es necesario
                                            document.getElementById('usuarioForm').reset();
                                        })
                                        .catch((error) => {
                                            console.error('Error:', error);
                                            // Muestra un SweetAlert de error
                                            Swal.fire({
                                                title: 'Error!',
                                                text: "El correo o identificación ya existe",
                                                icon: 'error',
                                                confirmButtonText: 'Aceptar'
                                            });
                                        });
                                });

                                document.addEventListener('DOMContentLoaded', function() {
                                    // Obtener la lista de hoteles al cargar la página
                                    fetch('http://localhost/backend/hoteles')
                                        .then(response => response.json())
                                        .then(data => {
                                            const hotelSelect = document.getElementById('id_hotel');
                                            data.forEach(hotel => {
                                                const option = document.createElement('option');
                                                option.value = hotel.id; // Asumiendo que el objeto hotel tiene una propiedad 'id'
                                                option.textContent = hotel.nombre; // Asumiendo que el objeto hotel tiene una propiedad 'nombre'
                                                hotelSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error al obtener los hoteles:', error);
                                            Swal.Fire("Error", "No se pudo cargar la lista de hoteles.", "error");
                                        });
                                    // Obtener la lista de tipos de habitación
                                    fetch('http://localhost/backend/tipo_habitacion')
                                        .then(response => response.json())
                                        .then(data => {
                                            const tipoHabitacionSelect = document.getElementById('id_tipo_habitacion');
                                            data.forEach(tipo => {
                                                const option = document.createElement('option');
                                                option.value = tipo.id; // Asumiendo que el objeto tipo tiene una propiedad 'id'
                                                option.textContent = tipo.nombre; // Asumiendo que el objeto tipo tiene una propiedad 'nombre'
                                                tipoHabitacionSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error al obtener los tipos de habitación:', error);
                                            alert("No se pudo cargar la lista de tipos de habitación.");
                                        });
                                });

                                document.getElementById('usuarioForm').addEventListener('submit', function(event) {
                                    event.preventDefault(); // Evita el envío del formulario por defecto

                                    const formData = {
                                        numero: document.getElementById('numero').value,
                                        id_hotel: document.getElementById('id_hotel').value,
                                        id_tipo_habitacion: document.getElementById('id_tipo_habitacion').value,
                                        estado: document.getElementById('estado').value
                                    };

                                    fetch('http://localhost/backend/habitaciones', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify(formData),
                                        })
                                        .then(response => {
                                            if (response.ok) {
                                                Swal.fire("Habitación creado", "El Habitación ha sido creado exitosamente.", "success")
                                                    .then(() => location.reload()); // Recarga la página
                                            } else {
                                                Swal.fire("Error", "No se pudo crear el Habitación. Intenta nuevamente.", "error");
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            Swal.Fire("Error", "Ocurrió un error. Intenta nuevamente.", "error");
                                        });
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
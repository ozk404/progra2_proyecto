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
    <title>Reservaciones - Hotel Mariano Gálvez</title>

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
                            <a href="/habitaciones.php">
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
                        <li class="active has-sub">
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
                            <h1>Bienvenido al menú de Reservaciones</h1>
                            <h5>Aquí puede gestionar (crear, eliminar) todo lo relacionado con Reservaciones del sistema</h5>
                        </div>
                        <div class="row">
                            <div class="container text-center">

                                <!-- Formulario para ver la lista de reservaciones -->
                                <form action="listado-reservaciones.php" method="post">
                                    <button class="col-8 btn btn-primary" name="accion" value="reservaciones">Ver Listado</button>
                                </form>
                                <br class="pb-15 pt-5">

                                <!-- Formulario para crear un reservacion -->
                                <form action="crear-reservacion.php" method="post">
                                    <button class="col-8 btn btn-secondary" name="accion" value="crear_usuario">Crear Reservación</button>
                                </form>
                                <br class="pb-5 pt-5">

                                <!-- Formulario para borrar un reservacion -->
                                <form action="listado-reservaciones.php" method="post">
                                    <button class="col-8 btn btn-danger" name="accion" value="borrar_usuario">Borrar Reservación</button>
                                </form>
                                <br class="pb-5 pt-5">
                                <br class="pb-5 pt-5">

                                <!-- Botón para generar reporte de reservación -->
                                <button id="generarReporte" class="col-8 btn btn-dark">Generar reporte de reservación</button>

                            </div>
                        </div>


                    </div>


                </div>
                <p class="text-center mt-3 p-5">Este sistema fue creado con fines demostrativos por Oscar Morales Cuellar para la clase de Programación II (2024) del ingeníero Marco Culajay.</p>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

    <script>
        document.getElementById('generarReporte').addEventListener('click', function(event) {
            event.preventDefault();

            // Obtener listado de reservaciones desde el endpoint
            fetch('http://104.197.54.121/backend/reservaciones') // Endpoint que devuelve la lista de reservaciones
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        Swal.fire('No hay reservaciones disponibles', '', 'info');
                        return;
                    }

                    // Crear un select con las opciones de reservaciones
                    let selectOptions = '<select id="reservacionSelect" class="swal2-input">';
                    data.forEach(reservacion => {
                        selectOptions += `<option value="${reservacion.id}">Reservación #${reservacion.id}</option>`;
                    });
                    selectOptions += '</select>';

                    // Mostrar el SweetAlert con el select para elegir una reservación
                    Swal.fire({
                        title: 'Selecciona una reservación',
                        html: selectOptions,
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            const selectedId = document.getElementById('reservacionSelect').value;
                            return selectedId ? selectedId : null;
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value) {
                            // Enviar el ID de la reservación seleccionada al endpoint /reserv para obtener el PDF
                            fetch(`http://104.197.54.121/backend/reservacion/pdf/`+result.value, {
                                    method: 'GET',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                                    return response.blob(); // Convertir la respuesta a blob
                                })
                                .then(blob => {
                                    // Crear un enlace para descargar el PDF
                                    const url = window.URL.createObjectURL(blob);
                                    const link = document.createElement('a');
                                    link.href = url;
                                    link.download = `reservacion_${result.value}.pdf`;
                                    link.click();
                                    window.URL.revokeObjectURL(url); // Limpiar la URL

                                    Swal.fire({
                                        title: 'Éxito',
                                        text: 'El reporte se ha descargado exitosamente.',
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    });
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Ocurrió un error al descargar el reporte.',
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                });
                        }
                    });
                })
                .catch(error => {
                    console.error('Error al obtener las reservaciones:', error);
                    Swal.fire('Error al cargar las reservaciones', '', 'error');
                });
        });
    </script>

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
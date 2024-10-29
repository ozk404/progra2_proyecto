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
    <title>Inicio - Hotel Mariano Gálvez</title>

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
                        <li class="active has-sub">
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
                        <div class="row">

                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513473/man.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Usuarios</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con Usuarios del sistema.</p>
                                                <br>
                                                <a href="/usuarios.php" class="btn btn-primary">Gestionar Usuarios</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513477/building.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Hotles</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con los Hoteles del sistema.</p>
                                                <br>
                                                <a href="/hoteles.php" class="btn btn-primary">Gestionar Hoteles</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513482/hard-disk.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Habitaciones</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado las habitaciones del sistema.</p>
                                                <br>
                                                <a href="/habitaciones.php" class="btn btn-primary">Gestionar Habitaciones</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513487/id-card.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Clientes</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con las Clientes del sistema.</p>
                                                <br>
                                                <a href="/clientes.php" class="btn btn-primary">Gestionar Clientes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513486/medal.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Empleados</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con las Empleados del sistema.</p>
                                                <br>
                                                <a href="/empleados.php" class="btn btn-primary">Gestionar Empleados</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card zoom-menos" style="width: 18rem;text-align:center;border-radius:15px;align-items:center;">
                                            <img src="https://www.svgrepo.com/show/513468/macbook-pro.svg" class="card-img-center" style="text-align:center;padding:1rem;max-width: 10rem;" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu de Reservaciones</h5>
                                                <p class="card-text">Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con las Reservaciones del sistema.</p>
                                                <br>
                                                <a href="/reservaciones.php" class="btn btn-primary">Gestionar Reservaciones</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
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
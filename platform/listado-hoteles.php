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
    <title>Hoteles - Hotel Mariano Gálvez</title>

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
                        <li >
                            <a href="/usuarios.php">
                                <i class="fas fa-user"></i>Menu Usuarios</a>
                        </li>

                        <li class="active has-sub">
                            <a href="/hoteles.php">
                                <i class="fas fa-home"></i>Menu Hoteles</a>
                        </li>
                        <li>
                            <a href="/habitaciones.php">
                                <i class="fas fa-home"></i>Menu Habitaciones</a>
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
                        <div class="col-12 text-center pb-5">
                            <h1>Bienvenido al menú de Hoteles</h1>
                            <h5>Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con Hoteles del sistema</h5>
                       <br>
                      <a href="listado-hoteles.php">Ver el listado de Hoteles </a>     
                       <br>
                        </div>
                        <?php
                                $usuariosJson = file_get_contents('http://104.197.54.121/backend/hoteles');
                                $hoteles = json_decode($usuariosJson, true);

                        ?>
                        <div class="row">
                            <div class="container mt-5">
                                <h2>Lista de Hoteles</h2>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($hoteles)): ?>
                                            <?php foreach ($hoteles as $hotel): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($hotel['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($hotel['nombre']); ?></td>
                                                    <td><?php echo htmlspecialchars($hotel['direccion']); ?></td>
                                                    <td><?php echo htmlspecialchars($hotel['telefono']); ?></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" onclick="verDetalles(<?php echo htmlspecialchars(json_encode($hotel)); ?>)">Ver Detalles</button>
                                                        <button class="btn btn-warning btn-sm" onclick="editarUsuario(<?php echo htmlspecialchars(json_encode($hotel)); ?>)">Editar</button>
                                                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(<?php echo htmlspecialchars($hotel['id']); ?>)">Eliminar</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No hay hoteles disponibles.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <script>
                                    function verDetalles(hotel) {
                                        Swal.fire({
                                            title: "Detalles del Hotel",
                                            html: "Nombre: " + hotel.nombre + "<br>Direccion: " + hotel.direccion + "<br>Teléfono: " + hotel.telefono,
                                            icon: "info",
                                            buttons: true,
                                        });
                                    }

                                    function confirmarEliminacion(usuarioId) {
                                        Swal.fire({
                                                title: "¿Estás seguro?",
                                                text: "Una vez eliminado, no podrás recuperar este hotel.",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Borrar hotel!",
                                            })
                                            .then((result) => {
                                                if (result.isConfirmed) {
                                                    eliminarUsuario(usuarioId);
                                                }
                                            });
                                    }

                                    function eliminarUsuario(usuarioId) {
                                        console.log(usuarioId);
                                        fetch(`http://104.197.54.121/backend/hoteles/${usuarioId}`, {
                                                method: 'DELETE'
                                            })
                                            .then(response => {
                                                if (response.ok) {
                                                    Swal.fire("hotel eliminado", "El hotel ha sido eliminado exitosamente.", "success")
                                                        .then(() => {
                                                            // Aquí puedes recargar la página o eliminar la fila de la tabla
                                                            location.reload(); // Recarga la página para actualizar la lista
                                                        });
                                                } else {
                                                    Swal.fire("Error", "No se pudo eliminar el hotel. Intenta nuevamente.", "error");
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire("Error", "Ocurrió un error. Intenta nuevamente.", "error");
                                            });
                                    }

                                    function editarUsuario(hotel) {
                                        // Crear el formulario de edición
                                        const formHtml = `
        <form id="editForm">
            <input type="hidden"  name="id" value="${hotel.id}">
            <div class="pb-2">
                <label>Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="${hotel.nombre}" required>
            </div>
            <div class="pb-2">
                <label>Direccion:</label>
                <input type="email" class="form-control"  name="direccion" value="${hotel.direccion}" required>
            </div>
            <div class="pb-2">
                <label>Teléfono:</label>
                <input type="text"  class="form-control" name="telefono" value="${hotel.telefono}" required>
            </div>
            <div class="pb-2">
                <label>Estado:</label>
                <select  class="form-control" name="estado" required>
                    <option value="1" ${hotel.estado === '1' ? 'selected' : ''}>Activo</option>
                    <option value="0" ${hotel.estado === '0' ? 'selected' : ''}>Inactivo</option>
                </select>
            </div>
        </form>
    `;

                                        Swal.fire({
                                            title: "Editar hotel",
                                            html: formHtml,
                                            showCancelButton: true,

                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Editar hotel",

                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                const formData = new FormData(document.getElementById('editForm'));
                                                const data = {};
                                                formData.forEach((value, key) => {
                                                    data[key] = value;
                                                });
                                                actualizarUsuario(data);
                                            }
                                        });
                                    }

                                    function actualizarUsuario(data) {
                                        fetch(`http://104.197.54.121/backend/hoteles/${data.id}`, {
                                                method: 'PUT', // O 'PATCH' según tu API
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                },
                                                body: JSON.stringify(data),
                                            })
                                            .then(response => {
                                                if (response.ok) {
                                                    Swal.fire("hotel actualizado", "El hotel ha sido actualizado exitosamente.", "success")
                                                        .then(() => location.reload());
                                                } else {
                                                    Swal.fire("Error", "No se pudo actualizar el hotel. Intenta nuevamente.", "error");
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire("Error", "Ocurrió un error. Intenta nuevamente.", "error");
                                            });
                                    }
                                </script>
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
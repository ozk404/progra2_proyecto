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
    <title>Habitaciones - Hotel Mariano Gálvez</title>

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

                        <li class="active has-sub">
                            <a href="/habitaciones.php">
                                <i class="fas fa-home"></i>Menu Habitaciones</a>
                        </li>
                        <li>
                            <a href="/tipohabitaciones.php">
                                <i class="fas fa-home"></i>Menu Tipo de Habitacion</a>
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
                            <h1>Bienvenido al menú de Habitaciones</h1>
                            <h5>Aquí puede gestionar (crear, editar, eliminar) todo lo relacionado con Habitaciones del sistema</h5>
                            <br>
                            <a href="crear-habitacion.php">Crear una nueva habitación </a>
                            <br>
                        </div>
                        <?php
                        $usuariosJson = file_get_contents('http://127.0.0.1/backend/habitaciones');
                        $habitaciones = json_decode($usuariosJson, true);

                        ?>
                        <div class="row">
                            <div class="container mt-5">
                                <h2>Lista de Habitaciones</h2>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Número</th>
                                            <th>Hotel</th>
                                            <th>Tipo de Habitación</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($habitaciones)): ?>
                                            <?php foreach ($habitaciones as $habitacion): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($habitacion['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($habitacion['numero']); ?></td>
                                                    <td><?php echo htmlspecialchars($habitacion['id_hotel']); ?></td>
                                                    <td><?php echo htmlspecialchars($habitacion['id_tipo_habitacion']); ?></td>
                                                    <td><?php echo htmlspecialchars($habitacion['estado']); ?></td>

                                                    <td>
                                                        <button class="btn btn-info btn-sm" onclick="verDetalles(<?php echo htmlspecialchars(json_encode($habitacion)); ?>)">Ver Detalles</button>
                                                        <button class="btn btn-warning btn-sm" onclick="editarUsuario(<?php echo htmlspecialchars(json_encode($habitacion)); ?>)">Editar</button>
                                                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(<?php echo htmlspecialchars($habitacion['id']); ?>)">Eliminar</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No hay habitaciones disponibles.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <script>
                                    function verDetalles(habitacion) {
                                        Swal.fire({
                                            title: "Detalles del Habitación",
                                            html: "numero: " + habitacion.numero + "<br>" +
                                                "id_hotel: " + habitacion.id_hotel + "<br>" +
                                                "id_tipo_habitacion: " + habitacion.id_tipo_habitacion + "<br>" +
                                                "estado: " + habitacion.estado,
                                            icon: "info",
                                            buttons: true,
                                        });
                                    }

                                    function confirmarEliminacion(usuarioId) {
                                        Swal.fire({
                                                title: "¿Estás seguro?",
                                                text: "Una vez eliminado, no podrás recuperar este habitacion.",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Borrar habitacion!",
                                            })
                                            .then((result) => {
                                                if (result.isConfirmed) {
                                                    eliminarUsuario(usuarioId);
                                                }
                                            });
                                    }

                                    function eliminarUsuario(usuarioId) {
                                        console.log(usuarioId);
                                        fetch(`http://127.0.0.1/backend/habitaciones/${usuarioId}`, {
                                                method: 'DELETE'
                                            })
                                            .then(response => {
                                                if (response.ok) {
                                                    Swal.fire("habitacion eliminado", "El habitacion ha sido eliminado exitosamente.", "success")
                                                        .then(() => {
                                                            // Aquí puedes recargar la página o eliminar la fila de la tabla
                                                            location.reload(); // Recarga la página para actualizar la lista
                                                        });
                                                } else {
                                                    Swal.fire("Error", "No se pudo eliminar el habitacion. Intenta nuevamente.", "error");
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire("Error", "Ocurrió un error. Intenta nuevamente.", "error");
                                            });
                                    }

                                    function editarUsuario(habitacion) {
                                        // Crear el formulario de edición
                                        const formHtml = `
        <form id="editForm">
            <input type="hidden"  name="id" value="${habitacion.id}">
            <div class="pb-2">
                <label>Numero:</label>
                <input type="number" class="form-control" name="numero" value="${habitacion.numero}" required>
            </div>
            <div class="pb-2">
                <label>Seleccionar Hotel:</label>
                <select id="id_hotel" name="id_hotel" required class="form-select">
                    <option value="" disabled>Seleccione un hotel</option>
                    <!-- Las opciones se llenarán mediante JavaScript -->
                </select>
            </div>
            <div class="pb-2">
                <label>Seleccionar Tipo de Habitación:</label>
                <select id="id_tipo_habitacion" name="id_tipo_habitacion" required class="form-select">
                    <option value="" disabled>Seleccione un tipo de habitación</option>
                    <!-- Las opciones se llenarán mediante JavaScript -->
                </select>
            </div>

            <div class="pb-2">
                <label>Estado:</label>
                <input type="text"  class="form-control" name="estado" value="${habitacion.estado}" required>
            </div>

        </form>
    `;
                                        // Obtener la lista de hoteles
                                        fetch('http://localhost/backend/hoteles')
                                            .then(response => response.json())
                                            .then(data => {
                                                const hotelSelect = document.getElementById('id_hotel');
                                                data.forEach(hotel => {
                                                    const option = document.createElement('option');
                                                    option.value = hotel.id; // Asumiendo que el objeto hotel tiene una propiedad 'id'
                                                    option.textContent = hotel.nombre; // Asumiendo que el objeto hotel tiene una propiedad 'nombre'

                                                    // Marcar el hotel actual del empleado como seleccionado
                                                    if (hotel.id === habitacion.id_hotel) {
                                                        option.selected = true;
                                                    }

                                                    hotelSelect.appendChild(option);
                                                });
                                            })
                                            .catch(error => {
                                                console.error('Error al obtener los hoteles:', error);
                                                Swal.fire("Error", "No se pudo cargar la lista de hoteles.", "error");
                                            });

                                        fetch('http://localhost/backend/tipo_habitacion')
                                            .then(response => response.json())
                                            .then(data => {
                                                const hotelSelect = document.getElementById('id_tipo_habitacion');
                                                data.forEach(tipo_habitacion => {
                                                    const option = document.createElement('option');
                                                    option.value = tipo_habitacion.id; // Asumiendo que el objeto tipo_habitacion tiene una propiedad 'id'
                                                    option.textContent = tipo_habitacion.nombre; // Asumiendo que el objeto tipo_habitacion tiene una propiedad 'nombre'

                                                    // Marcar el tipo_habitacion actual del empleado como seleccionado
                                                    if (tipo_habitacion.id === habitacion.id_hotel) {
                                                        option.selected = true;
                                                    }

                                                    hotelSelect.appendChild(option);
                                                });
                                            })
                                            .catch(error => {
                                                console.error('Error al obtener los hoteles:', error);
                                                Swal.fire("Error", "No se pudo cargar la lista de hoteles.", "error");
                                            });

                                        Swal.fire({
                                            title: "Editar habitacion",
                                            html: formHtml,
                                            showCancelButton: true,

                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Editar habitacion",

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
                                        fetch(`http://127.0.0.1/backend/habitaciones/${data.id}`, {
                                                method: 'PUT', // O 'PATCH' según tu API
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                },
                                                body: JSON.stringify(data),
                                            })
                                            .then(response => {
                                                if (response.ok) {
                                                    Swal.fire("habitacion actualizado", "El habitacion ha sido actualizado exitosamente.", "success")
                                                        .then(() => location.reload());
                                                } else {
                                                    Swal.fire("Error", "No se pudo actualizar el habitacion. Intenta nuevamente.", "error");
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
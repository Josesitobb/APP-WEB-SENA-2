<?php
session_start();

// Verificar si la sesión está iniciada y la variable de sesión está definida
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}

// Obtener el ID del cliente desde la sesión
$id_cliente = $_SESSION['user_id'];

// Incluir archivos de configuración y conexión a la base de datos
include('config/db.php');
require('config/config.php');

$sql_citas = "SELECT Citas.Id_Citas, Citas.start, Citas.end, Clientes.Id_Clientes, CONCAT(Usuarios_Clientes.Nombre_Usuarios, ' ', Usuarios_Clientes.Apellido_Usuarios) AS Nombre_Cliente, Estilistas.Id_Estilistas, CONCAT(Usuarios_Estilistas.Nombre_Usuarios, ' ', Usuarios_Estilistas.Apellido_Usuarios) AS Nombre_Estilista, Servicios.Id_Servicios, Servicios.Nombre_Servicios, Servicios.Valor_Servicios AS Precio_Servicio 
FROM Citas 
INNER JOIN Clientes ON Citas.Id_Clientes = Clientes.Id_Clientes 
INNER JOIN Usuarios AS Usuarios_Clientes ON Clientes.Id_Usuarios = Usuarios_Clientes.Id_Usuarios 
INNER JOIN Estilistas ON Citas.Id_Estilistas = Estilistas.Id_Estilistas 
INNER JOIN Usuarios AS Usuarios_Estilistas ON Estilistas.Id_Usuarios = Usuarios_Estilistas.Id_Usuarios 
INNER JOIN Servicios ON Citas.Id_Servicios = Servicios.Id_Servicios
WHERE Clientes.Id_Usuarios = ?"; // Filtrar por el id_cliente

// Preparar la consulta
$stmt = $conn->prepare($sql_citas);

// Enlazar parámetros
$stmt->bind_param("i", $id_cliente);

// Ejecutar consulta de citas
$stmt->execute();

// Obtener resultados de la consulta
$resultado_citas = $stmt->get_result();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SGCITAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon1.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para centrar la tabla */
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
    </style>
   <style>
    /* Estilos para el modal */
    .modal {
        display: none; /* Por defecto, el modal está oculto */
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%; /* Ancho del modal */
        max-width: 500px; /* Ancho máximo del modal */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
    }

    .modal-content h2 {
        margin-top: 0; /* Eliminar margen superior del título */
    }

    .modal-content label {
        display: block;
        margin-bottom: 10px;
    }

    .modal-content input[type="text"],
    .modal-content input[type="submit"] {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .modal-content input[type="submit"] {
        background-color: #4caf50;
        color: white;
        border: none;
        cursor: pointer;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .modal-content {
            margin: 20px auto;
            width: 95%;
        }
    }
</style>
<style>
    /* Estilos para el botón Guardar cambios */
    .modal-content input[type="submit"] {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #ff69b4; /* Cambiar el color de fondo a rosado */
        color: white; /* Color del texto */
        cursor: pointer;
    }
</style>
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="../admin/theme/page-login.php">Iniciar sesión</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="../admin/theme/page-register.php">Registrarse</a>
 
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="./index.php" class="nav-item nav-link active">Inicio</a>
                        <!-- <a href="./about.php" class="nav-item nav-link">Nosotros</a> -->
                        <a href="./product.php" class="nav-item nav-link">Productos</a>
                    </div>
                    <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="./service.php" class="nav-item nav-link">Servicios</a>
                        <a href="./citas.php" class="nav-item nav-link">Citas</a>
                        <a href="gallery.php" class="nav-item nav-link">Galeria</a>
                        <!-- <a href="./contact.php" class="nav-item nav-link">Contactenos</a> -->
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Citas</h1>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <center>
        <h1>Citas</h1>
    </center>
    <div class="container table-container" id="table-container">
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Nombre Estilista</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_cita = $resultado_citas->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row_cita['Nombre_Servicios']; ?></td>
                        <td><?php echo $row_cita['Nombre_Estilista']; ?></td>
                        <td><?php echo '$' . $row_cita['Precio_Servicio']; ?></td>
                        <td><?php echo $row_cita['start']; ?></td>
                        <td>
                        <button class="btn-editar" data-id="<?php echo $row_cita['Id_Citas']; ?>" data-nombre-estilista="<?php echo $row_cita['Nombre_Estilista']; ?>" data-nombre-servicio="<?php echo $row_cita['Nombre_Servicios']; ?>" data-precio="<?php echo $row_cita['Precio_Servicio']; ?>" data-fecha="<?php echo $row_cita['start']; ?>">Editar</button>

    <button>Inactivar</button>
</td>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>

                    <a class="btn btn-outline-secondary btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Ubicación</h5>
                            <p class="mb-2">Cra 11 #180a-9, 110141 Bogotá</p>
                            <p class="mb-0">+57 322 4014764</p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Horarios</h5>
                            <p class="mb-2">Lun – Vie, 8AM – 8PM</p>
                            <p class="mb-0">Sab – Dom, 9AM – 4PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">&copy; <a href="#"></a>Estamos aquí para servirte<a href=""></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>
   <!-- MODAL -->
<div id="modalEditarCita" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Cita</h2>
        <!-- Formulario de edición de detalles -->
        <form id="formEditarCita">
            <!-- Campos para mostrar detalles de la cita -->
            <label for="edit-nombre-estilista">Nombre del Estilista:</label>
            <input type="text" id="edit-nombre-estilista" name="nombre_estilista" readonly>
            <label for="edit-nombre-servicio">Nombre del Servicio:</label>
            <input type="text" id="edit-nombre-servicio" name="nombre_servicio" readonly>
            <label for="edit-precio">Precio:</label>
            <input type="text" id="edit-precio" name="precio" readonly>
            <label for="edit-fecha">Fecha:</label>
            <input type="text" id="edit-fecha" name="fecha" readonly>
            <!-- Campo oculto para almacenar el ID de la cita -->
            <input type="hidden" id="edit-id-cita" name="id_cita" value="">
            <input type="submit" value="Guardar cambios">
        </form>
    </div>
</div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
    // Obtener el modal
    var modal = document.getElementById("modalEditarCita");

    // Obtener el botón que abre el modal
    var btnsEditar = document.getElementsByClassName("btn-editar");

    // Obtener el elemento span que cierra el modal
    var span = document.getElementsByClassName("close")[0];

    // Cuando el usuario haga clic en un botón de "Editar", abrir el modal y llenar los campos con los detalles de la cita
    for (var i = 0; i < btnsEditar.length; i++) {
        btnsEditar[i].onclick = function() {
            modal.style.display = "block";
            // Obtener los detalles de la cita desde los atributos de datos del botón
            var idCita = this.getAttribute("data-id");
            var nombreEstilista = this.getAttribute("data-nombre-estilista");
            var nombreServicio = this.getAttribute("data-nombre-servicio");
            var precio = this.getAttribute("data-precio");
            var fecha = this.getAttribute("data-fecha");
            // Llenar los campos del formulario en el modal con los detalles de la cita
            document.getElementById("edit-id-cita").value = idCita;
            document.getElementById("edit-nombre-estilista").value = nombreEstilista;
            document.getElementById("edit-nombre-servicio").value = nombreServicio;
            document.getElementById("edit-precio").value = precio;
            document.getElementById("edit-fecha").value = fecha;
        }
    }

    // Cuando el usuario haga clic en el botón de cierre (x), cerrar el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario haga clic fuera del modal, cerrar el modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Manejar el envío del formulario de edición
    document.getElementById("formEditarCita").onsubmit = function(event) {
        event.preventDefault();
        // Enviar datos del formulario a editar_cita.php usando AJAX
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "editar_cita.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
            
                window.location.href = "citas.php";
            }
        };
        xhr.send(formData);
    };
</script>

    
    
</body>

</html>
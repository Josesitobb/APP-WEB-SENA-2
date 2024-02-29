<?php
session_start();

// Verificar si la sesión está iniciada y la variable de sesión está definida
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}

// Obtener el ID del cliente desde la sesión
if (isset($_SESSION['client_id'])) {
    $id_cliente = $_SESSION['client_id'];
} else {
    // Manejar el caso en que el ID del cliente no esté definido en la sesión
    // Puedes redirigir a otra página de error o mostrar un mensaje al usuario
    echo "ID del cliente no encontrado en la sesión.";
    exit();
}

// Imprimir la ID del cliente
echo "La ID del cliente es: " . $id_cliente;



// Incluir archivos de configuración y conexión a la base de datos
include('config/db.php');
require('config/config.php');

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta SQL para obtener citas del cliente
$sql_citas = "SELECT Citas.Id_Citas, Citas.start, Citas.end, Clientes.Id_Clientes, CONCAT(Usuarios_Clientes.Nombre_Usuarios, ' ', Usuarios_Clientes.Apellido_Usuarios) AS Nombre_Cliente, Estilistas.Id_Estilistas, CONCAT(Usuarios_Estilistas.Nombre_Usuarios, ' ', Usuarios_Estilistas.Apellido_Usuarios) AS Nombre_Estilista, Servicios.Id_Servicios, Servicios.Nombre_Servicios, Servicios.Valor_Servicios AS Precio_Servicio 
FROM Citas 
INNER JOIN Clientes ON Citas.Id_Clientes = Clientes.Id_Clientes 
INNER JOIN Usuarios AS Usuarios_Clientes ON Clientes.Id_Usuarios = Usuarios_Clientes.Id_Usuarios 
INNER JOIN Estilistas ON Citas.Id_Estilistas = Estilistas.Id_Estilistas 
INNER JOIN Usuarios AS Usuarios_Estilistas ON Estilistas.Id_Usuarios = Usuarios_Estilistas.Id_Usuarios 
INNER JOIN Servicios ON Citas.Id_Servicios = Servicios.Id_Servicios
WHERE Clientes.Id_Clientes = ? AND Citas.activo = 1"; 

// Preparar la consulta
$stmt = $conn->prepare($sql_citas);
if (!$stmt) {
    // Manejar el error de preparación de consulta
    echo "Error al preparar la consulta: " . $conn->error;
    exit();
}

// Enlazar parámetros
$stmt->bind_param("i", $id_cliente);

// Ejecutar consulta de citas
if (!$stmt->execute()) {
    // Manejar el error de ejecución de consulta
    echo "Error al ejecutar la consulta: " . $stmt->error;
    exit();
}


$resultado_citas = $stmt->get_result();


$stmt->close();
$conn->close();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SGCITAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <!-- NOSE QUE MONDA ES ESTO -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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


        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
    </style>
   <style>
   
    .modal {
        display: none; 
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%; 
        max-width: 500px; 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-content h2 {
        margin-top: 0; 
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
            <button class="btn-editar" 
                    data-id="<?php echo $row_cita['Id_Citas']; ?>"
                    data-nombre-estilista="<?php echo $row_cita['Nombre_Estilista']; ?>"
                    data-nombre-servicio="<?php echo $row_cita['Nombre_Servicios']; ?>"
                    data-precio="<?php echo $row_cita['Precio_Servicio']; ?>"
                    data-fecha="<?php echo $row_cita['start']; ?>">Editar</button>
                 
                 <button class="btn-inactivar" data-id="<?php echo $row_cita['Id_Citas']; ?>">Cancelar cita</button>
</td>
        </td>
    </tr>
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



   <?php
// Incluir archivos de configuración y conexión a la base de datos
include('config/db.php');



// Consulta SQL para obtener todos los estilistas
$sql_estilistas = "SELECT Estilistas.Id_Estilistas, usuarios.Nombre_Usuarios
FROM Estilistas
INNER JOIN usuarios ON Estilistas.Id_Usuarios = usuarios.Id_Usuarios";
$resultado_estilistas = $conn->query($sql_estilistas);

// Consulta SQL para obtener todos los servicios
$sql_servicios = "SELECT * FROM `Servicios` ";
$resultado_servicios = $conn->query($sql_servicios);


?>
<div id="modalEditarCita" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Cita</h2>
        <!-- Formulario de edición de detalles -->
        <form id="formEditarCita">
            <!-- Campos para mostrar detalles de la cita -->
            <input type="hidden" id="id_estilista" name="id_estilista" value="<?php echo $row_cita['Id_Estilistas']; ?>">

<div class="form-group">
    <label for="edit-estilista">Estilista:</label>
    <select class="form-control" id="edit-estilista" name="estilista">
        <?php while ($row_estilista = $resultado_estilistas->fetch_assoc()) { ?>
            <option value="<?php echo $row_estilista['Id_Estilistas']; ?>">
                <?php echo $row_estilista['Nombre_Usuarios']; ?>
            </option>
        <?php } ?>
    </select>
</div>

            <div class="form-group">
                <label for="edit-servicio">Servicio:</label>
                <input type="hidden" id="id_servicio" name="id_servicio" value="<?php echo $row_cita['Id_Servicios']; ?>">

<select class="form-control" id="edit-servicio" name="servicio">
    <?php while ($row_servicio = $resultado_servicios->fetch_assoc()) { ?>
        <option value="<?php echo $row_servicio['Id_Servicios']; ?>" data-precio="<?php echo $row_servicio['Valor_Servicios']; ?>">
            <?php echo $row_servicio['Nombre_Servicios']; ?>
        </option>
    <?php } ?>
</select>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-precio">Precio:</label>
                <input type="text" class="form-control" id="edit-precio" name="precio" readonly>
            </div>

            <input type="hidden" id="fecha_hora" name="fecha_hora" value="">

<div class="form-group">
    <label for="edit-fecha">Fecha y Hora:</label>
    <input type="text" class="form-control" id="edit-fecha" name="fecha">
</div>

            <!-- Campo oculto para almacenar el ID de la cita -->
            <input type="hidden" id="edit-id-cita" name="id_cita" value="">

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
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

        // Obtener el elemento select para el estilista
        var estilistaSelect = document.getElementById("edit-estilista");
        // Buscar la opción que coincide con el nombre del estilista y establecerla como seleccionada
        for (var j = 0; j < estilistaSelect.options.length; j++) {
            if (estilistaSelect.options[j].text === nombreEstilista) {
                estilistaSelect.options[j].selected = true;
                break;
            }
        }

        // Obtener el elemento select para el servicio
        var servicioSelect = document.getElementById("edit-servicio");
        // Buscar la opción que coincide con el nombre del servicio y establecerla como seleccionada
        for (var k = 0; k < servicioSelect.options.length; k++) {
            if (servicioSelect.options[k].text === nombreServicio) {
                servicioSelect.options[k].selected = true;
                break;
            }
        }

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

document.getElementById("formEditarCita").onsubmit = function(event) {
    event.preventDefault();

    // Obtener el ID del cliente desde la sesión (suponiendo que $id_cliente está disponible aquí)
    var idCliente = <?php echo $id_cliente; ?>;

    // Obtener valores de los campos
    var idServicio = document.getElementById("edit-servicio").value;
    var idEstilista = document.getElementById("edit-estilista").value;
    var fechaHora = document.getElementById("edit-fecha").value;
    var idCita = document.getElementById("edit-id-cita").value;

    // Crear objeto FormData
    var formData = new FormData();
    formData.append('id_cliente', idCliente); // Agregar el ID del cliente al formData
    formData.append('id_servicio', idServicio);
    formData.append('id_estilista', idEstilista);
    formData.append('fecha_hora', fechaHora);
    formData.append('id_cita', idCita);

    // Crear y enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "editar_cita.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Mostrar una alerta cuando la cita se ha editado con éxito
            alert("La cita se ha editado correctamente.");
            // Redirigir a la página de citas
            // window.location.href = "citas.php";
        }
    };
    xhr.send(formData);
};

</script>
<script>
// JavaScript para actualizar el precio del servicio automáticamente
document.addEventListener("DOMContentLoaded", function() {
    var servicioSelect = document.getElementById("edit-servicio");

    servicioSelect.addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        var precio = selectedOption.getAttribute("data-precio");

        document.getElementById("edit-precio").value = precio;
    });
});
</script>
<script>
    flatpickr("#edit-fecha", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
</script>


<script>
    // JavaScript para inactivar citas
document.addEventListener("DOMContentLoaded", function() {
    // Capturar el evento de clic del botón "Inactivar"
    var buttonsInactivar = document.querySelectorAll('.btn-inactivar');
    buttonsInactivar.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener la ID de la cita desde el atributo "data-id" del botón
            var citaId = button.getAttribute('data-id');

            // Crear objeto FormData con la ID de la cita
            var formData = new FormData();
            formData.append('cita_id', citaId);

            // Crear y enviar la solicitud AJAX al archivo PHP
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'inactivar_cita.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Manejar la respuesta del servidor si es necesario
                    alert('La cita se ha marcado como inactiva.');
                    // Actualizar la página o realizar otras acciones según sea necesario
                }
            };
            xhr.send(formData);
        });
    });
});

</script>


</body>

</html>
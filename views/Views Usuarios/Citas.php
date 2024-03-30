<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

// // Imprimir la ID del cliente
// echo "La ID del cliente es: " . $id_cliente;

$nombre_usuario = $_SESSION['username'];

// Incluir archivos de configuración y conexión a la base de datos


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
    <link rel="icon" href="../../views/SG.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../views/Views Usuarios/css/style.css" rel="stylesheet">
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

 <div class="container-fluid bg-primary py-3 d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                <h6>Bienvenido <?php echo $nombre_usuario; ?></h6>

                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                <a class="text-white px-3" href="https://www.facebook.com/profile.php?id=100083475433076&mibextid=rS40aB7S9Ucbxw6v">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="https://www.instagram.com/espejismosycolor?igsh=MTUwazNnenQ4dm53OA==">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <a class="text-white px-3" href="./cerrar_Sesion.php">
                        <i class="fas fa-sign-out-alt"></i> <!-- Ícono de salida -->
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    
<?php include('Model/header.php'); ?>

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



   <!-- MODAL -->



   <?php
// Incluir archivos de configuración y conexión a la base de datos
include('../../controllers/db.php');




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



<?php include('Model/footer.php'); ?>
 
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
    xhr.open("POST", "../../Modelos/Usuarios/Editar_Cita.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Mostrar una alerta cuando la cita se ha editado con éxito
            alert("La cita se ha editado correctamente.");
            
            setTimeout(function() {
            window.location.reload();
        }, 1000);
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
            xhr.open('POST', '../../Modelos/Usuarios/Inactivar_Cita.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Manejar la respuesta del servidor si es necesario
                    alert('La cita se ha marcado como inactiva.');
                    setTimeout(function() {
            window.location.reload();
        }, 1000);
    }
};
xhr.send(formData);
        });
    });
});

</script>


</body>

</html>
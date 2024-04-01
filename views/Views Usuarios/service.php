<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la sesión está iniciada y la variable de sesión está definida
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location:../../controllers/principal.php?action=sesion?");
    exit();
}

// Obtener el ID del cliente desde la sesión (asegúrate de haber inicializado $_SESSION['user_id'] en algún lugar)
$id_cliente = $_SESSION['user_id'];

// Imprimir la ID del usuario almacenada en la sesión
// echo "Bienvenido, tu ID de usuario es: " . $_SESSION['user_id'];



// Obtener el ID del cliente desde la sesión
$id_cliente = $_SESSION['client_id'];

// Imprimir la ID del cliente
// echo "La ID del cliente es: " . $id_cliente;

$nombre_usuario = $_SESSION['username'];
// Incluir archivos de configuración y conexión a la base de datos
include('../../Modelos/Usuarios/config/config.php');
// Consulta SQL para obtener información de servicios
$sql_servicios = "SELECT Id_Servicios, Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios FROM servicios";

// Ejecutar consulta de servicios
$resultado = mysqli_query($conn, $sql_servicios);

// Consulta SQL para obtener información de estilistas
$sql_estilistas = "SELECT e.Id_Estilistas, u.Nombre_Usuarios 
FROM Usuarios u 
INNER JOIN Estilistas e ON u.Id_Usuarios = e.Id_Usuarios";

// Ejecutar consulta de estilistas
$resultado_estilistas = mysqli_query($conn, $sql_estilistas);

// Verificar si la consulta de estilistas fue exitosa
if (!$resultado_estilistas) {
    echo "Error al obtener la información de los estilistas: " . mysqli_error($conn);
}
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

    
</head>

<body>
    
    <!-- Topbar Start -->
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
                    <a class="text-white px-3" href="user_data.php?action=cerrarsesion">
                        <i class="fas fa-sign-out-alt"></i> <!-- Ícono de salida -->
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Topbar End -->

    <?php include('Model/header.php'); ?>


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Servicios</h1>
        </div>
    </div>
    <!-- Header End -->


 <!-- Products Start -->
 <div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="section-title position-relative text-center mb-5">Tu mejor versión</h1>
            </div>
        </div>
        <div class="row">
            <?php foreach ($resultado as $row) { ?>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                        <div class="bg-primary mt-n5 py-3" style="">
                            <h4 class="font-weight-bold text-white mb-0">$<?php echo $row['Valor_Servicios']; ?></h4>
                        </div>
                        <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                        <?php
                            $imagen_base64 = base64_encode($row['Imagen_Servicios']);
                            $imagen_src = 'data:image/png;base64,' . $imagen_base64;
                            ?>
                            <img class="rounded-circle w-100 h-100" src="<?php echo $imagen_src; ?>" alt="<?php echo $row['Nombre_Servicios']; ?>">
                        </div>
                        <h5 class="font-weight-bold mb-4"><?php echo $row['Nombre_Servicios']; ?></h5>
                        <br>
                        <a href="user_data.php?action=infoservicios&Id_Servicios=<?php echo $row['Id_Servicios']; ?>&token=<?php echo hash_hmac('sha1', $row['Id_Servicios'], KEY_TOKEN); ?>#detalle_<?php echo $row['Id_Servicios']; ?>" class="btn btn-sm btn-secondary">Detalle</a>

                        <a href="#" class="btn btn-sm btn-secondary open-modal" data-toggle="modal" data-target="#citaModal" data-id="<?php echo $row['Id_Servicios']; ?>" data-nombre="<?php echo $row['Nombre_Servicios']; ?>" data-precio="<?php echo $row['Valor_Servicios']; ?>">Agregar cita</a>
                    </div>
                </div>
            <?php } ?>
        </div>
      
    </div>
</div>



    
    


<!-- Modal -->
<div id="citaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Cita</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="servicio">Servicio:</label>
                    <input type="text" class="form-control" id="servicio" readonly>
                </div>
                <div class="form-group">
                    <label for="estilista">Estilista:</label>
                    <select class="form-control" id="estilista">
                        <?php
                        while ($row_estilista = mysqli_fetch_assoc($resultado_estilistas)) {
                            echo '<option value="' . $row_estilista['Id_Estilistas'] . '" data-nombre="' . $row_estilista['Nombre_Usuarios'] . '">' . $row_estilista['Nombre_Usuarios'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha">
                </div>
                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="time" class="form-control" id="hora">
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="text" class="form-control" id="precio" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="confirmarCitaBtn" class="btn btn-primary">Confirmar Cita</button>
                <input type="hidden" id="idServicio">
            </div>
        </div>
    </div>
</div>








    
<?php include('Model/footer.php'); ?>

</script>
<script>
$(document).ready(function() {
    $('.open-modal').click(function() {
        var servicioId = $(this).data('id');
        var servicioNombre = $(this).data('nombre');
        var servicioPrecio = $(this).data('precio');

        $('#idServicio').val(servicioId);
        $('#servicio').val(servicioNombre);
        $('#precio').val('$' + servicioPrecio); // Agregar el signo de dólar antes del precio
    });

    $('#confirmarCitaBtn').click(function() {
        // Obtener los valores de los campos del formulario
        var servicioId = $('#idServicio').val();
        var estilistaId = $('#estilista').val(); // Obtener la ID del estilista seleccionado
        var estilistaNombre = $('#estilista option:selected').data('nombre'); // Obtener el nombre del estilista seleccionado
        var fecha = $('#fecha').val();
        var hora = $('#hora').val();
        var clienteId = "<?php echo $id_cliente; ?>"; // Obtener el ID del cliente desde PHP
        
        // Enviar los datos del formulario a través de una solicitud AJAX
        $.ajax({
            url: '../../Modelos/Usuarios/Agregarcita.php',
            type: 'POST',
            data: {
                servicioId: servicioId, // Agregar el ID del servicio
                estilistaId: estilistaId, // Agregar el ID del estilista seleccionado
                estilistaNombre: estilistaNombre, // Agregar el nombre del estilista seleccionado
                fecha: fecha,
                hora: hora,
                clienteId: clienteId // Esta es la ID del cliente, asegúrate de que sea correcta
            },
            success: function(response) {
                // Mostrar mensaje recibido desde PHP
                alert(response);
                // Cerrar el modal después de mostrar el mensaje
                $('#citaModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Mostrar mensaje de error genérico
                alert('Error al programar la cita. Por favor, inténtelo de nuevo.');
            }
        });
    });
});
</script>






</body>

</html>
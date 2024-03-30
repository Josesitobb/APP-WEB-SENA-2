<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config/db.php');
require('config/config.php');

// Verificar si el parámetro Id_Servicios está presente en la URL
if (isset($_GET['Id_Servicios'])) {
    // Obtener el Id_Servicios de la URL
    $id_servicio = $_GET['Id_Servicios'];

    // Consulta SQL para obtener los detalles del servicio
    $sql = "SELECT * FROM servicios WHERE Id_Servicios = $id_servicio";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontraron resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obtener los detalles del servicio y mostrarlos
        $servicio = mysqli_fetch_assoc($resultado);
?>


<?php
    } else {
        // Manejar el caso donde no se encontró el servicio
        echo "No se encontró el servicio.";
        header("Location: index.php");
        exit(); 
    }
} else {
    // Manejar el caso donde el parámetro Id_Servicios no está presente en la URL
    echo "Error: ID de servicio no especificado.";
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
    <link href="../../views/Views Usuarios/css/style.css" rel="stylesheet">
    <style>
/* Estilo para el modal */
.modal {
  display: none; /* Ocultar el modal por defecto */
  position: fixed; /* Posición fija para que el modal permanezca en la misma posición al hacer scroll */
  z-index: 1000; /* Z-index alto para que el modal esté sobre otros elementos */
  left: 0;
  top: 0;
  width: 100%; /* Ancho del modal */
  height: 100%; /* Altura del modal */
  overflow: auto; /* Habilitar el desplazamiento si el contenido del modal es demasiado grande */
  background-color: rgba(0, 0, 0, 0.4); /* Fondo semi-transparente */
}

/* Estilo para el contenido del modal */
.modal-content {
  background-color: #fefefe; /* Fondo blanco */
  margin: 15% auto; /* Margen superior e inferior automático para centrar verticalmente */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Ancho del contenido del modal */
}

/* Estilo para el botón de cerrar */
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

    
    <?php include('../../views/Views Usuarios/Model/header.php'); ?> 
  

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Servicios</h1>
        </div>
    </div>
    <!-- Header End -->
 

<!-- Contenido de los detalles del producto -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <?php foreach ($resultado as $row) { ?>
            <div id="detalle_<?php echo $row['Id_Servicios']; ?>">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h1 class="section-title position-relative text-center mb-5"><?php echo $row['Nombre_Servicios']; ?></h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 order-md-1 text-center">
                        <?php
                        // Verifica si la columna Imagen_Servicios contiene datos binarios
                        if (!empty($row['Imagen_Servicios'])) {
                            $imagenBase64 = base64_encode($row['Imagen_Servicios']);
                            $imagenTipo = pathinfo($row['Nombre_Servicios'], PATHINFO_EXTENSION);
                            $imagenSrc = 'data:image/' . $imagenTipo . ';base64,' . $imagenBase64;
                            echo '<img src="' . $imagenSrc . '" alt="' . $row['Nombre_Servicios'] . '" width="500" height="500">';
                        } else {
                            echo '<p>Imagen no disponible</p>';
                        }
                        ?>
                    </div>

                    <div class="col-md-6 order-md-2 text-center">
                        <h2><?php echo MONEDA . number_format($row['Valor_Servicios'], 2, '.', ','); ?></h2>
                        <p><?php echo $row['Descripcion_Servicios']; ?></p>
                        <div class="d-grid gap-3 col-10 mx-auto">

                        <!-- <a href="#" class="btn btn-primary btn-agendar-cita">Agendar Cita</a> -->

                        <a href="index.php" class="btn btn-primary">Volver Al inicio</a>

                 
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

    <!-- Products End -->


    <?php include('../../views/Views Usuarios/Model/footer.php'); ?> 




</body>

</html>
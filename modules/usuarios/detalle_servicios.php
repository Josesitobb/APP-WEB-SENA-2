<?php
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
    <link href="css/style.css" rel="stylesheet">
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
                    <a href="index.php" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="./service.php" class="nav-item nav-link">Servicios</a>
                        <a href="gallery.php" class="nav-item nav-link">Galeria</a>
                    
                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->   

  

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
    function addProducto(id, token) {
    let url = 'clases/carrito_Productos.php';
    let formData = new FormData();
    formData.append('Id_Productos', id);
    formData.append('token', token);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors' 
    }).then(response => response.json())
      .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart");
            elemento.innerHTML = data.numero;
          }
      });
}


    </script>



</body>

</html>
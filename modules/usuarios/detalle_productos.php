<?php
// Verificar si el parámetro Id_Productos está presente en la URL
if (isset($_GET['Id_Productos'])) {
    // Obtener el Id_Productos de la URL
    $id_producto = $_GET['Id_Productos'];

    // Incluir el archivo de configuración de la base de datos
    include('config/db.php');

    // Consulta SQL para obtener los detalles del producto
    $sql = "SELECT * FROM productos WHERE Id_Productos = $id_producto";

    // Ejecutar la consulta
    $resultado = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Obtener el detalle del producto y mostrarlo
        $producto = $resultado->fetch_assoc();
        $imagenDecodificada = base64_decode($producto['Imagen_Productos']);
        ?>
       
        <?php
    } else {
        // Manejar el caso donde no se encontró el producto
        echo '<script>alert("No se encontró el producto.");</script>';
        header("Location: index.php");
        exit(); 
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Manejar el caso donde el parámetro Id_Productos no está presente en la URL
    echo "Error: ID de producto no especificado.";
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
                        <a class="text-white px-3" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="#">
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
                        <a href="clases/carrito_Productos.php" class="nav-item nav-link">Carrito
                            <span id="num_cart" class="badge bg-secondary">0</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->   

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Productos</h1>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contenido de los detalles del producto -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5"><?php echo $producto['Nombre_Productos']; ?></h1>
                   
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 order-md-1 text-center">
                    <!-- Imagen del producto -->

                    <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['Imagen_Productos']); ?>" alt="Nombre del Producto" width="500" height="500">

           
                </div>
                <div class="col-md-6 order-md-2 text-center">
                    <!-- Precio y descripción del producto -->
                    <h2><?php echo $producto['Precio_Productos']; ?></h2>
                    
                    <p><?php echo $producto['Descripcion_Productos']; ?></p>
                    <!-- Botón para comprar -->
                    <div class="d-grid gap-3 col-10 mx-auto">
                    <a href="product.php" class="btn btn-primary">Volver al inicio</a>

                    </div>
                </div>
            </div>
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
                    <p class="m-0">&copy; <a href="#"></a>Estamos aquí para servirte<a href=""></a></p>
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
        // Aquí puedes agregar cualquier script adicional necesario
    </script>
</body>

</html>

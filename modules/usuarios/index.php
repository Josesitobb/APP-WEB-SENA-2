<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la sesión está iniciada y la variable de sesión está definida
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/page-error-500.php");
    exit();
}

// Imprimir la ID del usuario almacenada en la sesión
// echo "Bienvenido, tu ID de usuario es: " . $_SESSION['user_id'];

$nombre_usuario = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SGCItas</title>
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
    <link href="modules/company/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="modules/company/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    
    <link href="./css/style.css" rel="stylesheet">
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


                        <!-- <a href="./contact.php" class="nav-item nav-link">Contactenos</a> -->
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/6_IMAGEN_INICIO_PRINCIPAL.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Servicios de calidad</h4>
                            <h1 class="display-3 text-white mb-md-4">Espejismo y color</h1>
                            <a href="service.php" class="btn btn-secondary ">Agregar cita</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/8_IMAGEN_INICIAL_PROTOTIPO.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Servicios de calidad</h4>
                            <h1 class="display-3 text-white mb-md-4">Espejismo y color</h1>
                            <a href="service.php" class="btn btn-secondary ">Agregar cita</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-secondary px-0" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n1"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-secondary px-0" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n1"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h1 class="section-title position-relative text-center mb-5">Espejismo y color</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 py-5">
                    <h4 class="font-weight-bold mb-3">Sobre nosotros</h4>
                    <h5 class="text-muted mb-3">¡Sumérgete en la belleza en su máximo esplendor! Te recibimos en nuestro salón de belleza, líder en la zona desde hace más de cuatro años. Déjanos realzar tu belleza y hacerte brillar como nunca. ¡Bienvenido a una experiencia única!</h5>
                    <p>Bogotá D.C</p>
                    <!-- <a href="" class="btn btn-secondary mt-2">MAS INFORMACION</a> -->
                </div>
                <div class="col-lg-4" style="min-height: 400px;">
                    <div class="position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="img/000.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-5">
                    <h4 class="font-weight-bold mb-3">Nuestras caracteristicas</h4>
                    <p>Nuestro talentoso equipo de esteticistas expertos está dedicado a transformar tu estilo con cortes de vanguardia, colores deslumbrantes y tratamientos capilares indulgentes. Únete a nosotros para vivir una experiencia única de cuidado capilar y tendencias de moda en constante evolución.</p>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Servicios de cuidado del cabello</h5>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Profesionales capacitados</h5>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Productos de calidad</h5>
                    <!-- <a href="" class="btn btn-primary mt-2">MAS INFORMACION</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Promotion Start -->
    <div class="container-fluid my-5 py-5 px-0">
        <div class="row bg-primary m-0">
            <div class="col-md-6 px-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/1_IMAGEN_INICIO_PRINCIPAL.jpg" style="object-fit: cover;">
                    <button type="button" class="btn-play" data-toggle="modal"
                        data-src="img/1_IMAGEN_INICIO_PRINCIPAL.jpg" data-target="#videoModal">
                        
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 py-5 py-md-0 px-0">
                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <div class="d-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                        style="width: 100px; height: 100px;">
                        <h3 class="font-weight-bold text-secondary mb-0">$20.000</h3>
                    </div>
                    <h3 class="font-weight-bold text-white mt-3 mb-4">Bono de bienvenida</h3>
                    <p class="text-white mb-4">Ven, prueba nuestros servicios y recibe un bono por facturas superiores a $120.000.</p>
                    <a href="service.php" class="btn btn-secondary ">Agregar cita</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Promotion End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    
                    <a class="btn btn-outline-secondary btn-social mr-2" href="https://www.facebook.com/profile.php?id=100083475433076&mibextid=rS40aB7S9Ucbxw6v"><i class="fab fa-facebook-f"></i></a>

                    <a class="btn btn-outline-secondary btn-social" href="https://www.instagram.com/espejismosycolor?igsh=MTUwazNnenQ4dm53OA=="><i class="fab fa-instagram"></i></a>
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
                    <p class="m-0"><a href="#"></a>Nos dedicamos a servirte con excelencia.<a href=""></a>
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
</body>

</html>
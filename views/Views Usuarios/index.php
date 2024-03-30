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
    
    <link href="../../views/Views Usuarios/css/style.css" rel="stylesheet">
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
                    <a class="text-white px-3" href="user_data.php?action=cerrarsesion">
                        <i class="fas fa-sign-out-alt"></i> <!-- Ícono de salida -->
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    

<?php include('Model/header.php'); ?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../../views/Views Usuarios/img/6_IMAGEN_INICIO_PRINCIPAL.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Servicios de calidad</h4>
                            <h1 class="display-3 text-white mb-md-4">Espejismo y color</h1>
                            <a href="../../controllers/user/user_views.php?vista=servicios" class="btn btn-secondary ">Agregar cita</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../../views/Views Usuarios/img/8_IMAGEN_INICIAL_PROTOTIPO.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Servicios de calidad</h4>
                            <h1 class="display-3 text-white mb-md-4">Espejismo y color</h1>
                            <a href="../../controllers/user/user_views.php?vista=servicios" class="btn btn-secondary ">Agregar cita</a>
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
                        <img class="position-absolute w-100 h-100" src="../../views/Views Usuarios/img/000.png" style="object-fit: cover;">
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
                    <img class="position-absolute w-100 h-100" src="../../views/Views Usuarios/img/1_IMAGEN_INICIO_PRINCIPAL.jpg" style="object-fit: cover;">
                    <button type="button" class="btn-play" data-toggle="modal"
                        data-src="../../views/Views Usuarios/img/1_IMAGEN_INICIO_PRINCIPAL.jpg" data-target="#videoModal">
                        
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 py-5 py-md-0 px-0">
                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                        style="width: 100px; height: 100px;">
                        <h3 class="font-weight-bold text-white mb-0">$20.000</h3>
                    </div>
                    <h3 class="font-weight-bold text-white mt-3 mb-4">Bono de bienvenida</h3>
                    <p class="text-white mb-4">Ven, prueba nuestros servicios y recibe un bono por facturas superiores a $120.000.</p>
                    <a href="../../controllers/user/user_views.php?vista=servicios" class="btn btn-secondary ">Agregar cita</a>
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

    <?php include('Model/footer.php'); ?>
</body>

</html>
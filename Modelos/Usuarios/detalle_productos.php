<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Verificar si el parámetro Id_Productos está presente en la URL
if (isset($_GET['Id_Productos'])) {
    // Obtener el Id_Productos de la URL
    $id_producto = $_GET['Id_Productos'];

    // Incluir el archivo de configuración de la base de datos


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
    <link href="../../views/Views Usuarios/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    
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

<?php include('../../views/Views Usuarios/Model/header.php'); ?> 

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
                    <a href="user_views.php?vista=productos" class="btn btn-primary">Volver al inicio</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <?php include('../../views/Views Usuarios/Model/footer.php'); ?> 
</body>

</html>

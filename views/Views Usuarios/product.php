<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
 
    header("Location:../../controllers/principal.php?action=sesion?");
    exit();
}
$nombre_usuario = $_SESSION['username'];
?>

<?php

require('../../Modelos/Usuarios/config/config.php');

// Consulta SQL
$sql = "SELECT Id_Productos, Nombre_Productos, Precio_Productos, Cantidad_Productos, Imagen_Productos, Id_Clientes FROM productos";

// Ejecutar consulta
$resultado = $conn->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Obtener resultados y procesarlos
    while ($row = $resultado->fetch_assoc()) {
        // Procesar cada fila de resultados aquí
        // echo "ID: " . $row["Id_Productos"]. " - Nombre: " . $row["Nombre_Productos"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión
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

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Productos</h1>
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
                            <h4 class="font-weight-bold text-white mb-0">$<?php echo $row['Precio_Productos']; ?></h4>
                        </div>
                        <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                        <?php
                            $imagen_base64 = base64_encode($row['Imagen_Productos']);
                            $imagen_src = 'data:image/png;base64,' . $imagen_base64;
                            ?>
                            <img class="rounded-circle w-100 h-100" src="<?php echo $imagen_src; ?>" alt="<?php echo $row['Nombre_Productos']; ?>">
                        </div>
                        <h5 class="font-weight-bold mb-4"><?php echo $row['Nombre_Productos']; ?></h5>
                        <br>
                        <a href="user_data.php?action=infoproductos&Id_Productos=<?php echo $row['Id_Productos']; ?>&token=<?php echo hash_hmac('sha1', $row['Id_Productos'], KEY_TOKEN); ?>#detalle_<?php echo $row['Id_Productos']; ?>" class="btn btn-sm btn-secondary">Detalle</a>


                        



                    </div>
                </div>
            <?php } ?>
        </div>
       
    </div>
</div>
    <!-- Products End -->


    <?php include('Model/footer.php'); ?>
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
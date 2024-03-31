<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}




$sql_servicios = "SELECT Id_Servicios, Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios FROM servicios";



$resultado = mysqli_query($conn, $sql_servicios);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../../views/Views Estilistas/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

<?php include('Model/nav.php') ?>
<?php include('Model/header.php') ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">

            </div>
            <!-- #/ container -->
            <div class="container">
    <h2>Tabla de Servicios</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                        <td><?php echo $row['Nombre_Servicios']; ?></td>
                        <td><?php echo '$' . number_format($row['Valor_Servicios'], 2); ?></td>
                        <td><?php echo $row['Descripcion_Servicios']; ?></td>
                        <td><button class="btn btn-primary">Agregar al carrito</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <?php include('Model/footer.php') ?>

</body>

</html>
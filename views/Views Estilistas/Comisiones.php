<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}
$id_estilista=$_SESSION['id_estilista'];
$sql_servicios = "SELECT c.Id_Comisiones, c.Pagar_Comisiones, c.Estado_De_Pago_Comisiones, f.Fecha_Factura, u.Nombre_Usuarios AS Nombre_Usuario
        FROM comisiones c
        JOIN estilistas e ON c.Id_Estilistas = e.Id_Estilistas
        JOIN usuarios u ON e.Id_Usuarios = u.Id_Usuarios
        JOIN facturas f ON c.Id_Facturas = f.Id_Facturas
        WHERE e.Id_Estilistas = $id_estilista";
$resultado = mysqli_query($conn, $sql_servicios);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Comisiones</title>
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
            <center><h2>Comisiones</h2></center> 

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>    
                    <th>Id</th>
                    <th>Nombre Estilista</th>
                    <th>Comision</th>
                    <th>Estado de comision</th>
                    <th>Fecha de factura</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                        <td><?php echo $row['Id_Comisiones']; ?></td>
                        <td><?php echo $row['Nombre_Usuario']; ?></td>
                        <td><?php echo $row['Pagar_Comisiones']; ?></td>
                        <td>
                            <?php
                            if ($row['Estado_De_Pago_Comisiones'] == 0) {
                                echo '<span class="text-danger">Por pagar</span>';
                            } else {
                                echo '<span class="text-success">Pagado</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo $row['Fecha_Factura']; ?></td>
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
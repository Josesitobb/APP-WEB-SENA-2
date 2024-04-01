<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


// Verifica si el nombre de usuario está en la sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "¡Hola, $username!";
} else {
    // El usuario no ha iniciado sesión, realiza la lógica correspondiente

    session_destroy();
    header("Location:../../controllers/principal.php?action=sesion?");

    // Destruye la sesión solo si no ha iniciado sesión
  
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Inicio Administrador</title>
    <!-- Favicon icon -->
    <!-- <link rel="icon" href="icons/SG.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../views/Views_Admin/images/sgc.png">
    <!-- Pignose Calender -->
    <link href="../../views/Views_Admin/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../../views/Views_Admin/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../../views/Views_Admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Custom Stylesheet -->
    <link href="../../views/Views_Admin/css/style.css" rel="stylesheet">
    <link href="../../views/Views_Admin/css/style.css.map" rel="stylesheet">
    <!-- <link href="../../views/Views_Admin/css/bootstrap.min.css" rel="stylesheet"> -->


</head>

<body>

<?php Include("Model/header.php") ?>
       
<?php Include("Model/navbar.php") ?>


<?php
// Ejecutar la consulta SQL para contar todas las citas donde activo sea 1
$sql = "SELECT COUNT(*) AS total_citas FROM Citas WHERE activo = 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $total_citas = $row['total_citas'];
} else {
    $total_citas = 0;
}
?>

  
  <?php

$sql = "SELECT COUNT(*) AS cantidad_comisiones_estado_cero FROM comisiones WHERE Estado_De_Pago_Comisiones = 0";
$resultado = $conn->query($sql);


if ($resultado->num_rows > 0) {

    $row = $resultado->fetch_assoc();

    $cantidad_comisiones_estado_cero = $row['cantidad_comisiones_estado_cero'];
} else {

    $cantidad_comisiones_estado_cero = 0;
}
?>

<?php

$sqlClientes = "SELECT COUNT(*) AS cantidad_clientes FROM clientes";
$resultClientes = $conn->query($sqlClientes);
$rowClientes = $resultClientes->fetch_assoc();
$cantidadClientes = $rowClientes['cantidad_clientes'];
?>

<?php
$sqlProductos = "SELECT COUNT(*) AS productos FROM productos";
$resultadoProductos = $conn->query($sqlProductos);
$rowProductos = $resultadoProductos->fetch_assoc();
$cantidadProductos = $rowProductos['productos'];
?>

<?php
$sqlFacturas ="SELECT COUNT(*) AS total_facturas FROM Facturas;";
$resultadoFacturas =$conn->query($sqlFacturas);
$rowFactura=$resultadoFacturas->fetch_assoc();
$cantidadFactura=$rowFactura['total_facturas'];

?>

<?php
$sqlServicios ="SELECT COUNT(*) AS total_servicios FROM Servicios;";
$resultadoServicios =$conn->query($sqlServicios);
$rowServicios=$resultadoServicios->fetch_assoc();
$cantidadServicios=$rowServicios['total_servicios'];
?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

          <div class="container-fluid mt-3">
              <div class="row">
                  <div class="col-lg-4 col-sm-6">
                      <div class="card-now gradient-1">
                          <div class="card-body">
                            <a href="admin_views.php?vista=usuariosC" class="card-title text-white">Usuarios</a>
                              <span ><i class="fa fa-shopping-cart"></i></span>
                              <i class="bi bi-person-gear text-white"></i>
                              <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $cantidadClientes; ?></h2>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                      <div class="card-now gradient-3">
                          <div class="card-body">
                            <a href="admin_views.php?vista=productos" class="card-title text-white">
                              Productos</a>
                              <span ><i class="fa fa-users"></i></span>
                              <i class="bi bi-basket"><?php echo $cantidadProductos; ?></i>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                    <div class="card-now gradient-2">
                        <div class="card-body">
                          <a href="admin_views.php?vista=servicios" class="card-title text-white">Servicios</a>
                          <span ><i class="fa fa-money"></i></span>
                          <i class="bi bi-scissors"><?php echo $cantidadServicios; ?></i> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                  <div class="card-now gradient-4">
                      <div class="card-body">
                          <a href="admin_views.php?vista=factura" class="card-title text-white">Facturas</a>
                          <span><i class="fa fa-heart text-white"></i></span>
                          <i class="bi bi-receipt"><?php echo $cantidadFactura; ?></i>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                  <div class="card-now gradient-4">
                      <div class="card-body">
                          <a href="admin_views.php?vista=citas" class="card-title text-white">Citas</a>
                          <span><i class="fa fa-heart text-white"></i></span>
                          <i class="bi bi-calendar-plus"></i>
                          <div class="d-inline-block">
                            <h2 class="text-white"><?php echo  $total_citas; ?></h2>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                  <div class="card-now gradient-4">
                      <div class="card-body">
                          <a href="admin_views.php?vista=comisiones" class="card-title text-white">Pagos</a>
                          <span><i class="fa fa-heart text-white"></i></span>
                          <i class="bi bi-cash-stack"></i>
                          <div class="d-inline-block">
                            <h2 class="text-white"><?php echo $cantidad_comisiones_estado_cero; ?></h2>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>

    </div>

    <?php Include("Model/footer.php") ?>

   

</body>

</html>

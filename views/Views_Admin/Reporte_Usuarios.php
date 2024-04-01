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
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Facturas</title>
    <!-- <link rel="icon" href="icons/SG.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="SG.png">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../../views/Views_Admin/css/style.css" rel="stylesheet">
    <link href="../../views/Views_Admin/css/style.css.map" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php Include ("Model/header.php"); ?>

<?php Include ("Model/navbar.php"); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li> -->
                    </ol>
                </div>
            </div>
            <!-- row -->



<div class="container mt-5">
    <h1 class="text-center mb-4">Reporte de usuarios</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <canvas id="citasPieChart" width="50" height="50"></canvas>
        </div>
        <div class="col">
            <canvas id="citasBarChart" width="50" height="50"></canvas>
        </div>
        <div class="col">
            <canvas id="usuariosPieChart" width="50" height="50"></canvas>
        </div>
        <div class="col">
            <canvas id="usuariosBarChart" width="50" height="50"></canvas>
        </div>
    </div>
</div>

<?php

setlocale(LC_TIME, 'es_ES.UTF-8');





$sqlClientes = "SELECT COUNT(*) AS cantidad_clientes FROM clientes";
$resultClientes = $conn->query($sqlClientes);
$rowClientes = $resultClientes->fetch_assoc();
$cantidadClientes = $rowClientes['cantidad_clientes'];


$sqlEstilistas = "SELECT COUNT(*) AS cantidad_estilistas FROM estilistas";
$resultEstilistas = $conn->query($sqlEstilistas);
$rowEstilistas = $resultEstilistas->fetch_assoc();
$cantidadEstilistas = $rowEstilistas['cantidad_estilistas'];


$sqlUsuarios = "SELECT COUNT(*) AS cantidad_usuarios FROM Usuarios";
$resultUsuarios = $conn->query($sqlUsuarios);
$rowUsuarios = $resultUsuarios->fetch_assoc();
$cantidadUsuarios = $rowUsuarios['cantidad_usuarios'];


$conn->close();
?>

<script>

    var ctxUsuariosPie = document.getElementById('usuariosPieChart').getContext('2d');
    var ctxUsuariosBar = document.getElementById('usuariosBarChart').getContext('2d');


    var usuariosData = {
        labels: ['Clientes', 'Estilistas', 'Usuarios Registrados'],
        datasets: [{
            label: 'Cantidad de Usuarios',
            data: [<?php echo $cantidadClientes; ?>, <?php echo $cantidadEstilistas; ?>, <?php echo $cantidadUsuarios; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };


    var usuariosOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };


    var usuariosPieChart = new Chart(ctxUsuariosPie, {
        type: 'pie',
        data: usuariosData,
        options: usuariosOptions
    });


    var usuariosBarChart = new Chart(ctxUsuariosBar, {
        type: 'bar',
        data: usuariosData,
        options: usuariosOptions
    });
</script>




            <!-- #/ container -->
        </div>
      
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php Include ("Model/footer.php"); ?>
</body>

</html>
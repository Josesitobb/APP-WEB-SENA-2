<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$varsesion=$_SESSION['username'];

if($varsesion == null || $varsesion=''){
    echo 'USTED INICIE SESION';
    die();
}

echo $_SESSION['username'];
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

    
<?php Include("Model/header.php"); ?>

<?php Include ("Model/navbar.php"); ?>

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

          


    <div class="container mt-5">
        <h1 class="text-center mb-4">Reporte de Citas</h1>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <canvas id="citasPieChart" width="300" height="300"></canvas>
            </div>
            <div class="col">
                <canvas id="citasBarChart" width="300" height="300"></canvas>
            </div>
            <div class="col">
                <canvas id="usuariosPieChart" width="300" height="300"></canvas>
            </div>
            <div class="col">
                <canvas id="usuariosBarChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>

    <?php

    setlocale(LC_TIME, 'es_ES.UTF-8');

    // Conexión a la base de datos


    $sqlCitas = "SELECT MONTH(start) AS mes, COUNT(*) AS cantidad_citas
    FROM Citas
    GROUP BY MONTH(start)";
$resultCitas = $conn->query($sqlCitas);

$labelsCitas = [];
$dataCitas = [];
while ($row = $resultCitas->fetch_assoc()) {
$nombre_mes = date('F', mktime(0, 0, 0, $row['mes'], 1)); // Obtener el nombre completo del mes
$labelsCitas[] = ucfirst($nombre_mes); // Convertir la primera letra en mayúscula
$dataCitas[] = $row['cantidad_citas'];
}

$conn->close();
?>


    <script>

        var ctxCitasPie = document.getElementById('citasPieChart').getContext('2d');
        var ctxCitasBar = document.getElementById('citasBarChart').getContext('2d');
        

        var citasPieChart = new Chart(ctxCitasPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labelsCitas); ?>,
                datasets: [{
                    label: 'Número de Citas por Mes',
                    data: <?php echo json_encode($dataCitas); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var citasBarChart = new Chart(ctxCitasBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labelsCitas); ?>,
                datasets: [{
                    label: 'Número de Citas por Mes',
                    data: <?php echo json_encode($dataCitas); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>




            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php Include("Model/footer.php") ?>

</body>

</html>
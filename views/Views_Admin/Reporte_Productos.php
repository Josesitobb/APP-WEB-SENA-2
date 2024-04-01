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

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Reporte de Cantidad de Productos</h1>

        <div class="row">
            <div class="col">
                <canvas id="productosChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <?php



    $sqlProductos = "SELECT Nombre_Productos, Cantidad_Productos FROM productos";
    $resultProductos = $conn->query($sqlProductos);


    $productosData = array();
    $nombresProductos = array();


    while ($row = $resultProductos->fetch_assoc()) {
        $nombresProductos[] = $row['Nombre_Productos'];
        $productosData[] = $row['Cantidad_Productos'];
    }
    ?>

    <script>
       
        var nombresProductos = <?php echo json_encode($nombresProductos); ?>;
        var productosData = <?php echo json_encode($productosData); ?>;

        // Configuración del gráfico con Chart.js
        var ctxProductos = document.getElementById('productosChart').getContext('2d');
        var productosChart = new Chart(ctxProductos, {
            type: 'bar', 
            data: {
                labels: nombresProductos, 
                datasets: [{
                    label: 'Cantidad de productos',
                    data: productosData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Producto' 
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cantidad' 
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <?php

    $conn->close();
    ?>
</body>
</html>


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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$varsesion=$_SESSION['username'];

if($varsesion == null || $varsesion=''){
    echo 'USTED INICIE SESION';
    header("Location:page-error-500.php");
    die();
}


// echo $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Comisione</title>
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
    <style>
.btn-custom-pink {
    background-color: #F299B9;
    border-color: #F299B9;
    color: white; 
}

.btn-custom-blue {
    background-color: #6BCCF2; 
    border-color: #6BCCF2;
    color: white; 
}
</style>

</head>

<body>
  

<?php Include("Model/header.php"); ?>

<?php Include ("Model/navbar.php"); ?>

        <div class="content-body">


            <!-- row -->
            <div class="container-fluid">
            <div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <br>
                        <h1 class="text-center">Lista de comisiones</h1>
                    </div>

                  
                    <div class="container mt-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre Estilista</th>
                                        <th scope="col">Comisiones</th>
                                        <th scope="col">Fecha de comisión</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT c.Id_Comisiones, c.Pagar_Comisiones, c.Estado_De_Pago_Comisiones, f.Fecha_Factura, u.Nombre_Usuarios AS Nombre_Usuario
                                            FROM comisiones c
                                            JOIN estilistas e ON c.Id_Estilistas = e.Id_Estilistas
                                            JOIN usuarios u ON e.Id_Usuarios = u.Id_Usuarios
                                            JOIN facturas f ON c.Id_Facturas = f.Id_Facturas";
                                    $resultado = $conn->query($sql);
                                    while ($fila = $resultado->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $fila['Id_Comisiones'] ?></th>
                                            <td><?php echo $fila['Nombre_Usuario'] ?></td>
                                            <td><?php echo $fila['Pagar_Comisiones'] ?></td>
                                            <td><?php echo $fila['Fecha_Factura'] ?></td>
                                            <td>
                                                <?php
                                                if ($fila['Estado_De_Pago_Comisiones'] == 0) {
                                                    echo '<span style="color: red;">Por pagar</span>';
                                                } else {
                                                    echo '<span style="color: green;">Pagado</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <button class="btn btn-success btn-sm" onclick="marcarPagado(<?php echo $fila['Id_Comisiones']; ?>)">
    <i class="bi bi-check-circle-fill"></i> Marcar como pagado
</button>
<button class="btn btn-danger btn-sm" onclick="marcarPorPagar(<?php echo $fila['Id_Comisiones']; ?>)">
    <i class="bi bi-x-circle-fill"></i> Marcar como por pagar
</button>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    
    <script>
    function marcarPagado(idComision) {
        $.ajax({
            url: '../../Modelos/Admin/actualizar_estado_comision.php',
            type: 'POST',
            data: { idComision: idComision, nuevoEstado: 1 },
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                alert(response);
                // Recargar la página después de 1 segundo
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(error);
            }
        });
    }

    function marcarPorPagar(idComision) {
        $.ajax({
            url: '../../Modelos/Admin/actualizar_estado_comision.php',
            type: 'POST',
            data: { idComision: idComision, nuevoEstado: 0 },
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                alert(response);
                // Recargar la página después de 1 segundo
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(error);
            }
        });
    }
</script>



</body>

</html>
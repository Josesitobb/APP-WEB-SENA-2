<?php 
session_start();

// Verificar si la sesión de estilista está iniciada
if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
    // Acceder a la variable de sesión específica para estilistas
    $id_estilista = $_SESSION['id_estilista'];

    // // Hacer algo con la variable $id_estilista
    // echo "ID del estilista: $id_estilista";
} else {
    // La sesión de estilista no está iniciada, manejar el caso aquí
    header("Location:../../controllers/principal.php?action=sesion?");
}

$sql = "SELECT 
            Citas.Id_Citas,
            Citas.start,
            Citas.end,
            Clientes.Id_Clientes,
            CONCAT(Usuarios_Clientes.Nombre_Usuarios, ' ', Usuarios_Clientes.Apellido_Usuarios) AS Nombre_Cliente,
            Estilistas.Id_Estilistas,
            CONCAT(Usuarios_Estilistas.Nombre_Usuarios, ' ', Usuarios_Estilistas.Apellido_Usuarios) AS Nombre_Estilista,
            Servicios.Id_Servicios,
            Servicios.Nombre_Servicios,
            Servicios.Valor_Servicios AS Precio_Servicio
        FROM 
            Citas
        INNER JOIN 
            Clientes ON Citas.Id_Clientes = Clientes.Id_Clientes
        INNER JOIN 
            Usuarios AS Usuarios_Clientes ON Clientes.Id_Usuarios = Usuarios_Clientes.Id_Usuarios
        INNER JOIN 
            Estilistas ON Citas.Id_Estilistas = Estilistas.Id_Estilistas
        INNER JOIN 
            Usuarios AS Usuarios_Estilistas ON Estilistas.Id_Usuarios = Usuarios_Estilistas.Id_Usuarios
        INNER JOIN 
            Servicios ON Citas.Id_Servicios = Servicios.Id_Servicios
        WHERE 
            Estilistas.Id_Estilistas = $id_estilista
            AND Citas.activo = 1"; // Filtra las citas con estado activo en 0




// Ejecutar la consulta SQL
$result = $conn->query($sql);





?>
<?php
$sqlProductos = "SELECT COUNT(*) AS productos FROM productos";
$resultadoProductos = $conn->query($sqlProductos);
$rowProductos = $resultadoProductos->fetch_assoc();
$cantidadProductos = $rowProductos['productos'];
?>



<?php
// Consulta SQL para obtener el total de citas activas para el estilista actual
$sql = "SELECT COUNT(*) AS total_citas FROM Citas WHERE activo = 1 AND Id_Estilistas = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_estilista); // Usar $id_estilista obtenido de $_SESSION
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $total_citas = $row['total_citas'];
} else {
    $total_citas = 0;
}

?>

<?php
  $sql = "SELECT COUNT(*) AS total_comisiones FROM Comisiones WHERE Estado_De_Pago_Comisiones = 0 AND Id_Estilistas = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id_estilista); // "i" indica que es un parámetro entero (ID del estilista)
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
      $row = $resultado->fetch_assoc();
      $total_comisiones = $row['total_comisiones'];
  } else {
      $total_comisiones = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>SGCITAS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../../views/Views Estilistas/css/style.css" rel="stylesheet">
    

</head>

<body>
<?php include('Model/nav.php') ?>
<?php include('Model/header.php') ?>


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


  

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

          <div class="container-fluid mt-3">
              <div class="row">
                  <div class="col-lg-4 col-sm-6">
                      <div class="card-now gradient-3">
                          <div class="card-body">
                            <a href="estilista_views.php?vista=productos" class="card-title text-white">
                              Pedido facturación</a>
                              <span ><i class="fa fa-users"></i></span>
                              <i class="bi bi-basket"><?php echo $cantidadProductos; ?></i>
                          </div>
                      </div>
                  </div>
              <div class="col-lg-4 col-sm-6">
                  <div class="card-now gradient-4">
                      <div class="card-body">
                          <a href="estilista_views.php?vista=citas" class="card-title text-white">Citas</a>
                          <span><i class="fa fa-heart text-white"></i></span>
                          <i class="bi bi-calendar-plus"><?php echo $total_citas ?></i>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                  <div class="card-now gradient-4">
                      <div class="card-body">
                          <a href="estilista_views.php?vista=comisiones" class="card-title text-white">Pagos</a>
                          <span><i class="fa fa-heart text-white"></i></span>
                          <i class="bi bi-cash-stack"><?php echo $total_comisiones ?></i>
                      </div>
                  </div>
              </div>
          </div>
        </div>


    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-xl-10 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-4 p-sm-5">
                <div class="users-table">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Citas</h5>
                    <div class="d-flex justify-content-between mb-3">


                        <!-- Sección de búsqueda -->
                        <div class="col-lg-3 col-xl-3">

                            </div>
                            </div>

                            <table class="table_id">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre Cliente</th>
                                        <th scope="col">Nombre Servicio</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col"></th>
                                    </tr>    
                                </thead>
                                <tbody style="text-align: center;">

                                    <?php
                                    
                                    // Iterar sobre los resultados de la consulta y mostrar los datos en la tabla
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["Nombre_Cliente"] . "</td>";
                                            echo "<td>" . $row["Nombre_Servicios"] . "</td>";
                                            echo "<td>$" . $row["Precio_Servicio"] . "</td>";
                                            echo "<td>" . date('M d, Y - h:i A', strtotime($row["start"])) . "</td>";
                                            // Agregar un botón para marcar si la cita ha sido atendida o no
                                            echo "<td><button onclick='confirmAtendido(" . $row['Id_Citas'] . ")' class='btn btn-primary'>¿Atendido?</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No hay citas programadas.</td></tr>";
                                    
                                    ?>
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

<script>
    function confirmAtendido(idCita) {
        // Mostrar un mensaje de confirmación al usuario
        var confirmacion = confirm("¿Se ha atendido a este cliente?");
        if (confirmacion) {
            // Crear un objeto FormData para enviar los datos por POST
            var formData = new FormData();
            formData.append('id_cita', idCita);

            // Ruta absoluta al archivo PHP
            var url = "../../controllers/estilista/estilista_data.php?action=estadocita";

            // Realizar una solicitud AJAX por POST para actualizar el estado 'atendido' en la base de datos
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Actualizar la interfaz de usuario si la actualización fue exitosa
                    console.log("Estado 'atendido' actualizado para la cita con ID " + idCita);
                }
            };
            xhttp.open("POST", url, true);
            xhttp.send(formData);
        }
    }
</script>


        
        <?php include('Model/footer.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

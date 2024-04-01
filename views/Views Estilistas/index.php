<?php 
session_start();

// Verificar si la sesión de estilista está iniciada
if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
    // Acceder a la variable de sesión específica para estilistas
    $id_estilista = $_SESSION['id_estilista'];

    // Hacer algo con la variable $id_estilista
    echo "ID del estilista: $id_estilista";
} else {
    // La sesión de estilista no está iniciada, manejar el caso aquí
    echo "La sesión de estilista no está iniciada.";
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Products Sold</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">$ 8541</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">New Customers</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Customer Satisfaction</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">99%</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
             
            < #/ container -->
        <!-- </div> -->
        <div class="container">
    <h2 class="mt-4 mb-4">Tabla de Citas</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre Cliente</th>
                <th scope="col">Nombre Servicio</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha</th>
                <th scope="col">¿Atendido?</th>
            </tr>
        </thead>
        <tbody>
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
            }
            ?>
        </tbody>
    </table>
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
            var url = "../../Modelos/Estilistas/actualizar_atendido.php";

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

</body>

</html>

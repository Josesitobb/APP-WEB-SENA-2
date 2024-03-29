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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } */
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td a {
            color: #007bff;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        .no-data {
            text-align: center;
            color: #999;
        }
    </style>

</head>

<body>

<?php Include ("Model/header.php"); ?>

<?php Include ("Model/navbar.php"); ?>

        <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editarClienteForm">
          <!-- Aquí van los campos para editar el cliente -->
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">


            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                            <div class="container">
        <br>
    <div class="container">
        <h1>Lista de Facturas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Factura</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
               

                // Consulta SQL para obtener las facturas
                $sql = "SELECT 
                f.Id_Facturas, 
                f.Fecha_Factura, 
                f.Precio_Total_Productos, 
                f.Precio_Total_Servicios, 
                f.Factura_Total, 
                IFNULL(f.Cantidad_Productos, 0) AS Cantidad_Productos, 
                IFNULL(f.Cantidad_Servicios, 0) AS Cantidad_Servicios,
                p.Nombre_Productos, 
                IFNULL(p.Precio_Productos, 0) AS Precio_Producto,
                s.Nombre_Servicios, 
                IFNULL(s.Valor_Servicios, 0) AS Precio_Servicio,
                c.Nombre_Usuarios AS Nombre_Cliente, 
                e.Nombre_Usuarios AS Nombre_Estilista
            FROM 
                facturas f
            LEFT JOIN 
                Productos p ON f.Id_Productos = p.Id_Productos
            LEFT JOIN 
                servicios s ON f.Id_Servicios = s.Id_Servicios
            LEFT JOIN 
                clientes cl ON f.Id_Clientes = cl.Id_Clientes
            LEFT JOIN 
                Usuarios c ON cl.Id_Usuarios = c.Id_Usuarios
            LEFT JOIN 
                Estilistas es ON f.Id_Estilistas = es.Id_Estilistas
            LEFT JOIN 
                Usuarios e ON es.Id_Usuarios = e.Id_Usuarios";
                $result = $conn->query($sql);

                // Comprobar si se encontraron resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y mostrar las filas de la tabla
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Id_Facturas"] . "</td>";
                        // Formatear la fecha
                        $fechaFormateada = date('d/m/Y', strtotime($row["Fecha_Factura"]));
                        echo "<td>". $row["Nombre_Cliente"] . "</td>";
                        echo "<td>" . $fechaFormateada . "</td>";
                        echo "<td><a href='../../controllers/admin/admin_data.php?action=generarPDF&id_factura=" . $row["Id_Facturas"] . "'>Descargar PDF</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='no-data'>No hay facturas</td></tr>";
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

    </div>
    <br>





   

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
        <!--**********************************
            Content body end
        ***********************************-->
        
        <div id="mensaje"></div>

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
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
    <?php Include ("Model/footer.php"); ?>
  





</body>

</html>
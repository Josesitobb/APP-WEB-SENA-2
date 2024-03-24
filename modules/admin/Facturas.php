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

    <title>Clientes</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logi.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

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

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                <b class="logo-abbr"><img src="images/logi.png" alt=""> </b>
                    <span class="logo-compact"><img src="images/logi.png" alt=""></span>
                    <span class="brand-title">
                    <img src="images/logi.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down   d-md-none">
							<form action="#">
								<input type="text" class="form-control" placeholder="Search">
							</form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">

                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>

                                        
                                        <hr class="my-2">

                                        <li><a href="page-login.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Inicio</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./index.php">Inicio</a></li>
                            <!-- <li><a href="./index-2.php">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Modulos</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./Clientes.php">Usuarios/Clientes</a></li>
                            <li><a href="./Estilistas.php">Usuarios/Estilistas</a></li>
                            <li><a href="./layout-one-column.php">Productos</a></li>
                            <li><a href="./layout-two-column.php">Servicios</a></li>
                            <li><a href="./Citas.php">Citas </a></li>
                            <li><a href="./Facturas.php">Facturas </a></li>
                            <li><a href="./layout-compact-nav.php">Roles </a></li>
                            
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./app-calender.php">Calender</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i> <span class="nav-text">Reportes Graficos</span>
                        </a>
                        <ul aria-expanded="false">
                        <li><a href="./Reporte_Citas.php">Citas</a></li>
                            <li><a href="./Reporte_Usuarios.php">Usuarios</a></li>
                            <li><a href="./Reporte_Productos.php">Productos</a></li>


                        </ul>
                    </li>
                    <li class="nav-label">Alerta</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">Alerta</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-alert.php">Alerta</a></li>
                        <!-- </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false"> -->

                        </ul>
                    </li>

                    <li class="nav-label">Table</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Table</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./table-basic.php" aria-expanded="false">Basic Table</a></li>
                            <li><a href="./table-datatable.php" aria-expanded="false">Data Table</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Pages</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./page-login.php">Login</a></li>
                            <li><a href="./page-register.php">Register</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-404.php">Error 404</a></li>
                                    <li><a href="./page-error-403.php">Error 403</a></li>
                                    <li><a href="./page-error-400.php">Error 400</a></li>
                                    <li><a href="./page-error-500.php">Error 500</a></li>
                                    <li><a href="./page-error-503.php">Error 503</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

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
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Facturas</title>
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
                include("db.php");

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
                        echo "<td><a href='./reportes_pdf/generar_pdf.php?id_factura=" . $row["Id_Facturas"] . "'>Descargar PDF</a></td>";
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
    <script src="./js/validaciones/ValidacionProductos.js"></script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script>
function cargarDatosCliente(idCliente, nombre, apellido, correo, telefono, contraseña ,idRol ) {
    // Genera las opciones de selección para los roles
    var opcionesRol = '';
    for (var i = 0; i < roles.length; i++) {
        opcionesRol += `<option value="${roles[i].Id_Rol}" ${roles[i].Id_Rol == idRol ? 'selected' : ''}>${roles[i].Nombre_Rol}</option>`;
    }

    document.getElementById('editarClienteForm').innerHTML = `
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" value="${nombre}">
      </div>
      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" value="${apellido}">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" value="${correo}">
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" value="${telefono}">
      </div>
      <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="text" class="form-control" id="contraseña" value="${contraseña}">
      </div>
     
      <input type="hidden" id="idCliente" value="${idCliente}">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
      </div>
    `;
    $('#editarClienteModal').modal('show');
}
</script>



<script>
function guardarCambios() {
    // Obtener los valores del formulario
    var idCliente = document.getElementById('idCliente').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var correo = document.getElementById('correo').value;
    var telefono = document.getElementById('telefono').value;
    var contraseña = document.getElementById('contraseña').value;


    // Crear un objeto con los datos del formulario
    var datos = {
        idCliente: idCliente,
        nombre: nombre,
        apellido: apellido,
        correo: correo,
        telefono: telefono,
        contraseña: contraseña,

    };

    // Enviar los datos mediante AJAX a un archivo PHP
    $.ajax({
        url: 'Editar_Clientes.php',
        type: 'POST',
        data: datos,
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response);
            // Recargar la página
            location.reload();
            // Mostrar mensaje de actualización
            $('#mensaje').text(response); // Aquí se muestra el mensaje recibido del servidor
        },
        error: function(xhr, status, error) {
            // Manejar errores de AJAX
            console.error(xhr.responseText);
            // Mostrar mensaje de error
            $('#mensaje').text('Error al guardar los cambios.'); // Mensaje genérico en caso de error
        }
    });
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Cuando se envía el formulario dentro del modal
    $('#agregarUsuarioForm').submit(function(e) {
        e.preventDefault(); // Evita que se envíe el formulario de manera tradicional

        // Recopila los datos del formulario
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();
        var contraseña = $('#contraseña').val();

        // Envía los datos mediante AJAX a un archivo PHP
        $.ajax({
            url: 'Agregar_Clientes.php',
            type: 'POST',
            data: {
                nombre: nombre,
                apellido: apellido,
                correo: correo,
                telefono: telefono,
                contraseña: contraseña
            },
            success: function(response) {
                // Mostrar el mensaje al usuario
                alert(response);
                
                // Recargar la página si la inserción fue exitosa
                // location.reload();
            },
            error: function(xhr, status, error) {
                // Manejar errores de AJAX
                console.error(xhr.responseText);
            }
        });
    });
});
</script>



</body>

</html>
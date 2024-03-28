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


<?php
include("db.php");
// Realiza una consulta SQL para obtener todos los roles
$sql_roles = $conn->query("SELECT * FROM Roles");

// Almacena los resultados en un array
$roles = array();
while ($row = $sql_roles->fetch_assoc()) {
    $roles[] = $row;
}

// Convierte el array de roles a formato JSON
$roles_json = json_encode($roles);
?>

<script>
// Almacena la lista de roles en una variable JavaScript
var roles = <?php echo $roles_json; ?>;
</script>

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
                    <b class="logo-abbr"><img src="images/SG.png" alt=""> </b>
                    <span class="logo-compact"><img src="images/SG.png" alt=""></span>
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
                <!-- <div class="header-left">
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
                </div> -->
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
                            <li><a href="./Productos.php">Productos</a></li>
                            <li><a href="./Servicios.php">Servicios</a></li>
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
       
    </div>
    <br>
  <h1><center>USUARIOS CLIENTES</center></h1>
    
  <!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">Agregar Usuario</button>
<a href="reportes_excel/execel_clientes.php" class="btn btn-primary">Descargar</a>

<!-- Modal para agregar un nuevo usuario -->
<div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="agregarUsuarioForm">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" required>
          </div>
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" required>
          </div>
          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" required>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" required>
          </div>
          <div class="mb-3">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  <br>
    <br>

<a href="">Descargar</a>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Rol</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Apellido usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Acciones</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("db.php");

            $sql = $conn->query("SELECT U.*, R.Nombre_Rol as Rol
            FROM Usuarios U
            JOIN Roles R ON U.Id_Rol = R.Id_Rol
            WHERE R.Nombre_Rol = 'clientes'");

            while ($resultado = $sql->fetch_assoc()) {
            ?>
                <tr class="table-light">
                    <td><?php echo $resultado['Rol'] ?></td>
                    <td><?php echo $resultado['Nombre_Usuarios'] ?></td>
                    <td><?php echo $resultado['Apellido_Usuarios'] ?></td>
                    <td><?php echo $resultado['Correo_Usuarios'] ?></td>
                    <td><?php echo $resultado['Telefono_Usuarios'] ?></td>
                    <td><?php echo $resultado['Contraseña_Usuarios'] ?></td>
                    <td>
                        <a class="btn btn-custom-blue my-1" href="javascript:void(0);" onclick="cargarDatosCliente(<?php echo $resultado['Id_Usuarios']; ?>, '<?php echo $resultado['Nombre_Usuarios']; ?>', '<?php echo $resultado['Apellido_Usuarios']; ?>', '<?php echo $resultado['Correo_Usuarios']; ?>', '<?php echo $resultado['Telefono_Usuarios']; ?>', '<?php echo $resultado['Contraseña_Usuarios'] ?>', '<?php echo $resultado['Id_Rol']; ?>')">Editar</a>
                        <a class="btn btn-custom-pink my-1" href="Borrar_Clientes.php?Id_Usuarios=<?php echo $resultado['Id_Usuarios']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">Eliminar</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$varsesion = $_SESSION['username'];

if ($varsesion == null || $varsesion = '') {
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

    <title>Clientes</title>
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
<!-- MODAL DE AGREGAR -->
<div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAgregarProducto" action="../../controllers/admin/admin_data.php?action=agregarproducto" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nombreProducto" class="form-label">Nombre Producto</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
          </div>
          <div class="mb-3">
            <label for="descripcionProducto" class="form-label">Descripción Producto</label>
            <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" required></textarea>
          </div>
          <div class="mb-3">
            <label for="precioProducto" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precioProducto" name="precioProducto" required>
          </div>
          <div class="mb-3">
            <label for="cantidadProducto" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidadProducto" name="cantidadProducto" required>
          </div>
          <div class="mb-3">
            <label for="imagenProducto" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagenProducto" name="imagenProducto" required accept="image/*">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE EDITAR -->

<div class="modal fade" id="modificarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formModificarProducto" action="../../controllers/admin/admin_data.php?action=editarproducto" method="post" enctype="multipart/form-data">
          <input type="hidden" id="idProducto" name="idProducto">
          <div class="mb-3">
            <label for="editarNombreProducto" class="form-label">Nombre Producto</label>
            <input type="text" class="form-control" id="editarNombreProducto" name="nombreProducto" required>
          </div>
          <div class="mb-3">
            <label for="editarDetalleProducto" class="form-label">Detalle Producto</label>
            <textarea class="form-control" id="editarDetalleProducto" name="Destalleproductos" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editarPrecioProducto" class="form-label">Precio</label>
            <input type="number" class="form-control" id="editarPrecioProducto" name="precioProducto" required>
          </div>
          <div class="mb-3">
            <label for="editarCantidadProducto" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="editarCantidadProducto" name="cantidadProducto" required>
          </div>
          <div class="mb-3">
            <label for="editarImagenesProducto" class="form-label">Imagenes</label>
            <input type="file" class="form-control" id="editarImagenesProducto" name="imagenesProducto" multiple accept="image/*">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



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
                    <b class="logo-abbr"><img src="../../views/Views_Admin/images/SG.png" alt=""> </b>
                    <span class="logo-compact"><img src="../../views/Views_Admin/images/logi.png" alt=""></span>
                    <span class="brand-title">
                        <img src="../../views/Views_Admin/images/logi.png" alt="">
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
                        <li><a href="admin_controller.php?rol=indexadmin">Inicio</a></li>
                            <!-- <li><a href="./index-2.php">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Modulos</span>
                        </a>
                        <ul aria-expanded="false">
                        <li><a href="admin_views.php?vista=usuariosC">Usuarios/Clientes</a></li>
                            <li><a href="admin_views.php?vista=usuariosE">Usuarios/Estilistas</a></li>
                            <li><a href="admin_views.php?vista=productos">Productos</a></li>
                            <li><a href="admin_views.php?vista=servicios">Servicios</a></li>
                            <li><a href="admin_views.php?vista=citas">Citas </a></li>
                            <li><a href="admin_views.php?vista=factura">Facturas </a></li>
                            
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
                        <li><a href="admin_views.php?vista=citasr">Citas</a></li>
                            <li><a href="admin_views.php?vista=usuariosr">Usuarios</a></li>
                            <li><a href="admin_views.php?vista=productosr">Productos</a></li>


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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Lista de productos</h1>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary" onclick="mostrarModalAgregarProducto()">Agregar nuevo producto</button>
                        <a href="reportes_excel/execel_productos.php" class="btn btn-primary">Descargar</a>
                    </div>
                    <div class="container mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Imágenes</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $sql = "SELECT * FROM `productos`";
                                $resultado = $conn->query($sql);
                                while ($fila = $resultado->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $fila['Id_Productos'] ?></td>
                                        <td><?php echo $fila['Nombre_Productos'] ?></td>
                                        <td><?php echo $fila['Descripcion_Productos'] ?></td>
                                        <td><?php echo $fila['Precio_Productos'] ?></td>
                                        <td><?php echo $fila['Cantidad_Productos'] ?></td>
                                        <td><img style="width: 100px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_Productos']) ?>" alt=""></td>
                                        <td>
                                            <button type="button" class="btn btn-custom-blue my-1"  onclick="mostrarModalModificar(<?php echo $fila['Id_Productos'] ?>, '<?php echo $fila['Nombre_Productos'] ?>', '<?php echo $fila['Descripcion_Productos'] ?>', '<?php echo $fila['Precio_Productos'] ?>', '<?php echo $fila['Cantidad_Productos'] ?>')">Editar</button>
                                            <button type="button" class="btn btn-custom-pink my-1" onclick="confirmarEliminar(<?php echo $fila['Id_Productos'] ?>)">Eliminar</button>

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
    <script src="../../views/Views_Admin/plugins/common/common.min.js"></script>
    <script src="../../views/Views_Admin/js/custom.min.js"></script>
    <script src="../../views/Views_Admin/js/settings.js"></script>
    <script src="../../views/Views_Admin/js/gleek.js"></script>
    <script src="../../views/Views_Admin/js/styleSwitcher.js"></script>
    <script>
  function mostrarModalAgregarProducto() {
    $('#agregarProductoModal').modal('show');
  }
</script>
<script>
  function mostrarModalModificar(id, nombre, detalle, precio, cantidad) {
    $('#idProducto').val(id);
    $('#editarNombreProducto').val(nombre);
    $('#editarDetalleProducto').val(detalle);
    $('#editarPrecioProducto').val(precio);
    $('#editarCantidadProducto').val(cantidad);
    $('#modificarProductoModal').modal('show');
  }
</script>

<script>
    function confirmarEliminar(idProducto) {
        if (confirm('¿Está seguro de que desea eliminar este producto?')) {
            // Si el usuario confirma, redirigir a la página de eliminación con el ID del producto
            window.location.href = '../../Modelos/Admin/deleteProducto.php?id=' + idProducto;
            
        }
    }
</script>


</body>

</html>
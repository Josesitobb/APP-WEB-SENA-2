<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}

include("db.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Productos</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

        <style>
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .btn-calcular {
            margin-top: 10px;
            margin-left:100px
        }

        .btn-enviar {
            margin-top: 10px;
        }

        .form-label-custom {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }


        .form-select-option {
            font-size: 16px;
            color: #555;
        }

        select.form-select {
            height: calc(2.25rem + 2px);
            padding: .375rem 2.25rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            width: 100%;
        }

        select.form-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(0, 123, 255, .25);
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
                <a href="index.html">
                    <b class="logo-abbr"><img src="images/Logo_compañia.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/Logo_compañia.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/Logo_compañia.png" alt="">
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
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        
                               
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>  
                                    <span class="badge badge-pill badge-primary"></span>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/4.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                 <a href="agregar_al_carrito.php" class="carrito-link">
    <i class="fas fa-shopping-cart"></i> 
   
</a>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill badge-primary">3</div></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a></li>
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
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Home 1</a></li>
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Modulos</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./Citas.php">Citas</a></li>
                            <li><a href="./Servicios.php">Servicios</a></li>
                            <li><a href="./Productos.php">Productos</a></li>
                        </ul>
                    </li>
                    
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

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

            <div class="container-fluid">

    
            <!-- #/ container -->
<?php
$sql_usuarios = "SELECT c.*, u.Nombre_Usuarios, u.Apellido_Usuarios
FROM clientes AS c
INNER JOIN Usuarios AS u ON c.Id_Usuarios = u.Id_Usuarios
WHERE u.Id_Rol = 2;";
$result_usuarios = $conn->query($sql_usuarios);

$sql_productos = "SELECT Id_Productos, Nombre_Productos, Precio_Productos FROM productos";
$result_productos = $conn->query($sql_productos);

$sql_servicios = "SELECT Id_Servicios, Nombre_Servicios, Valor_Servicios FROM servicios";
$result_servicios = $conn->query($sql_servicios);
if ($result_usuarios->num_rows > 0 && $result_productos->num_rows > 0 && $result_servicios->num_rows > 0) {
?>
    <div class="container">
        <h2 class="text-center">Formulario de Pedido y Facturación</h2>
        <form action="procesar_pedido_factura.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label form-label-custom">Seleccionar Usuario:</label>
                <select name="usuario" id="usuario" class="form-select">
                    <?php
                    while ($row = $result_usuarios->fetch_assoc()) {
                        echo "<option value='" . $row["Id_Usuarios"] . "' class='form-select-option'>" . $row["Nombre_Usuarios"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
            <label for="producto" class="form-label form-label-custom">Seleccionar Producto:</label>
    <select name="producto" id="producto" class="form-select" onchange="updatePrecioUnitario()">
        <option value="" selected>-- Seleccionar Producto --</option>
        <?php
        while ($row = $result_productos->fetch_assoc()) {
            echo "<option value='" . $row["Id_Productos"] . "' data-precio='" . $row["Precio_Productos"] . "' class='form-select-option'>" . $row["Nombre_Productos"] . "</option>";
        }
        ?>
    </select>
            </div>
            <div class="row mb-3">
                <div class="col-md">
                    <label for="precio_unitario" class="form-label form-label-custom">Precio Unitario:</label>
                    <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" step="0.01" readonly>
                </div>
                <div class="col-md">
                <label for="cantidad" class="form-label form-label-custom">Cantidad:</label>
    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" onchange="calcularTotal()">
                </div>
            </div>
            <div class="mb-3">
                <label for="total_productos" class="form-label form-label-custom">Valor Total Productos:</label>
                <input type="text" name="total_productos" id="total_productos" class="form-control" readonly>
            </div>
            <div class="mb-3">
            <label for="servicio" class="form-label form-label-custom">Seleccionar Servicio:</label>
            
    <select name="servicio" id="servicio" class="form-select" onchange="updatePrecioServicio(); calcularTotal()">
        <?php
        while ($row = $result_servicios->fetch_assoc()) {
            echo "<option value='" . $row["Id_Servicios"] . "' data-precio='" . $row["Valor_Servicios"] . "' class='form-select-option'>" . $row["Nombre_Servicios"] . " - Precio: $" . $row["Valor_Servicios"] . "</option>";
        }
        ?>
    </select>
            </div>
            <div class="mb-3">
            <label for="precio_servicio" class="form-label form-label-custom">Precio Servicio:</label>
    <input type="number" name="precio_servicio" id="precio_servicio" class="form-control" step="0.01" onchange="calcularTotal()">
            </div>
            <div class="mb-3">
            <label for="total_factura" class="form-label form-label-custom">Valor Total Factura:</label>
    <input type="text" name="total_factura" id="total_factura" class="form-control" readonly>
            </div>
            <button type="button" class="btn btn-primary btn-calcular" onclick="calcularTotal()">Calcular Total</button>
            <button type="submit" class="btn btn-success btn-enviar">Enviar Pedido y Factura</button>
        </form>
    </div>
<?php
} else {
    echo "No se encontraron usuarios, productos o servicios en la base de datos.";
}

// Cerrar conexión
$conn->close();
?>

<script>
    function updatePrecioUnitario() {
        var selectedProduct = document.getElementById("producto");
        var precioUnitarioInput = document.getElementById("precio_unitario");
        var precioUnitario = selectedProduct.options[selectedProduct.selectedIndex].getAttribute("data-precio");
        precioUnitarioInput.value = precioUnitario;
        updateTotal(); 
    }

    function updateTotal() {
        var cantidadInput = document.getElementById("cantidad");
        var precioUnitarioInput = document.getElementById("precio_unitario");
        var totalProductosInput = document.getElementById("total_productos");
        var cantidad = cantidadInput.value;
        var precioUnitario = precioUnitarioInput.value;
        var total = cantidad * precioUnitario;
        totalProductosInput.value = total.toFixed(2);
    }

    function calcularTotal() {
    updateTotal();
    
    var totalProductosInput = document.getElementById("total_productos").value;
    var precioServicioInput = document.getElementById("precio_servicio").value;
    var totalFacturaInput = document.getElementById("total_factura");

    var totalProductos = parseFloat(totalProductosInput);
    var precioServicio = parseFloat(precioServicioInput);

    // Verifica si el campo de Precio Servicio está vacío
    if (isNaN(precioServicio)) {
        precioServicio = 0; // Asigna un valor de 0 si el campo está vacío
    }

    // Suma el valor total de los productos con el precio del servicio
    var totalFactura = totalProductos + precioServicio;

    // Actualiza el campo "Valor Total Factura" con el resultado
    totalFacturaInput.value = totalFactura.toFixed(2);
}

    function updatePrecioServicio() {
    var selectedService = document.getElementById("servicio");
    var precioServicioInput = document.getElementById("precio_servicio");
    var precioServicio = selectedService.options[selectedService.selectedIndex].getAttribute("data-precio");
    precioServicioInput.value = precioServicio;
}

</script>

</div>
   
    </div>
</div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gb1y9jZ2MZoS7a1zWv3XTKXvRv5u5vwqyZZc1az5V7czbsuEV0Ic8d4bdAi8u1Yb"
        crossorigin="anonymous"></script>
        <!-- <script>
    // Función para calcular el valor total de los productos
    function calcularTotal() {
        // Obtener el valor seleccionado del producto y el valor ingresado en la cantidad
        var precioUnitario = parseFloat(document.getElementById("precio_unitario").value);
        var cantidad = parseInt(document.getElementById("cantidad").value);
        
        // Calcular el valor total de los productos
        var totalProductos = precioUnitario * cantidad;
        
        // Actualizar el valor del campo "Valor Total Productos"
        document.getElementById("total_productos").value = totalProductos.toFixed(2); // Mostrar solo 2 decimales
    }
    
    // Asignar la función calcularTotal al evento onchange de los elementos select de "producto" y "cantidad"
    document.getElementById("producto").onchange = calcularTotal;
    document.getElementById("cantidad").onchange = calcularTotal;
</script> -->


</body>

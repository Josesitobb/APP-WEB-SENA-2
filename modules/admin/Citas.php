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
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logi.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

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
                                <span class="activity active"></span>
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
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./index.php">Home 1</a></li>
                            <!-- <li><a href="./index-2.php">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Layouts</span>
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
                    <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Email</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./email-inbox.php">Inbox</a></li>
                            <li><a href="./email-read.php">Read</a></li>
                            <li><a href="./email-compose.php">Compose</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.php">Profile</a></li>
                            <li><a href="./app-calender.php">Calender</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i> <span class="nav-text">Reporte Graficos</span>
                        </a>
                        <ul aria-expanded="false">
                        <li><a href="./Reporte_Citas.php">Citas</a></li>
                            <li><a href="./Reporte_Usuarios.php">Usuarios</a></li>
                            <li><a href="./Reporte_Productos.php">Productos</a></li>

                        </ul>
                    </li>
                    <li class="nav-label">UI Components</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">UI Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.php">Accordion</a></li>
                            <li><a href="./ui-alert.php">Alert</a></li>
                            <li><a href="./ui-badge.php">Badge</a></li>
                            <li><a href="./ui-button.php">Button</a></li>
                            <li><a href="./ui-button-group.php">Button Group</a></li>
                            <li><a href="./ui-cards.php">Cards</a></li>
                            <li><a href="./ui-carousel.php">Carousel</a></li>
                            <li><a href="./ui-dropdown.php">Dropdown</a></li>
                            <li><a href="./ui-list-group.php">List Group</a></li>
                            <li><a href="./ui-media-object.php">Media Object</a></li>
                            <li><a href="./ui-modal.php">Modal</a></li>
                            <li><a href="./ui-pagination.php">Pagination</a></li>
                            <li><a href="./ui-popover.php">Popover</a></li>
                            <li><a href="./ui-progressbar.php">Progressbar</a></li>
                            <li><a href="./ui-tab.php">Tab</a></li>
                            <li><a href="./ui-typography.php">Typography</a></li>
                        <!-- </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false"> -->
                            <li><a href="./uc-nestedable.php">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.php">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.php">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.php">Toastr</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="widgets.php" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                        </a>
                    </li>
                    <li class="nav-label">Forms</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./form-basic.php">Basic Form</a></li>
                            <li><a href="./form-validation.php">Form Validation</a></li>
                            <li><a href="./form-step.php">Step Form</a></li>
                            <li><a href="./form-editor.php">Editor</a></li>
                            <li><a href="./form-picker.php">Picker</a></li>
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
                            <li><a href="./page-lock.php">Lock Screen</a></li>
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

            <?php
include("db.php");

// Obtener la lista de clientes
$query = "SELECT clientes.Id_Clientes, usuarios.Nombre_Usuarios
FROM clientes
INNER JOIN usuarios ON clientes.Id_Usuarios = usuarios.Id_Usuarios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $clientes = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $clientes[$fila['Id_Clientes']] = $fila['Nombre_Usuarios'];
}

} else {
    echo "Error al obtener la lista de clientes: " . mysqli_error($conn);
}



// Obtener la lista de estilistas
$query = "SELECT Estilistas.Id_Estilistas, usuarios.Nombre_Usuarios
FROM Estilistas
INNER JOIN usuarios ON Estilistas.Id_Usuarios = usuarios.Id_Usuarios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $Estilistas = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $Estilistas[$fila['Id_Estilistas']] = $fila['Nombre_Usuarios'];
}
} else {
    echo "Error al obtener la lista de estilistas: " . mysqli_error($conn);
}

// Obtener la lista de servicios
$query = "SELECT Id_Servicios, Nombre_Servicios FROM servicios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $Servicios = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $Servicios[$fila['Id_Servicios']] = $fila['Nombre_Servicios'];
}

} else {
    echo "Error al obtener la lista de servicios: " . mysqli_error($conn);
}


?>












<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendario PHP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .hoy {
        background-color: #ffe0b2;
    }

    /* Estilos para el modal */
    .modal {
        display: none; /* Ocultar el modal por defecto */
        position: fixed; /* Posición fija para cubrir toda la ventana */
        z-index: 1; /* Situar el modal por encima de todo */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Habilitar desplazamiento si el contenido es más grande que la ventana */
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* Margen superior e inferior para centrar verticalmente */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Ancho del contenido del modal */
    }

    /* Estilo para el botón de cerrar */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

</head>
<body>

<?php
// Establecer la zona horaria a Bogotá, Colombia
date_default_timezone_set('America/Bogota');

// Obtener el mes y el año actual
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('n');
$año = isset($_GET['año']) ? $_GET['año'] : date('Y');

// Obtener el número de días en el mes actual
$dias_en_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $año);

// Obtener el día de la semana del primer día del mes
$primer_dia_del_mes = date('N', strtotime("$año-$mes-01"));

// Array de días de la semana
$dias_de_la_semana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

// Array de nombres de los meses en español
$meses_en_espanol = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

// Obtener el nombre del mes en español
$nombre_del_mes = $meses_en_espanol[$mes - 1];
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center"><?php echo $nombre_del_mes . ' ' . $año; ?></h2>
            <div class="text-center mb-3">
                <a href="?mes=<?php echo ($mes == 1) ? 12 : $mes - 1; ?>&año=<?php echo ($mes == 1) ? $año - 1 : $año; ?>" class="btn btn-primary mr-2">Mes Anterior</a>
                <a href="?mes=<?php echo ($mes == 12) ? 1 : $mes + 1; ?>&año=<?php echo ($mes == 12) ? $año + 1 : $año; ?>" class="btn btn-primary mr-2">Mes Siguiente</a>
                <a href="?mes=<?php echo date('n'); ?>&año=<?php echo date('Y'); ?>" class="btn btn-primary">Mes Actual</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <?php foreach ($dias_de_la_semana as $dia) : ?>
                            <th><?php echo $dia; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        // Llena los espacios vacíos al principio del mes
                        for ($i = 1; $i < $primer_dia_del_mes; $i++) {
                            echo '<td></td>';
                        }

                        // Llena los días del mes
                        $dia_actual = 1;
                        for ($i = $primer_dia_del_mes; $i <= 7; $i++) {
                            echo '<td' . (($dia_actual == date('j')) ? ' class="hoy"' : '') . '><a href="#" onclick="mostrarModal(\'' . $año . '-' . $mes . '-' . $dia_actual . '\')">' . $dia_actual . '</a></td>';
                            $dia_actual++;
                        }
                        ?>
                    </tr>
                    <?php
                    // Llena los días restantes del mes
                    while ($dia_actual <= $dias_en_mes) {
                        echo '<tr>';
                        for ($i = 1; $i <= 7 && $dia_actual <= $dias_en_mes; $i++) {
                            echo '<td' . (($dia_actual == date('j')) ? ' class="hoy"' : '') . '><a href="#" onclick="mostrarModal(\'' . $año . '-' . $mes . '-' . $dia_actual . '\')">' . $dia_actual . '</a></td>';
                            $dia_actual++;
                        }
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <table class="table">
            <?php


// Obtener el ID del cliente seleccionado de los parámetros de la URL
$clienteSeleccionado = isset($_GET['cliente']) ? $_GET['cliente'] : null;

// Consulta SQL para obtener los datos de las citas filtradas por cliente
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
FROM Citas
INNER JOIN Clientes ON Citas.Id_Clientes = Clientes.Id_Clientes
INNER JOIN Usuarios AS Usuarios_Clientes ON Clientes.Id_Usuarios = Usuarios_Clientes.Id_Usuarios
INNER JOIN Estilistas ON Citas.Id_Estilistas = Estilistas.Id_Estilistas
INNER JOIN Usuarios AS Usuarios_Estilistas ON Estilistas.Id_Usuarios = Usuarios_Estilistas.Id_Usuarios
INNER JOIN Servicios ON Citas.Id_Servicios = Servicios.Id_Servicios
";

// Agregar la cláusula WHERE si se ha seleccionado un cliente
if ($clienteSeleccionado !== null) {
    $sql .= " WHERE Clientes.Id_Clientes = $clienteSeleccionado";
}

// Ejecutar la consulta SQL
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Citas</h1>
        
        
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select.form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        select.form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        button[type="submit"], button[type="button"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        button[type="button"] {
            background-color: #6c757d;
            color: #fff;
            margin-left: 10px;
        }

        button[type="button"]:hover {
            background-color: #5a6268;
        }

        .table-container {
            display: flex;
            justify-content: center;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e2e2e2;
        }

        .btn-primary, .btn-primary:hover {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-danger, .btn-danger:hover {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container">

        
        <!-- Formulario de filtrado por cliente -->
        <form action="" method="GET" style="display: none;">
            <div class="form-group">
                <label for="cliente">Seleccione un cliente:</label>
                <select class="form-control" id="cliente" name="cliente">
                <option value="" disabled>Todos los clientes</option>
                    <?php
                    // Obtener la lista de clientes desde la base de datos
                    $sqlClientes = "SELECT Clientes.*, CONCAT(Usuarios.Nombre_Usuarios, ' ', Usuarios.Apellido_Usuarios) AS Nombre_Usuario
                    FROM Clientes
                    INNER JOIN Usuarios ON Clientes.Id_Usuarios = Usuarios.Id_Usuarios";
                    $resultClientes = $conn->query($sqlClientes);

                    // Imprimir opciones del menú desplegable para cada cliente
                    while ($rowCliente = $resultClientes->fetch_assoc()) {
                        $selected = ($rowCliente['Nombre_Usuario'] == $clienteSeleccionado) ? 'selected' : '';
                        echo "<option value='" . $rowCliente["Id_Clientes"] . "' $selected>" . $rowCliente["Nombre_Usuario"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='index.php';">Quitar filtro</button>
        </form>
        
        <!-- Tabla de citas -->
        <div class="table-container mt-4">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Estilista</th>
                            <th>Servicio</th>
                            <!-- <th>Hora</th> -->
                            <th>Precio</th>
                            <th colspan="2">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Imprimir los datos en la tabla HTML
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["start"] . "</td>";
                                echo "<td>" . $row["Nombre_Cliente"] . "</td>";
                                echo "<td>" . $row["Nombre_Estilista"] . "</td>";
                                echo "<td>" . $row["Nombre_Servicios"] . "</td>";
                                // echo "<td>" . $row["end"] . "</td>";
                                echo "<td>" . $row["Precio_Servicio"] . "</td>";
                                echo "<td><a href='editar_cita.php?Id_Citas=" . $row["Id_Citas"] . "' class='btn btn-primary'>Editar</a></td>";
                                echo "<td><a href='eliminar_cita.php?Id_Citas=" . $row["Id_Citas"] . "' onclick='return confirmarEliminar();' class='btn btn-danger'>Eliminar</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>0 resultados</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap JS y otros (si es necesario) -->
    <script>
        function confirmarEliminar() {
            return confirm('¿Está seguro de que desea eliminar esta cita?');
        }
    </script>
</body>
</html>



<?php
$conn->close();
?>




            </table>
        </div>
    </div>
</div>

<!-- Modal -->


<div id="myModal" class="modal" style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ajusta el tamaño del modal a 'lg' (grande) -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="cerrarModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formulario" action="Agrega._citas.php" method="POST">
                <form id="formulario" action="Agrega._citas.php" method="POST">
                    <div class="form-group">
                        <label for="Nombre_Cliente">Nombre del Cliente:</label>
                        <select id="Nombre_Cliente" name="Nombre_Cliente" class="form-control">
                            <?php foreach ($clientes as $id => $nombre) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Nombre_Estilista">Estilista:</label>
                        <select id="Nombre_Estilista" name="Nombre_Estilista" class="form-control">
                            <?php foreach ($Estilistas as $id => $nombre) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Nombre_Servicios">Servicios:</label>
                        <select id="Nombre_Servicios" name="Nombre_Servicios" class="form-control">
                            <?php foreach ($Servicios as $id => $nombre) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="fecha_actual">Fecha actual:</label>
                        <input type="text" id="fecha_actual" name="fecha_actual" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="hora_actual">Hora actual:</label>
                        <input type="time" id="hora_actual" name="hora_actual" value="<?php echo date('H:i'); ?>" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
// Obtener el modal
var modal = document.getElementById("myModal");

// Función para mostrar el modal y establecer la fecha seleccionada en el formulario
function mostrarModal(fechaSeleccionada) {
    document.getElementById('fecha_actual').value = fechaSeleccionada;
    modal.style.display = "block";
}

// Función para cerrar el modal
function cerrarModal() {
    modal.style.display = "none";
}

// Cerrar el modal cuando el usuario haga clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) {
        cerrarModal();
    }
}
</script>

</body>
</html>

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
    <script src="./js/validaciones/ValidacionProductos.js"></script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>
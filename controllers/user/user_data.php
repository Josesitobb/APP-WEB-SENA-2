<?php
require_once('../db.php');

function cargarInforProductossView($conn){
    require_once('../../Modelos/Usuarios/detalle_productos.php');
}

function cargarInforServiciosView($conn){
    require_once('../../Modelos/Usuarios/detalle_servicios.php');
}


if(isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'infoproductos':
            cargarInforProductossView($conn);
            break;
        case 'infoservicios':
            cargarInforServiciosView($conn);
            break;
        case 'agregarcita':
            require_once('../../Modelos/Usuarios/Agregarcita.php');
            break;
        case 'cerrarsesion':
            require_once('../../Modelos/Usuarios/cerrar_Sesion.php');
        default:
            // require_once('../views/View_Error/page-error-400.php');
            break; // Agregamos break aquí
    }
}
?>

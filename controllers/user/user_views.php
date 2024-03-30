<?php
require_once('../db.php');

// Función para cargar la vista de inicio de sesión
function cargarProductosView($conn) {
    require_once('../../views/Views Usuarios/product.php');
}

function cargarServicioView($conn){
    require_once('../../views/Views Usuarios/service.php');
}
function cargarCitasView($conn){
    require_once('../../views/Views Usuarios/Citas.php');
}


if(isset($_GET['vista'])) {
    $action = $_GET['vista'];
    
    switch ($action) {
        case 'productos':
            cargarProductosView($conn);
            break;
        case 'servicios':
            cargarServicioView($conn);
            break;
        case 'citas':
            cargarCitasView($conn);
            break;
        default:
            // require_once('../views/View_Error/page-error-400.php');
            break; // Agregamos break aquí
    }
}
?>

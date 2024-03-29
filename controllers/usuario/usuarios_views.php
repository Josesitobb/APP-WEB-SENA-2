<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../db.php');

function cargarProductoView($conn){
    require('../../views/Views Usuarios/product.php');
}

function cargarServiciosView($conn){

    require('../../views/Views Usuarios/service.php');
}

function cargarCitasview($conn){
    require_once('../../views/Views Usuarios/Citas.php');
}


// Verificar la acción solicitada
if(isset($_GET['vista'])) {
    $vistas = $_GET['vista'];
    
    switch ($vistas) {
        case 'productos':
            cargarProductoView($conn);
            break;  
        case 'servicios':
            cargarServiciosView($conn);
            break;
        case 'citas':
            cargarCitasview($conn);
            break;
        default:
            // Acción por defecto si no se reconoce ninguna acción
            require_once('../../views/View_Error/page-error-400.php');
    }
} elseif (isset($_GET['mes']) && isset($_GET['año'])) {
   
} else {

    echo "No se proporcionaron parámetros para mostrar la vista.";
}
?>

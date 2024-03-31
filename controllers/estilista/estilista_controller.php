<?php
require_once('../db.php');

// Función para cargar la vista de inicio de sesión
function cargarEstilistaView($conn) {
    require_once('../../views/Views Estilistas/index.php');
    
}




if(isset($_GET['rol'])) {
    $action = $_GET['rol'];
    
    switch ($action) {
        case 'indexestilista':
            cargarEstilistaView($conn);
            break;
        default:
            // require_once('../views/View_Error/page-error-400.php');
            echo "hola";
            break; // Agregamos break aquí
    }
}
?>

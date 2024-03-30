<?php
require_once('../db.php');

// Función para cargar la vista de inicio de sesión
function cargarUserView($conn) {
    require_once('../../views/Views Usuarios/index.php');
    
}




if(isset($_GET['rol'])) {
    $action = $_GET['rol'];
    
    switch ($action) {
        case 'indexuser':
            cargarUserView($conn);
            break;
        default:
            // require_once('../views/View_Error/page-error-400.php');
            break; // Agregamos break aquí
    }
}
?>

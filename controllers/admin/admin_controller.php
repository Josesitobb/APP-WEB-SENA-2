<?php
require_once('../db.php');


function cargarIndexView(){
    require('../../views/Views_Admin/index.php');
}
// Verificar la acción solicitada
if(isset($_GET['rol'])) {
    $rol = $_GET['rol'];
    
    switch ($rol) {
        case 'indexadmin':
            cargarIndexView();
            break;
        default:
            // Acción por defecto si no se reconoce ninguna acción
            require_once('../../views/View_Error/page-error-400.php');
    }
}
?>

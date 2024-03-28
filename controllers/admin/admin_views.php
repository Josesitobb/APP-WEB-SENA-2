<?php
require_once('../db.php');


function cargarUsuariosCView($conn){
    require('../../views/Views_Admin/Clientes.php');
}

function cargarUsuarioEView($conn){
    require('../../views/Views_Admin/Estilistas.php');
}

function cargarProductosView($conn){
    require('../../views/Views_Admin/Productos.php');
}

function cargarCitaView($conn){
    require('../../views/Views_Admin/Citas.php');
}

function cargarFacturaView($conn){
    require('../../views/Views_Admin/Facturas.php');
}

function cargarServicioView($conn){
    require('../../views/Views_Admin/Servicios.php');
}
// Verificar la acción solicitada
if(isset($_GET['vista'])) {
    $vistas = $_GET['vista'];
    
    switch ($vistas) {
        case 'usuariosC':
            cargarUsuariosCView($conn);
            break;
        case 'usuariosE':
            cargarUsuarioEView($conn);
            break;
        case 'productos':
            cargarProductosView($conn);
            break;
        case 'servicios':
            cargarServicioView($conn);
            break;
        case 'citas':
            cargarCitaView($conn);
            break;
        case 'factura':
            cargarFacturaView($conn);
            break;
            
        default:
            // Acción por defecto si no se reconoce ninguna acción
            require_once('../../views/View_Error/page-error-400.php');
    }
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

function cargarEditarCita($conn){
    require('../../views/Views_Admin/Editar_Cita.php');
}

function cargarReporteCitasview($conn){
    require('../../views/Views_Admin/Reporte_Citas.php');
}

function cargarReporteProductosview($conn){
    require('../../views/Views_Admin/Reporte_Productos.php');
}
function cargarReporteUsuarioview($conn){
    require('../../views/Views_Admin/Reporte_Usuarios.php');
}
function cargarComisionesView($conn){
    require_once('../../views/Views_Admin/Comisiones.php');
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
        case 'EditarCita':
            cargarEditarCita($conn);
            break;
        case 'citasr':
            cargarReporteCitasview($conn);
            break;
        case 'usuariosr':
            cargarReporteUsuarioview($conn);
            break;
        case 'productosr':
            cargarReporteProductosview($conn);
            break;
        case 'comisiones':
            cargarComisionesView($conn);
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

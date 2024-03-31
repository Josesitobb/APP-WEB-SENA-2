<?php
require_once('../db.php');

// Función para cargar la vista de inicio de sesión
function cargarServiciosEstilistaView($conn) {
    require_once('../../views/Views Estilistas/Servicios.php');
    
}

function cargarProductosEstilistaView($conn){
    require_once('../../views/Views Estilistas/Productos.php');
}
function cargarCitasEstilistaView($conn){
    require_once('../../views/Views Estilistas/Citas.php');
}

function cargarEditarCitaView($conn){
    require_once('../../views/Views Estilistas/Editar_Cita.php');
}

if(isset($_GET['vista'])) {
    $action = $_GET['vista'];
    
    switch ($action) {
        case 'servicios':
            cargarServiciosEstilistaView($conn);
            break;
        case 'productos':
            cargarProductosEstilistaView($conn);
            break;
        case 'citas':
            cargarCitasEstilistaView($conn);
            break;
        case 'EditarCita':
            cargarEditarCitaView($conn);
            break;

        default:
            // require_once('../views/View_Error/page-error-400.php');
            echo "hola";
            break; // Agregamos break aquí
    }
}
?>

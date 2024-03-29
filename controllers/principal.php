<?php



require_once('db.php');


function cargarGaleriaView() {
    require_once('../views/View_company/gallery.php');
    
}


function cargarInicioView($conn) {
    require_once('../views/View_company/service.php');

}


function cargarContactoView() {
    require_once('../views/View_company/contact.php');
    
}

function cargarNosotrosView(){
    require_once('../views/View_company/about.php');
}

function cargarProductosView($conn){
    require_once('../views/View_company/product.php');
}

function cargarIndexView(){
    require('../views/View_company/index.php');
}
// Verificar la acción solicitada
if(isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'galeria':
            cargarGaleriaView();
            break;
        case 'servicios':
            cargarInicioView($conn);
            break;
        case 'contacto':
            cargarContactoView();
            break;
        case 'nosotros':
            cargarNosotrosView();
            break;
        case 'productos':
        
            if ($conn) {
                cargarProductosView($conn);
            } else {
                echo "Error: No se pudo conectar a la base de datos.";
            }
            break;
        case 'index':
            cargarIndexView();
            break;
        default:
            // Acción por defecto si no se reconoce ninguna acción
            require_once('../views/View_Error/page-error-400.php');
    }
}
?>

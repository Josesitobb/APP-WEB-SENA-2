<?php
require_once('db.php');

// Función para cargar la vista de inicio de sesión
function cargarLoginView() {
    require_once('../views/View_Login/Login.php');
}

// Función para validar el inicio de sesión
function validarInicioSesion() {
    include_once('../Modelos/Login/validad.php');
}

// Función para cargar la vista de registro
function cargarRegisterView(){
    require_once('../views/View_Login/register.html');
}

// Función para registrar usuarios
function registrarUsuarios(){
    include_once('../Modelos/Login/register.php');
}



if(isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'login':
            cargarLoginView();
            break;
        case 'validar':
            validarInicioSesion();
            break; // Agregamos break aquí
        case 'register':
            cargarRegisterView();
            break; // Agregamos break aquí
        case 'registrar':
            registrarUsuarios();
            break; // Agregamos break aquí
        default:
            require_once('../views/View_Error/page-error-400.php');
            break; // Agregamos break aquí
    }
}
?>

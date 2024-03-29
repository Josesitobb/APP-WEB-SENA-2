<?php
require_once('../db.php');

function cargarEditarCita($conn){
    require('../../views/Views_Admin/Editar_Cita.php');
}

// Verificar si se proporciona un parámetro en la URL
if(isset($_GET['cliente'])) {
    // Obtener el valor del parámetro
    $cliente = $_GET['cliente'];

    // Dependiendo del valor del parámetro, cargar la vista correspondiente
    switch ($cliente) {
        case 'cliente':
            // Cargar la vista de editar cita
            cargarEditarCita($conn);
            break;
        default:
            // Cargar la vista de citas por defecto si no se proporciona un valor válido
            cargarCitasView($conn);
            break;
    }
} else {
    // Si no se proporciona ningún parámetro en la URL, cargar la vista de citas por defecto
    cargarCitasView($conn);
}

// Función para cargar la vista de citas
function cargarCitasView($conn) {
    // Aquí puedes requerir la vista de citas o realizar cualquier acción adicional
    require('../../views/Views_Admin/Citas.php');
    echo "Cargar vista de citas aquí";
}
?>

<?php
require_once('../db.php');

if(isset($_GET['action'])) {
    $action = $_GET['action'];

    // Hacer que $conn sea accesible dentro del ámbito de los archivos incluidos
    global $conn;

    switch ($action) {
        case 'usuariosclientesagregar':
        // CLIENTES
            require_once('../../Modelos/Admin/Agregar_Clientes.php');
            break;
        case 'usuariosclienteseditar':
            require_once('../../Modelos/Admin/Editar_Clientes.php');
            break;
        case 'borrar_cliente':
            require_once('../../Modelos/Admin/Borrar_Clientes.php');
            break;
            // ESTILISTAS
        case 'agregarestilista':
            require_once('../../Modelos/Admin/Agregar_Estilista.php');
            break;
        case 'usuariosestilistaseditar':
            require_once('../../Modelos/Admin/Editar_Estilistas.php');
            break;
            // PRODUCTOS
        case 'agregarproducto':
            require_once('../../Modelos/Admin/AgregarProducto.php');
            break;
        default:
        case 'editarproducto':
            require_once('../../Modelos/Admin/EditarProductos.php');
            break;
        case 'agregarservicio':
            require_once('../../Modelos/Admin/AgregarServicios.php');

            echo "pa donde va rey";
            break;
    }
}
?>

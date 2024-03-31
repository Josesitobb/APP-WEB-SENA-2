<?php
require_once('../db.php');

if(isset($_GET['action'])) {
    $action = $_GET['action'];


    global $conn;

    switch ($action) {
        // case 'usuariosclientesagregar':
        //     // CITAS
        // case 'agregarcitas':
        //     require_once('../../Modelos/Estilistas/Agregar_Citas.php');
        //     break;
        // case 'actualizarprecio':
        //     require_once('../../Modelos/Admin/obtener_precio_servicio.php');
        //     break;
        case 'actualizarcita':
            require_once('../../Modelos/Estilistas/Actualizar_Cita.php');
            break;
        case 'agregarcitas':
            require_once('../../Modelos/Estilistas/Agregar_Citas.php');
        case 'EliminarCita':
            require_once('../../Modelos/Estilistas/eliminar_cita.php');
            break;
        case 'factura':
            require_once('../../Modelos/Estilistas/procesar_pedido_factura.php');
            break;

            echo "pa donde va rey";
            break;
    }
}
?>

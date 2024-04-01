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
            // SERVICIOS
        case 'agregarservicio':
            require_once('../../Modelos/Admin/AgregarServicios.php');
            break;
            // CITAS
        case 'agregarcitas':
            require_once('../../Modelos/Admin/Agregar_Citas.php');
            break;
        case 'actualizarprecio':
            require_once('../../Modelos/Admin/obtener_precio_servicio.php');
            break;
        case 'actualizarcita':
            require_once('../../Modelos/Admin/Actualizar_Cita.php');
            break;
        case 'EliminarCita':
            require_once('../../Modelos/Admin/Eliminar_Cita.php');
            break;
        case 'generarPDF':
            require_once('../../Modelos/Admin/reportes_pdf/generar_pdf.php');
            break;
        case 'excelclientes':
            require_once('../../Modelos/Admin/reportes_excel/execel_clientes.php');
            break;
        case 'excelcitas':
            require_once('../../Modelos/Admin/reportes_excel/execel_citas.php');
            break;
        case 'excelestilistas':
            require_once('../../Modelos/Admin/reportes_excel/execel_estilistas.php');
            break;
        case 'excelproductos':
            require_once('../../Modelos/Admin/reportes_excel/execel_productos.php');
            break;
        case 'excelservicios':
            require_once('../../Modelos/Admin/reportes_excel/execel_servicios.php');
            break;
        case 'cerrarsesion':
            require_once('../../Modelos/Admin/Cerrar_Sesion.php');
            

            echo "pa donde va rey";
            break;
    }
}
?>

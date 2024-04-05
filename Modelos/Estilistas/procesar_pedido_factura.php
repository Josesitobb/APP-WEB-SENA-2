<?php
// Verificar si algún campo obligatorio está vacío
if (empty($_POST['cliente']) || empty($_POST['producto']) || empty($_POST['servicio']) || empty($_POST['total_factura']) || empty($_POST['id_estilista'])) {
    echo "<script>alert('Por favor, complete todos los campos del formulario'); history.back();</script>";
    exit; // Detener la ejecución del código PHP
}
// Verificar si se cumple la condición para la validación de campos
// Verificar si se cumple la condición para la validación de campos
if (
    (!empty($_POST['producto']) && !empty($_POST['precio_unitario']) && !empty($_POST['cantidad']) && !empty($_POST['total_productos'])) &&
    (!empty($_POST['servicio']) && (!isset($_POST['cantidad_servicios']) || empty($_POST['cantidad_servicios'])) || !empty($_POST['precio_servicio']) || !empty($_POST['valor_total_servicios']))
) {
    echo "<script>alert('Por favor, complete todos los campos del formulario correctamente.'); history.back();</script>";
    exit; // Detener la ejecución del código PHP
}



include("../../controllers/db.php");

// Usuario cliente
$cliente = $_POST['cliente'];

// Productos
$producto = $_POST['producto'];

// Precio unitario / individual productos
$precio_unitario = $_POST['precio_unitario'];

// Cantidad productos
$cantidad_productos = $_POST['cantidad'];

// Total productos 
$total_productos = $_POST['total_productos'];

// Servicio
$servicio = $_POST['servicio'];

// Cantidad servicios
$cantidad_servicios = $_POST['cantidad_servicios'];

// Precio unitario /individual servicios
$precio_servicio = $_POST['precio_servicio'];

// Valor total servicios
$total_servicios = $_POST['valor_total_servicios'];

// Porcentaje en Valor Total Servicios
$porcentaje = 50; // Cambia este valor al porcentaje deseado

// Verificar si $total_productos es 'NaN' y asignarle 0 si es así
if (!is_numeric($total_productos)) {
    $total_productos = 0;
}

// Verificar si $total_servicios es 'NaN' y asignarle 0 si es así
if (!is_numeric($total_servicios)) {
    $total_servicios = 0;
}

// Calcular el porcentaje en Valor Total Servicios
if (is_numeric($total_servicios) && $total_servicios != 0) {
    $porcentaje_valor_total_servicios = ($total_servicios * $porcentaje) / 100;
} else {
    // Si el total de servicios es nulo o cero, establecer el porcentaje en 0
    $porcentaje_valor_total_servicios = 0;
}

// Total factura
$total_factura = $_POST['total_factura'];

// Id estilista del que inicia sesión
$id_estilista = $_POST['id_estilista'];

// Obtener la fecha y hora actual
$fecha_actual = date("Y-m-d H:i:s");

// Insertar la factura en la base de datos
$sql_insert_factura = "INSERT INTO `facturas`(`Fecha_Factura`, `Precio_Total_Productos`, `Precio_Total_Servicios`, `Factura_Total`, `Cantidad_Productos`, `Cantidad_Servicios`, `Id_Productos`, `Id_Servicios`, `Id_Clientes`, `Id_Estilistas`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta para insertar factura
$stmt_insert_factura = $conn->prepare($sql_insert_factura);

// Asociar los parámetros para insertar factura
$stmt_insert_factura->bind_param("ssssssssss", $fecha_actual, $total_productos, $total_servicios, $total_factura, $cantidad_productos, $cantidad_servicios, $producto, $servicio, $cliente, $id_estilista);

// Ejecutar la consulta para insertar factura
if ($stmt_insert_factura->execute()) {
    // Obtener la última ID de la factura insertada
    $last_insert_id = $conn->insert_id;

    // Insertar en la tabla de comisiones solo si el valor de Valor Total Servicios no es nulo ni cero
    if ($porcentaje_valor_total_servicios != 0) {
        $sql_insert_comision = "INSERT INTO `comisiones`(`Id_Facturas`, `Id_Estilistas`, `Pagar_Comisiones`) VALUES (?, ?, ?)";
        // Preparar la consulta para insertar comisión
        $stmt_insert_comision = $conn->prepare($sql_insert_comision);
        // Asociar los parámetros para insertar comisión
        $stmt_insert_comision->bind_param("sss", $last_insert_id, $id_estilista, $porcentaje_valor_total_servicios);
        // Ejecutar la consulta para insertar comisión
        if ($stmt_insert_comision->execute()) {
            // Cerrar la consulta para insertar comisión
            $stmt_insert_comision->close();
        } else {
            echo "Error al insertar comisión: " . $conn->error;
        }
    } else {
        // Mostrar un mensaje indicando que no se insertó comisión
        echo "No se insertó comisión porque el Valor Total de Servicios es nulo o cero.";
    }

    // Actualizar la cantidad de productos en la base de datos si la cantidad vendida es mayor que 0
    if ($cantidad_productos > 0) {
        $sql_update_productos = "UPDATE productos SET Cantidad_Productos = Cantidad_Productos - ? WHERE Id_Productos = ?";
        $stmt_update_productos = $conn->prepare($sql_update_productos);
        $stmt_update_productos->bind_param("ss", $cantidad_productos, $producto);
        $stmt_update_productos->execute();
        $stmt_update_productos->close();
    }

    // Cerrar la consulta para insertar factura
    $stmt_insert_factura->close();

    // Cerrar la conexión
    $conn->close();

    // Alerta de éxito y redireccionamiento
    echo "<script>alert('La operación fue exitosa.'); window.location.href = 'estilista_views.php?vista=productos';</script>";
} else {
    // Mostrar un mensaje de error si la inserción falla
    echo "Error al insertar factura: " . $conn->error;
}
?>

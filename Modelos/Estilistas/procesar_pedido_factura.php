<?php
include("db.php");

// Usuario cliente
$cliente = !empty($_POST['cliente']) ? $_POST['cliente'] : null;

// Productos
$producto = !empty($_POST['producto']) ? $_POST['producto'] : null;

// Precio unitario / individual productos
$precio_unitario = !empty($_POST['precio_unitario']) ? $_POST['precio_unitario'] : null;

// Cantidad productos
$cantidad_productos = !empty($_POST['cantidad']) ? $_POST['cantidad'] : null;

// Total productos 
$total_productos = !empty($_POST['total_productos']) ? $_POST['total_productos'] : null;

// Servicio
$servicio = !empty($_POST['servicio']) ? $_POST['servicio'] : null;

// Cantidad servicios
$cantidad_servicios = !empty($_POST['cantidad_servicios']) ? $_POST['cantidad_servicios'] : null;

// Precio unitario /individual servicios
$precio_servicio = !empty($_POST['precio_servicio']) ? $_POST['precio_servicio'] : null;

// Valor total servicios
$total_servicios = !empty($_POST['valor_total_servicios']) ? $_POST['valor_total_servicios'] : null;

// Total factura
$total_factura = !empty($_POST['total_factura']) ? $_POST['total_factura'] : null;

// Id estilista del que inicia sesión
$id_estilista = !empty($_POST['id_estilista']) ? $_POST['id_estilista'] : null;

// Imprimir los valores recibidos
echo "Usuario: " . $cliente . "<br>";
echo "Producto: " . $producto . "<br>";
echo "Precio unitario: " . $precio_unitario . "<br>";
echo "Cantidad productos: " . $cantidad_productos . "<br>";
echo "Total productos: " . $total_productos . "<br>";
echo "Servicio: " . $servicio . "<br>";
echo "Cantidad servicios: " . $cantidad_servicios . "<br>";
echo "Precio servicio: " . $precio_servicio . "<br>";
echo "Total factura: " . $total_factura . "<br>";
echo "Id estilista: " . $id_estilista . "<br>";

// Obtener la fecha y hora actual
$fecha_actual = date("Y-m-d H:i:s");

$sql = "INSERT INTO `facturas`(`Fecha_Factura`, `Precio_Total_Productos`, `Precio_Total_Servicios`, `Factura_Total`, `Cantidad_Productos`, `Cantidad_Servicios`, `Id_Productos`, `Id_Servicios`, `Id_Clientes`, `Id_Estilistas`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Asociar los parámetros
$stmt->bind_param("ssssssssss", $fecha_actual, $total_productos, $total_servicios, $total_factura, $cantidad_productos, $cantidad_servicios, $producto, $servicio, $cliente, $id_estilista);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Factura insertada correctamente.";
} else {
    echo "Error al insertar factura: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

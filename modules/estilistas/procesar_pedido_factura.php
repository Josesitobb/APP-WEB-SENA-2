<?php
include("db.php");

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

// Total factura
$total_factura = $_POST['total_factura'];

// Id estilista del que inicia sesión
$id_estilista = $_POST['id_estilista'];

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


// $sql = "INSERT INTO `facturas`(`Fecha_Factura`, `Precio_Total_Productos`, `Precio_Total_Servicios`, `Factura_Total`, `Cantidad_Productos`, `Cantidad_Servicios`, `Id_Productos`, `Id_Servicios`, `Id_Clientes`, `Id_Estilistas`) 
//         VALUES (NOW(),'$total_productos','$total_servicios','$total_factura','$cantidad_productos','$cantidad_servicios','$producto','$servicio','$cliente','$id_estilista')";

// if ($conn->query($sql) === TRUE) {
//     echo "Factura insertada correctamente.";
// } else {
//     echo "Error al insertar factura: " . $conn->error;
// }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
        </div>
        <h2>Productos</h2>
        <table>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
            <tr>
                <td><?= $producto ?></td>
                <td><?= $cantidad_productos ?></td>
                <td>$<?= $precio_unitario ?></td>
                <td>$<?= $total_productos ?></td>
            </tr>
        </table>
        <h2>Servicios</h2>
        <table>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
            <tr>
                <td><?= $servicio ?></td>
                <td><?= $cantidad_servicios ?></td>
                <td>$<?= $precio_servicio ?></td>
                <td>$<?= $total_servicios ?></td>
            </tr>
        </table>
        <div class="total">Total Factura: $<?= $total_factura ?></div>
        <p><strong>Cliente:</strong> <?= $cliente ?></p>
        <p><strong>Estilista:</strong> <?= $id_estilista ?></p>
    </div>
</body>
</html>

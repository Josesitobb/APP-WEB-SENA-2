<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    echo json_encode(array('success' => false, 'message' => 'Sesión no iniciada.'));
    exit();
}

// Verificar si se recibieron los parámetros necesarios
if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    echo json_encode(array('success' => false, 'message' => 'Parámetros incompletos.'));
    exit();
}

// Incluir el archivo de conexión a la base de datos
include("../../controllers/db.php");

// Obtener los datos del formulario
$product_id = $_POST['product_id'];
$new_quantity = intval($_POST['quantity']); // Convertir la cantidad a entero

// Verificar si la cantidad es un número válido
if (!is_numeric($new_quantity) || $new_quantity < 0) {
    echo json_encode(array('success' => false, 'message' => 'La cantidad debe ser un número entero positivo.'));
    exit();
}

// Consultar la cantidad actual del producto
$sql_select_quantity = "SELECT Cantidad_Productos FROM productos WHERE Id_Productos = ?";
$stmt_select_quantity = $conn->prepare($sql_select_quantity);
$stmt_select_quantity->bind_param("i", $product_id);
$stmt_select_quantity->execute();
$result_select_quantity = $stmt_select_quantity->get_result();

if ($result_select_quantity->num_rows > 0) {
    $row = $result_select_quantity->fetch_assoc();
    $current_quantity = intval($row['Cantidad_Productos']);
    
    // Verificar si la nueva cantidad es menor que 0
    if ($new_quantity < 0) {
        echo json_encode(array('success' => false, 'message' => 'La cantidad no puede ser negativa.'));
        exit();
    }

    // Realizar la actualización de la cantidad en la base de datos
    $sql_update_quantity = "UPDATE productos SET Cantidad_Productos = ? WHERE Id_Productos = ?";
    $stmt_update_quantity = $conn->prepare($sql_update_quantity);
    $stmt_update_quantity->bind_param("ii", $new_quantity, $product_id);
    if ($stmt_update_quantity->execute()) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al actualizar la cantidad en la base de datos: ' . $conn->error));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'No se encontró el producto en la base de datos.'));
}

// Cerrar las consultas y la conexión
$stmt_select_quantity->close();
$stmt_update_quantity->close();
$conn->close();
?>

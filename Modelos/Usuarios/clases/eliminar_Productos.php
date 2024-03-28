<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el ID del producto y la acción están presentes
    if (isset($_POST['Id_Productos']) && isset($_POST['action'])) {
        $id_producto = $_POST['Id_Productos'];

        if ($_POST['action'] === 'eliminar') {
            // Verifica si el producto está en el carrito
            if (isset($_SESSION['carrito']['productos'][$id_producto])) {
                // Elimina el producto del carrito
                unset($_SESSION['carrito']['productos'][$id_producto]);
                
                // Envía una respuesta JSON indicando éxito
                echo json_encode(['ok' => true]);
                exit;
            }
        }
    }
}

// Envía una respuesta JSON indicando un error si algo salió mal
echo json_encode(['ok' => false]);
?>

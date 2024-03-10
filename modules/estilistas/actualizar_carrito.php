<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_POST['actualizar_carrito']) && isset($_POST['cantidad'])) {
    foreach ($_POST['cantidad'] as $producto_id => $cantidad) {
        // Verificar si la cantidad es válida (mayor que cero)
        if ($cantidad > 0) {
            $_SESSION['carrito'][$producto_id] = $cantidad;
        } else {
            // Si la cantidad es cero o negativa, eliminar el producto del carrito
            unset($_SESSION['carrito'][$producto_id]);
        }
    }
}

// Redirigir de vuelta a la página de productos después de actualizar el carrito
header("Location: Productos.php");
exit();
?>

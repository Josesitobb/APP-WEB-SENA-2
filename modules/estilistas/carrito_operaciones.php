<?php


function agregarProductoAlCarrito($id_producto, $cantidad) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Verificar si el producto ya está en el carrito
    if (array_key_exists($id_producto, $_SESSION['carrito'])) {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        // Si el producto no está en el carrito, agregarlo con la cantidad especificada
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }
}

function actualizarCantidadProductoEnCarrito($id_producto, $cantidad) {
    if (isset($_SESSION['carrito'][$id_producto])) {
        // Actualizar la cantidad del producto en el carrito
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }
}

function eliminarProductoDelCarrito($id_producto) {
    if (isset($_SESSION['carrito'][$id_producto])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$id_producto]);
    }
}
?>

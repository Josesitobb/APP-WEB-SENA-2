<?php
session_start();
include "carrito_operaciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    agregarProductoAlCarrito($id_producto, $cantidad);
    header("Location: productos.php");
    exit();
}
?>

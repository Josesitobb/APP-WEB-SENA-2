<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

$id = $_REQUEST['id'];

$sql = "DELETE FROM `productos` WHERE Id_Productos = $id";

$Resultado = $conn->query($sql);

if ($Resultado) {
    echo "<script>alert('El producto se ha eliminado exitosamente.');</script>";
    header("Refresh: 0; URL=../../controllers/admin/admin_views.php?vista=productos"); // Redireccionar a productos.php inmediatamente
} else {
    echo "<script>alert('No se pudo eliminar el producto.');</script>";
}
?>

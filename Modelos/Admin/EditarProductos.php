<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../../controllers/db.php");

$Id = $_REQUEST['idProducto'];
$producto_nombret = $_POST['nombreProducto'];
$producto_precio = $_POST['precioProducto'];
$producto_cantidad = $_POST['cantidadProducto'];
$Descripcion_Productos = $_POST['Destalleproductos'];

// Verificar si se ha subido un nuevo archivo de imagen
if (!empty($_FILES['imagenesProducto']['tmp_name'])) {
    $Imagen_productos = addslashes(file_get_contents($_FILES['imagenesProducto']['tmp_name']));
    $updateImage = true;
    $extension = strtolower(pathinfo($_FILES['imagenesProducto']['name'], PATHINFO_EXTENSION));
    if ($extension != 'jpg') {
        // Mostrar un mensaje de error y redirigir
        echo "<script>alert('Solo se permiten archivos JPG (.jpg)');</script>";
        echo "<script>window.history.go(-1);</script>";
        exit(); // Detener la ejecución del script
        }
} else {
    // Si no se subió un nuevo archivo de imagen, mantener la imagen existente en la base de datos
    $updateImage = false;
}

// Construir la consulta SQL de actualización
if ($updateImage) {
    $sql = "UPDATE productos SET Nombre_Productos='$producto_nombret', Precio_Productos='$producto_precio', Cantidad_Productos='$producto_cantidad', Imagen_Productos='$Imagen_productos', Descripcion_Productos='$Descripcion_Productos' WHERE Id_Productos = $Id";
} else {
    $sql = "UPDATE productos SET Nombre_Productos='$producto_nombret', Precio_Productos='$producto_precio', Cantidad_Productos='$producto_cantidad', Descripcion_Productos='$Descripcion_Productos' WHERE Id_Productos = $Id";
}

$resultado = $conn->query($sql);

if ($resultado) {
    header('location:../../controllers/admin/admin_views.php?vista=productos');
} else {
    echo "No se editó el dato: " . mysqli_error($conn);
}
?>
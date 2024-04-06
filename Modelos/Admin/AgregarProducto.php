<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

// Verificar si se ha enviado una imagen
if (isset($_FILES['imagenProducto'])) {
    // Obtener el nombre y la extensión del archivo
    $nombreArchivo = $_FILES['imagenProducto']['name'];
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

    // Verificar si la extensión es .jpg
    if ($extension != 'jpg') {
        // Mostrar un mensaje de error y redirigir
        echo "<script>alert('Solo se permiten archivos JPG (.jpg)');</script>";
        echo "<script>window.history.go(-1);</script>";
        exit(); // Detener la ejecución del script
    }

    // Procesar el archivo si es de tipo JPEG
    $Name_product = $_POST['nombreProducto'];
    $Price_Name = $_POST['precioProducto'];
    $Product_description = $_POST['descripcionProducto'];
    $Product_amount = $_POST['cantidadProducto'];

    //$FILES ES UN ARRAY QUE CONTIENE LA IMAGEN
    // el nombre temporal del archivo cargado en el servidor tmp_name
    // file_get_contents lee completamente un archivo en una caneda
    // addslashes modifica la cadena para caractetes especiales 

    $Product_Image = addslashes(file_get_contents($_FILES['imagenProducto']['tmp_name']));

    // Preparar la consulta SQL para insertar los datos del producto
    $sql = "INSERT INTO `productos`(`Id_Productos`, `Nombre_Productos`, `Precio_Productos`, `Cantidad_Productos`, `Descripcion_Productos`, `Imagen_Productos`) 
            VALUES (null, '$Name_product', '$Price_Name', '$Product_amount', '$Product_description', '$Product_Image')";

    // Ejecutar la consulta
    $Resultado = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if ($Resultado) {
        header('location:../../controllers/admin/admin_views.php?vista=productos');
    } else {
        echo "No se insertaron los datos.";
    }
} else {
    echo "No se ha enviado ninguna imagen.";
}
?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../../controllers/db.php");

$Id = $_REQUEST['editId'];
$servicio_nombre = $_POST['editNombre'];
$servicio_valor = $_POST['editPrecio'];
$servicio_descripcion = $_POST['editDescripcion'];

//Comprueba si se ha subido una nueva imagen
if (!empty($_FILES['editImagen']['tmp_name'])) {
    $servicio_Imagen = addslashes(file_get_contents($_FILES['editImagen']['tmp_name']));
    $updateImage = true;

    // Obtener la extensión del archivo cargado
    $extension = strtolower(pathinfo($_FILES['editImagen']['name'], PATHINFO_EXTENSION));

    // Verificar si la extensión es .jpg
    if ($extension != 'jpg') {
        // Mostrar un mensaje de error y redirigir
        echo "<script>alert('Solo se permiten archivos JPEG (.jpg)');</script>";
        echo "<script>window.history.go(-1);</script>";
        exit(); // Detener la ejecución del script
    }

} else {
    // No se cargó ninguna imagen nueva, use la imagen existente de la base de datos
    $query = "SELECT Imagen_Servicios FROM servicios WHERE Id_Servicios = $Id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $servicio_Imagen = $row['Imagen_Servicios'];
    } else {
        echo "Error: No existing image found for the specified ID.";
        exit();
    }
    $updateImage = false;
}

// Construir la consulta SQL de actualización
if ($updateImage) {
    $sql = "UPDATE `servicios` SET `Nombre_Servicios`='$servicio_nombre', `Valor_Servicios`='$servicio_valor', `Descripcion_Servicios`='$servicio_descripcion', `Imagen_Servicios`='$servicio_Imagen' WHERE Id_Servicios = $Id";
} else {
    $sql = "UPDATE `servicios` SET `Nombre_Servicios`='$servicio_nombre', `Valor_Servicios`='$servicio_valor', `Descripcion_Servicios`='$servicio_descripcion' WHERE Id_Servicios = $Id";
}

$resultado = $conn->query($sql);

if ($resultado) {
    echo "<script>alert('Edicion exitosa');</script>";
    echo "<script>window.location.href='../../controllers/admin/admin_views.php?vista=servicios';</script>";
} else {
    echo "No se editó el dato.";
}
?>

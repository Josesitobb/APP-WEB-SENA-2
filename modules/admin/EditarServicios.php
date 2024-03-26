<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

$Id = $_REQUEST['editId'];
$servicio_nombre = $_POST['editNombre'];
$servicio_valor = $_POST['editPrecio'];
$servicio_descripcion = $_POST['editDescripcion'];

// Check if a new image is uploaded
if (!empty($_FILES['editImagen']['tmp_name'])) {
    $servicio_Imagen = addslashes(file_get_contents($_FILES['editImagen']['tmp_name']));
    $updateImage = true;
} else {
    // No new image uploaded, use the existing image from the database
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
    header('location:Servicios.php');
} else {
    echo "No se editó el dato.";
}
?>

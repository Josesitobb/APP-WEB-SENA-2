<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

// Verificar si se ha cargado un archivo
if(isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen'];

    // Obtener la extensión del archivo
    $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);

    // Verificar si la extensión es JPEG
    if(strtolower($extension) != 'jpg') {
        // Mostrar una alerta
        echo "<script>alert('Solo se permiten archivos JPEG (.jpg)');</script>";

        echo "<script>window.history.go(-1);</script>";
        exit(); // Detener la ejecución del script
    }


    $Servicio_Nombre = $_POST['nombre'];
    $Servicio_Precio = $_POST['precio'];
    $Servicio_Descripcion = $_POST['descripcion'];
    //$FILES ES UN ARRAY QUE CONTIENE LA IMAGEN
    // el nombre temporal del archivo cargado en el servidor tmp_name
    // file_get_contents lee completamente un archivo en una caneda
    // addslashes modifica la cadena para caractetes especiales 

    $Servicio_Imagen = addslashes(file_get_contents($imagen['tmp_name']));

    $sql = "INSERT INTO `servicios`(`Id_Servicios`, `Nombre_Servicios`, `Valor_Servicios`, `Descripcion_Servicios`, `Imagen_Servicios`) VALUES (null,'$Servicio_Nombre','$Servicio_Precio','$Servicio_Descripcion','$Servicio_Imagen')";

    $Resultado = $conn->query($sql);

    if ($Resultado) {
        header("location:../../controllers/admin/admin_views.php?vista=servicios");
    } else {
        echo "No se insertaron los datos: " . $conn->error;
    }
} else {
    echo "No se ha seleccionado ningún archivo de imagen";
}
?>

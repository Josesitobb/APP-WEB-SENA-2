<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");

$Servicio_Nombre = $_POST['nombre'];
$Servicio_Precio = $_POST['precio'];
$Servicio_Descripcion = $_POST['descripcion'];

$Servicio_Imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$sql = "INSERT INTO `servicios`(`Id_Servicios`, `Nombre_Servicios`, `Valor_Servicios`, `Descripcion_Servicios`, `Imagen_Servicios`) VALUES (null,'$Servicio_Nombre','$Servicio_Precio','$Servicio_Descripcion','$Servicio_Imagen')";

$Resultado = $conn->query($sql);

if ($Resultado) {
    header('location:Servicios.php');
} else {
    echo "No se insertaron los datos: " . $conn->error;
}



?>
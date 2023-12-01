<?php

include("db.php");

$Servicio_Nombre = $_POST['Servicio_Nombre'];
$Servicio_Precio = $_POST['Servicio_Precio'];
$Servicio_cantidad = $_POST['Servicio_cantidad'];
$Servicio_Imagen = addslashes(file_get_contents($_FILES['servicio_Imagen']['tmp_name']));

$sql = "INSERT INTO `servicios`(`idSERVICIOS`, `servicio_nombre`, `servicio_valor`, `servicio_cantidad`, `servicio_Imagen`) VALUES (null,'$Servicio_Nombre','$Servicio_Precio','$Servicio_cantidad','$Servicio_Imagen')";

$Resultado = $conn->query($sql);

if ($Resultado) {
    header('location:layout-two-column.php');
} else {
    echo "No se insertaron los datos: " . $conn->error;
}



?>
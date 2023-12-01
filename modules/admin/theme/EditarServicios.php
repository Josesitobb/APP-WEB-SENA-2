<?php

error_reporting(1);

include("db.php");

$Id = $_REQUEST['IdEditar'];

$servicio_nombre= $_POST['servicio_nombre'];

$servicio_valor=$_POST['servicio_valor'];

$servicio_cantidad=$_POST['servicio_cantidad'];

$servicio_Imagen= addslashes(file_get_contents($_FILES['servicio_Imagen']['tmp_name']));



// $sql="UPDATE `servicios` SET `idSERVICIOS`=null,`servicio_nombre`='$servicio_nombre',`servicio_valor`='$servicio_valor',`servicio_cantidad`='$servicio_cantidad',`servicio_Imagen`='$servicio_Imagen' WHERE idSERVICIOS = $Id ";
$sql = "UPDATE `servicios` SET `servicio_nombre`='$servicio_nombre', `servicio_valor`='$servicio_valor', `servicio_cantidad`='$servicio_cantidad', `servicio_Imagen`='$servicio_Imagen' WHERE idSERVICIOS = $Id";


$resultado = $conn -> query($sql);

if($resultado){
    header('location:layout-two-column.php');
}else{
    echo "no se edito el dato";
}
?>
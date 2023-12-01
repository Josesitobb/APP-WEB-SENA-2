<?php

error_reporting(1);

include("db.php");

$Id = $_REQUEST['IdEditar'];

$producto_nombret= $_POST['Name_producto'];

$producto_precio=$_POST['Price_producto'];

$producto_cantidad=$_POST['Amount_producto'];

$Imagen_productos= addslashes(file_get_contents($_FILES['Producto_Imagen']['tmp_name']));



$sql="UPDATE `productos` SET `idPRODUCTOS`=null,`producto_nombre`='$producto_nombret',`producto_precio`='$producto_precio',`producto_cantidad`='$producto_cantidad',`Imagen_productos`='$Imagen_productos' WHERE idPRODUCTOS = $Id ";

$resultado = $conn -> query($sql);

if($resultado){
    header('location:layout-one-column.php');
}else{
    echo "no se edito el dato";
}
?>
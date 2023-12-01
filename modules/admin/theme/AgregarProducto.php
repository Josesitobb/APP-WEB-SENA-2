<?php

include("db.php");

$Name_product=$_POST['Name_product'];

$Price_Name = $_POST['Price_Name'];

$Product_amount = $_POST['Product_amount'];

$Product_Image =addslashes(file_get_contents($_FILES['Product_Image']['tmp_name']));

$sql="INSERT INTO `productos`(`idPRODUCTOS`, `producto_nombre`, `producto_precio`, `producto_cantidad`, `Imagen_productos`) VALUES (null,'$Name_product','$Price_Name','$Product_amount','$Product_Image')";


$Resultado=$conn -> query($sql);

if($Resultado){
header('location:layout-one-column.php');
}else{
    echo"no se inserto los datos";
}

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

$Name_product=$_POST['Name_product'];

$Price_Name = $_POST['Price_Name'];

$Product_amount = $_POST['Product_amount'];

$Product_Image =addslashes(file_get_contents($_FILES['Product_Image']['tmp_name']));

$sql="INSERT INTO `productos`(`Id_Productos`, `Nombre_Productos`, `Precio_Productos`, `Cantidad_Productos`, `Imagen_Productos`) VALUES (null,'$Name_product','$Price_Name','$Product_amount','$Product_Image')";


$Resultado=$conn -> query($sql);

if($Resultado){
header('location:layout-one-column.php');
}else{
    echo"no se inserto los datos";
}

?>
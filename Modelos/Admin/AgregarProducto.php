<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

$Name_product=$_POST['nombreProducto'];

$Price_Name = $_POST['precioProducto'];

$Product_description= $_POST['descripcionProducto'];

$Product_amount = $_POST['cantidadProducto'];

$Product_Image =addslashes(file_get_contents($_FILES['imagenProducto']['tmp_name']));

$sql="INSERT INTO `productos`(`Id_Productos`, `Nombre_Productos`, `Precio_Productos`, `Cantidad_Productos`, `Descripcion_Productos`,`Imagen_Productos`) VALUES (null,'$Name_product','$Price_Name','$Product_amount','$Product_description','$Product_Image')";


$Resultado=$conn -> query($sql);

if($Resultado){
header('location:../../controllers/admin/admin_views.php?vista=productos');
}else{
    echo"no se inserto los datos";
}

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

$id=$_REQUEST['id'];

$sql="DELETE FROM `servicios` WHERE Id_Servicios = $id";

$Resultado= $conn ->query($sql);


if($Resultado){
    header("location:../../controllers/admin/admin_views.php?vista=servicios");
}else{
    echo "no se elimino f";
}

?>
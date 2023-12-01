<?php
include("db.php");

$id=$_REQUEST['id'];

$sql="DELETE FROM `servicios` WHERE idSERVICIOS = $id";

$Resultado= $conn ->query($sql);


if($Resultado){
    header("location:layout-two-column.php");
}else{
    echo "no se elimino f";
}

?>
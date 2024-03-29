<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");
$id= $_GET['id'];
$sql = "DELETE FROM `usuarios` WHERE idUSUARIOS = $id";
$result = mysqli_query($conn,$sql);
if($result){

    header("Location:layout-blank.php");
}

else{
    echo"Erro".mysqli_error($conn);
}



?>
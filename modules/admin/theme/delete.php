<?php
include "db.php";
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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";
$id= $_GET['id'];
$sql ="DELETE FROM `roles` WHERE IdROLES = $id";
$result = mysqli_query($conn,$sql);
if($result){

    header("Location:layout-compact-nav.php");
}

else{
    echo"Erro".mysqli_error($conn);
}



?>
<?php
include("db.php");

$Id_Usuarios = $_GET['Id_Usuarios'];
$sql = "DELETE FROM `usuarios` WHERE Id_Usuarios = '$Id_Usuarios'";

$query = mysqli_query($conn, $sql);

if ($query) {
    header("location:Clientes.php");  
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

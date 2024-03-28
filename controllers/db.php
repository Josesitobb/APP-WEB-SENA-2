<?php
// db.php

// CONEXION A LA BASE DE DATOS
$servername="localhost";
$username ="root";
$password ="";
$db="SGCitas";

$conn=mysqli_connect($servername,$username,$password,$db);

// // Verificar la conexión
// if (!$conn) {
//     die("Conexión fallida: " . mysqli_connect_error());
// }else{
//     echo "existe";
// }
?>

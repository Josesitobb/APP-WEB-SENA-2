<?php

$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;

include "db.php";

// $consulta="SELECT * FROM  usuarios WHERE Nombre_usuarios='$usuario' and contraseña='$contraseña'";
$consulta="SELECT * FROM `usuarios` WHERE Nombre_usuarios='$usuario' and contraseña='$contraseña'";
$resultado=mysqli_query($conn,$consulta);
$filas=mysqli_num_rows($resultado);

if($filas){

    header("location:index.php");
}else{
    ?>
    <?php
    include("indexlogin.php");
    ?>
    <h1>HP SIRVA</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
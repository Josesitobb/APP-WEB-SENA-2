<?php
include('db.php');
$Id_Usuarios=$_POST['Id_Usuarios'];
$nombreUsuario2=$_POST['nombreUsuario2'];
$apellidoUsuario2=$_POST['apellidoUsuario2'];
$correoUsuario2=$_POST['correoUsuario2'];
$telefonoUsuario2=$_POST['telefonoUsuario2'];
$contrasenaUsuario2=$_POST['contrasenaUsuario2'];
$NombreRol2=$_POST['NombreRol2'];

$sql = "UPDATE `usuarios` SET 
        `Nombre_Usuarios` = '$nombreUsuario2',
        `Apellido_Usuarios` = '$apellidoUsuario2',
        `Correo_Usuarios` = '$correoUsuario2',
        `Telefono_Usuarios` = '$telefonoUsuario2',
        `Contraseña_Usuarios` = '$contrasenaUsuario2',
        `Id_Rol` = '$NombreRol2'
        WHERE `Id_Usuarios` = $Id_Usuarios";
if($resultado = $conn->query($sql)){
    header("location:Clientes.php");
}
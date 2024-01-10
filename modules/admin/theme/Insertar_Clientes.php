<?php
include("db.php");
// $NombreRol=$_POST['NombreRol'];
$nombreUsuario=$_POST['nombreUsuario'];
$apellidoUsuario=$_POST['apellidoUsuario'];
$correoUsuario=$_POST['correoUsuario'];
$telefonoUsuario=$_POST['telefonoUsuario'];
$contrasenaUsuario=$_POST['contrasenaUsuario'];

$sql ="INSERT INTO `usuarios`(`Id_Usuarios`, `Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`) 
VALUES (null,'$nombreUsuario','$apellidoUsuario','$correoUsuario','$telefonoUsuario','$contrasenaUsuario',2)";

$Resultado = mysqli_query($conn,$sql);

if($Resultado){
    header("location:Clientes.php");
}else{
    echo "paila";
}

?>



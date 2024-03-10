<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");

$nombreUsuario = $_POST['nombreUsuario'];
$apellidoUsuario = $_POST['apellidoUsuario'];
$correoUsuario = $_POST['correoUsuario'];
$telefonoUsuario = $_POST['telefonoUsuario'];
$contrasenaUsuario = $_POST['contrasenaUsuario'];

$sqlUsuarios = "INSERT INTO `usuarios`(`Id_Usuarios`, `Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`) 
VALUES (null,'$nombreUsuario','$apellidoUsuario','$correoUsuario','$telefonoUsuario','$contrasenaUsuario',2)";

$ResultadoUsuarios = mysqli_query($conn, $sqlUsuarios);

if ($ResultadoUsuarios) {
    // Obtener el ID del último registro insertado
    $ultimoIdInsertado = mysqli_insert_id($conn);

    // Insertar en la tabla clientes
    $sqlClientes = "INSERT INTO `clientes`(`Id_Clientes`, `Id_Usuarios`) VALUES (null, $ultimoIdInsertado)";

    $ResultadoClientes = mysqli_query($conn, $sqlClientes);

    if ($ResultadoClientes) {
        header("location:Clientes.php");
    } else {
        echo "Error al agregar cliente en la tabla clientes: " . mysqli_error($conn);
    }
} else {
    echo "Error al agregar usuario en la tabla usuarios: " . mysqli_error($conn);
}
?>

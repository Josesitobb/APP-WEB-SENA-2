<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

$nombreUsuario = $_POST['nombreUsuario'];
$apellidoUsuario = $_POST['apellidoUsuario'];
$correoUsuario = $_POST['correoUsuario'];
$telefonoUsuario = $_POST['telefonoUsuario'];
$contrasenaUsuario = $_POST['contrasenaUsuario'];

// Insertar en la tabla usuarios
$sqlUsuarios = "INSERT INTO `usuarios`(`Id_Usuarios`, `Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`) 
VALUES (null,'$nombreUsuario','$apellidoUsuario','$correoUsuario','$telefonoUsuario','$contrasenaUsuario',1)";

$ResultadoUsuarios = mysqli_query($conn, $sqlUsuarios);

if ($ResultadoUsuarios) {
    // Obtener el ID del último registro insertado en la tabla usuarios
    $ultimoIdInsertado = mysqli_insert_id($conn);

    // Insertar en la tabla estilistas
    $sqlEstilistas = "INSERT INTO `estilistas`(`Id_Estilistas`, `Id_Usuarios`, `Estado`) VALUES (null, $ultimoIdInsertado, 1)";

    $ResultadoEstilistas = mysqli_query($conn, $sqlEstilistas);

    if ($ResultadoEstilistas) {
        header("location:Estilistas.php");
    } else {
        echo "Error al agregar datos en la tabla estilistas: " . mysqli_error($conn);
    }
} else {
    echo "Error al agregar datos en la tabla usuarios: " . mysqli_error($conn);
}
?>

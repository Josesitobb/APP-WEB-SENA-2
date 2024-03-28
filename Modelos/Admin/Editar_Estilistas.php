<?php
include("db.php");

// Recibir los datos del formulario
$nombreUsuario = $_POST['nombreUsuario'];
$apellidoUsuario = $_POST['apellidoUsuario'];
$correoUsuario = $_POST['correoUsuario'];
$telefonoUsuario = $_POST['telefonoUsuario'];
$contraseñaUsuario = $_POST['contraseñaUsuario'];
$idUsuario = $_POST['idUsuario']; // Asegúrate de pasar el ID del usuario desde el formulario

// Imprimir los datos recibidos para verificar
echo "Nombre de usuario: " . $nombreUsuario . "<br>";
echo "Apellido de usuario: " . $apellidoUsuario . "<br>";
echo "Correo de usuario: " . $correoUsuario . "<br>";
echo "Teléfono de usuario: " . $telefonoUsuario . "<br>";
echo "Contraseña de usuario: " . $contraseñaUsuario . "<br>";

// Consulta SQL para actualizar los datos en la tabla usuarios
$sql = "UPDATE usuarios SET 
            Nombre_Usuarios = '$nombreUsuario',
            Apellido_Usuarios = '$apellidoUsuario',
            Correo_Usuarios = '$correoUsuario',
            Telefono_Usuarios = '$telefonoUsuario',
            Contraseña_Usuarios = '$contraseñaUsuario',
            Id_Rol = 1
        WHERE Id_Usuarios = $idUsuario";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Los datos se han actualizado correctamente.";
} else {
    echo "Error al actualizar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

?>

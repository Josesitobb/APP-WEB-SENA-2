<?php
include("db.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$contraseña = $_POST['contraseña'];

$sql_check_correo = "SELECT * FROM Usuarios WHERE Correo_Usuarios = '$correo'";
$result_correo = $conn->query($sql_check_correo);

$sql_check_telefono = "SELECT * FROM Usuarios WHERE Telefono_Usuarios = '$telefono'";
$result_telefono = $conn->query($sql_check_telefono);

if ($result_correo->num_rows > 0) {
    echo "El correo electrónico ya está registrado";
} elseif ($result_telefono->num_rows > 0) {
    echo "El número de teléfono ya está registrado";
} else {
    // Insertar datos en la tabla de usuarios
    $sql_insert_usuario = "INSERT INTO Usuarios (Nombre_Usuarios, Apellido_Usuarios, Correo_Usuarios, Telefono_Usuarios, Contraseña_Usuarios, Id_Rol) 
                            VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$contraseña', 2)";
    
    if ($conn->query($sql_insert_usuario) === TRUE) {
        // Obtener la última ID insertada
        $last_id = $conn->insert_id;

        // Insertar la ID en la tabla de clientes
        $sql_insert_cliente = "INSERT INTO Clientes (Id_Usuarios) 
                                VALUES ('$last_id')";

        if ($conn->query($sql_insert_cliente) === TRUE) {
            echo "Cliente agregado correctamente";
        } else {
            echo "Error al agregar el cliente: " . $conn->error;
        }
    } else {
        echo "Error al agregar el usuario: " . $conn->error;
    }
}

$conn->close();
?>


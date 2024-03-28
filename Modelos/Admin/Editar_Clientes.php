<?php
include("db.php"); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idCliente = $_POST['idCliente']; 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];


    $conn->begin_transaction();


    $sql_update_usuarios = "UPDATE Usuarios SET Nombre_Usuarios='$nombre', Apellido_Usuarios='$apellido', Correo_Usuarios='$correo', Telefono_Usuarios='$telefono', Contraseña_Usuarios='$contraseña' WHERE Id_Usuarios='$idCliente'";

    if ($conn->query($sql_update_usuarios) === TRUE) {
        echo "Datos actualizados correctamente en la tabla Usuarios<br>";

        $conn->commit();
    } else {
        echo "Error al actualizar datos en la tabla Usuarios: " . $conn->error;
        $conn->rollback();
    }

    $conn->close();
} else {

    echo "Error: No se han recibido datos mediante POST.";
}
?>

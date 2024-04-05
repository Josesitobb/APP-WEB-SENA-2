<?php
require("../../controllers/db.php");

// SE REIVEN POR METODO POST LOS DATOS

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SE OBTIENE LOS DATOS Y SE ALMACENAN EN VARIABLES
    $idCliente = $_POST['idCliente']; 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];

    // SE INICALIZA LA TRANSACCION PARA EL CAMBIO
    $conn->begin_transaction();

    // SE PREPARA LA CONSULTA SQL 
    $sql_update_usuarios = "UPDATE Usuarios SET Nombre_Usuarios='$nombre', Apellido_Usuarios='$apellido', Correo_Usuarios='$correo', Telefono_Usuarios='$telefono', Contraseña_Usuarios='$contraseña' WHERE Id_Usuarios='$idCliente'";
    // SE HACE EL QUERY PARA LA INSERCION A LA BASE DE DATOS Y SI SU ESTADO ES TRUE MANDA UN MENSAJE DICIENDO Datos actualizados correctamente en la tabla Usuarios<br>
    if ($conn->query($sql_update_usuarios) === TRUE) {
        echo "Datos actualizados correctamente en la tabla Usuarios<br>";
        // CONFIRMA LA TRANSACCION
        $conn->commit();
    } else {
        // SI ALGO NO SE PUEDO MANDARA UN MENSAJE DE ERROR
        echo "Error al actualizar datos en la tabla Usuarios: " . $conn->error;
        // SE CANCELA EL ERROR
        $conn->rollback();
    }

    $conn->close();
} else {

    echo "Error: No se han recibido datos mediante POST.";
}
?>

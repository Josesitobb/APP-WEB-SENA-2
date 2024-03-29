<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../../controllers/db.php");

// Verificar si se proporciona el ID del usuario a eliminar
if(isset($_GET['id'])) {
    // Obtener y sanitizar el ID del usuario a eliminar
    $id_usuario = mysqli_real_escape_string($conn, $_GET['id']);

    // Crear la consulta SQL para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE Id_Usuarios = '$id_usuario'";

    // Ejecutar la consulta
    $query = mysqli_query($conn, $sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($query) {
        // Redireccionar al controlador después de eliminar el registro
        header("location:../../controllers/admin/admin_views.php?vista=usuariosC");
        exit();
    } else {
        // Mostrar un mensaje de error si la consulta falla
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }
} else {
    // Mostrar un mensaje de error si no se proporciona el ID del usuario
    echo "ID de usuario no proporcionado";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

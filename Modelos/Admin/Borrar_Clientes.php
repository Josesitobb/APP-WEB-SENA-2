<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../../controllers/db.php");

// VERIFICA QUE SE HAYA MANDADO LA ID
if(isset($_GET['id'])) {
    //SE OBTIENE LA ID  
    $id_usuario = mysqli_real_escape_string($conn, $_GET['id']);

    // CREAR LA CONSULTA A LA BASE DE DATOS
    $sql = "DELETE FROM usuarios WHERE Id_Usuarios = '$id_usuario'";

    // EJECUTA EL QUERY
    $query = mysqli_query($conn, $sql);

    // VERIFICA QUE SI SE EJECUTO EL QUERY 
    if ($query) {
        // SI SE EJECUTA EL QUERY LO MANDA A UN CONTROLADOR 
        header("location:../../controllers/admin/admin_views.php?vista=usuariosC");
        exit();
    } else {
        // SI NO SE EJECUTA LE MANDA UN ERROR
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }
} else {

    echo "ID de usuario no proporcionado";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

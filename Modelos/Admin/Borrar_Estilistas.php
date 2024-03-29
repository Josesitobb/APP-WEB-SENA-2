<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

$Id_Usuarios = $_GET['Id_Usuarios'];
$sql = "DELETE FROM `usuarios` WHERE Id_Usuarios = '$Id_Usuarios'";

$query = mysqli_query($conn, $sql);

if ($query) {
    header("location:../../controllers/admin/admin_views.php?vista=usuariosC");  // Corrected the space in the file name
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

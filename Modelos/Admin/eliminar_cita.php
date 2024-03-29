<?php
// eliminar_cita.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Id_Citas'])) {
    $id_cita = $_GET['Id_Citas'];

    // Eliminar la cita de la base de datos
    $query = "DELETE FROM Citas WHERE Id_Citas = '$id_cita'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirigir a la página principal con un mensaje de éxito
        echo "<script>alert('Se elimino.'); window.location.href = '../../controllers/admin/admin_views.php?vista=citas';</script>";
        exit();
    } else {
        echo "Error al eliminar la cita: " . mysqli_error($conn);
    }
} else {
    echo "Solicitud no válida.";
}

mysqli_close($conn);
?>

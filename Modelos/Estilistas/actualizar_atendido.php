<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["id_cita"])) {

        $id_cita = $_POST["id_cita"];


        require("../../controllers/db.php");


        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }


        $sql = "UPDATE Citas SET activo = 0 WHERE Id_Citas = $id_cita";


        if ($conn->query($sql) === TRUE) {
            echo "El estado 'activo' de la cita con ID $id_cita se actualizó correctamente.";
        } else {
            echo "Error al actualizar el estado 'activo' de la cita: " . $conn->error;
        }


        $conn->close();
    } else {

        echo "Error: No se proporcionó el ID de la cita.";
    }
} else {

    echo "Error: Método de solicitud no válido.";
}
?>

<?php
// Verifica si se ha enviado el formulario para inactivar la cita
if (isset($_POST['inactivar_cita'])) {
    // Verifica si se ha proporcionado el ID de la cita
    if (isset($_POST['id_cita'])) {
        // Incluye el archivo de configuración y conexión a la base de datos
        include('config/db.php');

        // Prepara la consulta para actualizar el estado de la cita a "inactivo"
        $sql_inactivar_cita = "UPDATE Citas SET estado = 'inactivo' WHERE Id_Citas = ?";

        // Prepara la declaración
        $stmt = $conn->prepare($sql_inactivar_cita);

        // Vincula los parámetros
        $stmt->bind_param("i", $_POST['id_cita']);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Redirecciona de vuelta a la página de citas después de inactivar la cita
            header("Location: citas.php");
            exit();
        } else {
            // Maneja el error si la consulta no se ejecuta correctamente
            echo "Error al inactivar la cita: " . $conn->error;
        }

        // Cierra la declaración y la conexión
        $stmt->close();
        $conn->close();
    } else {
        // Maneja el caso en que no se proporciona el ID de la cita
        echo "ID de la cita no proporcionado.";
    }
} else {
    // Maneja el caso en que el formulario no se ha enviado correctamente
    echo "El formulario no se ha enviado correctamente.";
}
?>

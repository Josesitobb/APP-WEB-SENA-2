<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Verificar si se ha recibido la solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la ID de la cita de la solicitud
    $citaId = $_POST['cita_id'];

    // Incluir el archivo de configuración y conexión a la base de datos
    include('../../controllers/db.php');

    // Consulta SQL para actualizar el estado de la cita como inactiva
    $sql = "UPDATE Citas SET activo = 0 WHERE Id_Citas = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Manejar el error de preparación de consulta
        http_response_code(500); // Código de respuesta HTTP 500 (Error interno del servidor)
        echo "Error al preparar la consulta: " . $conn->error;
        exit();
    }

    // Enlazar parámetros
    $stmt->bind_param("i", $citaId);

    // Ejecutar la consulta
    if (!$stmt->execute()) {
        // Manejar el error de ejecución de consulta
        http_response_code(500); // Código de respuesta HTTP 500 (Error interno del servidor)
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit();
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();

    // Si la actualización fue exitosa, enviar una respuesta de éxito al cliente
    http_response_code(200); // Código de respuesta HTTP 200 (OK)
    echo "La cita se ha marcado como inactiva.";
} else {
    // Si no se recibió una solicitud POST, responder con un código de error
    http_response_code(400); // Código de respuesta HTTP 400 (Solicitud incorrecta)
    echo "Solicitud incorrecta.";
}
?>

<?php
// Iniciar sesión
session_start();

// Verificar si la variable de sesión 'user_id' está vacía o no está definida
if (empty($_SESSION['user_id'])) {
    // Si 'user_id' está vacía, redirigir al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit(); // Terminar la ejecución del script después de la redirección
}

// Obtener el ID del cliente desde la sesión
$id_cliente = $_SESSION['user_id'];

// Incluir archivo de configuración y conexión a la base de datos
include('config/db.php');
require('config/config.php');

// Verificar si se recibieron los datos del formulario de manera adecuada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $servicioId = $_POST['servicioId'];
    $estilistaId = $_POST['estilistaId'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Consulta SQL para insertar la cita en la base de datos
    $sql_insertar_cita = "INSERT INTO Citas (Id_Servicios, Id_Estilistas, start, end, Id_Clientes) VALUES (?, ?, ?, ?, ?)";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql_insertar_cita);

    // Enlazar parámetros
    $stmt->bind_param("iissi", $servicioId, $estilistaId, $fecha, $hora, $id_cliente);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // La cita se ha insertado correctamente
        echo "La cita se ha programado correctamente.";
    } else {
        // Error al insertar la cita
        echo "Error al programar la cita: " . $conn->error;
    }

    // Cerrar la declaración
    $stmt->close();

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se recibieron datos por POST, redirigir o mostrar un mensaje de error
    echo "Error: No se recibieron datos del formulario.";
}
?>

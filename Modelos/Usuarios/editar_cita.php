<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../controllers/db.php');

// Recibir datos del formulario
$idServicio = $_POST['id_servicio'];
$idEstilista = $_POST['id_estilista'];
$fechaHora = $_POST['fecha_hora'];
$idCita = $_POST['id_cita']; // Corregir el nombre del campo para obtener el ID de la cita
$idCliente = $_POST['id_cliente']; // Obtener el ID del cliente del formulario

// Verificar si la hora seleccionada está dentro del rango permitido (de 8 am a 9 pm)
$hora_seleccionada = date("H", strtotime($fechaHora));
if ($hora_seleccionada < 8 || $hora_seleccionada >= 21) {
    echo json_encode(array('success' => false, 'message' => 'La hora seleccionada está fuera del horario permitido (8 am - 9 pm).'));
    exit();
}

// Consulta SQL para verificar si ya existe una cita en la misma fecha y hora
$sql_verificar_cita = "SELECT * FROM citas WHERE start = ?";
$stmt = $conn->prepare($sql_verificar_cita);
$stmt->bind_param("s", $fechaHora);
$stmt->execute();
$resultado = $stmt->get_result();

// Si ya existe una cita en la misma fecha y hora, devolver un mensaje de error en formato JSON
if ($resultado->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Ya hay una cita programada para la fecha y hora seleccionadas. Por favor, elija otra fecha u hora.'));
    exit();
}

// Consulta SQL para actualizar la cita en la base de datos
$sql_editar_citas = "UPDATE `citas` SET `start`=?, `Id_Clientes`=?, `Id_Estilistas`=?, `Id_Servicios`=? WHERE `Id_Citas`=?";

// Preparar la consulta
$stmt = $conn->prepare($sql_editar_citas);
if (!$stmt) {
    // Manejar el error de preparación de consulta
    echo json_encode(array('success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error));
    exit();
}

// Enlazar parámetros
$stmt->bind_param("siisi", $fechaHora, $idCliente, $idEstilista, $idServicio, $idCita);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode(array('success' => true, 'message' => 'La cita se ha actualizado correctamente.'));
} else {
    // Manejar el error de ejecución de consulta
    echo json_encode(array('success' => false, 'message' => 'Error al actualizar la cita: ' . $stmt->error));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

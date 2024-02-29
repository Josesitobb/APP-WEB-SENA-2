<?php
include('config/db.php');
// Recibir datos del formulario
$idServicio = $_POST['id_servicio'];
$idEstilista = $_POST['id_estilista'];
$fechaHora = $_POST['fecha_hora'];
$idCita = $_POST['id_cita']; // Corregir el nombre del campo para obtener el ID de la cita
$idCliente = $_POST['id_cliente']; // Obtener el ID del cliente del formulario

// Imprimir los datos en pantalla
echo "<h2>ID del Servicio: $idServicio</h2>";
echo "<h2>ID del Estilista: $idEstilista</h2>";
echo "<h2>Fecha y Hora: $fechaHora</h2>";
echo "<h2>ID de la Cita: $idCita</h2>"; // Mostrar el ID de la cita correctamente
echo "<h2>ID del Cliente: $idCliente</h2>"; // Mostrar el ID del cliente

// Consulta SQL para actualizar la cita en la base de datos
$sql_editar_citas = "UPDATE `citas` SET `start`=?, `Id_Clientes`=?, `Id_Estilistas`=?, `Id_Servicios`=? WHERE `Id_Citas`=?";

// Preparar la consulta
$stmt = $conn->prepare($sql_editar_citas);
if (!$stmt) {
    // Manejar el error de preparación de consulta
    echo "Error al preparar la consulta: " . $conn->error;
    exit();
}

// Enlazar parámetros
$stmt->bind_param("siisi", $fechaHora, $idCliente, $idEstilista, $idServicio, $idCita);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "La cita se ha actualizado correctamente.";
} else {
    // Manejar el error de ejecución de consulta
    echo "Error al actualizar la cita: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

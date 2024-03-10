<?php
include('config/db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si se ha enviado información a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $servicioId = $_POST['servicioId'];
    $estilistaId = $_POST['estilistaId'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $clienteId = $_POST['clienteId'];

    // Mostrar los valores recibidos del formulario
    echo "ID del Servicio: " . $servicioId . "<br>";
    echo "ID del Estilista: " . $estilistaId . "<br>";
    echo "Fecha: " . $fecha . "<br>";
    echo "Hora: " . $hora . "<br>";
    echo "ID del Cliente: " . $clienteId . "<br>";

    // Preparar la consulta SQL usando una consulta preparada para prevenir inyección SQL
    $sql_citas = "INSERT INTO `citas`(`start`, `end`, `Id_Clientes`, `Id_Estilistas`, `Id_Servicios`) VALUES (?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = mysqli_prepare($conn, $sql_citas);

    // Vincular parámetros a la consulta preparada
    mysqli_stmt_bind_param($stmt, "sssss", $fechaHora, $fechaHora, $clienteId, $estilistaId, $servicioId);

    // Combinar fecha y hora en un solo campo
    $fechaHora = $fecha . ' ' . $hora;

    // Ejecutar la consulta preparada
    if (mysqli_stmt_execute($stmt)) {
        echo "Cita agregada correctamente.";
    } else {
        echo "Error al agregar la cita: " . mysqli_error($conn);
    }

    // Cerrar la sentencia
    mysqli_stmt_close($stmt);
} else {
    // Si no se ha enviado información a través del método POST, mostrar un mensaje de error
    echo "Error: No se han recibido datos del formulario.";
}
?>



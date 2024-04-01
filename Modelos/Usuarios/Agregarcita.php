<?php
include('../../controllers/db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$hora_inicio = strtotime('08:00:00');
$hora_fin = strtotime('21:00:00');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $servicioId = $_POST['servicioId'];
    $estilistaId = $_POST['estilistaId'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $clienteId = $_POST['clienteId'];


    $fechaHora = $fecha . ' ' . $hora;


    $hora_seleccionada = strtotime($hora);
    if ($hora_seleccionada < $hora_inicio || $hora_seleccionada > $hora_fin) {
        // Retornar un mensaje de error si la hora está fuera del horario permitido
        echo "Error: No se pueden asignar citas fuera del horario de trabajo (de 8 am a 9 pm).";
        exit; // Detener la ejecución del script
    }

    $sql_verificar_cita = "SELECT * FROM citas WHERE start = ?";
    $stmt = mysqli_prepare($conn, $sql_verificar_cita);
    mysqli_stmt_bind_param($stmt, "s", $fechaHora);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);


    if (mysqli_stmt_num_rows($stmt) > 0) {

        echo "Error: Ya hay una cita programada para la fecha y hora seleccionadas. Por favor, elija otra fecha u hora.";
    } else {

        $sql_citas = "INSERT INTO `citas`(`start`, `end`, `Id_Clientes`, `Id_Estilistas`, `Id_Servicios`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_citas);
        mysqli_stmt_bind_param($stmt, "sssss", $fechaHora, $fechaHora, $clienteId, $estilistaId, $servicioId);


        if (mysqli_stmt_execute($stmt)) {
            // Retornar un mensaje de éxito
            echo "La cita ha sido programada correctamente.";
        } else {
            // Retornar un mensaje de error
            echo "Error: " . mysqli_error($conn);
        }

        // Cerrar la conexión y la sentencia
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {
    // Si no se ha enviado información a través del método POST, mostrar un mensaje de error
    echo "Error: No se han recibido datos del formulario.";
}
?>

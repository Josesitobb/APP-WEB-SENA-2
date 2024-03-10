<?php
// actualizar_cita.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID de la cita
    if (isset($_POST['id_cita'])) {
        $id_cita = $_POST['id_cita'];

        // Obtener los datos del formulario
        $fecha_hora = $_POST['fecha_hora'];
        $id_cliente = $_POST['Nombre_Cliente'];
        $id_estilista = $_POST['Nombre_Estilista'];
        $id_servicio = $_POST['Nombre_Servicios'];
        $hora = $_POST['hora'];
        $precio = $_POST['precio'];

        // Actualizar la cita en la base de datos
        $query = "UPDATE Citas SET start = '$fecha_hora', Id_Clientes = '$id_cliente', Id_Estilistas = '$id_estilista', Id_Servicios = '$id_servicio', end = '$hora' WHERE Id_Citas = '$id_cita'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirigir después de mostrar la alerta
            echo "<script>alert('Se edito exitosamente.'); window.location.href = 'Citas.php';</script>";
        exit();
        } else {
            echo "Error al actualizar la cita: " . mysqli_error($conn);
        }
    } else {
        echo "No se especificó el ID de la cita.";
    }
} else {
    echo "La solicitud no es válida.";
}


mysqli_close($conn);
?>

<?php
include("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['Nombre_Cliente'];
    $estilista = $_POST['Nombre_Estilista'];
    $servicio = $_POST['Nombre_Servicios'];
    $fecha = $_POST['fecha_actual'];
    $hora = $_POST['hora_actual'];

    $fecha_hora = date('Y-m-d H:i:s', strtotime("$fecha $hora"));

    $sql = "INSERT INTO citas (start, end, Id_Clientes, Id_Estilistas, Id_Servicios)
            VALUES ('$fecha_hora', '$fecha_hora', '$cliente', '$estilista', '$servicio')";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // Éxito: imprimir script de alerta y redirigir
        echo "<script>alert('Cita agregada exitosamente.'); window.location.href = 'Citas.php';</script>";
    } else {
        // Error: imprimir mensaje de error
        echo "NO EXITOSO: " . mysqli_error($conn);
    }
}
?>

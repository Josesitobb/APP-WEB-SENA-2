<?php
// actualizar_estado_comision.php

// Verificar si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados desde el frontend
    $idComision = $_POST['idComision'];
    $nuevoEstado = $_POST['nuevoEstado'];

    // Conectar a la base de datos (debes incluir tu archivo de conexión aquí)
    require("../../controllers/db.php");

    // Preparar la consulta SQL para actualizar el estado de la comisión
    $sql = "UPDATE comisiones SET Estado_De_Pago_Comisiones = $nuevoEstado WHERE Id_Comisiones = $idComision";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Estado de la comisión actualizado correctamente";
    } else {
        echo "Error al actualizar el estado de la comisión: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "Acceso denegado";
}
?>

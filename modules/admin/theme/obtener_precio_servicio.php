<?php
// obtener_precio_servicio.php

include("./db.php");

if(isset($_POST['servicioSeleccionado'])) {
    $id_servicio = $_POST['servicioSeleccionado'];

    // Consulta SQL para obtener el precio del servicio seleccionado
    $query = "SELECT Valor_Servicios FROM servicios WHERE Id_Servicios = $id_servicio";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $fila = mysqli_fetch_assoc($result);
        echo $fila['Valor_Servicios']; // Devolver el precio como respuesta
    } else {
        echo "Error al obtener el precio del servicio";
    }
} else {
    echo "No se especificó un servicio";
}

mysqli_close($conn);
?>

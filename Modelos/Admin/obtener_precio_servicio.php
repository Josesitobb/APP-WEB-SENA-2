<?php
// obtener_precio_servicio.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['servicioSeleccionado'])) {
    $id_servicio = $_POST['servicioSeleccionado'];
    $query = "SELECT Valor_Servicios FROM servicios WHERE Id_Servicios = $id_servicio";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $fila = mysqli_fetch_assoc($result);
        echo $fila['Valor_Servicios']; 
    } else {
        echo "Error al obtener el precio del servicio";
    }
} else {
    echo "No se especificó un servicio";
}

mysqli_close($conn);
?>

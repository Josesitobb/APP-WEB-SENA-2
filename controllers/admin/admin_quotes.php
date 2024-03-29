<?php
// Controlador para manejar las solicitudes GET de los enlaces de navegación de meses

// Verificar si se proporciona el parámetro 'mes' en la URL
if (isset($_GET['mes'])) {
    // Obtener el valor del parámetro 'mes' de la URL y sanitizarlo
    $mes = filter_input(INPUT_GET, 'mes', FILTER_VALIDATE_INT);

    // Verificar si se proporciona el parámetro 'año' en la URL
    if (isset($_GET['año'])) {
        // Obtener el valor del parámetro 'año' de la URL y sanitizarlo
        $año = filter_input(INPUT_GET, 'año', FILTER_VALIDATE_INT);

        // Aquí puedes realizar acciones basadas en el mes y el año proporcionados
        // Por ejemplo, puedes cargar datos correspondientes al mes y año dados
        // O puedes redirigir a otra página con los parámetros mes y año

        // Por ahora, simplemente vamos a mostrar el mes y el año recibidos
        echo "Mes: $mes, Año: $año";
    } else {
        // Si el parámetro 'año' no está presente en la URL, muestra un mensaje de error
        echo "Error: Parámetro 'año' no proporcionado en la URL";
    }
} else {
    // Si el parámetro 'mes' no está presente en la URL, muestra un mensaje de error
    echo "Error: Parámetro 'mes' no proporcionado en la URL";
}
?>

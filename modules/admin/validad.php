<?php

ob_start();
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

// SE CAPTURAN LOS DATOS DEL FORMULARIO
$email = $_POST['emailuser'];
$password = $_POST['passwordlog'];

// SE INICIA SESIÓN

$consulta = "SELECT * FROM `usuarios` WHERE Correo_Usuarios='$email' AND Contraseña_Usuarios='$password'";
$resultados = mysqli_query($conn, $consulta);
$filas = mysqli_num_rows($resultados);

if ($filas) {
    // Obtener datos del usuario
    $usuario = mysqli_fetch_assoc($resultados);

    // Inicializar variable de sesión
    $_SESSION['sesion_iniciada'] = true;

    // Almacena el nombre de usuario en la sesión
    $_SESSION['username'] = $usuario['Nombre_Usuarios'];

    // Almacena la ID del usuario en la sesión
    $_SESSION['user_id'] = $usuario['Id_Usuarios'];

    // Obtener la ID de cliente del usuario
    $consulta_cliente = "SELECT Id_Clientes FROM `clientes` WHERE Id_Usuarios = '{$usuario['Id_Usuarios']}'";
    $resultado_cliente = mysqli_query($conn, $consulta_cliente);

    if ($resultado_cliente && mysqli_num_rows($resultado_cliente) > 0) {
        $cliente = mysqli_fetch_assoc($resultado_cliente);
        // Almacena la ID de cliente en la sesión
        $_SESSION['client_id'] = $cliente['Id_Clientes'];
    } else {
        // Manejo de error si no se encuentra la ID de cliente
        echo "Error: No se pudo encontrar la ID de cliente para el usuario.";
        // Puedes redirigir a una página de error o realizar otra acción apropiada aquí
    }

    // Verificar si el usuario es un estilista
    if ($usuario['Id_Rol'] == 1) {
        // Obtener la ID de estilista del usuario
        $consulta_estilista = "SELECT Id_Estilistas FROM `Estilistas` WHERE Id_Usuarios = '{$usuario['Id_Usuarios']}'";
        $resultado_estilista = mysqli_query($conn, $consulta_estilista);

        if ($resultado_estilista && mysqli_num_rows($resultado_estilista) > 0) {
            $estilista = mysqli_fetch_assoc($resultado_estilista);
            // Almacena la ID de estilista en la sesión
            $_SESSION['id_estilista'] = $estilista['Id_Estilistas'];
        } else {
            // Manejo de error si no se encuentra la ID de estilista
            echo "Error: No se pudo encontrar la ID de estilista para el usuario.";
            // Puedes redirigir a una página de error o realizar otra acción apropiada aquí
        }
    }

    // Redirige según el rol del usuario
    switch ($usuario['Id_Rol']) {
        case 1:
            // ESTILISTA
            header("location:../estilistas/index.php"); 
            break;
        case 2:
            // CLIENTES
            header("location:../usuarios/index.php"); 
            break;
        case 3:
            // ADMIN
            header("location:./index.php"); 
            break;
        default:
            header("location:./index.php");
            break;
    }

    exit();
} else {
    ob_end_flush(); // Limpia el búfer de salida
    echo '<script>
        alert("DATOS INCORRECTOS");
        window.history.go(-1);
    </script>';
}
?>
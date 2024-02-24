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

    // Redirige según el rol del usuario
    switch ($usuario['Id_Rol']) {
        case 1:
            header("location:./index.php");
            break;
        case 2:
            header("location:../../usuarios/index.php");
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

mysqli_free_result($resultados);
?>

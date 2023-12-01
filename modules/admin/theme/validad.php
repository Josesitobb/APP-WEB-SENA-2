<?php
ob_start(); // Inicia el almacenamiento en búfer de salida
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

// SE CAPTURAN LOS DATOS DEL FORMULARIO
$username = $_POST['usernamelog'];
$password = $_POST['passwordlog'];

// SE INICIA SESIÓN

$consulta = "SELECT * FROM `usuarios` WHERE usuario_username='$username' AND usuario_contraseña='$password'";
$resultados = mysqli_query($conn, $consulta);
$filas = mysqli_num_rows($resultados);

if ($filas) {
    // Almacena el nombre de usuario en la sesión
    $_SESSION['username'] = $username;
    
    header("location:./index.php");
    exit();  // Asegúrate de salir después de redirigir
} else {
    ob_end_flush(); // Limpia el búfer de salida
    echo '<script>
        alert("DATOS INCORRECTOS");
        window.location.href = "otra_vista.php";
    </script>';
}

mysqli_free_result($resultados);
?>

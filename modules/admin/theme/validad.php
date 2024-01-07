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
    // Obtiene los datos del usuario
    $usuario = mysqli_fetch_assoc($resultados);

    // Almacena el nombre de usuario y el rol en la sesión
    $_SESSION['username'] = $usuario['usuario_username'];
    $_SESSION['rol'] = $usuario['ROLES_IdROLES'];

    // Redirecciona según el rol
    if ($_SESSION['rol'] == 2) {
        header("location:./index.php");; // Cambia a la vista de administrador
    } else {
        header("location:./vista_usuario.php"); // Cambia a la vista de usuario normal
    }

    exit();  // Asegúrate de salir después de redirigir
} else {
    ob_end_flush(); 
    echo '<script>
        alert("DATOS INCORRECTOS");
        window.location.href = "otra_vista.php";
    </script>';
}

mysqli_free_result($resultados);
?>

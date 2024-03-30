<?php
// Iniciar o reanudar la sesión
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea eliminar la sesión por completo, también se debe eliminar la cookie de sesión.
// Nota: Esto destruirá la sesión y no solo los datos de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión u otra página relevante
header("Location:../../index.php");
exit();
?>

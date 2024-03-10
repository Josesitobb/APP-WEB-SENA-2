<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// $servername="localhost";
// $username ="root";
// $password ="";
// $db="SGCitas";
// $conn=mysqli_connect($servername,$username,$password,$db);



$servername = "veico.mysql.database.azure.com";
$username = "veicol12";
$password = "Joseguerra302004";
$db = "sgcitas";
$port = 3306;

$ssl_cert = realpath('../../base de datos/DigiCertGlobalRootCA.crt.pem');

// Configuración de la conexión
$conn = mysqli_init();

// Establecer la ruta del certificado
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

// Configuración de opciones SSL
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// Intentar conectar de forma segura
if (mysqli_real_connect($conn, $servername, $username, $password, $db, $port)) {
    echo "¡Conexión segura establecida!";
} else {
    // Manejar el error en caso de que la conexión falle
    echo "Error al conectar de forma segura: " . mysqli_connect_error();
}

?>



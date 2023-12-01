<?php


$servername = "josecitas.mysql.database.azure.com";
$username = "JOSE";
$password = "Celular528";
$db = "mydb";
$port = 3306;


$ssl_cert = '../../../base de datos/DigiCertGlobalRootCA.crt.pem"';



// Configuración de la conexión
$conn = mysqli_init();
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// Establecer la ruta del certificado
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

// Conectar a la base de datos
mysqli_real_connect($conn, $servername, $username, $password, $db, $port);

// Probar la conexión
if($conn){
    echo "hay conexion";
}else{
    echo "no hay conexion";
}
// Probar la conexion
// if(!$conn){
//     die("Muy bot".mysqli_connect_error());
// }
// echo "La conexion esta muy fina"
// ?>
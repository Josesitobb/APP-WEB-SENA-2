<?php

// // conexion azure
// // $servername = "josecitas.mysql.database.azure.com";
// // $username = "JOSE";
// // $password = "Celular528";
// // $db = "mydb";
// // $port = 3306;

// $servername = "locahost";
// $username = "root";
// $password = "Celular528";
// $db = "mydb";
// $port = 3306;


// $ssl_cert = realpath('../../../base de datos/DigiCertGlobalRootCA.crt.pem');

// // Configuración de la conexión
// $conn = mysqli_init();

// // Establecer la ruta del certificado
// mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

// // Configuración de opciones SSL
// mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// // Intentar conectar
// // if (mysqli_real_connect($conn, $servername, $username, $password, $db, $port)) {
// //     echo "Hay conexión";
// // } else {
// //     // Manejar el error en caso de que la conexión falle
// //     echo "No hay conexión. Error: " . mysqli_connect_error();
// // }


// conexion local


$servername="localhost";

$username ="root";
$password ="";
$db="SGCitas";

$conn=mysqli_connect($servername,$username,$password,$db);

// Probar la conexion
// if(!$conn){
//     die("Muy bot".mysqli_connect_error());
// }
// echo "La conexion esta muy fina"
// 
?>

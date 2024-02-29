<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");

$Nombre_usuario = $_POST['Nombre_usuario'];
$Apellido_Usuario = $_POST['Apellido_Usuario'];
$Correo_Usuario = $_POST['Correo_Usuario'];
$Telefono_usuario = $_POST['Telefono_usuario'];
$Contraseña_Usuario = $_POST['Contraseña_Usuario'];

// CONSULTA PARA INSERTAR USUARIO
$insert_usuario = "INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`) VALUES ('$Nombre_usuario', '$Apellido_Usuario', '$Correo_Usuario', '$Telefono_usuario', '$Contraseña_Usuario', 2)";

// EJECUTAR CONSULTA PARA INSERTAR USUARIO
$result_usuario = mysqli_query($conn, $insert_usuario);

if(!$result_usuario){
    echo "ERROR al insertar usuario";
} else {
    // OBTENER Id_Usuarios GENERADO AUTOMÁTICAMENTE
    $id_usuario_insertado = mysqli_insert_id($conn);

    // CONSULTA PARA INSERTAR CLIENTE
    $insert_cliente = "INSERT INTO `clientes`(`Id_Usuarios`) VALUES ($id_usuario_insertado)";

    // EJECUTAR CONSULTA PARA INSERTAR CLIENTE
    $result_cliente = mysqli_query($conn, $insert_cliente);

    if(!$result_cliente){
        echo "ERROR al insertar cliente";
    } else {
        echo '<script>
        alert("Usuario registrado y cliente creado");
        window.location.replace("../../../index.html");
        </script>';
    }
}

mysqli_close($conn);
?>

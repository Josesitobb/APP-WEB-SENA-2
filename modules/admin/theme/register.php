<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");
$Nombre_usuario = $_POST['Nombre_usuario'];
$Apellido_Usuario = $_POST['Apellido_Usuario'];
$Correo_Usuario = $_POST['Correo_Usuario'];
$Telefono_usuario = $_POST['Telefono_usuario'];
$Contraseña_Usuario = $_POST['Contraseña_Usuario'];

// CONSULTA PARA INSERTAR
$insert = "INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`) VALUES ('$Nombre_usuario', '$Apellido_Usuario', '$Correo_Usuario', '$Telefono_usuario', '$Contraseña_Usuario', 2)";




// $insert="INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `usuario_contraseña`, `usuario_correo`, `ROLES_IdROLES`) 
// VALUES ('$usernamereg','$lastnamereg','$nameuserg','$passwordreg','$emailreg','1')";

// VERIFICAR CONSULTA CORREOS
$verifica_telefono= mysqli_query($conn,"SELECT * FROM `usuarios` WHERE `Telefono_Usuarios` ='$Telefono_usuario'");
if(mysqli_num_rows($verifica_telefono)>0){
    echo '<script>

    alert("Numero de telefono ya registrado intente con otro")
    window.history.go(-1);
    </script>
    
    ';
    exit;
}



// VERIFICAR CONSULTA CORREOS
$verify_correos= mysqli_query($conn,"SELECT * FROM `usuarios` WHERE `Correo_Usuarios` ='$Correo_Usuario'");
if(mysqli_num_rows($verify_correos)>0){
    echo '<script>

    alert("Correo ya registrado intente con otro")
    window.history.go(-1);
    </script>
    
    ';
    exit;
}


// EJECUTAR CONSULTA

$result = mysqli_query($conn,$insert);

if(!$result){
    echo"ERROR ";
}else{
    echo '<script>

    alert("usuario registrado");
    window.location.replace("../../../index.html");
    // window.history.go(-1);
    </script>
    
    ';
}



?>


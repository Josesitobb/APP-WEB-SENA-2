<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");
// RESIVIR DATOS
$usernamereg=$_POST['usernamereg'];
$lastnamereg=$_POST['lastnamereg'];
$nameuserg=$_POST['nameuserg'];
$passwordreg=$_POST['passwordreg'];
$emailreg=$_POST['emailreg'];
// CONSULTA PARA INSENTAR

// $insert="INSERT INTO `usuarios`( `usuarios_nombres`, `usuario_contraseña`, `usuario_correo`, `ROLES_IdROLES`) VALUES ('$usernamereg','$passwordreg','$emailreg','1')";
$insert="INSERT INTO `usuarios`(`usuarios_nombres`, `usuario_apellido`, `usuario_username`, `usuario_contraseña`, `usuario_correo`, `ROLES_IdROLES`) VALUES ('$usernamereg','$lastnamereg','$nameuserg','$passwordreg','$emailreg','1')";

// VERIFICAR CONSULTA USUARIOS
$verify_username= mysqli_query($conn,"SELECT * FROM `usuarios` WHERE `usuario_username` ='$nameuserg'");
if(mysqli_num_rows($verify_username)>0){
    echo '<script>

    alert("EL NOMBRE DE USUARIO  YA ESTA EN USO")
    window.history.go(-1);
    </script>
    
    ';
    exit;
}

// VERIFICAR CONSULTA CORREOS
$verify_correos= mysqli_query($conn,"SELECT * FROM `usuarios` WHERE `usuario_correo` ='$emailreg'");
if(mysqli_num_rows($verify_correos)>0){
    echo '<script>

    alert("CORREO YA ESTA REGISTRADO")
    window.history.go(-1);
    </script>
    
    ';
    exit;
}


// EJECUTAR CONSULTA

$result = mysqli_query($conn,$insert);

if(!$result){
    echo"ERRO ";
}else{
    echo '<script>

    alert("usuario registrado");
    window.location.replace("../../../index.html");
    // window.history.go(-1);
    </script>
    
    ';
}



?>


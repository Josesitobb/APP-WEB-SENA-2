<?php
include "db.php";
$id=$_GET['id'];
if(isset($_POST['Enviar'])){

    $Nombre=$_POST['Nombre'];
    $Apellido=$_POST['Apellido']; 
    $Username=$_POST['Username'];   
    $Correo=$_POST['Correo'];
    $Contraseña=$_POST['Contraseña'];
    $Rolid=$_POST['Rolesid']; 
    
    // $sql="UPDATE `usuarios` SET `usuarios_nombres`='$Nombre',`usuario_apellido`='$Apellido',`usuario_contraseña`='$Contraseña',`usuario_correo`='$Correo' WHERE id_usuarios=$id";
    $sql="UPDATE `usuarios` SET `usuarios_nombres`='$Nombre',`usuario_apellido`='$Apellido',`usuario_username`='$Username',`usuario_contraseña`='$Contraseña',`usuario_correo`='$Contraseña',`ROLES_IdROLES`='$Rolid' WHERE idUSUARIOS = $id";

    $result = mysqli_query($conn,$sql);
    
    if($result){

        header("Location:layout-blank.php?msg=New record created successfully");
    }
    else{
        echo "fallido".mysqli_error($conn);
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
crossorigin="anonymous">
<!-- FONS -->
    <title>Maryuri</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#c6e5d9">
        EDITAR USUARIO
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>EDITAR USUARIO</h3>
        <P class="text-muted">Porfa rellene toda las informacion para que pueda editar el usuario</P>
    </div>
    <?php

    // $sql="SELECT * FROM 'usuarios' WHERE id_usuarios =$id LIMIT 1";
    $sql="SELECT * FROM `usuarios` WHERE idUSUARIOS=$id LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    ?>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;" onsubmit="return ValidarEditarUsuario();">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="">Nombre</label>
                <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?php echo $row['usuarios_nombres']?>">
            </div>

            <div class="col">
                <label class="form-label" for="">Apellido</label>
                <input type="text" class="form-control" name="Apellido" id="Apellido"  value="<?php echo $row['usuario_apellido']?>">
            </div>

            <div class="col">
                <label class="form-label" for="">username</label>
                <input type="text" class="form-control" name="Username" id="Username" value="<?php echo $row['usuario_username']?>">
            </div>
        </div>
        <div class="mb-3">
        <label class="form-label" for="">Correo</label>
                <input type="text" class="form-control" name="Correo" id="Correo" value="<?php echo $row['usuario_correo']?>">
        </div>

        <div class="col">
        <label class="form-label" for="">Contraseña</label>
                <input type="text" class="form-control" name="Contraseña" id="Contraseña" value="<?php echo $row['usuario_contraseña']?>">
        </div>
        <div class="col">
            
                <label class="form-label" for="">IDRol</label>
                <input type="text" class="form-control" name="Rolesid" id="Rolesid" value="<?php echo $row['ROLES_IdROLES']?>">
            </div>
        <div >
        <button type="submit" class="btn btn-success margin=5px" name="Enviar"> Actualizar</button>
        <a href="index.php" class="btn btn-danger"> Cancelar</a>
        </div>

        </div>
    
       

        </fomr>
        </div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="./js/validaciones/ValidarEditarUsuarios.js"></script>
    
</body>
</html>
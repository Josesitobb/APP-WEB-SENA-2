<?php
include "db.php";
$id=$_GET['id'];
if(isset($_POST['Enviar'])){

    $NombreRol=$_POST['NombreRol'];
    
    // $sql="UPDATE `usuarios` SET `usuarios_nombres`='$Nombre',`usuario_apellido`='$Apellido',`usuario_contraseña`='$Contraseña',`usuario_correo`='$Correo' WHERE id_usuarios=$id";
    // UPDATE `roles` SET `IdROLES`='[value-1]',`Nombres_Roles`='[value-2]' WHERE 1
    // $sql="UPDATE `roles` SET `IdROLES`=null,`Nombres_Roles`='$NombreRol', IdROLES = $id";
    $sql = "UPDATE `roles` SET `Nombres_Roles`='$NombreRol' WHERE IdROLES = $id";


    $result = mysqli_query($conn,$sql);
    
    if($result){

        header("Location:layout-compact-nav.php?msg=New record created successfully");
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
    <title>Editar Rol</title>
    <script src="./js/validaciones/ValidacionRoles.js"></script>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#c6e5d9">
        Editar Roles
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>Editar Roles</h3>
        <P class="text-muted">Porfa rellene toda las informacion para que pueda editar el Rol</P>
    </div>
    <?php

    // $sql="SELECT * FROM 'usuarios' WHERE id_usuarios =$id LIMIT 1";
    $sql="SELECT * FROM `roles` WHERE IdROLES=$id LIMIT 1";

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    ?>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;" onsubmit="return ValidarRoles();">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="">Nombre</label>
                <input type="text" class="form-control" name="NombreRol" id="NombreRol" value="<?php echo $row['Nombres_Roles']?>">
            </div>

       
        <button type="submit" class="btn btn-success margin=5px" name="Enviar"> Actualizar</button>
        <a href="index.php" class="btn btn-danger"> Cancelar</a>
        </div>

        </div>
    
       

        </fomr>
        </div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
</body>
</html>
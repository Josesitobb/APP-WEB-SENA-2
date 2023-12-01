<?php
include "db.php";

if(isset($_POST['Enviar'])){

    $NombreRol=$_POST['NombreRol'];

    // $sql="INSERT INTO `usuarios`(`id_usuarios`, `Nombre_usuarios`, `Apellido_usuarios`, `IdRol`, `contraseña`, `correo`) VALUES (NULL,'$Nombre','$Apellido',NULL,'$Contraseña','$Correo')";
    // $sql="INSERT INTO `usuarios`(`idUSUARIOS`, `usuarios_nombres`, `usuario_apellido`, `usuario_username`, `usuario_contraseña`, `usuario_correo`, `ROLES_IdROLES`) VALUES (NULL,'$Nombre','$Apellido','$Username','$Contraseña','$Correo','$IdRol')";
    $sql="INSERT INTO `roles`(`IdROLES`, `Nombres_Roles`) VALUES (null,'$NombreRol')";

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
    <title>AÑADIR NUEVO ROL</title>
    <script src="./js/validaciones/ValidacionRoles.js"></script>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#c6e5d9">
        AÑADIR NUEVO ROL
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>AÑADIR NUEVO ROL</h3>
        <P class="text-muted">Porfa rellene toda las informacion para que pueda ingresar un usuario</P>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;" onsubmit="return ValidarRoles();">
            <div class="col">
                <label class="form-label" for="">Nombre</label>
                <input type="text" class="form-control" name="NombreRol" id="NombreRol" placeholder="Pepito">
            </div>

            
        <div >
            <br>
        <button type="submit" class="btn btn-success margin=5px" name="Enviar"> Enviar</button>
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
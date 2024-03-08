<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDITAR ESTILISTA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
  </head>
  <style>
       
       h1,label {
           display: block;
           text-align: center;
       }
   </style>
  <body>
    <h1>EDITAR ESTILISTAS</h1>
  
    <div class="container my-4">
    <form method="post" action="Editar_Datos_Clientes.php" >
        <?php
        include("db.php");
        $sql = "SELECT * FROM `usuarios` WHERE Id_Usuarios=" . $_REQUEST['Id_Usuarios'];
        $resultado =$conn->query($sql);
        $row = $resultado->fetch_assoc();


        ?>
        <input type="Hidden" class="form-control" id="nombreUsuario" name="Id_Usuarios" value="<?php echo $row['Id_Usuarios']; ?>">
        
       <div class="form-group">
    <label for="rol">ROL</label>
    <select class="form-select form-control" name="NombreRol2" id="rol2">
        <?php
        include("conexion.php");

        $sql = "SELECT * FROM `roles`";
        $result = $conn->query($sql);

        while ($rowRole = $result->fetch_assoc()) {
            $selected = ($rowRole['Id_Rol'] == $row['Id_Rol']) ? 'selected' : '';
            echo '<option value="' . $rowRole['Id_Rol'] . '" ' . $selected . '>' . $rowRole['Nombre_Rol'] . '</option>';
        }
        ?>
    </select>
</div>

      
        <div class="form-group">
    <label for="nombreUsuario">NOMBRE USUARIO</label>
    <input type="text" class="form-control" id="nombreUsuario2" name="nombreUsuario2" value="<?php echo $row['Nombre_Usuarios']; ?>">
    </div>

    <div class="form-group">
    <label for="apellidoUsuario">APELLIDO USUARIO</label>
    <input type="text" class="form-control" id="apellidoUsuario2" name="apellidoUsuario2" value="<?php echo $row['Apellido_Usuarios']; ?>">
    </div>

    <div class="form-group">
    <label for="correoUsuario">CORREO USUARIO</label>
    <input type="email" class="form-control" id="correoUsuario2" name="correoUsuario2" value="<?php echo $row['Correo_Usuarios']; ?>">
    </div>

    <div class="form-group">
    <label for="telefonoUsuario">TELEFONO USUARIO</label>
    <input type="tel" class="form-control" id="telefonoUsuario2" name="telefonoUsuario2" value="<?php echo $row['Telefono_Usuarios']; ?>">
    </div>

    <div class="form-group">
    <label for="contrasenaUsuario">CONTRASEÑA USUARIO</label>
    <input type="password" class="form-control" id="contrasenaUsuario2" name="contrasenaUsuario2" value="<?php echo $row['Contraseña_Usuarios']; ?>">
    </div>


    <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="Clientes.php" class="btn btn-primary">VOLVER</a>
            </div>
    </form>
    </div>
  <body>
	
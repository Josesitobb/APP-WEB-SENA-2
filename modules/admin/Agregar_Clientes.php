<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./ESTILOS/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <title>Agregar nuevo estilista</title>
    <style>
       
        h1,label {
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Agregar clientes</h1>
    <div  class="container my-4">



    <form method="post" action="Insertar_Clientes.php">
        <div class="form-group">
            <!-- <label for="rol">ROL</label>
            <select class="form-select form-control" name="NombreRol" id="rol">
                <option selected disabled>SELECCIONAR UN ROL</option>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                include("db.php");


                $sql = $conn->query("SELECT * FROM `roles`");

                while ($Resultado = $sql->fetch_assoc()) {
                    echo "<option value='" . $Resultado['Id_Rol'] . "'>" . $Resultado['Nombre_Rol'] . "</option>";
                }
                ?>
            </select>
        </div> -->

        <div class="form-group">
            <label for="nombreUsuario">NOMBRE USUARIO</label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="NOMBRE USUARIO">
        </div>

        <div class="form-group">
            <label for="apellidoUsuario">APELLIDO USUARIO</label>
            <input type="text" class="form-control" id="apellidoUsuario" name="apellidoUsuario" placeholder="APELLIDO USUARIO">
        </div>

        <div class="form-group">
            <label for="correoUsuario">CORREO USUARIO</label>
            <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" placeholder="CORREO USUARIO">
        </div>

        <div class="form-group">
            <label for="telefonoUsuario">TELEFONO USUARIO</label>
            <input type="tel" class="form-control" id="telefonoUsuario" name="telefonoUsuario" placeholder="TELEFONO USUARIO">
        </div>

        <div class="form-group">
            <label for="contrasenaUsuario">CONTRASEÑA USUARIO</label>
            <input type="password" class="form-control" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="CONTRASEÑA USUARIO">
        </div>

       
                 <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="Clientes.php" class="btn btn-primary">VOLVER</a>
            </div>
            
    </form>
            <br>

    </div>
</body>

</html>

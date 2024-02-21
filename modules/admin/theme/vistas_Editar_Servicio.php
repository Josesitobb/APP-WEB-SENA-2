<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 50px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        .preview-image {
            max-width: 500px;
            max-height: 500px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }
    </style>
    <title>Modificar</title>
</head>

<body>
    <?php
    include("db.php");
    $Id = $_REQUEST['Id'];
    $sql = "SELECT * FROM `servicios` WHERE `Id_Servicios` = $Id ";
    $resultado = $conn->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>

    <div class="container">
        <h1 class="text-center">Editar servicio</h1>
        <form action="EditarServicios.php?IdEditar=<?php echo $fila['Id_Servicios'] ?>" method="post" enctype="multipart/form-data" onsubmit="return ValidacioServiciosEditar();">
            <div class="mb-3">
                <label for="servicio_nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="servicio_nombre" id="servicio_nombre" value="<?php echo $fila['Nombre_Servicios'] ?>">
            </div>
            <div class="mb-3">
                <label for="servicio_valor" class="form-label">Precio</label>
                <input type="number" class="form-control" id="servicio_valor" name="servicio_valor" value="<?php echo $fila['Valor_Servicios'] ?>">
            </div>
            <div class="mb-3">
                <label for="servicio_descripcion" class="form-label">Descripción</label>
                <input type="text" name="servicio_descripcion" class="form-control" id="servicio_descripcion" value="<?php echo $fila['Descripcion_Servicios'] ?>">
            </div>
            <div class="mb-3">
                <label for="servicio_Imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="servicio_Imagen" name="servicio_Imagen">
                <img class="preview-image" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_Servicios']) ?>" alt="Preview Image">
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="layout-two-column.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>

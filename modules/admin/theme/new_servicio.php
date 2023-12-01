<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
      <script src="./js/validaciones/ValidacionServicios.js"></script>
</head>

<body>

   <div class="container">
    <br> 
    <h1>Nuevo Servicio</h1>
    <br>
   <form action="./AgregarServicios.php" method="POST" enctype="multipart/form-data" onsubmit="return ValidacioServicios();" >
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Servicio_Nombre</label>
            <input type="text" class="form-control" id="Servicio_Nombre" name="Servicio_Nombre">
            <div id="emailHelp" class="form-text">hola</div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Servicio_Precio</label>
            <input type="number" class="form-control" id="Servicio_Precio" name="Servicio_Precio">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Servicio_cantidad</label>
            <input type="number" class="form-control" id="Servicio_cantidad" name="Servicio_cantidad">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="servicio_Imagen" name="servicio_Imagen">
        </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-info" href="./layout-two-column.php">Cancelar</a>
    </form>
   </div>
</body>

</html>
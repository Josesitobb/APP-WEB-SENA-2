<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px; /* Ajustar el ancho máximo según sea necesario */
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary,
        .btn-info {
            width: 100%;
            margin-top: 20px;
            padding: 8px 16px; /* Ajustar el padding según sea necesario */
            font-size: 14px; /* Ajustar el tamaño de fuente según sea necesario */
        }
    </style>
    <script src="./js/validaciones/ValidacionServicios.js"></script>
</head>

<body>

    <div class="container">
        <h1>Nuevo Servicio</h1>
        <form action="./AgregarServicios.php" method="POST" enctype="multipart/form-data" onsubmit="return ValidacioServicios();">
            <div class="mb-3">
                <label for="Servicio_Nombre" class="form-label">Nombre del Servicio</label>
                <input type="text" class="form-control" id="Servicio_Nombre" name="Servicio_Nombre" required>

            </div>

            
            <div class="mb-3">
                <label for="Servicio_cantidad" class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="Servicio_Descripcion" name="Servicio_Descripcion" required>
            </div>


            <div class="mb-3">
                <label for="Servicio_Precio" class="form-label">Precio del Servicio</label>
                <input type="number" class="form-control" id="Servicio_Precio" name="Servicio_Precio" required>
            </div>

            <div class="mb-3">
                <label for="servicio_Imagen" class="form-label">Imagen del Servicio</label>
                <input type="file" class="form-control" id="servicio_Imagen" name="servicio_Imagen" required>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
            <a class="btn btn-info btn-sm" href="./layout-two-column.php">Cancelar</a>
        </form>
    </div>
</body>

</html>

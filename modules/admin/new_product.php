<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }
    </style>
    <title>Document</title>
    <script src="./js/validaciones/ValidacionProductos.js"></script>
</head>

<body>

    <div class="container">
        <h1 class="text-center">NUEVO PRODUCTO</h1>
        <form class="mx-auto" style="max-width: 400px;" action="./AgregarProducto.php" method="POST" enctype="multipart/form-data">
        <!-- colocar cuando coloque las valicaciones -->
        <!-- <form class="mx-auto" style="max-width: 400px;" action="./AgregarProducto.php" method="POST" enctype="multipart/form-data" onsubmit="return ValidacioProductos();"> -->
            <div class="mb-3">
                <label for="Name_product" class="form-label">Nombre producto</label>
                <input type="text" class="form-control" id="Name_product" name="Name_product">
            </div>

            <div class="mb-3">
                <label for="Name_product" class="form-label">Descripcion Producto</label>
                <input type="text" class="form-control" id="Product_description" name="Product_description">
            </div>

            <div class="mb-3">
                <label for="Price_Name" class="form-label">Precio</label>
                <input type="number" class="form-control" id="Price_Name" name="Price_Name">
            </div>

            <div class="mb-3">
                <label for="Product_amount" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="Product_amount" name="Product_amount">
            </div>

            <div class="mb-3">
                <label for="Product_Image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="Product_Image" name="Product_Image">
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-info" href="layout-one-column.php">Cancelar</a>
        </form>
    </div>

    <!-- <script src="./js/validaciones/ValidacionProductos.js"></script> -->
</body>

</html>

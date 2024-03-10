<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 150px; /* Ancho personalizado */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            width: 150px; /* Ancho personalizado */
        }

        .btn-info:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }

        /* Estilo para centrar la imagen */
        img.center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px; /* Margen superior añadido */
            margin-bottom: 20px; /* Margen inferior añadido */
        }

        /* Estilos adicionales para los botones */
        .btn {
            font-weight: bold;
            margin-top: 10px; /* Margen superior añadido */
        }

        /* Estilo para los campos de entrada */
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            border-radius: 5px; /* Bordes redondeados */
            border: 1px solid #ced4da; /* Borde */
            padding: 10px; /* Espaciado interno */
            margin-bottom: 15px; /* Margen inferior */
        }

        /* Estilo para los mensajes de ayuda */
        .form-text {
            color: #6c757d; /* Color del texto */
        }
    </style>
    <title>Modificar</title>
    <!-- <script src="./js/validaciones/ValidacionProductosEditar.js"></script> -->
</head>

<body>
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include("db.php");
    $Id = $_REQUEST['Id'];
    $sql = "SELECT * FROM `productos` WHERE `Id_Productos` = $Id ";

    $resultado = $conn->query($sql);

    $fila = $resultado->fetch_assoc();
    ?>

    <div class="container">
        <h1>MODIFICAR PRODUCTO</h1>

        <form action="EditarProductos.php?IdEditar=<?php echo $fila['Id_Productos'] ?>" method="post" enctype="multipart/form-data" onsubmit="return ValidacioProductosEditar();">
            <div class="mb-3">
                <label for="Name_producto" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" name="Name_producto" id="Name_producto" value="<?php echo $fila['Nombre_Productos'] ?>">

            </div>

            <div class="mb-3">
                <label for="Name_producto" class="form-label">Descripcion producto</label>
                <input type="text" class="form-control" name="Product_description" id="Product_description" value="<?php echo $fila['Descripcion_Productos'] ?>">
 
            </div>

            <div class="mb-3">
                <label for="Price_producto" class="form-label">Precio del producto</label>
                <input type="number" class="form-control" name="Price_producto" id="Price_producto" value="<?php echo $fila['Precio_Productos'] ?>">
   
            </div>

            <div class="mb-3">
                <label for="Amount_producto" class="form-label">Cantidad del producto</label>
                <input type="number" class="form-control" name="Amount_producto" id="Amount_producto" value="<?php echo $fila['Cantidad_Productos'] ?>">
            </div>

            <div class="mb-3">
                <label for="Producto_Imagen" class="form-label">Imagen del producto</label>
                <input type="file" class="form-control" id="Producto_Imagen" name="Producto_Imagen">
            </div>

            <!-- Centrar la imagen -->
            <img class="center" style="width: 500px; height: 500px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_Productos']) ?>" alt="Imagen del producto">


            <div class="d-flex justify-content-center mt-3">
    <button type="submit" class="btn btn-primary btn-sm me-2">Guardar cambios</button>
    <a href="layout-one-column.php" class="btn btn-info btn-sm ms-2">Regresar</a>
</div>

        </form>
    </div>

</body>

</html>

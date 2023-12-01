<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Modificar</title>
    <script src="./js/validaciones/ValidacionProductosEditar.js"></script>
</head>

<body>
    <?php

    include("./db.php");
    $Id = $_REQUEST['Id'];
    $sql = "SELECT * FROM `productos` WHERE `idPRODUCTOS` = $Id ";

    $resultado = $conn->query($sql);

    $fila = $resultado->fetch_assoc();
    ?>

    <div class="container">
        <br>
        <center>
            <h1>MODIFICAR PRODUCTO</h1>
        </center>


        <form action="EditarProductos.php?IdEditar=<?php echo $fila['idPRODUCTOS'] ?>" method="post" enctype="multipart/form-data" onsubmit="return ValidacioProductosEditar();">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre producto</label>
                <input type="text" class="form-control"  name="Name_producto" id="Name_producto" value="<?php echo $fila['producto_nombre'] ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
           
             <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                <input type="number" class="form-control"  name="Price_producto" id="Price_producto" value="<?php echo $fila['producto_precio'] ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cantidad producto</label>
                <input type="number" name="Amount_producto" class="form-control" id="Amount_producto"  value="<?php echo $fila['producto_cantidad'] ?>" >
            </div>
            <th><img style="width: 500px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_productos'])  ?>" alt=""></th>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Imagen producto</label>
                <input type="file" class="form-control" id="Producto_Imagen" name="Producto_Imagen" >
            </div> 




            
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="layout-one-column.php" class="btn btn-info">Regresar</a>
        </form>
    </div>

</body>

</html>
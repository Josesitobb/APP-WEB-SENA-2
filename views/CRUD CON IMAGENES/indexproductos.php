<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <h1>Lista de productos</h1>
    </div>





    <div class="cotainer">


        <a href="./new_product.php" class="btn btn-dark">agregar nuevo producto</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">idPRODUCTOS</th>
                    <th scope="col">producto_nombre</th>
                    <th scope="col">producto_precio</th>
                    <th scope="col">producto_precio</th>
                    <th scope="col">Imagen_productos</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php

                include("./db.php");
                $sql = "SELECT * FROM `productos` ";
                $resultado = $conn->query($sql);

                while ($fila = $resultado->fetch_assoc()) { ?>





                    <tr>
                        <th scope="row"><?php echo $fila['idPRODUCTOS'] ?></th>
                        <th><?php echo $fila['producto_nombre'] ?></th>
                        <th><?php echo $fila['producto_precio'] ?></th>
                        <th><?php echo $fila['producto_cantidad'] ?></th>
                        <th><img style="width: 200px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_productos'])  ?>" alt=""></th>
                        <th><a class="btn  btn-warning" href="deleteProducto.php?id=<?php echo $fila['idPRODUCTOS'] ?>">eliminar</a>
                            <a class="btn  btn-danger" href="vistas_Editar.php?Id=<?php echo $fila['idPRODUCTOS'] ?>">modificar</a>
                        </th>

                    </tr>
                    </tr>
            </tbody>

        <?php } ?>
        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
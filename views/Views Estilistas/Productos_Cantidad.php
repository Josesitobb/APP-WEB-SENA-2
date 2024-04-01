<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location:../../controllers/principal.php?action=sesion?");
    exit();
}

$productos = "SELECT * FROM productos";
$resultado = mysqli_query($conn, $productos);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Productos</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../../views/Views Estilistas/css/style.css" rel="stylesheet">

    <style>
        .low-stock {
            background-color: #ffcccc;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <?php include('Model/nav.php') ?>
    <?php include('Model/header.php') ?>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-xl-10 mx-auto">
                    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-body p-4 p-sm-5">
                            <div class="users-table">
                                <h5 class="card-title text-center mb-5 fw-light fs-5">Productos</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <table class="table_id">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <?php foreach ($resultado as $row) {
                                                $row_class = $row['Cantidad_Productos'] < 10 ? 'low-stock' : '';
                                            ?>
                                                <tr class="<?php echo $row_class; ?>">
                                                    <td><?php echo $row['Id_Productos']; ?></td>
                                                    <td><?php echo $row['Nombre_Productos']; ?></td>
                                                    <td><?php echo $row['Precio_Productos']; ?></td>
                                                    <td contenteditable="true" class="quantity" data-product-id="<?php echo $row['Id_Productos']; ?>"><?php echo $row['Cantidad_Productos']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
            Content body end
        ***********************************-->

    <?php include('Model/footer.php') ?>

    <script>
        document.querySelectorAll('.quantity').forEach(element => {
            element.addEventListener('blur', function() {
                const productId = this.getAttribute('data-product-id');
                const newQuantity = this.innerText.trim();
                if (!isNaN(newQuantity)) {
                    updateQuantity(productId, newQuantity);
                } else {
                    alert('La cantidad debe ser un número válido.');
                }
            });
        });

        function updateQuantity(productId, newQuantity) {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        alert('La cantidad se actualizó correctamente.');
                    } else {
                        alert('Error al actualizar la cantidad: ' + response.message);
                    }
                }
            };
            xhttp.open("POST", "../../controllers/estilista/estilista_data.php?action=Actualizarcantidadproductos", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + productId + "&quantity=" + newQuantity);
        }
    </script>

</body>

</html>

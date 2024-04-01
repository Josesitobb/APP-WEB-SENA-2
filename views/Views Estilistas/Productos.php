<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // La sesión no está iniciada o la variable de sesión no está definida, redirige al usuario a la página de inicio de sesión
    header("Location:../../controllers/principal.php?action=sesion?");
    exit();
}



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
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .btn-calcular {
            margin-top: 10px;
            margin-left:100px
        }

        .btn-enviar {
            margin-top: 10px;
        }

        .form-label-custom {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }


        .form-select-option {
            font-size: 16px;
            color: #555;
        }

        select.form-select {
            height: calc(2.25rem + 2px);
            padding: .375rem 2.25rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            width: 100%;
        }

        select.form-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(0, 123, 255, .25);
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

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">

    
            <!-- #/ container -->
<?php
$sql_usuarios = "SELECT c.*, u.Nombre_Usuarios, u.Apellido_Usuarios
FROM clientes AS c
INNER JOIN Usuarios AS u ON c.Id_Usuarios = u.Id_Usuarios
WHERE u.Id_Rol = 2;";
$result_usuarios = $conn->query($sql_usuarios);

$sql_productos = "SELECT Id_Productos, Nombre_Productos, Precio_Productos FROM productos";
$result_productos = $conn->query($sql_productos);

$sql_servicios = "SELECT Id_Servicios, Nombre_Servicios, Valor_Servicios FROM servicios";
$result_servicios = $conn->query($sql_servicios);
if ($result_usuarios->num_rows > 0 && $result_productos->num_rows > 0 && $result_servicios->num_rows > 0) {
?>
<div class="container">
    <h2 class="text-center">Formulario de Pedido y Facturación</h2>
    <form action="estilista_data.php?action=factura" method="POST">
        <!-- Seleccionar Usuario -->
        <div class="mb-3">
            <label for="usuario" class="form-label form-label-custom">Seleccionar Usuario:</label>
            <select name="cliente" id="cliente" class="form-select">
    <?php while ($row = $result_usuarios->fetch_assoc()): ?>
        <option value="<?= $row["Id_Clientes"] ?>" class="form-select-option"><?= $row["Nombre_Usuarios"] ?></option>
    <?php endwhile; ?>
</select>
        </div>

        <!-- Seleccionar Producto -->
        <div class="mb-3">
            <label for="producto" class="form-label form-label-custom">Seleccionar Producto:</label>
            <select name="producto" id="producto" class="form-select" onchange="updatePrecioUnitario()">
                <option value="" selected>-- Seleccionar Producto --</option>
                <?php while ($row = $result_productos->fetch_assoc()): ?>
                    <option value="<?= $row["Id_Productos"] ?>" data-precio="<?= $row["Precio_Productos"] ?>" class="form-select-option"><?= $row["Nombre_Productos"] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Precio Unitario y Cantidad de Producto -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="precio_unitario" class="form-label form-label-custom">Precio Unitario:</label>
                <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" step="0.01" readonly>
            </div>
            <div class="col-md-6">
                <label for="cantidad" class="form-label form-label-custom">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" onchange="calcularTotal()">
            </div>
        </div>

        <!-- Valor Total Productos -->
        <div class="mb-3">
            <label for="total_productos" class="form-label form-label-custom">Valor Total Productos:</label>
            <input type="text" name="total_productos" id="total_productos" class="form-control" readonly>
        </div>

        <!-- Seleccionar Servicio -->
        <div class="mb-3">
            <label for="servicio" class="form-label form-label-custom">Seleccionar Servicio:</label>
            <select name="servicio" id="servicio" class="form-select" onchange="updatePrecioServicio(); calcularTotal()">
                <?php while ($row = $result_servicios->fetch_assoc()): ?>
                    <option value="<?= $row["Id_Servicios"] ?>" data-precio="<?= $row["Valor_Servicios"] ?>" class="form-select-option"><?= $row["Nombre_Servicios"] ?> - Precio: $<?= $row["Valor_Servicios"] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Cantidad y Valor Total de Servicios -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cantidad_servicios" class="form-label form-label-custom">Cantidad de Servicios:</label>
                <input type="number" name="cantidad_servicios" id="cantidad_servicios" class="form-control" min="1" onchange="calcularTotal()">
            </div>
            <div class="col-md-6">
                <label for="precio_servicio" class="form-label form-label-custom">Precio Servicio:</label>
                <input type="number" name="precio_servicio" id="precio_servicio" class="form-control" step="0.01" onchange="calcularTotal()">
            </div>
        </div>

        <!-- Valor Total Servicios -->
        <div class="mb-3">
            <label for="valor_total_servicios" class="form-label form-label-custom">Valor Total Servicios:</label>
            <input type="text" name="valor_total_servicios" id="valor_total_servicios" class="form-control" readonly>
        </div>

        <!-- Valor Total Factura y Botones de Acción -->
        <div class="mb-3">
            <label for="total_factura" class="form-label form-label-custom">Valor Total Factura:</label>
            <input type="text" name="total_factura" id="total_factura" class="form-control" readonly>
        </div>

        <input type="hidden" name="id_estilista" value="<?= $_SESSION['id_estilista'] ?>">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary btn-calcular me-md-2" onclick="calcularTotal()">Calcular Total</button>
            <button type="submit" class="btn btn-success btn-enviar">Enviar Pedido y Factura</button>
        </div>
    </form>
</div>


<?php
} else {
    echo "No se encontraron usuarios, productos o servicios en la base de datos.";
}

// Cerrar conexión
$conn->close();
?>

<script>
    function updatePrecioUnitario() {
        var selectedProduct = document.getElementById("producto");
        var precioUnitarioInput = document.getElementById("precio_unitario");
        var precioUnitario = selectedProduct.options[selectedProduct.selectedIndex].getAttribute("data-precio");
        precioUnitarioInput.value = precioUnitario;
        updateTotal(); 
    }

    function updateTotal() {
    var cantidadInput = document.getElementById("cantidad");
    var precioUnitarioInput = document.getElementById("precio_unitario");
    var totalProductosInput = document.getElementById("total_productos");
    var cantidad = parseInt(cantidadInput.value); // Parsear la cantidad como un entero

    console.log("Cantidad:", cantidad);
    console.log("Precio Unitario:", precioUnitarioInput.value);

    if (isNaN(cantidad)) {
        cantidad = 0; // Si la cantidad no es un número válido, establecerla como 0
    }

    var precioUnitario = parseFloat(precioUnitarioInput.value);
    var total = cantidad * precioUnitario;

    console.log("Total:", total);

    totalProductosInput.value = total.toFixed(2);
}



function calcularTotal() {
    updateTotal();

    var totalProductosInput = parseFloat(document.getElementById("total_productos").value);
    var precioServicioInput = parseFloat(document.getElementById("precio_servicio").value);
    var cantidadServicios = parseInt(document.getElementById("cantidad_servicios").value);

    if (isNaN(cantidadServicios)) {
        cantidadServicios = 0;
    }

    var totalServicios = precioServicioInput * cantidadServicios;
    var totalFacturaInput = document.getElementById("total_factura");

    var totalFactura = 0;

    if (!isNaN(totalProductosInput)) {
        totalFactura += totalProductosInput;
    }

    if (!isNaN(totalServicios)) {
        totalFactura += totalServicios;
    }

    totalFacturaInput.value = totalFactura.toFixed(2);

    var valorTotalServiciosInput = document.getElementById("valor_total_servicios");
    valorTotalServiciosInput.value = totalServicios.toFixed(2);
}



    function updatePrecioServicio() {
    var selectedService = document.getElementById("servicio");
    var precioServicioInput = document.getElementById("precio_servicio");
    var precioServicio = selectedService.options[selectedService.selectedIndex].getAttribute("data-precio");
    precioServicioInput.value = precioServicio;
}

</script>

</div>
   
    </div>
</div>
<?php include('Model/footer.php') ?>
        <!-- <script>
    // Función para calcular el valor total de los productos
    function calcularTotal() {
        // Obtener el valor seleccionado del producto y el valor ingresado en la cantidad
        var precioUnitario = parseFloat(document.getElementById("precio_unitario").value);
        var cantidad = parseInt(document.getElementById("cantidad").value);
        
        // Calcular el valor total de los productos
        var totalProductos = precioUnitario * cantidad;
        
        // Actualizar el valor del campo "Valor Total Productos"
        document.getElementById("total_productos").value = totalProductos.toFixed(2); // Mostrar solo 2 decimales
    }
    
    // Asignar la función calcularTotal al evento onchange de los elementos select de "producto" y "cantidad"
    document.getElementById("producto").onchange = calcularTotal;
    document.getElementById("cantidad").onchange = calcularTotal;
</script> -->


</body>

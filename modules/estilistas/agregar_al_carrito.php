<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['sesion_iniciada']) || $_SESSION['sesion_iniciada'] !== true) {
    // Si la sesión no está iniciada, redirigir al usuario a la página de inicio de sesión
    header("Location: modules/admin/theme/page-login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Variable para almacenar el total de la compra
$total_compra = 0;

// Verificar si se ha enviado un formulario con el botón "Agregar al carrito"
if (isset($_POST['agregar_al_carrito'])) {
    // Obtener el ID del producto seleccionado desde el formulario
    $producto_id = $_POST['producto_id'];

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$producto_id])) {
        // Si el producto ya está en el carrito, aumentar la cantidad en 1
        $_SESSION['carrito'][$producto_id]++;
    } else {
        // Si el producto no está en el carrito, agregar el producto al carrito con una cantidad de 1
        $_SESSION['carrito'][$producto_id] = 1;
    }

    // Redirigir de vuelta a la página de productos después de agregar el producto al carrito
    header("Location: Productos.php");
    exit();
}

// Verificar si existe la variable de sesión 'carrito' y si contiene productos
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    // Crear un array para almacenar los detalles de los productos en el carrito
    $productos_carrito = array();

    // Recorrer cada producto en el carrito
    foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
        // Consultar la base de datos para obtener los detalles del producto
        $consulta_producto = "SELECT * FROM Productos WHERE Id_Productos = $producto_id";
        $resultado_producto = mysqli_query($conn, $consulta_producto);

        if ($resultado_producto && mysqli_num_rows($resultado_producto) > 0) {
            // Obtener los detalles del producto
            $producto = mysqli_fetch_assoc($resultado_producto);

            // Calcular el subtotal del producto (cantidad por precio)
            $subtotal_producto = $cantidad * $producto['Precio_Productos'];

            // Agregar los detalles del producto al array de productos en el carrito
            $productos_carrito[] = array(
                'id' => $producto['Id_Productos'],
                'nombre' => $producto['Nombre_Productos'],
                'precio' => $producto['Precio_Productos'],
                'cantidad' => $cantidad,
                'subtotal' => $subtotal_producto
            );

            $total_compra += $subtotal_producto;
        }
    }

    echo "<form id='carrito_form' method='post' action='actualizar_carrito.php'>";
    echo "<h2>Productos en el carrito:</h2>";

    foreach ($productos_carrito as $producto) {
        echo "<p>Nombre: " . $producto['nombre'] . ", Precio: $" . number_format($producto['precio'], 2) . ", Cantidad: <input type='number' name='cantidad[" . $producto['id'] . "]' value='" . $producto['cantidad'] . "' min='1' max='10'>, Subtotal: $" . number_format($producto['subtotal'], 2) . "</p>";
    }

    echo "<input type='hidden' name='actualizar_carrito' value='1'>";
    echo "</form>";

    echo "<h2>Total de la compra: $" . number_format($total_compra, 2) . "</h2>";
} else {
    echo "El carrito está vacío.";
}
?>

<script>

document.querySelectorAll('input[name^="cantidad"]').forEach(function(input) {
    input.addEventListener('change', function() {
        document.getElementById('carrito_form').submit();
    });
});
</script>

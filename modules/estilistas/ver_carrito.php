<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
 
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type='number'] {
            width: 50px;
            text-align: center;
        }

        .action-buttons button {
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #d32f2f;
        }

        .total-price {
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 20px;
        }
    </style>
    
    <script>
        function eliminarProducto(idProducto) {
    if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        // Enviar una solicitud AJAX para eliminar el producto del carrito
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Actualizar la tabla del carrito después de eliminar el producto
                document.getElementById('fila-' + idProducto).remove();
                actualizarPrecioTotal(); // <-- Llama a la función para actualizar el precio total
            }
        };
        xhr.open('POST', 'ver_carrito.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('eliminar_producto&id_producto=' + idProducto);
    }
}

        function actualizarCantidadYTotal(input) {
            var fila = input.parentNode.parentNode;
            var nuevaCantidad = parseInt(input.value);
            var precioUnitario = parseFloat(fila.querySelector(".precio-unitario").innerText);
            var subtotal = nuevaCantidad * precioUnitario;
            fila.querySelector(".subtotal").innerText = subtotal.toFixed(2);
            actualizarPrecioTotal();
        }

        function actualizarPrecioTotal() {
            var precioTotal = 0;
            var filas = document.querySelectorAll("table tbody tr");
            filas.forEach(function (fila) {
                var subtotal = parseFloat(fila.querySelector(".subtotal").innerText);
                precioTotal += subtotal;
            });
            document.getElementById("precio-total").innerText = precioTotal.toFixed(2);
        }
    </script>
</head>
<body>

<h2>Carrito de Compras</h2>

<?php
session_start();
include "carrito_operaciones.php";

// Procesar eliminación de producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_producto'])) {
    $idProducto = $_POST['id_producto'];
    eliminarProductoDelCarrito($idProducto);
    exit();
}

// Establecer conexión a la base de datos (reemplaza los valores con los de tu propia configuración)
include("db.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "<table>";
echo "<thead><tr><th>ID Producto</th><th>Nombre</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th><th>Acción</th></tr></thead>";
echo "<tbody>";

foreach ($_SESSION['carrito'] as $idProducto => $cantidad) {
    // Obtener nombre y precio unitario del producto según su ID desde la base de datos
    $nombreProducto = obtenerNombreProductoPorId($conn, $idProducto);
    $precioUnitario = obtenerPrecioProductoPorId($conn, $idProducto);
    $subtotal = $cantidad * $precioUnitario;

    echo "<tr id='fila-$idProducto'>";
    echo "<td>$idProducto</td>";
    echo "<td>$nombreProducto</td>";
    echo "<td><input type='number' class='nueva-cantidad' value='$cantidad' min='1' onchange='actualizarCantidadYTotal(this)'></td>";
    echo "<td class='precio-unitario'>$precioUnitario</td>";
    echo "<td class='subtotal'>$subtotal</td>";
    echo "<td><button onclick='eliminarProducto($idProducto)'>Eliminar</button></td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
echo "<p>Precio Total: <span id='precio-total'></span></p>";

// Cerrar la conexión a la base de datos
$conn->close();

// Función para obtener el nombre del producto por su ID
function obtenerNombreProductoPorId($conn, $idProducto) {
    $sql = "SELECT Nombre_Productos FROM productos WHERE Id_Productos = $idProducto";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Nombre_Productos"];
    } else {
        return "Producto Desconocido";
    }
}

// Función para obtener el precio unitario del producto por su ID
function obtenerPrecioProductoPorId($conn, $idProducto) {
    $sql = "SELECT Precio_Productos FROM productos WHERE Id_Productos = $idProducto";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Precio_Productos"];
    } else {
        return 0; // Precio por defecto si no se encuentra el producto
    }
}
?>

<a href="productos.php">Volver a Productos</a>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Finalizar Compra</button>
<script>

    actualizarPrecioTotal();
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Compra Finalizada</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Selecciona un Cliente:</h4>
        <select class="form-select" aria-label="Selecciona un cliente">
          <?php
          include("db.php");
          // Mostrar lista de clientes
          $sql_clientes = "SELECT Nombre_Usuarios, Apellido_Usuarios FROM Usuarios WHERE Id_Rol = 2;
          ;
          ";
          $result_clientes = $conn->query($sql_clientes);
          if ($result_clientes->num_rows > 0) {
              while ($row = $result_clientes->fetch_assoc()) {
                  echo "<option v   alue='{$row['Nombre_Usuarios']}'>{$row['Nombre_Usuarios']}</option>";
              }
          } else {
              echo "<option value=''>No se encontraron clientes.</option>";
          }
          ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <!-- Puedes agregar más acciones de botones aquí si es necesario -->
      </div>
    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>



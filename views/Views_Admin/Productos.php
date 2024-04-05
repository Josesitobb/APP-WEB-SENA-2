<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  // echo "¡Hola, $username!";
} else {


  session_destroy();
  header("Location:../../controllers/principal.php?action=sesion?");



}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Clientes</title>
  <link href="../../views/Views_Admin/css/style.css" rel="stylesheet">
  <link href="../../views/Views_Admin/css/style.css.map" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    .btn-custom-pink {
      background-color: #F299B9;
      border-color: #F299B9;
      color: white;
    }

    .btn-custom-blue {
      background-color: #6BCCF2;
      border-color: #6BCCF2;
      color: white;
    }
  </style>


</head>

<body>

  <?php include("Model/header.php"); ?>

  <?php include("Model/navbar.php"); ?>
  <!-- MODAL DE AGREGAR -->
  <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formAgregarProducto" action="../../controllers/admin/admin_data.php?action=agregarproducto" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nombreProducto" class="form-label">Nombre Producto</label>
              <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
            </div>
            <div class="mb-3">
              <label for="descripcionProducto" class="form-label">Descripción Producto</label>
              <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" required></textarea>
            </div>

            <div class="mb-3">
              <label for="precioProducto" class="form-label">Precio</label>
              <input type="text" class="form-control" id="precioProducto" name="precioProducto" required>
            </div>
            
            <div class="mb-3">
              <label for="cantidadProducto" class="form-label">Cantidad</label>
              <input type="number" class="form-control" id="cantidadProducto" name="cantidadProducto" required>
            </div>
            <div class="mb-3">
              <label for="imagenProducto" class="form-label">Imagen</label>
              <input type="file" class="form-control" id="imagenProducto" name="imagenProducto" required accept="image/*">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DE EDITAR -->

  <div class="modal fade" id="modificarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formModificarProducto" action="../../controllers/admin/admin_data.php?action=editarproducto" method="post" enctype="multipart/form-data">
            <input type="hidden" id="idProducto" name="idProducto">
            <div class="mb-3">
              <label for="editarNombreProducto" class="form-label">Nombre Producto</label>
              <input type="text" class="form-control" id="editarNombreProducto" name="nombreProducto" required>
            </div>
            <div class="mb-3">
              <label for="editarDetalleProducto" class="form-label">Detalle Producto</label>
              <textarea class="form-control" id="editarDetalleProducto" name="Destalleproductos" required></textarea>
            </div>
            <div class="mb-3">
              <label for="editarPrecioProducto" class="form-label">Precio</label>
              <input type="text" class="form-control" id="editarPrecioProducto" name="precioProducto" required>
            </div>
            <div class="mb-3">
              <label for="editarCantidadProducto" class="form-label">Cantidad</label>
              <input type="number" class="form-control" id="editarCantidadProducto" name="cantidadProducto" required>
            </div>
            <div class="mb-3">
              <label for="editarImagenesProducto" class="form-label">Imagenes</label>
              <input type="file" class="form-control" id="editarImagenesProducto" name="imagenesProducto" multiple accept="image/*">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="content-body">


    <!-- row -->

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h1 class="text-center">Lista de productos</h1>
              <div class="container mt-4">
                <button type="button" class="btn btn-primary" onclick="mostrarModalAgregarProducto()">Agregar nuevo producto</button>
                <a href="admin_data.php?action=excelproductos" class="btn btn-primary">Descargar</a>
              </div>
              <div class="container mt-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Imágenes</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM `productos`";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo $fila['Id_Productos'] ?></td>
                        <td><?php echo $fila['Nombre_Productos'] ?></td>
                        <td><?php echo $fila['Descripcion_Productos'] ?></td>
                        <td><?php echo $fila['Precio_Productos'] ?></td>
                        <td><?php echo $fila['Cantidad_Productos'] ?></td>
                        <td><img style="width: 100px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_Productos']) ?>" alt=""></td>
                        <td>
                          <button type="button" class="btn btn-custom-blue my-1" onclick="mostrarModalModificar(<?php echo $fila['Id_Productos'] ?>, '<?php echo $fila['Nombre_Productos'] ?>', '<?php echo $fila['Descripcion_Productos'] ?>', '<?php echo $fila['Precio_Productos'] ?>', '<?php echo $fila['Cantidad_Productos'] ?>')">Editar</button>
                          <button type="button" class="btn btn-custom-pink my-1" onclick="confirmarEliminar(<?php echo $fila['Id_Productos'] ?>)">Eliminar</button>

                        </td>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- #/ container -->
  </div>
  
  <div id="mensaje"></div>

 
  <?php include("Model/footer.php"); ?>
  <script>
    function mostrarModalAgregarProducto() {
      $('#agregarProductoModal').modal('show');
    }
  </script>
  <script>
    function mostrarModalModificar(id, nombre, detalle, precio, cantidad) {
      $('#idProducto').val(id);
      $('#editarNombreProducto').val(nombre);
      $('#editarDetalleProducto').val(detalle);
      $('#editarPrecioProducto').val(precio);
      $('#editarCantidadProducto').val(cantidad);
      $('#modificarProductoModal').modal('show');
    }
  </script>

  <script>
    function confirmarEliminar(idProducto) {
      if (confirm('¿Está seguro de que desea eliminar este producto?')) {
        // Si el usuario confirma, redirigir a la página de eliminación con el ID del producto
        window.location.href = '../../Modelos/Admin/deleteProducto.php?id=' + idProducto;

      }
    }
  </script>

<script>
document.getElementById('precioProducto').addEventListener('input', function(evt) {
    let input = evt.target;
    let value = input.value.replace(/\./g, ''); // Eliminar todos los puntos actuales
    value = value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Agregar un punto cada tres dígitos
    input.value = value;
});
</script>


<script>
document.getElementById('editarPrecioProducto').addEventListener('input', function(evt) {
    let input = evt.target;
    let value = input.value.replace(/\./g, ''); // Eliminar todos los puntos actuales
    value = value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Agregar un punto cada tres dígitos
    input.value = value;
});
</script>

</body>

</html>
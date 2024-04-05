<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {


  session_destroy();
  header("Location:../../controllers/principal.php?action=sesion?");

  // Destruye la sesión solo si no ha iniciado sesión

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Servicios</title>
  <!-- <link rel="icon" href="icons/SG.png"> -->
  <link rel="icon" type="image/png" sizes="16x16" href="SG.png">
  <!-- Pignose Calender -->
  <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
  <!-- Chartist -->
  <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
  <link rel="stylesheet" href="plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
  <!-- Custom Stylesheet -->
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
  <!-- MODAL AGREGAR SERVICIO -->
  <div class="modal fade" id="agregarServicioModal" tabindex="-1" role="dialog" aria-labelledby="agregarServicioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarServicioModalLabel">Agregar Nuevo Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Aquí van los campos del formulario -->
          <form action="../../controllers/admin/admin_data.php?action=agregarservicio" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="text" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" class="form-control-file" id="imagen" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL EDITAR -->
  <div class="modal fade" id="editarServicioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="editarServicioForm" action="../../Modelos/Admin/EditarServicios.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="editId" name="editId">
            <div class="form-group">
              <label for="editNombre">Nombre</label>
              <input type="text" class="form-control" id="editNombre" name="editNombre" required>
            </div>
            <div class="form-group">
              <label for="editPrecio">Precio</label>
              <input type="text" class="form-control" id="editPrecio" name="editPrecio" required>
            </div>
            <div class="form-group">
              <label for="editDescripcion">Descripción</label>
              <textarea class="form-control" id="editDescripcion" name="editDescripcion" required></textarea>
            </div>
            <div class="form-group">
              <label for="editImagen">Imagen</label>
              <input type="file" class="form-control-file" id="editImagen" name="editImagen">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <?php include("Model/header.php"); ?>

  <?php include("Model/navbar.php"); ?>

  <div class="content-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <br>
                <h1 class="text-center">Lista de Servicio</h1>
              </div>

              <div class="container mt-4">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregarServicioModal">Agregar Nuevo Servicio</a>
                <a href="admin_data.php?action=excelservicios" class="btn btn-primary">Descargar</a>
              </div>

              <div class="container mt-4">
                <div class="table-responsive"> 
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      <?php

                      $sql = "SELECT * FROM `servicios`";
                      $resultado = $conn->query($sql);
                      while ($fila = $resultado->fetch_assoc()) {
                      ?>
                        <tr>
                          <th scope="row"><?php echo $fila['Id_Servicios'] ?></th>
                          <td><?php echo $fila['Nombre_Servicios'] ?></td>
                          <td><?php echo $fila['Valor_Servicios'] ?></td>
                          <td><?php echo $fila['Descripcion_Servicios'] ?></td>
                          <td><img style="max-width: 100px;" src="data:image/jpg;base64,<?php echo base64_encode($fila['Imagen_Servicios']) ?>" alt=""></td>
                          <td>
                            <a class="btn btn-custom-blue my-1" href="#" onclick="editarServicio('<?php echo $fila['Id_Servicios']; ?>', '<?php echo $fila['Nombre_Servicios']; ?>', '<?php echo $fila['Valor_Servicios']; ?>', '<?php echo $fila['Descripcion_Servicios']; ?>')">Editar</a>
                            <a class="btn btn-custom-pink my-1" href="../../Modelos/Admin/deleteServicios.php?id=<?php echo $fila['Id_Servicios'] ?>">Eliminar</a>
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
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- #/ container -->
  </div>

  </div>

  <?php include("Model/footer.php"); ?>
  <script>
    function editarServicio(id, nombre, precio, descripcion, imagenBase64) {
      $('#editId').val(id);
      $('#editNombre').val(nombre);
      $('#editPrecio').val(precio);
      $('#editDescripcion').val(descripcion);
      if (imagenBase64) {
        $('#editImagen').siblings('label').text('Imagen seleccionada');
      } else {
        $('#editImagen').siblings('label').text('Seleccione una imagen');
      }
      $('#editarServicioModal').modal('show');
    }
  </script>



</body>

</html>
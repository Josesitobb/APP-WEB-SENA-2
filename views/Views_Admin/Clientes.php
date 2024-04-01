<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$varsesion=$_SESSION['username'];

if($varsesion == null || $varsesion=''){
    echo 'USTED INICIE SESION';
    header("Location:page-error-500.php");
    die();
}


echo $_SESSION['username'];
?>


<?php
// Realiza una consulta SQL para obtener todos los roles
$sql_roles = $conn->query("SELECT * FROM Roles");

// Almacena los resultados en un array
$roles = array();
while ($row = $sql_roles->fetch_assoc()) {
    $roles[] = $row;
}

// Convierte el array de roles a formato JSON
$roles_json = json_encode($roles);
?>

<script>
// Almacena la lista de roles en una variable JavaScript
var roles = <?php echo $roles_json; ?>;
</script>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="../Views_Admin/images/SGC.png">
    <title>Clientes</title>
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

<?php Include("Model/header.php"); ?>

<?php Include ("Model/navbar.php"); ?>

        <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editarClienteForm">
          <!-- Aquí van los campos para editar el cliente -->
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">


            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                            <div class="container">
        <br>
       
    </div>
    <br>
  <h1><center>USUARIOS CLIENTES</center></h1>
    
  <!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">Agregar Usuario</button>
<a href="admin_data.php?action=excelclientes" class="btn btn-primary">Descargar</a>

<!-- Modal para agregar un nuevo usuario -->
<div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="agregarUsuarioForm">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" required>
          </div>
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" required>
          </div>
          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" required>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" required>
          </div>
          <div class="mb-3">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  <br>
    <br>


    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Rol</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Apellido usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Acciones</th>
               
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = $conn->query("SELECT U.*, R.Nombre_Rol as Rol
            FROM Usuarios U
            JOIN Roles R ON U.Id_Rol = R.Id_Rol
            WHERE R.Nombre_Rol = 'clientes'");

            while ($resultado = $sql->fetch_assoc()) {
            ?>
                <tr class="table-light">
                    <td><?php echo $resultado['Rol'] ?></td>
                    <td><?php echo $resultado['Nombre_Usuarios'] ?></td>
                    <td><?php echo $resultado['Apellido_Usuarios'] ?></td>
                    <td><?php echo $resultado['Correo_Usuarios'] ?></td>
                    <td><?php echo $resultado['Telefono_Usuarios'] ?></td>
                    <td><?php echo $resultado['Contraseña_Usuarios'] ?></td>
                    <td>
                        <a class="btn btn-custom-blue my-1" href="javascript:void(0);" onclick="cargarDatosCliente(<?php echo $resultado['Id_Usuarios']; ?>, '<?php echo $resultado['Nombre_Usuarios']; ?>', '<?php echo $resultado['Apellido_Usuarios']; ?>', '<?php echo $resultado['Correo_Usuarios']; ?>', '<?php echo $resultado['Telefono_Usuarios']; ?>', '<?php echo $resultado['Contraseña_Usuarios'] ?>', '<?php echo $resultado['Id_Rol']; ?>')">Editar</a>
                        <a class="btn btn-custom-pink my-1" href="../../Modelos/Admin/Borrar_Clientes.php?id=<?php echo $resultado['Id_Usuarios']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">Eliminar</a>


                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
     
    <?php Include("Model/footer.php") ?>
    <script>
function cargarDatosCliente(idCliente, nombre, apellido, correo, telefono, contraseña ,idRol ) {
    // Genera las opciones de selección para los roles
    var opcionesRol = '';
    for (var i = 0; i < roles.length; i++) {
        opcionesRol += `<option value="${roles[i].Id_Rol}" ${roles[i].Id_Rol == idRol ? 'selected' : ''}>${roles[i].Nombre_Rol}</option>`;
    }

    document.getElementById('editarClienteForm').innerHTML = `
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" value="${nombre}">
      </div>
      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" value="${apellido}">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" value="${correo}">
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" value="${telefono}">
      </div>
      <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="text" class="form-control" id="contraseña" value="${contraseña}">
      </div>
     
      <input type="hidden" id="idCliente" value="${idCliente}">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
      </div>
    `;
    $('#editarClienteModal').modal('show');
}
</script>



<script>
function guardarCambios() {
    // Obtener los valores del formulario
    var idCliente = document.getElementById('idCliente').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var correo = document.getElementById('correo').value;
    var telefono = document.getElementById('telefono').value;
    var contraseña = document.getElementById('contraseña').value;


    // Crear un objeto con los datos del formulario
    var datos = {
        idCliente: idCliente,
        nombre: nombre,
        apellido: apellido,
        correo: correo,
        telefono: telefono,
        contraseña: contraseña,

    };

    // Enviar los datos mediante AJAX a un archivo PHP
    $.ajax({
        url: 'admin_data.php?action=usuariosclienteseditar',
        type: 'POST',
        data: datos,
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response);
            // Recargar la página
            location.reload();
            // Mostrar mensaje de actualización
            $('#mensaje').text(response); // Aquí se muestra el mensaje recibido del servidor
        },
        error: function(xhr, status, error) {
            // Manejar errores de AJAX
            console.error(xhr.responseText);
            // Mostrar mensaje de error
            $('#mensaje').text('Error al guardar los cambios.'); // Mensaje genérico en caso de error
        }
    });
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Cuando se envía el formulario dentro del modal
    $('#agregarUsuarioForm').submit(function(e) {
        e.preventDefault(); // Evita que se envíe el formulario de manera tradicional

        // Recopila los datos del formulario
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();
        var contraseña = $('#contraseña').val();

        // Envía los datos mediante AJAX a un archivo PHP
        $.ajax({
            url: 'admin_data.php?action=usuariosclientesagregar',
            type: 'POST',
            data: {
                nombre: nombre,
                apellido: apellido,
                correo: correo,
                telefono: telefono,
                contraseña: contraseña
            },
            success: function(response) {
                alert(response);
                
                // Recargar la página si la inserción fue exitosa
                location.reload();
            },
            error: function(xhr, status, error) {
                // Manejar errores de AJAX
                console.error(xhr.responseText);
            }
        });
    });
});
</script>



</body>

</html>
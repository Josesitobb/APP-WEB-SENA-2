<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  session_destroy();
  header("Location:../../controllers/principal.php?action=sesion?");
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png" sizes="16x16" href="../Views_Admin/images/SGC.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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


  <!-- MODOLA EDITAR -->
  <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editarClienteForm">

          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>







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
              <h1>
                <center>USUARIOS CLIENTES</center>
              </h1>

              <!-- BOTON QUE ABRE EL MODAL PARA AGREGAR USUARIOS -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">Agregar Usuario</button>
              
              <a href="admin_data.php?action=excelclientes" class="btn btn-primary">Descargar</a>

              <!-- CUANDO SE DA CLICK EN EL MODAL SE ABRE EL MODAL CON LOS CAMPOS DEL MODAL-->
              <!-- AL HACER CLIK EN AGREGAR USUARIO SE ENVIAN LOS DATOS A LA FUNCION agregarUsuarioForm  -->
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
                      <th ></th>

                    </tr>
                  </thead>
                  <tbody>
                    <!-- SE EJECUTA UNA CONSULTA PARA VER TODOS LOS USUARIOS CON ROLES CLIENTES -->
                    <?php

                    $sql = $conn->query("SELECT U.*, R.Nombre_Rol as Rol
            FROM Usuarios U
            JOIN Roles R ON U.Id_Rol = R.Id_Rol
            WHERE R.Nombre_Rol = 'clientes'");
                      // SE HACE WHILE PARA QUE RECORRA TODOS LOS USUARIOS 
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
                          <!-- CUANDO SE  DA CLICK EN EL BOTON EDITAR  SE LLAMA A LA FUNCION cargarDatosCliente, QUE DEPENDIENDO EL ID_USUARIOS SE VAN A CARGAR LOS DATOS DE ESA ID   -->
                          <a class="btn btn-primary" href="javascript:void(0);" onclick="cargarDatosCliente(<?php echo $resultado['Id_Usuarios']; ?>, '<?php echo $resultado['Nombre_Usuarios']; ?>', '<?php echo $resultado['Apellido_Usuarios']; ?>', '<?php echo $resultado['Correo_Usuarios']; ?>', '<?php echo $resultado['Telefono_Usuarios']; ?>', '<?php echo $resultado['Contraseña_Usuarios'] ?>', '<?php echo $resultado['Id_Rol']; ?>')">
                              <i class="bi bi-gear"></i>
                          </a>
                          <a class="btn btn-primary" href="../../Modelos/Admin/Borrar_Clientes.php?id=<?php echo $resultado['Id_Usuarios']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">
                              <i class="bi bi-x-circle"></i>
                          </a>


                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>


              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

            
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <?php include("Model/footer.php") ?>
  <script>
    // SE CREA LA FUNCION CON LOS PARAMETRO QUE VA A OBTENER 
    function cargarDatosCliente(idCliente, nombre, apellido, correo, telefono, contraseña) {
  // SE LLAMA AL MODAL CUANDO SE EJECUTA LA FUNCION Y SE LE MANDA LOS VALORES QUE TIENE QUE MONSTRA 
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
    // MONSTRAR EL MODAL 
      $('#editarClienteModal').modal('show');
    }
  </script>

<!--         // CUANDO EL USUARIO LE DA AL BOTON guardar cambios SE MANDA LOS VALORES  A UNA FUNCION LLAMADA guardarCambios() -->

  <script>
    // SE CREA LA FUNCION
    function guardarCambios() {
      // SE GUARDA LOS VALORES QUE SE MANDARON DEL FORMULARIO
      var idCliente = document.getElementById('idCliente').value;
      var nombre = document.getElementById('nombre').value;
      var apellido = document.getElementById('apellido').value;
      var correo = document.getElementById('correo').value;
      var telefono = document.getElementById('telefono').value;
      var contraseña = document.getElementById('contraseña').value;


      // SE CREA UN OBJETO CON EL VALOR DE LOS CAMPOS DEL FORMULARIO
      var datos = {
        idCliente: idCliente,
        nombre: nombre,
        apellido: apellido,
        correo: correo,
        telefono: telefono,
        contraseña: contraseña,

      };

    //  CREAMO LA SOLICITUD AJAX
      $.ajax({
        // LA URL DONDE ESTA EL CONTROLADOR PARA EDITAR
        url: 'admin_data.php?action=usuariosclienteseditar',
        // EL TYPE POR DONDE SE VA A MANDAR EN ESTE CASO ES POST
        type: 'POST',
        // ME MANDA EL OBJETO CON LOS VALORES DEL FORMUALRIO
        data: datos,
        // SE MANEJA LA RESPUESA QUE TENGA EL SERVIDOR 
        success: function(response) {
          // SE MUESTRA EN LA CONSOLA LA RESPUESTA
          console.log(response);
          // SE RECARGAR LA PAGINA DESPUES DE ENVIAR LA PAGI
          location.reload();
          // Mostrar mensaje de actualización
          $('#mensaje').text(response); // Aquí se muestra el mensaje recibido del servidor
        },

        error: function(xhr, status, error) {
          // MANDA UN MENSAJE DE ERROR 
          console.error(xhr.responseText);
          // MUESTRA UN MENSAJE DE ERROR
          $('#mensaje').text('Error al guardar los cambios.'); // Mensaje genérico en caso de error
        }
      });
    }
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  
  <script>
    // SE COMIENZA LA OBTENCION DE DATOS POR PARTE DEL FORMUALRIO
    $(document).ready(function() {
      // CUANDO SE ENVIA DATOS DEL FORMULARIO LA FUNCION  COMIENZA A RECOLECTARLOS CUANDO SE DA CLICK EN EL BOTON "AGREGAR" QUE ES DE TIPO SUMMIT
      $('#agregarUsuarioForm').submit(function(e) {
        // CUANDO SE VA A EJECUTAR LA ACCION CUANDO 
        e.preventDefault(); 

      // SE RECOPILAN LOS DATOS DEL FORMULARIO Y SE GUARDAN EN VARIABLES PARA DESPUES UTILIZARSE 
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();
        var contraseña = $('#contraseña').val();

          // SE COMIENZA UNA SOLICITUD AJAX PARA COMENZAR A ENVIAR LOS DATOS
        $.ajax({
          // URL DONDE SE VAN A ENVIAR LOS DATOS.EN ESTE CASO LOS  MANDA A UN CONTROLADOR 
          url: 'admin_data.php?action=usuariosclientesagregar',
          // EN TYPO COMO LOS VA A MANDAR. EN ESTE CASO LO MANDA POR EL SERVIDOR POST
          type: 'POST',
          // DATA SE HACE UN OBJETO CON EL MISMO NOMBRE DE LAS VARIABLES PARA ENVIAR POR EL SERVIDOR 
          data: {
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            telefono: telefono,
            contraseña: contraseña
          },
          // REPUES DEL SERVIDOR SI SE COMPLETO LA SOLICITUD AJAX
          success: function(response) {
            // FUNCION ALERTA PARA MONSTRAR UNA ALERTA COMO ESTUVO LA SOLICITUD
            alert(response);

            // RECARGAR LA PAGINA DESPUES DE RECIBIR  RESPUES DEL SERVIDOR 
            location.reload();
          },
          // MUESTRA LOS ERRORES SI HAY UNO
          error: function(xhr, status, error) {
          //  LOS MUESTRA EN LA CONSOLA
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>




</body>

</html>
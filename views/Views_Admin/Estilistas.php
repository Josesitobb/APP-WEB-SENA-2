<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


// Verifica si el nombre de usuario está en la sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "¡Hola, $username!";
} else {
    // El usuario no ha iniciado sesión, realiza la lógica correspondiente

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
    <title>Estilistas</title>
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

<!-- Modal para agregar nuevo estilista -->
<div class="modal fade" id="agregarEstilistaModal" tabindex="-1" aria-labelledby="agregarEstilistaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarEstilistaModalLabel">Agregar Nuevo Estilista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar nuevo estilista -->
                <form id="agregarEstilistaForm" action="../../controllers/admin/admin_data.php?action=agregarestilista" method="POST">
                    <div class="mb-3">
                        <label for="nombreEstilista" class="form-label">Nombre Usuario</label>
                        <input type="text" class="form-control" id="nombreEstilista" name="nombreEstilista">
                    </div>
                    <div class="mb-3">
                        <label for="apellidoEstilista" class="form-label">Apellido Usuario</label>
                        <input type="text" class="form-control" id="apellidoEstilista" name="apellidoEstilista">
                    </div>
                    <div class="mb-3">
                        <label for="correoEstilista" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correoEstilista" name="correoEstilista">
                    </div>
                    <div class="mb-3">
                        <label for="telefonoEstilista" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoEstilista" name="telefonoEstilista">
                    </div>
                    <div class="mb-3">
                        <label for="contraseñaEstilista" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseñaEstilista" name="contraseñaEstilista">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Estilista</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   

<!-- Modal para editar estilista -->
<div class="modal fade" id="editarEstilistaModal" tabindex="-1" aria-labelledby="editarEstilistaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEstilistaModalLabel">Editar Estilista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar estilista -->
                <form id="editarEstilistaForm">
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="apellidoUsuario" class="form-label">Apellido Usuario</label> <!-- Nuevo campo para el apellido -->
                        <input type="text" class="form-control" id="apellidoUsuario" name="apellidoUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="correoUsuario" class="form-label">Correo Usuario</label>
                        <input type="email" class="form-control" id="correoUsuario" name="correoUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Telefono Usuario</label>
                        <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="contraseñaUsuario" class="form-label">Contraseña Usuario</label>
                        <input type="password" class="form-control" id="contraseñaUsuario" name="contraseñaUsuario">
                    </div>
                    <input type="hidden" id="idUsuario" name="idUsuario"> <!-- Campo oculto para la ID del usuario -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarCambiosEstilista()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>



        <!--**********************************
            Sidebar end
        ***********************************-->

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
                        <h1 class="text-center">USUARIOS ESTILISTAS</h1>
                    </div>

                    <!-- Botón para abrir el modal de agregar nuevo estilista -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarEstilistaModal">Agregar Nuevo Estilista</button>
<a href="admin_data.php?action=excelestilistas" class="btn btn-primary">Descargar</a>
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
           
            $sql = $conn->query("SELECT U.*, R.Nombre_Rol as Rol FROM Usuarios U JOIN Roles R ON U.Id_Rol = R.Id_Rol WHERE R.Nombre_Rol = 'estilistas'");
            while ($resultado = $sql->fetch_assoc()) {
            ?>
                <tr class="table-light">
                    <th scope="row"><?php echo $resultado['Rol'] ?></th>
                    <td><?php echo $resultado['Nombre_Usuarios'] ?></td>
                    <td><?php echo $resultado['Apellido_Usuarios'] ?></td>
                    <td><?php echo $resultado['Correo_Usuarios'] ?></td>
                    <td><?php echo $resultado['Telefono_Usuarios'] ?></td>
                    <td><?php echo $resultado['Contraseña_Usuarios'] ?></td>
                    <td>
                        <a class="btn btn-custom-blue my-1" href="#" onclick="cargarDatosEstilista('<?php echo $resultado['Nombre_Usuarios']; ?>', '<?php echo $resultado['Apellido_Usuarios']; ?>', '<?php echo $resultado['Correo_Usuarios']; ?>', '<?php echo $resultado['Telefono_Usuarios']; ?>', '<?php echo $resultado['Contraseña_Usuarios']; ?>', '<?php echo $resultado['Id_Usuarios']; ?>')" data-bs-toggle="modal" data-bs-target="#editarEstilistaModal" class="btn btn-warning">Editar</a>
                        <a class="btn btn-custom-pink my-1" href="../../Modelos/Admin/Borrar_Estilistas.php?Id_Usuarios=<?php echo $resultado['Id_Usuarios']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')" class="btn btn-danger">Eliminar</a>
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
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php Include("Model/footer.php"); ?>
    <script> 
    function cargarDatosEstilista(nombre, apellido, correo, telefono, contraseña, idUsuario) {
    document.getElementById("nombreUsuario").value = nombre;
    document.getElementById("apellidoUsuario").value = apellido;
    document.getElementById("correoUsuario").value = correo;
    document.getElementById("telefonoUsuario").value = telefono;
    document.getElementById("contraseñaUsuario").value = contraseña;
    document.getElementById("idUsuario").value = idUsuario; // Establecer el valor de la ID del usuario
}

</script>

<script>
    function guardarCambiosEstilista() {
        // Obtener los valores de los campos del formulario
        var nombreUsuario = document.getElementById('nombreUsuario').value;
        var apellidoUsuario = document.getElementById('apellidoUsuario').value; // Nuevo
        var correoUsuario = document.getElementById('correoUsuario').value;
        var telefonoUsuario = document.getElementById('telefonoUsuario').value;
        var contraseñaUsuario = document.getElementById('contraseñaUsuario').value;
        var idUsuario = document.getElementById('idUsuario').value;

        // Crear un objeto FormData para enviar los datos
        var formData = new FormData();
        formData.append('nombreUsuario', nombreUsuario);
        formData.append('apellidoUsuario', apellidoUsuario); // Nuevo
        formData.append('correoUsuario', correoUsuario);
        formData.append('telefonoUsuario', telefonoUsuario);
        formData.append('contraseñaUsuario', contraseñaUsuario);
        formData.append('idUsuario', idUsuario);

        // Enviar los datos mediante AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin_data.php?action=usuariosestilistaseditar', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Procesar la respuesta del servidor si es necesario
                console.log(xhr.responseText);
                
                // Cerrar el modal
                var modal = new bootstrap.Modal(document.getElementById('editarEstilistaModal'));
                modal.hide();
                
                // Recargar la página
                location.reload();
            } else {
                // Manejar errores si es necesario
                console.error('Error al enviar los datos');
            }
        };
        xhr.send(formData);
    }
</script>




</body>

</html>
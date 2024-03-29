<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../../controllers/db.php");
// Obtener la lista de clientes
$query = "SELECT clientes.Id_Clientes, usuarios.Nombre_Usuarios
FROM clientes
INNER JOIN usuarios ON clientes.Id_Usuarios = usuarios.Id_Usuarios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $clientes = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $clientes[$fila['Id_Clientes']] = $fila['Nombre_Usuarios'];
}

} else {
    echo "Error al obtener la lista de clientes: " . mysqli_error($conn);
}




// Obtener la lista de estilistas
$query = "SELECT Estilistas.Id_Estilistas, usuarios.Nombre_Usuarios
FROM Estilistas
INNER JOIN usuarios ON Estilistas.Id_Usuarios = usuarios.Id_Usuarios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $Estilistas = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $Estilistas[$fila['Id_Estilistas']] = $fila['Nombre_Usuarios'];
}
} else {
    echo "Error al obtener la lista de estilistas: " . mysqli_error($conn);
}



// Obtener la lista de servicios
$query = "SELECT Id_Servicios, Nombre_Servicios FROM servicios";

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    $Servicios = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $Servicios[$fila['Id_Servicios']] = $fila['Nombre_Servicios'];
}

} else {
    echo "Error al obtener la lista de servicios: " . mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Estilo para el contenedor del formulario */
        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Estilo para el título del formulario */
        h1 {
            text-align: center;
        }

        /* Estilo para los elementos del formulario */
        .form-group {
            margin-bottom: 20px;
        }

        /* Estilo para el botón de enviar */
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
        <h1 class="mt-5 mb-4">Editar Cita</h1>
        <div class="table-responsive">
            <!-- Tu formulario HTML aquí -->
        </div>
   
            <?php
            include("./db.php");

            if(isset($_GET['Id_Citas'])) {
                $id_cita = $_GET['Id_Citas'];

                // Consulta SQL para obtener los datos de la cita seleccionada
                $sql_cita = "SELECT 
                Citas.Id_Citas,
                Citas.start,
                Citas.end,
                Clientes.Id_Clientes,
                CONCAT(Usuarios_Clientes.Nombre_Usuarios, ' ', Usuarios_Clientes.Apellido_Usuarios) AS Nombre_Cliente,
                Estilistas.Id_Estilistas,
                CONCAT(Usuarios_Estilistas.Nombre_Usuarios, ' ', Usuarios_Estilistas.Apellido_Usuarios) AS Nombre_Estilista,
                Servicios.Id_Servicios,
                Servicios.Nombre_Servicios,
                Servicios.Valor_Servicios AS Precio_Servicio
            FROM Citas
            INNER JOIN Clientes ON Citas.Id_Clientes = Clientes.Id_Clientes
            INNER JOIN Usuarios AS Usuarios_Clientes ON Clientes.Id_Usuarios = Usuarios_Clientes.Id_Usuarios
            INNER JOIN Estilistas ON Citas.Id_Estilistas = Estilistas.Id_Estilistas
            INNER JOIN Usuarios AS Usuarios_Estilistas ON Estilistas.Id_Usuarios = Usuarios_Estilistas.Id_Usuarios
            INNER JOIN Servicios ON Citas.Id_Servicios = Servicios.Id_Servicios
            WHERE Citas.Id_Citas = $id_cita";


                $result_cita = $conn->query($sql_cita);

                if ($result_cita->num_rows > 0) {
                    $row = $result_cita->fetch_assoc();
                    ?>
                    <form action='actualizar_cita.php' method='post'>
                        <input type='hidden' name='id_cita' value='<?php echo $row["Id_Citas"]; ?>'>
                        <div class="form-group">
                            <label for="fecha_hora">Fecha y Hora:</label>
                            <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" value="<?php echo $row["start"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Nombre_Cliente">Nombre del Cliente:</label>
                            <select id="Nombre_Cliente" name="Nombre_Cliente" class="form-control">
                                <?php foreach ($clientes as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>" <?php if ($id == $row['Id_Clientes']) echo 'selected'; ?>><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Nombre_Estilista">Estilista:</label>
                            <select id="Nombre_Estilista" name="Nombre_Estilista" class="form-control">
                                <?php foreach ($Estilistas as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>" <?php if ($id == $row['Id_Estilistas']) echo 'selected'; ?>><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Nombre_Servicios">Servicios</label>
                            <select id="Nombre_Servicios" name="Nombre_Servicios" class="form-control">
                                <?php foreach ($Servicios as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>" <?php if ($id == $row['Id_Servicios']) echo 'selected'; ?>><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type='text' class="form-control" id='precio' name='precio' value='<?php echo $row["Precio_Servicio"]; ?>' readonly>
                        </div>

                        <button type='submit' class='btn btn-primary'>Guardar Cambios</button>
                    </form>
                    <?php
                } else {
                    echo "La cita no existe.";
                }
            } else {
                echo "No se ha especificado una cita para editar.";
            }

            $conn->close();
            ?>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#fecha_hora').datetimepicker({
                format: 'Y-m-d H:i', // Formato de fecha y hora
                step: 15 // Incremento en minutos
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#Nombre_Servicios').change(function(){
                var servicioSeleccionado = $(this).val();

                $.ajax({
                    url: 'obtener_precio_servicio.php',
                    method: 'POST',
                    data: { servicioSeleccionado: servicioSeleccionado },
                    success: function(response){
                        $('#precio').val(response);
                    },
                    error: function(xhr, status, error){
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>
</html>

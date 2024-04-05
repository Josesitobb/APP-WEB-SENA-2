<?php
session_start();

// Verificar si la sesión de estilista está iniciada
if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] === true) {
    // Acceder a la variable de sesión específica para estilistas
    $id_estilista = $_SESSION['id_estilista'];

    // Hacer algo con la variable $id_estilista
    echo "ID del estilista: $id_estilista";
} else {
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
        <title>Citas</title>
        <link rel="icon" type="image/png" sizes="16x16" href="SG.png">
        <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
        <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
        <link href="../../views/Views_Admin/css/style.css" rel="stylesheet">
        <link href="../../views/Views_Admin/css/style.css.map" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link href="css/style.css" rel="stylesheet">
    </head>

    <style>
    body {
        font-family: Arial, sans-serif;
        width: 100%; /* Establece el ancho del body al 100% del ancho del viewport */
    height: 100vh; /* Establece la altura del body al 100% del alto del viewport */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .hoy {
        background-color: #ffe0b2;
    }

    /* Estilos para el modal */
    .modal {
        display: none; /* Ocultar el modal por defecto */
        position: fixed; /* Posición fija para cubrir toda la ventana */
        z-index: 1; /* Situar el modal por encima de todo */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Habilitar desplazamiento si el contenido es más grande que la ventana */
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* Margen superior e inferior para centrar verticalmente */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Ancho del contenido del modal */
    }

    /* Estilo para el botón de cerrar */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        margin-top: 50px;
    }

    form {
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    select.form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    select.form-control:focus {
        border-color: #f2f2f2;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    button[type="submit"], button[type="button"] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"] {
        background-color: #A96E70;
        color: #fff;
    }

    button[type="submit"]:hover {
        background-color: #A96E70;
    }

    button[type="button"] {
        background-color: #6c757d;
        color: #fff;
        margin-left: 10px;
    }

    button[type="button"]:hover {
        background-color: #A96E70;
    }

    .table-container {
        display: flex;
        justify-content: center;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary-pink {
    background-color: #A96E70 !important;
    color: white !important;
    }
    
    table th, table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }
    table th {
        background-color: #A96E70;
        color: #fff;
    }
    table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    table tbody tr:hover {
        background-color: #e2e2e2;
    }
    .btn-primary, .btn-primary:hover {
        background-color: #007bff !important;
        border-color: #007bff !important;
    }
    .btn-danger, .btn-danger:hover {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    </style>

    <body >


        <?php include('Model/nav.php') ?>
        <?php include('Model/header.php') ?>
        
        <div class="content-body">
    
            <?php
    
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
    
            <?php
            // Establecer la zona horaria a Bogotá, Colombia
            date_default_timezone_set('America/Bogota');
            
            // Obtener el mes y el año actual
            $mes = isset($_GET['mes']) ? $_GET['mes'] : date('n');
            $año = isset($_GET['año']) ? $_GET['año'] : date('Y');
            
            // Obtener el número de días en el mes actual
            $dias_en_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
            
            // Obtener el día de la semana del primer día del mes
            $primer_dia_del_mes = date('N', strtotime("$año-$mes-01"));
            
            // Array de días de la semana
            $dias_de_la_semana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
            
            // Array de nombres de los meses en español
            $meses_en_espanol = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];
    
            // Obtener el nombre del mes en español
            $nombre_del_mes = $meses_en_espanol[$mes - 1];
            ?>
            
            <div class="container-fluid" style="width: 100%;">
            <div class="row">
        <div class="col-lg-10 col-xl-10 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-4 p-sm-5">
                <div class="users-table">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Citas</h5>
                <div class="row col-md-12">

                    <div class="container-part">

                        <div class="calendar col-md-5">
                            <h2 class="text-center"><?php echo $nombre_del_mes . ' ' . $año; ?></h2>
                            <div class="text-center mb-3">
    
                                <a href="../../controllers/estilista/estilista_views.php?vista=citas&mes=<?php echo ($mes == 1) ? 12 : $mes - 1; ?>&año=<?php echo ($mes == 1) ? $año - 1 : $año; ?>" class="btn btn-primary-rosa">Mes Anterior</a>
                                <a href="../../controllers/estilista/estilista_views.php?vista=citas&mes=<?php echo ($mes == 12) ? 1 : $mes + 1; ?>&año=<?php echo ($mes == 12) ? $año + 1 : $año; ?>" class="btn btn-primary-rosa">Mes Siguiente</a>
                                <a href="../../controllers/estilista/estilista_views.php?vista=citas&mes=<?php echo date('n'); ?>&año=<?php echo date('Y'); ?>" class="btn btn-primary-rosa">Mes Actual</a>
                            </div>
                        <table class="table">
                            <thead>

                                <tr>
                                    <?php foreach ($dias_de_la_semana as $dia) : ?>
                                        <th><?php echo $dia; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                // Llena los espacios vacíos al principio del mes
                                for ($i = 1; $i < $primer_dia_del_mes; $i++) {
                                    echo '<td></td>';
                                }
        
                                // Llena los días del mes
                                $dia_actual = 1;
                                for ($i = $primer_dia_del_mes; $i <= 7; $i++) {
                                    echo '<td' . (($dia_actual == date('j')) ? ' class="hoy"' : '') . '><a href="#" onclick="mostrarModal(\'' . $año . '-' . $mes . '-' . $dia_actual . '\')">' . $dia_actual . '</a></td>';
                                    $dia_actual++;
                                }
                                ?>
                            </tr>
                            <?php
                            // Llena los días restantes del mes
                            while ($dia_actual <= $dias_en_mes) {
                                echo '<tr>';
                                for ($i = 1; $i <= 7 && $dia_actual <= $dias_en_mes; $i++) {
                                    echo '<td' . (($dia_actual == date('j')) ? ' class="hoy"' : '') . '><a href="#" onclick="mostrarModal(\'' . $año . '-' . $mes . '-' . $dia_actual . '\')">' . $dia_actual . '</a></td>';
                                    $dia_actual++;
                                }
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="form-group col-md-13">
                                <label for="cliente">Seleccione un cliente:</label>
                                <select class="form-control col-md-12" id="cliente" name="cliente" >
                                    <option value="" disabled>Todos los clientes</option>
                                    <?php
                                    // Obtener la lista de clientes desde la base de datos
                                    $sqlClientes = "SELECT Clientes.*, CONCAT(Usuarios.Nombre_Usuarios, ' ', Usuarios.Apellido_Usuarios) AS Nombre_Usuario
                                    FROM Clientes
                                    INNER JOIN Usuarios ON Clientes.Id_Usuarios = Usuarios.Id_Usuarios";
                                    $resultClientes = $conn->query($sqlClientes);
                    
                                    // Imprimir opciones del menú desplegable para cada cliente
                                    while ($rowCliente = $resultClientes->fetch_assoc()) {
                                        $selected = ($rowCliente['Nombre_Usuario'] == $clienteSeleccionado) ? 'selected' : '';
                                        echo "<option value='" . $rowCliente["Id_Clientes"] . "' $selected>" . $rowCliente["Nombre_Usuario"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="container-botones col-md-13">
                                <form action="admin_cliente_citas.php?cliente=cliente" method="GET"> <!-- Eliminado el estilo display: none; -->
                                    <a href="admin_data.php?action=excelcitas" class="btn btn-primary-pink">Descargar</a>
                                    <button type="submit" class="btn btn-primary-pink">Filtrar</button>
                                    <button type="button" class="btn btn-secondary" onclick="location.href='index.php';">Quitar filtro</button>
                                </form>
                            </div>

                        </div>
                        <div class="table-responsive col-md-7" style="margin-top: 80px;">
                            
                        <table class="table">
                        <?php
    
                        // Obtener el ID del cliente seleccionado de los parámetros de la URL
                        $clienteSeleccionado = isset($_GET['cliente']) ? $_GET['cliente'] : null;
                        
                        // Consulta SQL para obtener los datos de las citas filtradas por cliente
                        $sql = "SELECT 
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
                        WHERE Estilistas.Id_Estilistas = $id_estilista";
                        
                        
                        // Agregar la cláusula WHERE si se ha seleccionado un cliente
                        if ($clienteSeleccionado !== null) {
                            $sql .= " WHERE Clientes.Id_Clientes = $clienteSeleccionado";
                        }
    
                        // Ejecutar la consulta SQL
                        $result = $conn->query($sql);
                        ?>
                            
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Estilista</th>
                                            <th>Servicio</th>
                                            <!-- <th>Hora</th> -->
                                            <th>Precio</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Imprimir los datos en la tabla HTML
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["start"] . "</td>";
                                                echo "<td>" . $row["Nombre_Cliente"] . "</td>";
                                                echo "<td>" . $row["Nombre_Estilista"] . "</td>";
                                                echo "<td>" . $row["Nombre_Servicios"] . "</td>";
                                                // echo "<td>" . $row["end"] . "</td>";
                                                echo "<td>" . $row["Precio_Servicio"] . "</td>";
                                                echo "<td><a href='../../controllers/estilista/estilista_views.php?vista=EditarCita&Id_Citas=" . $row["Id_Citas"] . "' class='btn btn-primary-pink'><i class='bi bi-gear'></i></a></td>";
                                                echo "<td><a href='../../controllers/estilista/estilista_data.php?action=EliminarCita&Id_Citas=" . $row["Id_Citas"] . "' onclick='return confirmarEliminar();' class='btn btn-primary-pink'><i class='bi bi-x-circle'></i></a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>0 resultados</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- Scripts de Bootstrap JS y otros (si es necesario) -->
                    <script>
                        function confirmarEliminar() {
                            return confirm('¿Está seguro de que desea eliminar esta cita?');
                        }
                    </script>
    
                    <?php
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        </div>
            </div>
        </div>
        
        <!-- Modal -->
        
        
        <div id="myModal" class="modal" style="overflow-y: auto;">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ajusta el tamaño del modal a 'lg' (grande) -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="cerrarModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="formulario" action="estilista_data.php?action=agregarcitas" method="POST">
                        <div class="form-group">
                            <label for="Nombre_Cliente">Nombre del Cliente:</label>
                            <select id="Nombre_Cliente" name="Nombre_Cliente" class="form-control">
                                <?php foreach ($clientes as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Nombre_Estilista">Estilista:</label>
                            <select id="Nombre_Estilista" name="Nombre_Estilista" class="form-control">
                                <?php foreach ($Estilistas as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Nombre_Servicios">Servicios:</label>
                            <select id="Nombre_Servicios" name="Nombre_Servicios" class="form-control">
                                <?php foreach ($Servicios as $id => $nombre) { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_actual">Fecha actual:</label>
                            <input type="text" id="fecha_actual" name="fecha_actual" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="hora_actual">Hora actual:</label>
                            <input type="time" id="hora_actual" name="hora_actual" value="<?php echo date('H:i'); ?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Obtener el modal
            var modal = document.getElementById("myModal");
        
            // Función para mostrar el modal y establecer la fecha seleccionada en el formulario
            function mostrarModal(fechaSeleccionada) {
                document.getElementById('fecha_actual').value = fechaSeleccionada;
                modal.style.display = "block";
            }
            
            // Función para cerrar el modal
            function cerrarModal() {
                modal.style.display = "none";
            }
            
            // Cerrar el modal cuando el usuario haga clic fuera de él
            window.onclick = function(event) {
                if (event.target == modal) {
                    cerrarModal();
                }
            }
        </script>
        <?php Include ("Model/footer.php"); ?>
    </body>
</html>
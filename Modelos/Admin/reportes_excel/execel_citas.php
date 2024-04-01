<?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Reporte-excel.xls");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <style>
        .tabla_reporte {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla_reporte th, .tabla_reporte td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .tabla_reporte th {
            background-color: #f2f2f2;
        }
        .tabla_reporte tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="contenedor">
        <h1>REPORTE DE CITAS</h1>
        <div class="tabla">
            <table class="tabla_reporte" style="text-align:center;">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Fecha Y Hora</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Nombre Estilista</th>
                        <th scope="col">Nombre Servicios</th>
                        <th scope="col">Precio </th>
                 
                    </tr>
                </thead>
                <tbody>
                    <?php
                       
                        session_start();

                        $sql_1 = "SELECT 
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
                        ";

                        $sql_2 = mysqli_query($conn,$sql_1);

                        while($campo = mysqli_fetch_assoc($sql_2)){
                    ?> 
                    
                    <tr>
                        <th scope="row"><?php echo $campo['Id_Citas']?></th>
                        <td scope="row"><?php echo $campo['start']?></td>
                        <td scope="row"><?php echo $campo['Nombre_Cliente']?></td>
                        <td scope="row"><?php echo $campo['Nombre_Estilista']?></td>
                        <td scope="row"><?php echo $campo['Nombre_Servicios']?></td>
                        <td scope="row"><?php echo $campo['Precio_Servicio']?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

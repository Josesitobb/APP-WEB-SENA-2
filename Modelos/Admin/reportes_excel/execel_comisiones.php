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
        <h1>REPORTE DE COMISIONES</h1>
        <div class="tabla">
            <table class="tabla_reporte" style="text-align:center;">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre Estilista</th>
                        <th scope="col">Comision</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de comision </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../../../controllers/db.php");
                        session_start();

                        $sql_1 = "SELECT c.Id_Comisiones, c.Pagar_Comisiones, c.Estado_De_Pago_Comisiones, f.Fecha_Factura, u.Nombre_Usuarios AS Nombre_Usuario
                        FROM comisiones c
                        JOIN estilistas e ON c.Id_Estilistas = e.Id_Estilistas
                        JOIN usuarios u ON e.Id_Usuarios = u.Id_Usuarios
                        JOIN facturas f ON c.Id_Facturas = f.Id_Facturas ";

                        $sql_2 = mysqli_query($conn,$sql_1);

                        while($campo = mysqli_fetch_assoc($sql_2)){
                            $estado_pago = ($campo['Estado_De_Pago_Comisiones'] == 1) ? 'Pago' : 'No pago';
                    ?> 
                    
                    <tr>
                        <th scope="row"><?php echo $campo['Id_Comisiones']?></th>
                        <td scope="row"><?php echo $campo['Nombre_Usuario']?></td>
                        <td scope="row"><?php echo $campo['Pagar_Comisiones']?></td>
                        <td scope="row"><?php echo $estado_pago ?></td>
                        <td scope="row"><?php echo $campo['Fecha_Factura']?></td>
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

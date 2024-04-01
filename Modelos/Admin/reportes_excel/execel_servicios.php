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
        <h1>REPORTE DE SERVICIOS</h1>
        <div class="tabla">
            <table class="tabla_reporte" style="text-align:center;">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripcion</th>
                        
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../../../controllers/db.php");
                        session_start();

                        $sql_1 = "SELECT * FROM `servicios`";

                        $sql_2 = mysqli_query($conn,$sql_1);

                        while($campo = mysqli_fetch_assoc($sql_2)){
                    ?> 
                    
                    <tr>
                        <th scope="row"><?php echo $campo['Id_Servicios']?></th>
                        <td scope="row"><?php echo $campo['Nombre_Servicios']?></td>
                        <td scope="row"><?php echo $campo['Valor_Servicios']?></td>
                        <td scope="row"><?php echo $campo['Descripcion_Servicios']?></td>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Facturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td a {
            color: #007bff;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        .no-data {
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Facturas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Factura</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("db.php");

                // Consulta SQL para obtener las facturas
                $sql = "SELECT 
                f.Id_Facturas, 
                f.Fecha_Factura, 
                f.Precio_Total_Productos, 
                f.Precio_Total_Servicios, 
                f.Factura_Total, 
                IFNULL(f.Cantidad_Productos, 0) AS Cantidad_Productos, 
                IFNULL(f.Cantidad_Servicios, 0) AS Cantidad_Servicios,
                p.Nombre_Productos, 
                IFNULL(p.Precio_Productos, 0) AS Precio_Producto,
                s.Nombre_Servicios, 
                IFNULL(s.Valor_Servicios, 0) AS Precio_Servicio,
                c.Nombre_Usuarios AS Nombre_Cliente, 
                e.Nombre_Usuarios AS Nombre_Estilista
            FROM 
                facturas f
            LEFT JOIN 
                Productos p ON f.Id_Productos = p.Id_Productos
            LEFT JOIN 
                servicios s ON f.Id_Servicios = s.Id_Servicios
            LEFT JOIN 
                clientes cl ON f.Id_Clientes = cl.Id_Clientes
            LEFT JOIN 
                Usuarios c ON cl.Id_Usuarios = c.Id_Usuarios
            LEFT JOIN 
                Estilistas es ON f.Id_Estilistas = es.Id_Estilistas
            LEFT JOIN 
                Usuarios e ON es.Id_Usuarios = e.Id_Usuarios";
                $result = $conn->query($sql);

                // Comprobar si se encontraron resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y mostrar las filas de la tabla
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Id_Facturas"] . "</td>";
                        // Formatear la fecha
                        $fechaFormateada = date('d/m/Y', strtotime($row["Fecha_Factura"]));
                        echo "<td>". $row["Nombre_Cliente"] . "</td>";
                        echo "<td>" . $fechaFormateada . "</td>";
                        echo "<td><a href='generar_pdf.php?id_factura=" . $row["Id_Facturas"] . "'>Descargar PDF</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='no-data'>No hay facturas</td></tr>";
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

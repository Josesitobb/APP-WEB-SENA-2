<?php
require('PDF/fpdf.php');
include("../db.php");

$id_factura = $_GET['id_factura'];

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar el logo
$pdf->Image('logi.png', 10, 10, 30);

// Configurar fuente y color
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); // Negro

// Consulta SQL para obtener la factura específica
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
            Usuarios e ON es.Id_Usuarios = e.Id_Usuarios
        WHERE 
            f.Id_Facturas = $id_factura";

$result = $conn->query($sql);

// Si se encontró la factura, generar el PDF
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Agregar los datos al PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
    $pdf->Ln(5);

    // Establecer la configuración regional en español
    setlocale(LC_ALL, 'spanish');

    $fecha_formateada = strftime('%A, %e de %B de %Y', strtotime($row["Fecha_Factura"]));

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha_formateada, 0, 1);
    
    // Nombre de cliente
    $pdf->Cell(0, 10, 'Cliente: ' . str_replace('ñ', ',', $row["Nombre_Cliente"]), 0, 1);
    // Nombre productos
    $pdf->Cell(0, 10, 'Producto: ' . (str_replace('ñ', ',', $row["Nombre_Productos"]) ?: 'No disponible'), 0, 1);
    // Precio productos
    $pdf->Cell(0, 10, 'Precio Producto: $' . number_format($row["Precio_Producto"], 2), 0, 1);
    // Cantidad productos
    $pdf->Cell(0, 10, 'Cantidad Productos: ' . $row["Cantidad_Productos"], 0, 1);
    // Precio total productos
    $pdf->Cell(0, 10, 'Total Productos: $' . number_format($row["Precio_Total_Productos"], 2), 0, 1);

    // Nombre servicio
    $pdf->Cell(0, 10, 'Servicio: ' . (str_replace('ñ', ',', $row["Nombre_Servicios"]) ?: 'No disponible'), 0, 1);
    // Precio servicio
    $pdf->Cell(0, 10, 'Precio Servicio: $' . number_format($row["Precio_Servicio"], 2), 0, 1);
    // Cantidad servicio
    $pdf->Cell(0, 10, 'Cantidad Servicios: ' . $row["Cantidad_Servicios"], 0, 1);
    // Precio total servicio
    $pdf->Cell(0, 10, 'Total Servicios: $' . number_format($row["Precio_Total_Servicios"], 2), 0, 1);

    // Total factura
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Total Factura: $' . number_format($row["Factura_Total"], 2), 0, 1);

} else {
    // Factura no encontrada
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura no encontrada', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>

<?php
// Tu lógica para conectarte a la base de datos y obtener la lista de clientes
include("db.php");

$sql = "SELECT Nombre_Usuarios, Apellido_Usuarios FROM Usuarios WHERE Id_Usuarios IN (SELECT Id_Usuarios FROM clientes)";
$result = $conn->query($sql);

$clientes = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = array(
            "nombre" => $row["Nombre_Usuarios"],
            "apellido" => $row["Apellido_Usuarios"]
        );
    }
}

// Enviar la lista de clientes como respuesta JSON
echo json_encode($clientes);

// Cerrar la conexión a la base de datos
$conn->close();
?>

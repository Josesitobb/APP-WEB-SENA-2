<?php
// Assuming you have established a database connection already
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombreNuevoEstilista"];
    $apellido = $_POST["apellidoNuevoEstilista"];
    $correo = $_POST["correoNuevoEstilista"];
    $telefono = $_POST["telefonoNuevoEstilista"];
    $contraseña = $_POST["contraseñaNuevoEstilista"];

    // Prepare the SQL statement
    $sql = "INSERT INTO usuarios (Nombre_Usuarios, Apellido_Usuarios, Correo_Usuarios, Telefono_Usuarios, Contraseña_Usuarios, Id_Rol) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Bind parameters and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $contraseña, $idRol);
    
    // Set the value for $idRol, assuming it is known
    $idRol = 1; // Example value
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Estilista agregado correctamente.";
    } else {
        echo "Error al agregar el estilista: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

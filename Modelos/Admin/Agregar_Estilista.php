<?php
require("../../controllers/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombreEstilista"];
    $apellido = $_POST["apellidoEstilista"];
    $correo = $_POST["correoEstilista"];
    $telefono = $_POST["telefonoEstilista"];
    $contraseña = $_POST["contraseñaEstilista"];

    // Prepare the SQL statement to insert into 'usuarios' table
    $sql_usuarios = "INSERT INTO usuarios (Nombre_Usuarios, Apellido_Usuarios, Correo_Usuarios, Telefono_Usuarios, Contraseña_Usuarios, Id_Rol) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Bind parameters and execute the statement for 'usuarios' table
    $stmt_usuarios = $conn->prepare($sql_usuarios);
    $stmt_usuarios->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $contraseña, $idRol);
    
    // Set the value for $idRol, assuming it is known
    $idRol = 1; // Example value
    
    // Execute the statement for 'usuarios' table
    if ($stmt_usuarios->execute()) {
        // Get the ID of the last inserted row
        $id_usuario = mysqli_insert_id($conn);
        
        // Prepare the SQL statement to insert into 'estilistas' table
        $sql_estilistas = "INSERT INTO estilistas (Id_Usuarios) VALUES (?)";
        
        // Bind parameters and execute the statement for 'estilistas' table
        $stmt_estilistas = $conn->prepare($sql_estilistas);
        $stmt_estilistas->bind_param("i", $id_usuario);
        if ($stmt_estilistas->execute()) {
            // Redirect to estilistas.php along with the ID of the newly inserted user
            // header("Location: estilistas.php?id_usuario=$id_usuario");
            header("location:../../controllers/admin/admin_views.php?vista=usuariosE");
            
            exit();
        } else {
            echo "Error al agregar el estilista a la tabla 'estilistas': " . $conn->error;
        }
        
        // Close the statement for 'estilistas' table
        $stmt_estilistas->close();
    } else {
        echo "Error al agregar el estilista a la tabla 'usuarios': " . $conn->error;
    }

    // Close the statement for 'usuarios' table
    $stmt_usuarios->close();
}

$conn->close();
?>

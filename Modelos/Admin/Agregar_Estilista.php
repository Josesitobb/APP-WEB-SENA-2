<?php
require("../../controllers/db.php");
    //SE RECIVEN LOS DATOS POR METODO POST Y SE ALAMACENAN  EN UNAS VARIABLES
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombreEstilista"];
    $apellido = $_POST["apellidoEstilista"];
    $correo = $_POST["correoEstilista"];
    $telefono = $_POST["telefonoEstilista"];
    $contraseña = $_POST["contraseñaEstilista"];

    // PREPARA LA CONSULTA PARA LA BASE DE DATOS Y PONEN LA CADENA DE MARCAION "?" PARA EVITAR ATAQUES A LA BASE DE DATOS
    $sql_usuarios = "INSERT INTO usuarios (Nombre_Usuarios, Apellido_Usuarios, Correo_Usuarios, Telefono_Usuarios, Contraseña_Usuarios, Id_Rol) 
            VALUES (?, ?, ?, ?, ?, ?)";
    // SE PREPARA LA COSULTA   
    $stmt_usuarios = $conn->prepare($sql_usuarios);
    // SE PARA LOS PARAMETROS O LAS POSICIONES
    $stmt_usuarios->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $contraseña, $idRol);
    
    // SE DEFINE EL ROL QUE VA A TENER EL USUARIO
    $idRol = 1; 

    // SE EJECUTA LA CONSULTA 
    // Y SI SE EJECUTA VA A INSERTALO EN LA TABLA ESTILISTAS TAMBIEN
    if ($stmt_usuarios->execute()) {
        // SE EXTRAE LA ULTIMA ID INSERTADA EN USUARIOS
        $id_usuario = mysqli_insert_id($conn);
        
        // SE PREPARA LA CONSULTA CON MARCADORES
        $sql_estilistas = "INSERT INTO estilistas (Id_Usuarios) VALUES (?)";
        
        // SE PREAPRA LA CONSULTA
        $stmt_estilistas = $conn->prepare($sql_estilistas);
        // SE LE INDICA EL TIPO DE DATOS Y POSICION 
        $stmt_estilistas->bind_param("i", $id_usuario);
        // SE EJECUTA LA CONSULTA Y SI TODO ESTA BIEN SE REDIRECCIONA A LA PAGINA PRINCIAP  
        if ($stmt_estilistas->execute()) {
            // Redirect to estilistas.php along with the ID of the newly inserted user
            // header("Location: estilistas.php?id_usuario=$id_usuario");
            header("location:../../controllers/admin/admin_views.php?vista=usuariosE");
            
            exit();
        } else {
            echo "Error al agregar el estilista a la tabla 'estilistas': " . $conn->error;
        }
        // CIERRA LA CONSULTA
        $stmt_estilistas->close();
    } else {
        echo "Error al agregar el estilista a la tabla 'usuarios': " . $conn->error;
    }

    // CIERRA LA CONSULTA
    $stmt_usuarios->close();
}

// CIERRA AL CONEXION
$conn->close();
?>

<?php
include('../../controllers/db.php');
// SE RECIBE LOS PARAMETRO DE LA SOLICITUD AJAX POR EL METODO POST
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';


// ANTES DE HACER AL INSERCION HACE UN CONSULTA SQL PARA VERIFICAR TODOS LOS CORRES
$sql_check_correo = "SELECT * FROM usuarios WHERE Correo_Usuarios = '$correo'";
// GUARDAR EL CORREO ES LA VARIBLE $result_correo 
$result_correo = $conn->query($sql_check_correo);


// ANTES DE HACER LA INSERCION HACE UAN CONSULTA SQL PARA VERIFICA TODOS LOS TELEFONOS
$sql_check_telefono = "SELECT * FROM usuarios WHERE Telefono_Usuarios = '$telefono'";
// GUARDAR EL TELEFONO  ES LA VARIBLE $result_telefono
$result_telefono = $conn->query($sql_check_telefono);


// SI EL NUMERO DE FILAS ES MAYOR A 1 SIGNIFICA QUE HAY UN CORREO IGUAL Y LE VA A MONSTAR UN MENSAJE
if ($result_correo->num_rows > 0) {
    echo "El correo electrónico ya está registrado";
} elseif ($result_telefono->num_rows > 0) {
    // SI EL NUMERO DE FILAS ES MAYOR A 1 SIGNIFICA QUE HAY UN TELEFONO IGUAL Y LE VA A MONSTAR UN MENSAJE
    echo "El número de teléfono ya está registrado";
} else {
    // SI NO SE ENCONTRO UN NUMERO REPETIDO O UN CORREO PREPARA LA CONSULTA CON LOS VALORES PARA INSERTARCE EN LA BASE DE DATOS
    $sql_insert_usuario = "INSERT INTO usuarios (Nombre_Usuarios, Apellido_Usuarios, Correo_Usuarios, Telefono_Usuarios, Contraseña_Usuarios, Id_Rol) 
                            VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$contraseña', 2)";
    //  ESTO MANDA EL QUERY PARA QUE HAGA LA INSERCION A LA BASE DE DATOS Y LE INDICAMOS QUE SI ES TRUE OBTENGA LA ULTIMA ID QUE SE HAYA INSERTADO
    if ($conn->query($sql_insert_usuario) === TRUE) {
        // CON LA PROPIEDAD $last_id HACEMOS QUE LA ULTIMA ID SE ALMACENE EN LA VARIABLE insert_id
        $last_id = $conn->insert_id;

        // AHORA LO QUE HACE ES PREPARA LA CONSULTA PARA INSERTA  A LA BASE DE DATOS
        $sql_insert_cliente = "INSERT INTO clientes (Id_Usuarios) 
                                VALUES ('$last_id')";
        // AHORA MANDAMOS EL QUERY Y SI ES TRUE LA INSERCION A LA BASE DE DATOS 
        if ($conn->query($sql_insert_cliente) === TRUE) {
            // MANDA UN MENSAJE SI TODO ESTA CORRECTO
            echo "Cliente agregado correctamente";
        } else {
            // MANDA UN ERROR SI EL CLIENTE NO SE AGREGO CORRECTAMENTE
            echo "Error al agregar el cliente: " . $conn->error;
        }
    } else {
        // MANDA UN ERROR SI EL USUARIO NO SE AGREGO CORRECTAMENTE
        echo "Error al agregar el usuario: " . $conn->error;
    }
}

$conn->close();
?>

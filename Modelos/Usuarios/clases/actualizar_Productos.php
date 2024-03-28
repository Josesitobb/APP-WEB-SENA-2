<?php

require("../config/config.php");
require("../config/db.php");



$datos = array(); // Inicializa el array de datos

if(isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['Id_Productos']) ? $_POST['Id_Productos'] : 0;

    if($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $Respuesta = agregar($id, $cantidad);

        if($Respuesta > 0) {
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }

        $datos['sub'] = MONEDA . number_format($Respuesta, 2, '.', ',');
    } else if($action == 'eliminar' ){

    }
    else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);

function agregar($id, $cantidad) {
    $res = 0;

    if($id > 0 && $cantidad > 0) {
        // Verifica si la sesión y la clave 'carrito' existen
        if(isset($_SESSION['carrito']['productos'])) {
            // Verifica si el producto ya está en el carrito
            if(isset($_SESSION['carrito']['productos'][$id])) {
                $_SESSION['carrito']['productos'][$id] = $cantidad;

                $db = new db();
                $conn = $db->conectar();
                
                $sql = $conn->prepare("SELECT `Precio_Productos` FROM `productos` WHERE `Id_Productos` = ?");
                $sql->execute([$id]);
                $row = $sql->fetch(PDO::FETCH_ASSOC);

                if($row) {
                    $Precio_Producto = $row['Precio_Productos'];
                    $Res = $cantidad * $Precio_Producto;
                    return $Res;
                }
            }
        }
    }

    return $res;
}

?>

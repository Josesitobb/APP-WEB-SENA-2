<?php
require("../config/config.php");

if(isset($_POST['Id_Productos'])){
    $id = $_POST['Id_Productos'];
    $token = $_POST['token'];
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {
        if(isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] += 1;
        } else {
            $_SESSION['carrito']['productos'][$id] = 1;
        }

        // Calcular la cantidad total en el carrito
        $totalProductos = array_sum($_SESSION['carrito']['productos']);

        $datos['numero'] = $totalProductos;
        $datos['ok'] = true;
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);
?>

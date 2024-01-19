<?php

define("KEY_TOKEN","SGC.itas-365*");
define("MONEDA","$");
session_start();
$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    foreach ($_SESSION['carrito']['productos'] as $id => $cantidad) {
        $num_cart += $cantidad;
    }
}



?>
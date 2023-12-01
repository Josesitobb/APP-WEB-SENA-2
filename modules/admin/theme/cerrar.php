<?php


session_start();
$varsesion=$_SESSION['username'];

if($varsesion == null || $varsesion=''){
    echo 'USTED INICIE SESION';
    die();
}

session_destroy();

 
header("location:../../../index.html");

?> 



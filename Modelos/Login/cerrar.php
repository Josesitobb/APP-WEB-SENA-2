<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$varsesion=$_SESSION['username'];

if($varsesion == null || $varsesion=''){
    echo 'USTED INICIE SESION';
    die();
}

session_destroy();

 
header("location:../../../index.html");

?> 



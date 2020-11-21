<?php

$ser= 'us-cdbr-east-02.cleardb.com';
$userna= 'b292f44398bfc1';
$pass='b9135424';
$database= 'heroku_3cce715d536db0f';

$conexion = mysqli_connect($ser,$userna,$pass,$database);
mysqli_set_charset($conexion,'utf8');
date_default_timezone_set('America/São_Paulo');
if( $conexion->connect_error )
{
	die('Error de conexion'. $conexion->connect_error);
}


?>

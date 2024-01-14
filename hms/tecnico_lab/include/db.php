<?php

$host = "localhost";
$user = "geoflrkf_geoffreey";
$password = "$%C4l1Torre5";
$database = "geoflrkf_hms";


$conexion = mysqli_connect($host, $user, $password, $database);
if(!$conexion){
echo "No se realizo la conexion a la basa de datos, el error fue:".
mysqli_connect_error() ;


}

?>
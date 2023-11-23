<?php
define('DB_SERVER','localhost');
define('DB_USER','geoflrkf_geoffreey');
define('DB_PASS' ,'$%C4l1Torre5');
define('DB_NAME', 'geoflrkf_hms');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php
if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'geoflrkf_hms');
}

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$con) {
    die("❌ Error de conexión: " . mysqli_connect_error());
} //else {
    //echo "✅ Conexión a la base de datos establecida.<br>";
//}
?>
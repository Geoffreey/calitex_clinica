<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la sesión ya está iniciada antes de llamarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("config.php"); // Asegurar la conexión a la BD

function check_login()
{
    if (!isset($_SESSION['dlogin'])) { 
        die("⚠️ Error: El doctor no ha iniciado sesión.");
    }

    if (!isset($GLOBALS['con'])) {
        die("❌ Error: La conexión a la base de datos no está definida.");
    }

    $con = $GLOBALS['con']; // Asegurar que `$con` esté accesible
    $email = $_SESSION['dlogin'];

    //echo "🔍 Buscando doctor con username: " . $email . "<br>";

    $query = mysqli_query($con, "SELECT uid FROM doctorslog WHERE username='$email' ORDER BY uid DESC LIMIT 1");

    if (!$query) {
       // die("❌ Error en la consulta SQL: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($query);
    if ($row) {
        $_SESSION['doctor_id'] = $row['uid']; // Guardar `uid` como `doctor_id`
        //echo "✅ Doctor ID recuperado de `doctorslog`: " . $_SESSION['doctor_id'] . "<br>";
    } //else {
        //die("❌ No se encontró un doctor con este username en `doctorslog`.");
    //}
}
?>
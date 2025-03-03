<?php
session_start();
include("config.php"); // Conexión a la BD

function check_login() {
    if (!isset($_SESSION['dlogin'])) { 
        die("⚠️ Error: El doctor no ha iniciado sesión.");
    }

    // Verificar si ya tenemos el `doctor_id` en la sesión
    if (!isset($_SESSION['doctor_id'])) {
        $email = $_SESSION['dlogin'];  
        
        // Depuración: Verificar que el email existe en la sesión
        echo "🔍 Buscando doctor con email: " . $email . "<br>";

        $query = mysqli_query($con, "SELECT uid FROM doctorslog WHERE email='$email' ORDER BY id DESC LIMIT 1");
        if ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['doctor_id'] = $row['uid']; // Guardar `uid` como `doctor_id`
            echo "✅ Doctor ID recuperado de `doctorslog`: " . $_SESSION['doctor_id'] . "<br>";
        } else {
            die("❌ No se encontró un doctor con este email en `doctorslog`.");
        }
    }
}
?>
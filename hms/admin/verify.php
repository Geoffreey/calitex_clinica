<?php
include 'include/config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token existe
    $sql = "SELECT * FROM doctors WHERE token='$token' AND status=0";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Activar la cuenta
        $update = "UPDATE doctors SET status=1, token=NULL WHERE token='$token'";
        if (mysqli_query($con, $update)) {
            echo "<script>alert('✅ Cuenta activada con éxito. Ahora puedes iniciar sesión.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('⛔ Error al activar la cuenta.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('⛔ Token inválido o cuenta ya activada.'); window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('⛔ No se recibió ningún token.'); window.location.href = 'index.php';</script>";
}
?>
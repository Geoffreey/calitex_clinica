<?php
include 'include/config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM doctors WHERE token='$token' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql_update = "UPDATE doctors SET status=1, token=NULL WHERE token='$token'";
        mysqli_query($con, $sql_update);
        echo "<script>alert('✅ Cuenta activada correctamente. Ahora puedes iniciar sesión.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('⛔ Token inválido o cuenta ya activada.'); window.location.href='index.php';</script>";
    }
}
?>
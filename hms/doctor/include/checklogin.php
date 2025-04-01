<?php session_start();
include 'include/config.php';

if (isset($_POST['login'])) {
    $email = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM doctors WHERE docEmail='$email' AND password='$password' AND status=1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['dlogin'] = $email;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('⛔ Cuenta no activada o credenciales incorrectas. Revisa tu correo.');</script>";
    }
}
?>
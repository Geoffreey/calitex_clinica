<?php 
session_start();
include 'include/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function check_login() {
    global $con;

    if (!isset($_SESSION['dlogin'])) {
        header("Location: index.php");
        exit();
    }

    $email = $_SESSION['dlogin'];
    $query = mysqli_query($con, "SELECT status FROM doctors WHERE docEmail='$email'");
    $row = mysqli_fetch_array($query);

    if ($row['status'] != 1) {
        session_destroy();
        echo "<script>alert('⛔ Tu cuenta no está activada. Verifica tu correo.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM doctors WHERE docEmail='$email' AND password='$password' AND status=1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['dlogin'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('⛔ Cuenta no activada o credenciales incorrectas. Revisa tu correo.');</script>";
    }
}
?>
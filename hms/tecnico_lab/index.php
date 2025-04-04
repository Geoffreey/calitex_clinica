<?php
session_start();
include("include/config.php");
error_reporting(0);
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM tecnico_lab WHERE labEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";
$_SESSION['teclogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into lablog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['teclogin']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$host  = $_SERVER['HTTP_HOST'];
$_SESSION['teclogin']=$_POST['username'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into lablog(username,userip,status) values('".$_SESSION['teclogin']."','$uip','$status')");
$_SESSION['errmsg']="Nombre de usuario o contraseña no válidos";
$extra="index.php";
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>


<!DOCTYPE html>
<html lang="es">
	<head>
	<meta charset="utf-8">
	    <meta name="viewport" content="">
	    <meta name="keywords" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Iniciar sesion laboratorio</title>
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<!--<link rel="stylesheet" href="assets/css/plugins.css">-->
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
	<div class="main-login">
  <div class="logo">
    <a href="../../index.php">
      <h2>CaliTex | Acceso Laboratorio</h2>
    </a>
  </div>

  <div class="box-login">
    <form class="form-login" method="post">
      <fieldset>
        <legend>Inicia sesión</legend>
        <p>Por favor ingresa tu correo y contraseña.</p>
        <span style="color:red;">
          <?php echo $_SESSION['errmsg']; $_SESSION['errmsg'] = ""; ?>
        </span>

        <div class="form-group">
          <span class="input-icon">
            <input type="text" name="username" class="form-control" placeholder="Correo electrónico">
            <i class="fa fa-user"></i>
          </span>
        </div>

        <div class="form-group">
          <span class="input-icon">
            <input type="password" name="password" class="form-control password" placeholder="Contraseña">
            <i class="fa fa-lock"></i>
          </span>
          <a href="forgot-password.php">¿Olvidaste tu contraseña?</a>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary" name="submit">
            Acceso <i class="fa fa-arrow-circle-right"></i>
          </button>
        </div>
      </fieldset>
    </form>

    <div class="copyright">
      &copy; <span class="current-year"></span> <strong>geoffdeep</strong>. Todos los derechos reservados.
    </div>
  </div>
</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>
<?php
// Ruta al archivo de cache
$cacheFile = 'ip_cache.json';

// Obtener la IP real del usuario (considerando proxies)
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // Si hay múltiples IPs, tomamos la primera válida
    $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $userIp = trim($ipList[0]);
} else {
    $userIp = $_SERVER['REMOTE_ADDR'];
}

// Validar que la IP es una dirección IPv4 o IPv6 válida
if (!filter_var($userIp, FILTER_VALIDATE_IP)) {
    error_log("IP inválida detectada: $userIp");
    header("HTTP/1.1 503 Service Unavailable");
    die("<h1>503 Servicio No Disponible</h1><p>El sitio está temporalmente fuera de servicio.</p>");
}

// Solo permitir acceso desde Guatemala
$allowedCountry = 'GT';

// Cargar el cache si existe
$cache = file_exists($cacheFile) ? json_decode(file_get_contents($cacheFile), true) : [];

// Verificar si la IP ya está en el cache
if (isset($cache[$userIp])) {
    $userCountry = $cache[$userIp];
} else {
    // Consultar la API de geolocalización
    $apiUrl = "https://ipwho.is/{$userIp}";
    $response = @file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Depuración: Verificar qué devuelve la API
    error_log("API Response for IP $userIp: " . print_r($data, true));

    // Verificar si la API respondió correctamente
    if (!empty($data['country_code']) && $data['success'] === true) {
        $userCountry = strtoupper($data['country_code']); // Convertir a mayúsculas
        $cache[$userIp] = $userCountry;

        // Guardar en el cache
        file_put_contents($cacheFile, json_encode($cache, JSON_PRETTY_PRINT));
    } else {
        // Si la API falla, bloquear el acceso mostrando error
        error_log("Error al obtener el país para la IP: $userIp - Mensaje API: " . ($data['message'] ?? 'Desconocido'));
        header("HTTP/1.1 503 Service Unavailable");
        die("<h1>503 Servicio No Disponible</h1><p>El sitio está temporalmente fuera de servicio.</p>");
    }
}

// **Depuración: Ver qué país se detectó**
error_log("IP: $userIp - País Detectado: $userCountry");

// **Si el país no es Guatemala, bloquear acceso**
if ($userCountry !== $allowedCountry) {
    header("HTTP/1.1 503 Service Unavailable");
    die("<h1>503 Servicio No Disponible</h1><p>El sitio está temporalmente fuera de servicio.</p>");
}

// Si el país es Guatemala, permitir el acceso
//echo '¡Bienvenido desde Guatemala!';
///////////////////////////////////////////////////////////////////////////////////////////////////

session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='".$_POST['username']."' and password='".$_POST['password']."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Nombre de usuario o contraseña no válidos";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Inicio de sesion de admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
	<div class="main-login">
  <div class="logo">
    <h2>Inicio de Sesión de Administrador</h2>
  </div>

  <div class="box-login">
    <form class="form-login" method="post">
      <fieldset>
        <legend>Inicia sesión</legend>
        <p>Por favor ingresa tu usuario y contraseña.</p>
        <span style="color:red;">
          <?php echo htmlentities($_SESSION['errmsg']); $_SESSION['errmsg'] = ""; ?>
        </span>

        <div class="form-group">
          <span class="input-icon">
            <input type="text" name="username" class="form-control" placeholder="Usuario">
            <i class="fa fa-user"></i>
          </span>
        </div>

        <div class="form-group">
          <span class="input-icon">
            <input type="password" name="password" class="form-control password" placeholder="Contraseña">
            <i class="fa fa-lock"></i>
          </span>
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
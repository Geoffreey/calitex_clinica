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
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hospital General RP</title>
		<!--<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />-->
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="images/favicon.png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="css/normalize.css">
		<!--<link rel="stylesheet" href="css/responsiveslides.css">-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<!--<script src="js/responsiveslides.min.js"></script>-->
		<script src="https://kit.fontawesome.com/45f2bb29fa.js" crossorigin="anonymous"></script>
		  <!--<script>
		    // You can also use "$(window).load(function() {"
			    //$(function () {
			
			      // Slideshow 1
			      //$("#slider1").responsiveSlides({
			        //maxwidth: 1600,
			        //speed: 600
			      //});
			//});
		  </script>-->
</head>
	<body>
		<!--start-wrap-->
		<!--start-header-->
		<header>
			<div class="container">
					    <a href="index.php" style="font-size: 30px; color: white;">Hospital General RP</a>
				    <nav>
						 <a href="index.php">Inicio</a>
						 <a href="#nosotros">Nosotros</a>
						 <a href="#servicios">Servicios</a>
						 <a href="#contactenos">Contacto</a>
						 <a href="hms/user-login.php">Portal pacientes</a>					
				    </nav>
					<a href="#" class="hamb"><i class="fa-solid fa-bars"></i></a>
			</div>
		</header>
		<main>
			<section id="inicio">
				<img src="images/hospital.jpg" alt="">
				<div class="bloque-inicio">
				  <h1>Cuando los segundos cuentan..</h1>
				  <p>Hospital RP siempre a tu lado.</p>
				  <a href="#nosotros"  class="boton boton-blanco">Ver más</a>
			    </div>
			</section>

			<section id="nosotros" class="seccion">
			    <div class="container">
				   <p>
					Somos el Grupo Médico de mayor crecimiento y expansión en Guatemala gracias a que hemos sabido empatizar con nuestros pacientes. 
					Entendemos que los segundos cuentan cuando tu familia necesita a un especialista de Alto Nivel e instalaciones de gran tecnología, pero sobre todo de calidez humana. 
					Hemos instalado un Hospital de manera estratégica para estar siempre al alcance de ti y tu familia.
			        </p>
			    </div>
		    </section>

			<section id="servicios" class="seccion">
				<div class="container">
					<div class="row">
						<!--<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/grid-img3.jpg">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Inicio de sesion pacientes</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Haga click aqui</a>
								</div>
							</div>
						</div>-->
						<!--<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
							   <div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/grid-img1.png">
								</div>
								<div class="bloque-contenido-servicio">
									 <h3>Inicio de sesion medicos</h3>
									 <a href="hms/doctor/" class="boton boton-blanco">Haga click aqui</a>
								</div>
							</div>
						</div>-->
						<!--<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/grid-img2.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Inicio de sesion adminstrador</h3>
									<a href="hms/admin" class="boton boton-blanco">Haga click aqui</a>
								</div>
							</div>
						</div>-->
						<!--Iniicio servicio Coex-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/coex.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Consulta externa</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>
                    <!--Iniicio servicio ginocologia-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/ginecologia.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Ginecologia</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>
                     <!--Iniicio servicio pediatria-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/pediatria.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Pediatria</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio otorrino-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/otorrino.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Otorrinolaringologia</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio cardiologia-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/cardio.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Cardiologia</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio otorrino-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/Odontologia.jpg">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Odontologia</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio Psicologia-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/psicologia.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Psicologia</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio laboratorio-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/laboratorio.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>Laboratorio</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

						<!--Iniicio servicio Rayos X-->
						<div class="columna columna-33 columna-mobile-100">
							<div class="bloque-servicio">
								<div class="bloque-img-servicio cuadrado-perfecto">
									<img src="images/Labrrayosx.png">
								</div>
								<div class="bloque-contenido-servicio">
									<h3>RayosX</h3>
									<a href="hms/user-login.php" class="boton boton-blanco">Agendar cita</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>
			<section id="contactenos" class="seccion">
				<iframe width="523" height="403" frameborder="0" src="https://maps.google.com/maps?width=523&amp;height=403&amp;hl=en&amp;q=6%20avenida%205-84%20zona%201%20Chimaltenango+(guatemala)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
			  <div class="container-fluid" >
			      <div class="row">
					  <div class="columna columna-41 columna-mobile-100 empujar-58 empujar-mobile-0 sinpadding-mobile">
						  <form action="index.php" method="post">
							   <div class="form-block">
								   <input type="text" name="nombre" class="form-control" placeholder="Nombre">
							    </div>
							    <div class="form-block">
								     <input type="email" name="email" class="form-control" placeholder="usuario@gmail.com">
							    </div>
							    <div class="form-block">
								   <textarea name="mensaje" placeholder="Mensaje"></textarea>
							    </div>
							    <div class="form-block bloque-ultimo">
								    <input type="submit" class="boton boton-negro" value="enviar">
							    </div>
							  <?php

                                // Verifica si el formulario ha sido enviado

                                if(isset($_POST['email'])) {


                               // Cambia las próximas dos líneas con tu dirección de email y el asunto del email

                              $email_to = "info@geoffdeep.pw";

                              $email_subject = "Contacto desde el sitio web";


                              // Validación de los campos del formulario. En caso de que alguno de los campos no exista, retorna un error.

                              if(!isset($_POST['nombre']) ||

                              !isset($_POST['email']) ||

                              !isset($_POST['mensaje'])) {


                              echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";

                              echo "Por favor, vuelva atrás y verifique la información ingresada<br />";

                              die();

                              }


                             // Construcción del mensaje del email

                             $email_message = "Detalles del formulario de contacto:\n\n";

                             $email_message .= "Nombre: " . $_POST['nombre'] . "\n";

                             $email_message .= "E-mail: " . $_POST['email'] . "\n";

                             $email_message .= "mensaje: " . $_POST['mensaje'] . "\n\n";


                             // Creación de las cabeceras del email

                             $headers = 'From: '.$email_from."\r\n".

                             'Reply-To: '.$email_from."\r\n" .

                             'X-Mailer: PHP/' . phpversion();


                             // Envío del email

                            @mail($email_to, $email_subject, $email_message, $headers);


                            // Mensaje de confirmación al usuario

                            echo "¡El formulario se ha enviado con éxito!";

                           }

                          ?>
						</form>
					</div>
				</div>
			</div>
			</section>
	    </main>
		<footer class="barra-footer">
				 &copy; Derechos Reservados -2023
		</footer>
		<script src="js/jquery.js"></script>
	    <script src="js/funciones.js"></script>
	</body>
</html>


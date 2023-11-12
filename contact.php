
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
	    <header>
			<div class="container">
				 <a href="index.html" style="font-size: 30px; color: white;">Hospital General RP</a>
				    <nav>
						 <a href="index.html">Inicio</a>
						 <a href="contact.php">Contacto</a>					
				    </nav>
					<a href="#" class="hamb"><i class="fa-solid fa-bars"></i></a>
			</div>
		</header>
		
		<main>
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
		<div class="container">
			<div class="row">
				<div class="columna columna-25 columna-mobile-100">
				    <a href="index.html" style="font-size: 30px; color: white;" class="logo-footer">Hospital General RP</a>
				</div>
			    <div class="columna columna-25 columna-mobile-100">
					<h3>
						Datos de contacto
					</h3>
					<ul>
						<li><i class="fa-solid fa-envelope fa-lg" style="color: white;"></i> info@geoffdeep.pw</li>

						<li><i class="fa-solid fa-phone fa-lg" style="color: white;"></i> (+502)48410140</li>

						<li><i class="fa-solid fa-location-dot fa-lg" style="color: white;"></i> Chimaltenango, Guatemala</li>
					</ul>
				</div>

				<div class="columna columna-25 columna-mobile-100">
					<h3>
						Redes sociales
					</h3>
					<ul class="redes">
						<li>
							<a href="https://www.facebook.com/geoffdeep64/">
								<i class="fa-brands fa-facebook fa-xl"></i>
							</a>
						</li>
						<li>
							<a href="https://wa.link/xj16ys">
							<i class="fa-brands fa-square-whatsapp fa-xl" style="color: #f7f7f7;"></i>
							</a>
						</li>
						<!--<li>
							<a href="#">
								<i class="fa-brands fa-square-instagram fa-xl"></i>
							</a>
						</li>-->
					</ul>
				</div>
			</div>
		</div>
	    <div class="barra-footer">&copy; 
			Derechos Reservados -2023
        </div>
	</footer>
	<script src="js/jquery.js"></script>
	<script src="js/funciones.js"></script>
</body>
</html>


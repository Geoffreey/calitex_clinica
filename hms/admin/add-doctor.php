<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_POST['submit'])) {
    $docspecialization = $_POST['Doctorspecialization'];
    $docname           = $_POST['docname'];
    $ncolegiado        = $_POST['ncolegiado'];
    $ndpi              = $_POST['ndpi'];
    $docaddress        = $_POST['clinicaddress'];
    $docfees           = $_POST['docfees'];
    $doccontactno      = $_POST['doccontact'];
    $docemail          = $_POST['docemail'];
    $password          = md5($_POST['npass']);
    $token             = bin2hex(random_bytes(50)); // Generar token único

    $sql = "INSERT INTO doctors (specilization, doctorName, ncolegiado, ndpi, address, docFees, contactno, docEmail, password, status, token) 
            VALUES ('$docspecialization', '$docname', '$ncolegiado', '$ndpi', '$docaddress', '$docfees', '$doccontactno', '$docemail', '$password', 0, '$token')";

    if (mysqli_query($con, $sql)) {
        $subject = "Confirma tu cuenta";
        $message = "Hola $docname, haz clic en el siguiente enlace para activar tu cuenta: \n\n";
        $message .= "http://hptl.geoffdevops.com/hms/doctor/verify.php?token=$token";
        $headers = "From: no-reply@geoffdevops.com";

        mail($docemail, $subject, $message, $headers);

        echo "<script>alert('✅ Registro exitoso. Se envio correo al medico para verificacion de cuenta.');</script>";
    } else {
        echo "<script>alert('⛔ Error al agregar el médico: " . mysqli_error($con) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Admin | Aggregar medico</title>

		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/add-patient.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script type="text/javascript">
            function valid()
              {
              if(document.adddoc.npass.value!= document.adddoc.cfpass.value)
              {
              alert("La contraseña y el campo Confirmar contraseña no coinciden  !!");
              document.adddoc.cfpass.focus();
              return false;
              }
              return true;
            }
        </script>
        <script>
          function checkemailAvailability() {
             $("#loaderIcon").show();
             jQuery.ajax({
             url: "check_availability.php",
             data:'emailid='+$("#docemail").val(),
             type: "POST",
             success:function(data){
             $("#email-availability-status").html(data);
             $("#loaderIcon").hide();
             },
             error:function (){}
             });
            }
       </script>
	</head>
	<body>
		<div id="app">
           <?php include 'include/sidebar.php';?>
			<div class="app-content">
				<?php include 'include/header.php';?>
                <!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Agregar medico</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Agregar medico</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white card">
												<div class="panel-heading">
													<h5 class="panel-title">Agregar medico</h5>
												</div>
												<div class="panel-body card-body">
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="row col-md-6 mb-3">
															<label for="DoctorSpecialization">
																Especializaicon medica
															</label>
							                                <select name="Doctorspecialization" class="form-control" required="true">
																<option value="">Seleccionar especialización</option>
                                                                <?php $ret = mysqli_query($con, "select * from doctorspecilization");
                                                                  while ($row = mysqli_fetch_array($ret)) {
                                                                ?>
																<option value="<?php echo htmlentities($row['specilization']); ?>">
																	<?php echo htmlentities($row['specilization']); ?>
																</option>
																<?php }?>
															</select>
														</div>
                                                        <div class="row col-md-6 mb-3">
															<label for="doctorname">Nombre medico</label>
					                                        <input type="text" name="docname" class="form-control"  placeholder="Nombre y apellidos" required="true">
														</div>
														<div class="row col-md-6 mb-3">
															<label for="ncolegiado">No. Colegiado</label>
															<input type="number" name="ncolegiado" class="form-control" placeholder="ingrese colegiado activo" required="ture">
														</div>
														<div class="row col-md-6 mb-3">
															<label for="ndpi">DPI</label>
															<input type="text" name="ndpi" class="form-control" pattern="\d{13}" maxlength="13" placeholder="Ingrese DPI" required="true">
														</div>
                                                        <div class="row col-md-6 mb-3">
															<label for="fess">Honorarios de consulta</label>
					                                        <input type="text" name="docfees" class="form-control"  placeholder="Honorarios" required="true">
														</div>
														<div class="row col-md-6 mb-3">
									                       <label for="fess">Telefono</label>
					                                       <input type="tel" name="doccontact" class="form-control"  placeholder="Telefono" required="true">
														</div>
														<div class="row col-md-6 mb-3">
									                       <label for="fess">Email</label>
                                                           <input type="email" id="docemail" name="docemail" class="form-control"  placeholder="Correo electronico" required="true" onBlur="checkemailAvailability()">
                                                           <span id="email-availability-status"></span>
                                                        </div>
														<div class="row col-md-6 mb-3">
															<label for="exampleInputPassword1">Contraseña</label>
					                                        <input type="password" name="npass" class="form-control"  placeholder="Nueva contraseña" required="required">
														</div>
														<div class="row col-md-6 mb-3">
															<label for="exampleInputPassword2">Conformar contraseña</label>
									                        <input type="password" name="cfpass" class="form-control"  placeholder="Confirmar contraseña" required="required">
														</div>
														<div class="row col-md-6 mb-3">
															<label for="address">Direccion</label>
					                                        <textarea name="clinicaddress" class="form-control"  placeholder="Domicilio" required="true"></textarea>
														</div>
														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
															Crear
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include 'include/footer.php';?>
			<?php include 'include/setting.php';?>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

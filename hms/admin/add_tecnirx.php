<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_POST['submit'])) {
    $tecnicoName           = $_POST['tecnicoName'];
    $address        = $_POST['address'];
    $contactno      = $_POST['contactno'];
    $labemail          = $_POST['labEmail'];
    $password          = md5($_POST['npass']);
    $sql               = mysqli_query($con, "INSERT INTO tecnico_rx(tecnicoName,address,contactno,labEmail,password) values('$tecnicoName','$address','$contactno','$labemail','$password')");
    if ($sql) {
        echo "<script>alert('Se guardo con exito');</script>";
        echo "<script>window.location.href ='manage-rayosx.php'</script>";

    }
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Admin | Agregar Tecnico Rayos X</title>

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
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
<script type="text/javascript">
function valid()
{
 if(document.addtecrx.npass.value!= document.addtecrx.cfpass.value)
{
alert("Los campos Contraseña y Confirmar contraseña no coinciden!!");
document.addtecrx.cfpass.focus();
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
data:'emailid='+$("#labEmail").val(),
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
									<h1 class="mainTitle">Admin | Agregar Tecnico Rayos X</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Agregar Tecnico Rayos X</span>
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
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Agregar tecnico</h5>
												</div>
												<div class="panel-body">

													<form role="form" name="addtecrx" method="post" onSubmit="return valid();">
														<!--<div class="form-group">
															<label for="DoctorSpecialization">
																Especializaicon medica
															</label>
							                                    <select name="Doctorspecialization" class="form-control" required="true">
																     <option value="">Select Specialization</option>
                                                                         // <?php //$ret = mysqli_query($con, "select * from doctorspecilization");
                                                                             // while ($row = mysqli_fetch_array($ret)) {
                                                                                ?>
																              <option value="<?php //echo htmlentities($row['specilization']); ?>">
																	             <?php //echo htmlentities($row['specilization']); ?>
																              </option>
																              <?php //}?>

															    </select>
														</div>-->

                                                        <div class="form-group">
															<label for="tecnicoName">
																 Nombre
															</label>
					                                           <input type="text" name="tecnicoName" class="form-control"  placeholder="Nombres y Apellidos" required="true">
														</div>


                                                        <div class="form-group">
															<label for="address">
																 Direccion
															</label>
					                                        <textarea name="address" class="form-control"  placeholder="Domicilio" required="true"></textarea>
														</div>

                                                        <!--<div class="form-group">
															<label for="labfess">
																 Honorarios de consulta
															</label>
					                                        <input type="text" name="labfees" class="form-control"  placeholder="Enter Doctor Consultancy Fees" required="true">
														</div>-->

                                                        <div class="form-group">
									                        <label for="contactno">
																 Telefono
															</label>
					                                        <input type="text" name="contactno" class="form-control"  placeholder="Contacto telefonico" required="true">
														</div>

                                                        <div class="form-group">
									                        <label for="labEmail">
																 Email
															</label>
                                                            <input type="labEmail" id="labEmail" name="labEmail" class="form-control"  placeholder="Correo electronico" required="true" onBlur="checkemailAvailability()">
                                                            <span id="email-availability-status"></span>
                                                        </div>

														<div class="form-group">
															<label for="exampleInputPassword1">
																 Contraseña
															</label>
					                                        <input type="password" name="npass" class="form-control"  placeholder="Contraseña" required="required">
														</div>

                                                        <div class="form-group">
															<label for="exampleInputPassword2">
																Conformar contraseña
															</label>
									                        <input type="password" name="cfpass" class="form-control"  placeholder="Confirme contraseña" required="required">
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
									       <div class="col-lg-12 col-md-12">
											<div class="panel panel-white">


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->
					</div>
					<?php include 'include/footer.php';?>
    <?php include 'include/setting.php';?>
				</div>
			</div>
			<!-- start: FOOTER -->
			<!-- end: SETTINGS -->
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

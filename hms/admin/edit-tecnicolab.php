<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();
$did = intval($_GET['id']); // get doctor id
if (isset($_POST['submit'])) {
    $tecnicoName           = $_POST['tecnicoName'];
    $labaddress        = $_POST['address'];
    $contactno      = $_POST['contactno'];
    $labemail          = $_POST['labEmail'];
    $sql               = mysqli_query($con, "Update tecnico_lab set tecnicoName='$tecnicoName',address='$labaddress',contactno='$contactno',labEmail='$labemail' where id='$did'");
    if ($sql) {
        $msg = "Detalles del tecnico actualizados con éxito";

    }
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Admin | Editar informacion de tecnico</title>

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


	</head>
	<body>
		<div id="app">
<?php include 'include/sidebar.php';?>
			<div class="app-content">

						<?php include 'include/header.php';?>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->

				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Editar informacion de tecnico</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Editar informacion de tecnico</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 style="color: green; font-size:18px; ">
                                         <?php if ($msg) {echo htmlentities($msg);}?>
									</h5>
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Editar informacion de tecnico</h5>
												</div>
												<div class="panel-body">
									                  <?php $sql = mysqli_query($con, "select * from tecnico_lab where id='$did'"); 
                                                         while ($data = mysqli_fetch_array($sql)) {
                                                       ?>
                                                      <h4><?php echo htmlentities($data['tecnicoName']); ?>'s Profile</h4>
                                                         <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
                                                          <?php if ($data['updationDate']) {?>
                                                          <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
                                                           <?php }?>
                                                           <hr />
													<form role="form" name="addtec" method="post" onSubmit="return valid();">
														<!--<div class="form-group">
															<label for="DoctorSpecialization">
																Especializacion
															</label>
							                                <select name="Doctorspecialization" class="form-control" required="required">
					                                        <option value="<?php //echo htmlentities($data['specilization']); ?>">
					                                        <?php //echo htmlentities($data['specilization']); ?></option>
                                                            <?php //$ret = mysqli_query($con, "select * from doctorspecilization");
                                                              //while ($row = mysqli_fetch_array($ret)) {
                                                            ?>
																<option value="<?php //echo htmlentities($row['specilization']); ?>">
																	<?php //echo htmlentities($row['specilization']); ?>
																</option>
																<?php //}?>

															</select>
														</div>-->

                                                        <div class="form-group">
															<label for="tecnicoName">
																 Nombre medico
															</label>
	                                                        <input type="text" name="tecnicoName" class="form-control" value="<?php echo htmlentities($data['tecnicoName']); ?>" >
														</div>


                                                        <div class="form-group">
															<label for="address">
																 Direccion de la clinica medica
															</label>
					                                        <textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
														</div>

                                                         <div class="form-group">
									                        <label for="contactno">
																 Telefono
															</label>
					                                        <input type="text" name="contactno" class="form-control" required="required"  value="<?php echo htmlentities($data['contactno']); ?>">
														</div>

                                                        <div class="form-group">
									                        <label for="labEmail">
																 Email
															</label>
					                                        <input type="labEmail" name="labEmail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['labEmail']); ?>">
														</div>




														<?php }?>


														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Actualizar
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
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include 'include/footer.php';?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
	<?php include 'include/setting.php';?>
			<>
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

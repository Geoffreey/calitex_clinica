<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

$vid = $_GET['viewid'] ?? $_SESSION['id'];
if (!$vid) {
    die("❌ Error: No se proporcionó un ID válido en la URL.");
}

// Obtener datos del paciente
$ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE user_id='$vid'");
$patient = mysqli_fetch_assoc($ret);

// Obtener historial médico
$history = mysqli_query($con, "SELECT * FROM tblmedicalhistory WHERE PatientID='$vid'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Paciente | Historial médico</title>
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
        <?php include 'include/sidebar.php'; ?>
        <div class="app-content">
            <?php include 'include/header.php'; ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-10">
                                <h1 class="mainTitle">Paciente | Historial médico</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Paciente</span></li>
                                <li class="active"><span>Historial médico</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white" id="printIt">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15"> Paciente <span class="text-bold">Historial médico</span></h5>
                                <?php if ($patient) { ?>
                                    <table class="table table-bordered">
                                        <tr align="center"><td colspan="5" class="text-primary">Datos del paciente</td></tr>
                                        <tr><th>No. Admisión</th><td><?= $patient['PatientAdmision']; ?></td><th>Nombre</th><td><?= $patient['PatientName']; ?></td></tr>
                                        <tr><th>Fecha de nacimiento</th><td><?= $patient['FechaNac']; ?></td><th>Email</th><td><?= $patient['PatientEmail']; ?></td></tr>
                                        <tr><th>Teléfono</th><td><?= $patient['PatientContno']; ?></td><th>Dirección</th><td><?= $patient['PatientAdd']; ?></td></tr>
                                        <tr><th>Género</th><td><?= $patient['PatientGender']; ?></td><th>Edad</th><td><?= $patient['PatientAge']; ?></td></tr>
                                        <tr><th>Motivo de ingreso</th><td><?= $patient['PatientMedhis']; ?></td><th>Fecha de registro</th><td><?= $patient['CreationDate']; ?></td></tr>
                                    </table>
                                <?php } else { echo "<p class='text-danger'>❌ No se encontró el paciente.</p>"; } ?>
                                
                                <h5 class="over-title margin-top-20">Historial Médico</h5>
                                <table class="table table-bordered">
                                    <tr align="center"><th colspan="10">Historial Médico</th></tr>
                                    <tr>
                                        <th>No.</th><th>Presión Arterial</th><th>Peso</th><th>Azúcar</th><th>Temperatura</th>
                                        <th>Examen Físico</th><th>Prescripción</th><th>Órdenes Médicas</th><th>Evolución</th><th>Fecha</th>
                                    </tr>
                                    <?php $cnt = 1; while ($row = mysqli_fetch_assoc($history)) { ?>
                                        <tr>
                                            <td><?= $cnt++; ?></td>
                                            <td><?= $row['BloodPressure']; ?></td>
                                            <td><?= $row['Weight']; ?></td>
                                            <td><?= $row['BloodSugar']; ?></td>
                                            <td><?= $row['Temperature']; ?></td>
                                            <td><?= $row['ExamenFisico']; ?></td>
                                            <td><?= $row['MedicalPres']; ?></td>
                                            <td><?= $row['OrdenesMedicas']; ?></td>
                                            <td><?= $row['Evolucion']; ?></td>
                                            <td><?= $row['CreationDate']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <p align="center"><button class="btn btn-primary" onclick="printOut('printIt')">Imprimir</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- start: FOOTER -->
	<?php include 'include/footer.php';?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
	<?php include 'include/setting.php';?>

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

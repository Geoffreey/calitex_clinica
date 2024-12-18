<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();
if (isset($_POST['submit'])) {

    $vid    = $_GET['viewid'];
    $bp     = $_POST['bp'];
    $bs     = $_POST['bs'];
    $weight = $_POST['weight'];
    $temp   = $_POST['temp'];
	$exf = $_POST['exf'];
    $pres   = $_POST['pres'];
	$ord   = $_POST['ord'];
	$evo   = $_POST['evo'];
	//$lab = $_POST['lab'];
    //$rayx = $_POST['rayx'];

    $query .= mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,ExamenFisico,MedicalPres,OrdenesMedicas,Evolucion,Laboratorio,RayosX)value('$vid','$bp','$bs','$weight','$temp','$exf','$pres','$ord','$evo','$lab','$rayx')");
    if ($query) {
        echo '<script>alert("Medicle history has been added.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Usuario | Historial medico</title>

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
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-10">
<h1 class="mainTitle">Paciente | Historial medico</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Paciente</span>
</li>
<li class="active">
<span>Historial medico</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white" id="printIt">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15"> Paciente <span class="text-bold"> Historial medico</span></h5>
<?php
$vid = $_GET['viewid'];
$ret = mysqli_query($con, "select * from tblpatient where ID='$vid'");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
    ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="5" style="font-size:20px;color:blue">Datos del paciente</td></tr>

    <tr>
	   <th scope>No. Admision</th>
       <td><?php  echo $row['PatientAdmision'];?></td>
       <th scope>Nombre paciente</th>
       <td><?php echo $row['PatientName']; ?></td>
    </tr>
	<tr>
	   <th scope>Fecha de nacimiento</th>
       <td><?php  echo $row['FechaNac'];?></td>
	   <th scope>Email</th>
       <td><?php echo $row['PatientEmail']; ?></td>
	</tr>
    <tr>
       <th scope>telefono</th>
       <td><?php echo $row['PatientContno']; ?></td>
       <th>Direccion</th>
       <td><?php echo $row['PatientAdd']; ?></td>
    </tr>
    <tr>
       <th>Genero</th>
       <td><?php echo $row['PatientGender']; ?></td>
       <th>Edad</th>
       <td><?php echo $row['PatientAge']; ?></td>
    </tr>
    <tr>
       <th>Motivo de ingreso</th>
       <td><?php echo $row['PatientMedhis']; ?></td>
       <th>fecha de registro del paciente</th>
       <td><?php echo $row['CreationDate']; ?></td>
    </tr>

<?php }?>
</table>
<?php

$ret = mysqli_query($con, "select * from tblmedicalhistory  where PatientID='$vid'");

?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="13" >Historial medico</th>
  </tr>
  <tr>
    <th>No.</th>
<th>Presion arterial</th>
<th>Peso</th>
<th>Nivel de azucar</th>
<th>Temperatura corporal</th>
<th>Examen ficico</th>
<th>Preinscripsion medica</th>
<th>OrdenesMedicas</th>
<th>Evolucion</th>
<!--<th>Laboratorio</th>
<th>Rayos X</th>-->
<th>Fecha de visita</th>
</tr>
<?php
while ($row = mysqli_fetch_array($ret)) {
    ?>
<tr>
  <td><?php echo $cnt; ?></td>
 <td><?php echo $row['BloodPressure']; ?></td>
 <td><?php echo $row['Weight']; ?></td>
 <td><?php echo $row['BloodSugar']; ?></td>
  <td><?php echo $row['Temperature']; ?></td>
  <td><?php  echo $row['ExamenFisico'];?></td>
  <td><?php echo $row['MedicalPres']; ?></td>
  <td><?php echo $row['OrdenesMedicas']; ?></td>
  <td><?php echo $row['Evolucion']; ?></td>
  <!--<td></?php  echo $row['Laboratorio'];?></td>
  <td></?php  echo $row['RayosX'];?></td>-->
  <td><?php echo $row['CreationDate']; ?></td>
</tr>
<?php $cnt = $cnt + 1;}?>
</table>

</div>
</div>
</div>
<p align="center">
	<button class="btn btn-primary waves-effect waves-light w-lg" onClick="printOut('printIt')">Imprimir</button>
  </p>
</div>
</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php //include ('include/footer.php');?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
	<?php include ('include/setting.php');?>

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
		<!-- end: JavaScript Event Handlers for this page, -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

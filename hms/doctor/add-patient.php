<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
	$docid = $_SESSION['id'];
    $patadmi = $_POST['patadmi'];
	$patname = $_POST['patname'];
    $fena = $_POST['fena'];
    $patcontact = $_POST['patcontact'];
    $patemail = $_POST['patemail'];
    $gender = $_POST['gender'];
    $pataddress = $_POST['pataddress'];
    $patage = $_POST['patage'];
    $medhis = $_POST['medhis'];
    $sql = mysqli_query($con,"insert into tblpatient(Docid,PatientAdmision,PatientName,FechaNac,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patadmi','$patname','$fena','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
    if ($sql)
    {
    echo "<script>alert('Informacion del paciente agregada correctamente');</script>";
    header('location:add-patient.php');

}
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Medico | Agregar paciente</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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

	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#patemail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
						
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-10">
<h1 class="mainTitle">Paciente | Agregar paciente</h1>
</div>
    <ol class="breadcrumb">
      <li>
         <span>Paciente</span>
      </li>
      <li class="active">
         <span>Agregar paciente</span>
      </li>
    </ol>
</div>
</section>
       <div class="container-fluid container-fullw bg-white">
          <div class="row">
            <div class="col-md-11">
                <div class="row margin-top-30">
                   <div class="col-lg-8 col-md-11">
                       <div class="panel panel-white">
                           <div class="panel-heading">
                               <h5 class="panel-title">Agregar paciente</h5>
                            </div>
                            <div class="panel-body">
                                <form role="form" name="" method="post">

                                <div class="form-group">
                                     <label for="doctorname">
                                        No. Admision
                                     </label>
                                     <input type="text" name="patadmi" class="form-control"  placeholder="No. adminision" required="true">
                                 </div>

                                 <div class="form-group">
                                     <label for="doctorname">
                                        Nombre paciente
                                     </label>
                                     <input type="text" name="patname" class="form-control"  placeholder="Enter Patient Name" required="true">
                                 </div>
                                 <div class="form-group">
                                    <label for="fess">
                                       Fecha de nacimiento
                                    </label>
                                    <input type="text" name="fena" class="form-control"  placeholder="AAA-MM-DD" required="true" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                 </div>
                                 <div class="form-group">
                                    <label for="fess">
                                       Telefono
                                    </label>
                                    <input type="text" name="patcontact" class="form-control"  placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
                                 </div>
                                 <div class="form-group">
                                    <label for="fess">
                                        Email
                                    </label>
                                    <input type="email" id="patemail" name="patemail" class="form-control"  placeholder="Enter Patient Email id"  onBlur="userAvailability()">
                                    <span id="user-availability-status1" style="font-size:12px;"></span>
                                 </div>
                                 <div class="form-group">
                                      <label class="block">
                                       Genero
                                      </label>
                                       <div class="clip-radio radio-primary">
                                          <input type="radio" id="rg-female" name="gender" value="femenino" >
                                          <label for="rg-female">
                                              Femenino
                                          </label>
                                          <input type="radio" id="rg-male" name="gender" value="masculino">
                                          <label for="rg-male">
                                             Masculino
                                          </label>
                                      </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="address">
                                       Direccion
                                     </label>
                                     <textarea name="pataddress" class="form-control"  placeholder="Enter Patient Address" required="true"></textarea>
                                 </div>
                                 <div class="form-group">
                                     <label for="fess">
                                      Edad
                                     </label>
                                     <input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
                                 </div>
                                 <div class="form-group">
                                     <label for="fess">
                                         Historial medico
                                     </label>
                                     <textarea type="text" name="medhis" class="form-control"  placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
                                 </div>	

                                 <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
                                    Agregar
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
</div>
</div>
</div>
			<!-- start: FOOTER -->
<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
<?php include('include/setting.php');?>
			
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

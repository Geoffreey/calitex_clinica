<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
    $eid = $_GET['editid'];
    $patadmi = $_POST['patadmi'];
    $patname = $_POST['patname'];
    $fena = $_POST['fena'];
    $patcontact = $_POST['patcontact'];
    $patemail = $_POST['patemail'];
    $gender = $_POST['gender'];
    $pataddress = $_POST['pataddress'];
    $patage = $_POST['patage'];
    $medhis = $_POST['medhis'];
    
    $sql = mysqli_query($con, "UPDATE tblpatient 
        SET PatientAdmision='$patadmi', PatientName='$patname', FechaNac='$fena', 
        PatientContno='$patcontact', PatientEmail='$patemail', PatientGender='$gender', 
        PatientAdd='$pataddress', PatientAge='$patage', PatientMedhis='$medhis' 
        WHERE ID='$eid'");
        
    if ($sql) {
        echo "<script>alert('Patient info updated Successfully');</script>";
        header('location:manage-patient.php');
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
</head>
<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Paciente | Agregar paciente</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Paciente</span></li>
                                <li class="active"><span>Agregar paciente</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Agregar paciente</h5>
                                    </div>
                                    <div class="panel-body">
                                        <form role="form" method="post">
                                            <?php
                                            $eid = $_GET['editid'];
                                            $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE ID='$eid'");
                                            while ($row = mysqli_fetch_array($ret)) {
                                            ?>
                                                <div class="form-group">
                                                    <label>No. Admision</label>
                                                    <input type="text" name="patadmi" class="form-control" value="<?php echo $row['PatientAdmision']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nombre Paciente</label>
                                                    <input type="text" name="patname" class="form-control" value="<?php echo $row['PatientName']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="text" name="fena" class="form-control" value="<?php echo $row['FechaNac']; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono</label>
                                                    <input type="text" name="patcontact" class="form-control" value="<?php echo $row['PatientContno']; ?>" required maxlength="10" pattern="[0-9]+">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" id="patemail" name="patemail" class="form-control" value="<?php echo $row['PatientEmail']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Género</label>
                                                    <input type="radio" name="gender" value="Female" <?php if ($row['PatientGender'] == "Female") echo "checked"; ?>> Femenino
                                                    <input type="radio" name="gender" value="Male" <?php if ($row['PatientGender'] == "Male") echo "checked"; ?>> Masculino
                                                </div>
                                                <div class="form-group">
                                                    <label>Dirección</label>
                                                    <textarea name="pataddress" class="form-control" required><?php echo $row['PatientAdd']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Edad</label>
                                                    <input type="text" name="patage" class="form-control" value="<?php echo $row['PatientAge']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Historial médico</label>
                                                    <textarea name="medhis" class="form-control" required><?php echo $row['PatientMedhis']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de creación</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['CreationDate']; ?>" readonly>
                                                </div>
                                            <?php } ?>
                                            <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('include/footer.php'); ?>
        <?php include('include/setting.php'); ?>
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

<?php
session_start();
//error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_POST['submit'])) {
    $specilization = $_POST['doctorspecialization'];
    $doctorid      = $_POST['doctor'];
    
    // Obtener el user_id correcto desde tblpatient
    $query_user = mysqli_query($con, "SELECT user_id FROM tblpatient WHERE USER_ID='".$_SESSION['id']."'");
    $row_user = mysqli_fetch_assoc($query_user);
    $userid = $row_user['user_id']; // Ahora el ID correcto

    $fees          = $_POST['fees'];
    $appdate       = $_POST['appdate'];
    $time          = $_POST['apptime'];
    $userstatus    = 1;
    $docstatus     = 1;

    $query = mysqli_query($con, "INSERT INTO appointment (doctorspecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) 
                                 VALUES ('$specilization', '$doctorid', '$userid', '$fees', '$appdate', '$time', '$userstatus', '$docstatus')");

    if ($query) {
        echo "<script>
        alert('Su cita ha sido reservada con éxito');
        window.location.href = 'book-appointment.php';
      </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Usuario | Agendar cita</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css">
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
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color">
    
    <!-- Scripts de jQuery y Bootstrap -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Scripts para obtener médicos y costos -->
    <script>
        function getdoctor(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: { specilizationid: val },
                success: function(data) {
                    $("#doctor").html(data);
                }
            });
        }

        function getfee(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: { doctor: val },
                success: function(data) {
                    $("#fees").html(data);
                }
            });
        }
    </script>
</head>

<body>
    <div id="app">
        <?php include 'include/sidebar.php'; ?>
        <div class="app-content">
            <?php include 'include/header.php'; ?>

            <!-- Contenido principal -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Usuario | Agendar cita</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Usuario</span></li>
                                <li class="active"><span>Agendar cita</span></li>
                            </ol>
                        </div>
                    </section>

                    <!-- Formulario de agendar cita -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Agendar cita</h5>
                                            </div>
                                            <div class="panel-body">
                                                <p style="color:red;">
                                                    <?php echo htmlentities($_SESSION['msg1']); ?>
                                                    <?php echo htmlentities($_SESSION['msg1'] = ""); ?>
                                                </p>
                                                <form role="form" name="book" method="post">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">Especialización médica</label>
                                                        <select name="doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required>
                                                            <option value="">Seleccionar especialización</option>
                                                            <?php
                                                            $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                                                            while ($row = mysqli_fetch_array($ret)) { ?>
                                                                <option value="<?php echo htmlentities($row['specilization']); ?>">
                                                                    <?php echo htmlentities($row['specilization']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctor">Médicos</label>
                                                        <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required>
                                                            <option value="">Seleccionar médico</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="consultancyfees">Honorarios consulta</label>
                                                        <select name="fees" class="form-control" id="fees" readonly></select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="AppointmentDate">Fecha</label>
                                                        <input class="form-control datepicker" name="appdate" required data-date-format="yyyy-mm-dd">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Appointmenttime">Hora</label>
                                                        <input class="form-control" name="apptime" id="timepicker1" required> Ej: 10:00 PM
                                                    </div>

                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Crear</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Fin row -->
                            </div>
                        </div> <!-- Fin container -->
                    </div> <!-- Fin wrap-content -->
                </div> <!-- Fin main-content -->
            </div> <!-- Fin app-content -->
        </div> <!-- Fin app -->

        <!-- Footer y ajustes -->
        <?php include 'include/footer.php'; ?>
        <?php include 'include/setting.php'; ?>

        <!-- Scripts adicionales -->
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/main.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});

			$('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
            });
		</script>
		<script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
                $('.datepicker').datepicker({ format: 'yyyy-mm-dd', startDate: '-3d' });
                $('#timepicker1').timepicker();
            });
        </script>
    </body>
</html>

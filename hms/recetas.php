<?php
session_start();
include("include/config.php"); // Asegúrate de que la ruta es correcta
include 'include/checklogin.php';
check_login();

$user_id = $_SESSION['id'] ?? null;  // Aquí cambiamos a $_SESSION['id']
$role = $_SESSION['role'] ?? 'paciente'; // Asumimos que es paciente si no está definido

if (!$user_id || $role != 'paciente') {
    die("Error: No se ha identificado correctamente el usuario. ID: " . $user_id);
}

// Obtener el ID real del paciente desde tblpatient
$queryPaciente = "SELECT id FROM tblpatient WHERE user_id = '$user_id' LIMIT 1";
$resultPaciente = mysqli_query($con, $queryPaciente);
$rowPaciente = mysqli_fetch_assoc($resultPaciente);

if (!$rowPaciente) {
    die("Error: No se encontró el paciente con el user_id: $user_id");
}

$paciente_id = $rowPaciente['id']; // Definir paciente_id antes de usarlo

// Ahora que tenemos el paciente_id correcto, hacemos la consulta de recetas
$query = "SELECT r.id, r.fecha_emision, d.doctorName AS doctor
          FROM recetas r
          JOIN doctors d ON r.doctor_id = d.id
          WHERE r.paciente_id = '$paciente_id'
          ORDER BY r.fecha_emision DESC";

$result = mysqli_query($con, $query);

// Manejar errores en la consulta
if (!$result) {
    die("Error en la consulta de recetas: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Recetas Médicas</title>
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
                                    <h1 class="mainTitle">Paciente | Recetas medicas</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Paciente</span></li>
                                    <li class="active"><span>Recetas medicas</span></li>
                                </ol>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead>
                                            <tr align="center"><th colspan="10">Lista de recetas medicas</th></tr>
                                                <th>Fecha</th>
                                                <?php if ($role == 'doctor') { echo "<th>Paciente</th>"; } else { echo "<th>Doctor</th>"; } ?>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td data-label="Fecha"><?php echo $row['fecha_emision']; ?></td>
                                                <td data-label="doctor"><?php echo ($role == 'doctor') ? $row['paciente'] : $row['doctor']; ?></td>
                                                <td data-label="Accion">
                                                    <div class="btn-group">
                                                        <a href="detalle-receta.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary" title="Ver"><i class="ti-receipt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                    
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
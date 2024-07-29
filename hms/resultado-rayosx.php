<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reg. Usuario | Ver historial Rayos X</title>

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
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Paciente | Resultados de rayos X</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Paciente</span>
                            </li>
                            <li class="active">
                                <span>Ver historial Rayos X</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="over-title margin-bottom-15"><span class="text-bold"> Historial de rayos X</span></h5>

                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                    <tr>
                                        <th class="center">No.</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Costo</th>
                                        <th>Fecha de Cita</th>
                                        <th>Resultado</th> <!-- Nueva columna -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $_SESSION['id'];
                                    // Obtener los laboratorios asociados al paciente
                                    $sql = mysqli_query($con, "SELECT l.nombre AS rxname, l.tipo AS rxtype, l.costo, a.appointmentDate, a.id AS appointmentrx_id
                                                               FROM rx_appointments a
                                                               JOIN rayosx l ON l.id = a.rxId
                                                               JOIN tblpatient p ON p.user_id = a.user_id
                                                               WHERE p.ID = (SELECT ID FROM tblpatient WHERE user_id = '$uid')");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                        // Obtener el enlace al archivo asociado con el appointment_id
                                        $file_sql = mysqli_query($con, "SELECT FilePath FROM tblfiles WHERE appointmentrx_id = '".$row['appointmentrx_id']."' LIMIT 1");
                                        $file_row = mysqli_fetch_array($file_sql);
                                        $file_url = $file_row['FilePath'] ? 'http://localhost/calitex_clinica/hms/tecnico_rx/' . $file_row['FilePath'] : '#';
                                        $file_link = $file_row['FilePath'] ? '<a href="' . $file_url . '" target="_blank">Ver Resultado</a>' : 'Sin Resultado';
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $cnt; ?>.</td>
                                            <td><?php echo $row['rxname']; ?></td>
                                            <td><?php echo $row['rxtype']; ?></td>
                                            <td><?php echo $row['costo']; ?></td>
                                            <td><?php echo $row['appointmentDate']; ?></td>
                                            <td><?php echo $file_link; ?></td> <!-- Nueva columna -->
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
    <?php include 'include/setting.php'; ?>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="vendor/autosize/autosize.min.js"></script>
<script src="vendor/selectFx/classie.js"></script>
<script src="vendor/selectFx/selectFx.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>
</body>
</html>
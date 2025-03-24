<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medico | Historial de citas</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    
    <!-- Stylesheets -->
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
        <!-- Sidebar -->
        <?php include('include/sidebar.php');?>

        <div class="app-content">
            <!-- Header -->
            <?php include('include/header.php');?>

            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- Page Title -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Medico  | Historial de citas</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Medico</span></li>
                                <li class="active"><span>Historial de citas</span></li>
                            </ol>
                        </div>
                    </section>

                    <!-- Table -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></p>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">No.</th>
                                            <th class="hidden-xs">Nombre paciente</th>
                                            <th>Especializacion</th>
                                            <th>Cuota de consulta</th>
                                            <th>Fecha/hora de la cita</th>
                                            <th>Fecha de creación de la cita</th>
                                            <th>Teléfono</th>
                                            <th>Correo Electrónico</th>
                                            <th>Dirección</th>
                                            <th>Historial Médico</th>
                                            <th>Estado actual</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT 
                                        users.id AS userId, 
                                        users.fullName AS fname, 
                                        appointment.*, 
                                        tblpatient.PatientName, 
                                        tblpatient.PatientAge, 
                                        tblpatient.PatientGender, 
                                        tblpatient.PatientContno, 
                                        tblpatient.PatientEmail, 
                                        tblpatient.PatientAdd, 
                                        tblpatient.PatientMedhis 
                                        FROM appointment 
                                        JOIN users ON users.id = appointment.userId 
                                        LEFT JOIN tblpatient ON tblpatient.user_id = users.id
                                        WHERE appointment.doctorId = '".$_SESSION['id']."'");
                                        
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                        <tr>
                                            <td datalabel="No." class="center"><?php echo $cnt; ?>.</td>
                                            <td data-label="PatientName" class="hidden-xs"><?php echo isset($row['PatientName']) ? $row['PatientName'] : '<span class="text-muted">No registrado</span>'; ?></td>
                                            <td data-label="doctorSpecialization"><?php echo $row['doctorSpecialization']; ?></td>
                                            <td data-label="consultancyFees"><?php echo $row['consultancyFees']; ?></td>
                                            <td data-label="appointmentDate"><?php echo $row['appointmentDate']; ?> / <?php echo $row['appointmentTime']; ?></td>
                                            <td data-label="postingDate"><?php echo $row['postingDate']; ?></td>
                                            <td data-label="PatientContno"><?php echo isset($row['PatientContno']) ? $row['PatientContno'] : '<span class="text-muted">No disponible</span>'; ?></td>
                                            <td data-label="PatientEmail"><?php echo isset($row['PatientEmail']) ? $row['PatientEmail'] : '<span class="text-muted">No disponible</span>'; ?></td>
                                            <td data-label="PatientAdd"><?php echo isset($row['PatientAdd']) ? $row['PatientAdd'] : '<span class="text-muted">No disponible</span>'; ?></td>
                                            <td data-label="PatientMedhis"><?php echo !empty($row['PatientMedhis']) ? nl2br(htmlspecialchars($row['PatientMedhis'])) : '<span class="text-muted">Sin historial</span>'; ?></td>
                                            <td data-label="Accion">
                                                <?php 
                                                if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                    echo "Activo";
                                                } elseif (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                                                    echo "Finalizada por paciente";
                                                } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                    echo "Cancelada por ti";
                                                } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 2)) {
                                                    echo "Finalizada por ti";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                    <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                                                    <div class="btn-group">
                                                        <a href="view-patient.php?viewid=<?php echo $row['userId']; ?>&appointmentid=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">Atender</a>
                                                        <a class="btn btn-sm btn-outline-danger" href="appointment-history.php?id=<?php echo $row['id']; ?>&Cancelada=update" onclick="return confirm('¿Estás seguro de cancelar esta cita?');">Cancelar</a>
                                                    </div>
                                                    <?php } else { ?>
                                                    <span class="text-muted">Sin acciones</span>
                                                    <?php } ?>
                                                </div>
                                            </td>
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
                    </div> <!-- End Table -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('include/footer.php');?>

        <!-- Settings -->
        <?php include('include/setting.php');?>

    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>

    <!-- Page-specific Scripts -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

    <!-- App Scripts -->
    <script src="assets/js/main.js"></script>

    <!-- Page Event Handlers -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>

<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

$technician_id = $_SESSION['id'];

// Procesar cancelaciones o finalizaciones de citas
if (isset($_GET['Cancelada'])) {
    mysqli_query($con, "UPDATE lab_appointments SET userStatus='0' WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "¡Tu cita ha sido cancelada!";
}

if (isset($_GET['Finalizada'])) {
    mysqli_query($con, "UPDATE lab_appointments SET userStatus='2' WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "¡Tu cita ha sido finalizada!";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Técnico | Historial de citas de laboratorio</title>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">Técnico | Historial de citas de laboratorio</h1>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre de Paciente</th>
                                                    <th>Tipo de Laboratorio</th>
                                                    <th>Nombre de Laboratorio</th>
                                                    <th>Costo</th>
                                                    <th>Fecha de la cita</th>
                                                    <th>Fecha de creación</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT laboratories.tipo AS labtype, laboratories.nombre AS labname, lab_appointments.*, tblpatient.PatientName
                                                    FROM lab_appointments
                                                    JOIN laboratories ON laboratories.id = lab_appointments.labId
                                                    LEFT JOIN tblpatient ON tblpatient.user_id = lab_appointments.user_id
                                                    WHERE lab_appointments.technician_id='" . $technician_id . "'");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['PatientName']; ?></td>
                                                    <td><?php echo $row['labtype']; ?></td>
                                                    <td><?php echo $row['labname']; ?></td>
                                                    <td><?php echo $row['consultancyFees']; ?></td>
                                                    <td><?php echo $row['appointmentDate'] . ' / ' . $row['appointmentTime']; ?></td>
                                                    <td><?php echo $row['created_at']; ?></td>
                                                    <td>
                                                        <?php 
                                                        if ($row['userStatus'] == 1) {
                                                            echo "Activo";
                                                        } elseif ($row['userStatus'] == 0) {
                                                            echo "Cancelado";
                                                        } elseif ($row['userStatus'] == 2) {
                                                            echo "Finalizado";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($row['userStatus'] == 1) { ?>
                                                            <a href="appointment-history.php?id=<?php echo $row['id'] ?>&Cancelada=update" class="btn btn-danger btn-sm" onClick="return confirm('¿Estás seguro de que quieres cancelar esta cita?')">Cancelar</a>
                                                            <a href="view-patient.php?viewid=<?php echo $row['user_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                                            
                                                            <!-- Formulario de subida de archivo -->
                                                            <form action="upload.php" method="post" enctype="multipart/form-data" style="display: inline; margin-right: 5px;">
                                                                <input type="file" name="fileToUpload" id="fileToUpload<?php echo $row['id']; ?>" style="display: none;">
                                                                <label for="fileToUpload<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Subir Archivo</label>
                                                                <input type="hidden" name="appointmentId" value="<?php echo $row['id']; ?>">
                                                                <input type="submit" value="Subir Archivo" name="submit" class="btn btn-success btn-sm" style="display: none;">
                                                            </form>
                                                            
                                                            <a href="#" class="btn btn-warning btn-sm" onClick="alert('Sin archivo adjunto'); return false; margin-left: 5px;"><i class="fa fa-exclamation-triangle"></i> Sin Archivo</a>
                                                        <?php } ?>
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

            // Toggle submenu
            $('.toggle-submenu').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $submenu = $this.next('.sub-menu');
                if ($submenu.is(':visible')) {
                    $submenu.slideUp();
                } else {
                    $submenu.slideDown();
                }
            });
        });
    </script>
</body>
</html>

















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
        <div class="sidebar app-aside" id="sidebar">
            <div class="sidebar-container perfect-scrollbar">
                <nav>
                    <div class="navbar-title">
                        <span>Navegación principal</span>
                    </div>
                    <ul class="main-navigation-menu">
                        <li>
                            <a href="dashboard.php">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-home"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Consola </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="appointment-history.php">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-list"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Historial laboratorios </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="toggle-submenu">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Pacientes </span><i class="icon-arrow"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="add-patient.php">
                                        <span class="title"> Agregar paciente</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="manage-patient.php">
                                        <span class="title"> Administrar paciente </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="resultados_lab.php">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-list"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Resultados </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="search.php">
                                <div class="item-content">
                                    <div class="item-media">
                                        <i class="ti-search"></i>
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Buscar </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="app-content">
            <?php include 'include/header.php';?>
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
                                                $sql = mysqli_query($con, "SELECT laboratories.tipo AS labtype, laboratories.nombre AS labname, lab_appointments.*, users.fullName
                                                    FROM lab_appointments
                                                    JOIN laboratories ON laboratories.id = lab_appointments.labId
                                                    LEFT JOIN users ON users.id = lab_appointments.userId
                                                    WHERE lab_appointments.technician_id='" . $technician_id . "'");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['fullName']; ?></td>
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
        <?php include 'include/footer.php';?>
        <?php include 'include/setting.php';?>
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






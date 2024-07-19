<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Verifica si la sesión contiene el ID del técnico
if (!isset($_SESSION['id'])) {
    echo "Error: No se encontró el ID del técnico en la sesión.";
    exit;
}

if (isset($_GET['viewid'])) {
    $vid = intval($_GET['viewid']); // Asegúrate de convertir el ID a un entero

    // Consulta para obtener la información del paciente desde la tabla tblpatient
    $sql_patient = "SELECT * FROM tblpatient WHERE user_id = '$vid'";
    $result_patient = mysqli_query($con, $sql_patient);

    if (mysqli_num_rows($result_patient) > 0) {
        $row_patient = mysqli_fetch_assoc($result_patient);
    } else {
        echo "No se encontró ningún paciente con ese ID.";
        exit;
    }

    // Consulta para obtener el historial de citas de laboratorio del paciente desde la tabla lab_appointments
    $sql_lab_appointments = "SELECT laboratories.tipo AS labtype, laboratories.nombre AS labname, lab_appointments.*
                             FROM lab_appointments
                             JOIN laboratories ON laboratories.id = lab_appointments.labId
                             WHERE lab_appointments.user_id = '$vid'";
    $result_lab_appointments = mysqli_query($con, $sql_lab_appointments);
} else {
    echo "Error: No se proporcionó ningún ID de paciente.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Detalles del Paciente</title>
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
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-10">
                                <h1 class="mainTitle">Detalles del Paciente</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><a href="#">Laboratorio</a></li>
                                <li class="active">Detalles del Paciente</li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <table border="1" class="table table-bordered">
                                    <tr align="center">
                                        <td colspan="4" style="font-size:20px;color:blue">Detalles del paciente</td>
                                    </tr>
                                    <tr>
                                        <th>No. Admisión</th>
                                        <td><?php echo $row_patient['PatientAdmision']; ?></td>
                                        <th>Nombre paciente</th>
                                        <td><?php echo $row_patient['PatientName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de nacimiento</th>
                                        <td><?php echo $row_patient['FechaNac']; ?></td>
                                        <th>Email</th>
                                        <td><?php echo $row_patient['PatientEmail']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Teléfono</th>
                                        <td><?php echo $row_patient['PatientContno']; ?></td>
                                        <th>Dirección</th>
                                        <td><?php echo $row_patient['PatientAdd']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Género</th>
                                        <td><?php echo $row_patient['PatientGender']; ?></td>
                                        <th>Historial Médico</th>
                                        <td><?php echo $row_patient['PatientMedhis']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de registro del paciente</th>
                                        <td><?php echo $row_patient['CreationDate']; ?></td>
                                        <th>Fecha de actualización</th>
                                        <td><?php echo $row_patient['UpdationDate']; ?></td>
                                    </tr>
                                </table>

                                <?php
                                if (mysqli_num_rows($result_lab_appointments) > 0) {
                                    echo "<h5>Historial de Citas de Laboratorio:</h5>";
                                    echo "<table class='table table-bordered'>";
                                    echo "<tr><th>#</th><th>Tipo de Laboratorio</th><th>Nombre de Laboratorio</th><th>Costo</th><th>Fecha de la cita</th><th>Resultado</th><th>Estado</th></tr>";
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($result_lab_appointments)) {
                                        // Consulta para obtener el archivo almacenado según el appointment_id
                                        $appointment_id = $row['id'];
                                        $sql_file = "SELECT * FROM tblfiles WHERE appointment_id = '$appointment_id' LIMIT 1";
                                        $result_file = mysqli_query($con, $sql_file);
                                        $file_row = mysqli_fetch_assoc($result_file);

                                        echo "<tr>";
                                        echo "<td>".$cnt."</td>";
                                        echo "<td>".$row['labtype']."</td>";
                                        echo "<td>".$row['labname']."</td>";
                                        echo "<td>".$row['consultancyFees']."</td>";
                                        echo "<td>".$row['appointmentDate'] . ' / ' . $row['appointmentTime']."</td>";
                                        echo "<td>";
                                        if ($file_row) {
                                            echo "<a href='".$file_row['FilePath']."' target='_blank'>Ver archivo</a>";
                                        } else {
                                            echo "No disponible";
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($row['userStatus'] == 1) {
                                            echo "Activo";
                                        } elseif ($row['userStatus'] == 0) {
                                            echo "Cancelado";
                                        } elseif ($row['userStatus'] == 2) {
                                            echo "Finalizado";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                        $cnt++;
                                    }
                                    echo "</table>";
                                } else {
                                    echo "No hay citas de laboratorio para este paciente.";
                                }
                                ?>

                                <p align="center">
                                    <button class="btn btn-primary waves-effect waves-light w-lg" onclick="return printData();">Imprimir</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('include/footer.php');?>
        <?php include('include/setting.php');?>
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

        function printData() {
            var divToPrint = document.getElementById("printIt");
            var newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
</body>
</html>


















<?php
session_start();
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_POST['submit'])) {
    $rxtype = $_POST['rxtype'];
    $rxid = $_POST['rxid'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];
    $userstatus = 1;
    $docstatus = 1;
    $technician_id = 1;

    // Obtener un técnico disponible
    $query_technician = "SELECT id FROM tecnico_rx WHERE disponible = 1 LIMIT 1";
    $result_technician = mysqli_query($con, $query_technician);

    if ($result_technician && mysqli_num_rows($result_technician) > 0) {
        $row_technician = mysqli_fetch_assoc($result_technician);
        $technician_id = $row_technician['id'];

        // Insertar la cita de laboratorio asignando el técnico disponible
        $query = mysqli_query($con, "INSERT INTO rx_appointments(rxType, rxId, user_id, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus, technician_id) VALUES ('$rxtype', '$rxid', '$userid', '$fees', '$appdate', '$time', '$userstatus', '$docstatus', '$technician_id')");

        if ($query) {
            echo "<script>alert('Tu cita para rayos X se ha agendado correctamente');</script>";
        } else {
            $error_message = mysqli_error($con);
            echo '<script>alert("Error al agendar la cita: ' . $error_message . '");</script>';
        }
    } else {
        echo '<script>alert("No hay técnicos disponibles en este momento. Por favor, intenta de nuevo más tarde.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crear Cita de Laboratorio</title>
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
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Crear Cita de Laboratorio</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>User</span>
                                </li>
                                <li class="active">
                                    <span>Crear cita para rayos X</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="cita-rayosx.php" method="post">
                                    <div class="form-group">
                                        <label for="rxtype">Tipo de rayos X</label>
                                        <select name="rxtype" id="rxtype" class="form-control" required="required">
                                            <option value="">Seleccionar tipo de rayos X</option>
                                            <?php
                                                $ret = mysqli_query($con, "SELECT DISTINCT tipo FROM rayosx");
                                                while ($row = mysqli_fetch_array($ret)) {
                                                    echo '<option value="' . $row['tipo'] . '">' . $row['tipo'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="rxid">Nombre</label>
                                        <select name="rxid" id="rxid" class="form-control" required="required">
                                            <option value="">Seleccionar rayos X</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fees">Honorarios de Consulta</label>
                                        <input type="text" name="fees" id="fees" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="appdate">Fecha de la Cita</label>
                                        <input type="text" name="appdate" id="appdate" class="form-control datepicker" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="apptime">Hora de la Cita</label>
                                        <input type="text" name="apptime" id="apptime" class="form-control" required="required">
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Guardar Cita</button>
                                </form>
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
    $(document).ready(function() {
        $('#rxtype').change(function() {
            var rxtype = $(this).val();
            $.ajax({
                url: 'get-rx-by-type.php',
                type: 'post',
                data: { rxtype: rxtype },
                success: function(response) {
                    $('#rxid').html(response);
                    $('#fees').val('');
                }
            });
        });

        $('#rxid').change(function() {
            var selectedOption = $(this).find(':selected');
            var costo = selectedOption.data('costo');
            $('#fees').val(costo);
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });

        $('#apptime').timepicker();
    });
    </script>
</body>
</html>
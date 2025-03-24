<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $docid = $_SESSION['id'];
    $patadmi = $_POST['patadmi'];
    $seguro = $_POST['seguro'];
    $dpi = $_POST['dpi'];
    $patname = $_POST['patname'];
    $fena = $_POST['fena'];
    $patcontact = $_POST['patcontact'];
    $patemail = $_POST['patemail'];
    $gender = $_POST['gender'];
    $pataddress = $_POST['pataddress'];
    $patage = $_POST['patage'];
    $alergias_patologicas = $_POST['alergias_patologicas'];
    $alergias_medicamentos = $_POST['alergias_medicamentos'];
    $diabetico = $_POST['diabetico'];
    $familiares_diabeticos = $_POST['familiares_diabeticos'];
    $medhis = $_POST['medhis'];

    // Insertar en la tabla users
    $sql_user = mysqli_query($con, "INSERT INTO users (fullName, FechaNac, address, city, gender, email, password) VALUES ('$patname', '$fena', '$pataddress', '', '$gender', '$patemail', '')");
    if ($sql_user) {
        // Obtener el ID del usuario recién creado
        $user_id = mysqli_insert_id($con);

        // Insertar en la tabla tblpatient usando el user_id
        $sql_patient = mysqli_query($con, "INSERT INTO tblpatient 
(user_id, Docid, PatientAdmision, PatientName, FechaNac, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis, alergias_patologicas, alergias_medicamentos, seguro, diabetico, familiares_diabeticos, dpi) 
VALUES 
('$user_id', '$docid', '$patadmi', '$patname', '$fena', '$patcontact', '$patemail', '$gender', '$pataddress', '$patage', '$medhis', '$alergias_patologicas', '$alergias_medicamentos', '$seguro', '$diabetico', '$familiares_diabeticos', '$dpi')");
        if ($sql_patient) {
            echo "<script>alert('Información del paciente se agregó correctamente');</script>";
            header('location:add-patient.php');
        } else {
            echo "<script>alert('Error al agregar la información del paciente');</script>";
        }
    } else {
        echo "<script>alert('Error al agregar la información del usuario');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
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
    <link rel="stylesheet" href="assets/css/add-patient.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#patemail").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>
</head>
    <title>Medico | Agregar paciente</title>
    <!-- Resto de tu código HTML y scripts -->
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
                            <div class="col-sm-10">
                                <h1 class="mainTitle">Medico| Agregar paciente</h1>
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
                                        <div class="panel panel-white card">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Agregar paciente</h5>
                                            </div>
                                            <div class="panel-body card-body">
                                                <form role="form" name="" method="post">
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="doctorname">No. Admision</label>
                                                        <input type="text" name="patadmi" class="form-control" placeholder="No. adminision" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="doctorname">Seguro Medico</label>
                                                        <input type="text" name="seguro" class="form-control" placeholder="Nombre de aseguradora" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="doctorname">DPI</label>
                                                        <input type="text" name="dpi" class="form-control" placeholder="Documento poesonal de identificacion" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="doctorname">Nombre paciente</label>
                                                        <input type="text" name="patname" class="form-control" placeholder="Nombre y apellido" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Fecha de nacimiento</label>
                                                        <input type="date" name="fena" class="form-control" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Telefono</label>
                                                        <input type="tel" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Email</label>
                                                        <input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email id" onBlur="userAvailability()">
                                                        <span id="user-availability-status1" style="font-size:12px;"></span>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label>Genero</label>
                                                        <select name="gender" class="form-select">
                                                            <option value="femenino">Femenino</option>
                                                            <option value="masculino">Masculino</optioon>
                                                        </select>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Edad</label>
                                                        <input type="text" name="patage" class="form-control" placeholder="Ingrese la edad" required="true">
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label>¿Es diabetico?</label>
                                                        <select name="diabetico" class="form-select">
                                                            <option value="Sí" required="true">Sí</option>
                                                            <option value="No" required="true">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label>¿Tiene familiares diabéticos?</label>
                                                        <select name="familiares_diabeticos" class="form-select">
                                                            <option value="Sí" required="true">Sí</option>
                                                            <option value="No" required="true">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="address">Direccion</label>
                                                        <textarea name="pataddress" class="form-control" placeholder="Domicilio" required="true"></textarea>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Alergias patologicas</label>
                                                        <textarea type="text" name="alergias_patologicas" class="form-control" placeholder="Describa las alegias" required="true"></textarea>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Alergias a medicamentos</label>
                                                        <textarea type="text" name="alergias_medicamentos" class="form-control" placeholder="Describa las alegias" required="true"></textarea>
                                                    </div>
                                                    <div class="row col-md-6 mb-3">
                                                        <label for="fess">Historial medico</label>
                                                        <textarea type="text" name="medhis" class="form-control" placeholder="Historial medico" required="true"></textarea>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Agregar</button>
                                                </form>
                                            </div>
                                        </div>
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


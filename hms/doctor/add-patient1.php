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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title><link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" href="assets/css/add-patient.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Agregar Paciente</div>
                <div class="card-body">
                    <form method="post" role="form" name="addpatient">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>No. Admisión</label>
                                <input type="text" name="patadmi" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Seguro Médico</label>
                                <input type="text" name="seguro" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>DPI</label>
                                <input type="text" name="dpi" class="form-control" maxlength="20">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nombre Paciente</label>
                                <input type="text" name="patname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fena" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Teléfono</label>
                                <input type="text" name="patcontact" class="form-control" maxlength="10" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="patemail" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Género</label>
                                <select name="gender" class="form-select">
                                    <option value="femenino">Femenino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Edad</label>
                                <input type="text" name="patage" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Dirección</label>
                                <textarea name="pataddress" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Alergias Patológicas</label>
                            <textarea name="alergias_patologicas" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Alergias a Medicamentos</label>
                            <textarea name="alergias_medicamentos" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>¿Es diabético?</label>
                                <select name="diabetico" class="form-select">
                                    <option value="Sí">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>¿Tiene familiares diabéticos?</label>
                                <select name="familiares_diabeticos" class="form-select">
                                    <option value="Sí">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Historial Médico</label>
                            <textarea name="medhis" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
            <?php include('include/footer.php'); ?>
        </div>
    </div>
    <script>
        document.querySelector('input[name="patage"]').addEventListener('input', function() {
        let age = parseInt(this.value);
        let dpiField = document.getElementById('dpi');
        if (age >= 18) {
            dpiField.required = true;
            dpiField.disabled = false;
        } else {
            dpiField.required = false;
            dpiField.disabled = true;
            dpiField.value = "";
        }
        });
    </script>
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
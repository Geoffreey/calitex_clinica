<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
    $vid = $_GET['viewid'];
    $bp = $_POST['bp'];
    $bs = $_POST['bs'];
    $weight = $_POST['weight'];
    $temp = $_POST['temp'];
    $exf = $_POST['exf'];
    $pres = $_POST['pres'];
    $ord = $_POST['ord'];
    $evo = $_POST['evo'];
    $lab = $_POST['lab'];
    $rayx = $_POST['rayx'];
    
    $query = mysqli_query($con, "INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, ExamenFisico, MedicalPres, OrdenesMedicas, Evolucion, Laboratorio, RayosX) VALUES ('$vid', '$bp', '$bs', '$weight', '$temp', '$exf', '$pres', '$ord', '$evo', '$lab', '$rayx')");
    
    if ($query) {
        echo '<script>alert("Medical history has been added.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

if(isset($_POST['submit_lab']))
{
    $vid = $_GET['viewid'];
    $labType = $_POST['labType'];
    $labId = $_POST['labId'];
    $consultancyFees = $_POST['consultancyFees'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $userStatus = 1; // Assuming user status is set to 1 when appointment is created
    $doctorStatus = 1; // Assuming doctor status is set to 1 when appointment is created
    $technician_id = 1;
    // Obtener user_id del paciente
    $result = mysqli_query($con, "SELECT user_id FROM tblpatient WHERE ID='$vid'");
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id']; // Asignar el user_id a la variable

    $query = mysqli_query($con, "INSERT INTO lab_appointments (labType, labId, consultancyFees, appointmentDate, appointmentTime, technician_id, userStatus, doctorStatus, user_id) VALUES ('$labType', '$labId', '$consultancyFees', '$appointmentDate', '$appointmentTime', '$technician_id',  '$userStatus', '$doctorStatus', '$user_id')");
    
    if ($query) {
        echo '<script>alert("Lab appointment has been created.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medico | Administrar pacientes</title>
    
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
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Medico | Administrar pacientes</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Medico</span>
                            </li>
                            <li class="active">
                                <span>Administrar pacientes</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white" id="printIt">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="over-title margin-bottom-15">Administrar<span class="text-bold"> pacientes</span></h5>
                            <?php
                            $vid = $_GET['viewid'];
                            $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE ID='$vid'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                <table border="1" class="table table-bordered">
                                    <tr align="center">
                                        <td colspan="5" style="font-size:20px;color:blue">Detalles del paciente</td>
                                    </tr>
                                    <tr>
                                        <th scope>No. Admision</th>
                                        <td><?php echo $row['PatientAdmision'];?></td>
                                        <th scope>Nombre paciente</th>
                                        <td><?php echo $row['PatientName'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope>Fecha de nacimiento</th>
                                        <td><?php echo $row['FechaNac'];?></td>
                                        <th scope>Email</th>
                                        <td><?php echo $row['PatientEmail'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope>Telefono</th>
                                        <td><?php echo $row['PatientContno'];?></td>
                                        <th>Direccion</th>
                                        <td><?php echo $row['PatientAdd'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Genero</th>
                                        <td><?php echo $row['PatientGender'];?></td>
                                        <th>Edad</th>
                                        <td><?php echo $row['PatientAge'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Historial médico del paciente (Si aplica)</th>
                                        <td><?php echo $row['PatientMedhis'];?></td>
                                        <th>Fecha de registro del paciente</th>
                                        <td><?php echo $row['CreationDate'];?></td>
                                    </tr>
                                </table>
                            <?php }?>
                            <?php
                            $ret = mysqli_query($con, "SELECT * FROM tblmedicalhistory WHERE PatientID='$vid'");
                            ?>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr align="center">
                                    <th colspan="13">Historial medico</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Presión arterial</th>
                                    <th>Peso</th>
                                    <th>Glucosa</th>
                                    <th>Temperatura corporal</th>
                                    <th>Examen físico</th>
                                    <th>Prescripción médica</th>
                                    <th>Ordenes médicas</th>
                                    <th>Evolución</th>
                                    <th>Laboratorio</th>
                                    <th>Rayos X</th>
                                    <th>Fecha visita</th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo $row['BloodPressure'];?></td>
                                        <td><?php echo $row['Weight'];?></td>
                                        <td><?php echo $row['BloodSugar'];?></td>
                                        <td><?php echo $row['Temperature'];?></td>
                                        <td><?php echo $row['ExamenFisico'];?></td>
                                        <td><?php echo $row['MedicalPres'];?></td>
                                        <td><?php echo $row['OrdenesMedicas'];?></td>
                                        <td><?php echo $row['Evolucion'];?></td>
                                        <td><?php echo $row['Laboratorio'];?></td>
                                        <td><?php echo $row['RayosX'];?></td>
                                        <td><?php echo $row['CreationDate'];?></td>
                                    </tr>
                                    <?php $cnt = $cnt + 1;} ?>
                            </table>
                            <!-- Aquí van los botones de agregar historial médico e imprimir -->
                            <div class="modal fade" id="addHistorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Añadir Historial Médico</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="add-medhistory" method="post" action="">
                                                <table class="table table-bordered table-hover data-tables">
                                                    <tr>
                                                        <th>Presión arterial :</th>
                                                        <td><input name="bp" placeholder="Presion arterial" class="form-control wd-450" required="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Glucosa :</th>
                                                        <td><input name="bs" placeholder="Nivel de glucosa" class="form-control wd-450" required="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Peso :</th>
                                                        <td><input name="weight" placeholder="Peso" class="form-control wd-450" required="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Temperatura corporal :</th>
                                                        <td><input name="temp" placeholder="Temperatura corporal" class="form-control wd-450" required="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Examen físico :</th>
                                                        <td><textarea name="exf" placeholder="Examen fisico" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Prescripción médica :</th>
                                                        <td><textarea name="pres" placeholder="Prescripción médica" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ordenes médicas :</th>
                                                        <td><textarea name="ord" placeholder="Ordenes médicas" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Evolución :</th>
                                                        <td><textarea name="evo" placeholder="Evolución" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Laboratorio :</th>
                                                        <td><textarea name="lab" placeholder="Laboratorio" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rayos X :</th>
                                                        <td><textarea name="rayx" placeholder="Rayos X" class="form-control wd-450" required="true"></textarea></td>
                                                    </tr>
                                                </table>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal para agregar cita de laboratorio -->
<div class="modal fade" id="addLabAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Crear Cita de Laboratorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="add-labappointment" method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $vid; ?>"> <!-- Campo oculto para user_id -->
                    <table class="table table-bordered table-hover data-tables">
                        <tr>
                            <th>Tipo de Laboratorio :</th>
                            <td>
                                <select id="labType" name="labType" class="form-control wd-450" required="true" onchange="updateLabOptions()">
                                    <option value="">Seleccione un tipo de laboratorio</option>
                                    <?php
                                    $query = mysqli_query($con, "SELECT DISTINCT tipo FROM laboratories");
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo "<option value='{$row['tipo']}'>{$row['tipo']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>ID del Laboratorio :</th>
                            <td>
                                <select id="labId" name="labId" class="form-control wd-450" required="true">
                                    <option value="">Seleccione un ID</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Costos de consultoría :</th>
                            <td><input name="consultancyFees" id="consultancyFees" placeholder="Costos de consultoría" class="form-control wd-450" required="true" readonly></td>
                        </tr>
                        <tr>
                            <th>Fecha de la Cita :</th>
                            <td><input type="date" name="appointmentDate" placeholder="Fecha de la Cita" class="form-control wd-450" required="true"></td>
                        </tr>
                        <tr>
                            <th>Hora de la Cita :</th>
                            <td><input type="time" name="appointmentTime" placeholder="Hora de la Cita" class="form-control wd-450" required="true"></td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="submit_lab" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                            <button class="btn btn-primary" data-toggle="modal" data-target="#addHistorialModal">Añadir Historial Médico</button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addLabAppointmentModal">Orden de laboratorio</button>
                            <button class="btn btn-primary" onclick="window.location.href='resultado-laboratorio.php?viewid=<?php echo $vid; ?>'">Resultados</button>
                            <button class="btn btn-primary" onclick="printDiv('printIt')">Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php');?>
    <?php include('include/setting.php'); ?>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script>
function updateLabOptions() {
    var labType = document.getElementById('labType').value;
    var labIdSelect = document.getElementById('labId');
    var consultancyFeesInput = document.getElementById('consultancyFees');
    
    // Limpiar las opciones existentes
    labIdSelect.innerHTML = '<option value="">Seleccione un ID</option>';
    consultancyFeesInput.value = '';
    
    if (labType) {
        // Hacer una solicitud AJAX para obtener los laboratorios de ese tipo
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_lab_options.php?labType=' + encodeURIComponent(labType), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                response.forEach(function(lab) {
                    var option = document.createElement('option');
                    option.value = lab.id;
                    option.text = lab.codigo;
                    labIdSelect.add(option);
                });
            }
        };
        xhr.send();
    }
}

// Actualiza el costo cuando cambia el ID del laboratorio
document.getElementById('labId').addEventListener('change', function() {
    var labId = this.value;
    var consultancyFeesInput = document.getElementById('consultancyFees');
    
    if (labId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_lab_cost.php?labId=' + encodeURIComponent(labId), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                consultancyFeesInput.value = response.costo;
            }
        };
        xhr.send();
    } else {
        consultancyFeesInput.value = '';
    }
});
</script>

<!-- include required scripts here -->
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


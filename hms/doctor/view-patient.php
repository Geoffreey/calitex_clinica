<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_GET['viewid'])) {
    //echo "✅ Recibido viewid: " . htmlspecialchars($_GET['viewid']);
} //else {
    //echo "❌ No se recibió viewid.";
//}

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
        echo '<script>alert("Se ha creado una orden para laboratorio.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

if(isset($_POST['submit_rx']))
{
    $vid = $_GET['viewid'];
    $rxType = $_POST['rxType'];
    $rxId = $_POST['rxId'];
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

    $query = mysqli_query($con, "INSERT INTO rx_appointments (rxType, rxId, consultancyFees, appointmentDate, appointmentTime, technician_id, userStatus, doctorStatus, user_id) VALUES ('$rxType', '$rxId', '$consultancyFees', '$appointmentDate', '$appointmentTime', '$technician_id',  '$userStatus', '$doctorStatus', '$user_id')");
    
    if ($query) {
        echo '<script>alert("Se ha creado una orden para rayos X.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

//Emitir receta
if (isset($_POST['emitir_receta'])) { 
    require_once("include/config.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['doctor_id'])) {
        header("Location: view-patient.php?viewid=" . $_GET['viewid']);
        exit();
    }

    if (!isset($con)) {
        header("Location: view-patient.php?viewid=" . $_GET['viewid']);
        exit();
    }

    $vid = $_GET['viewid']; // ID del paciente
    $doctor_id = $_SESSION['doctor_id'];
    $medicamento_ids = $_POST['medicamento_id'] ?? [];
    $cantidades = $_POST['cantidad'] ?? [];
    $indicaciones = $_POST['indicacion'] ?? [];

    // Validar que haya al menos un medicamento
    if (empty($medicamento_ids) || empty($cantidades) || empty($indicaciones)) {
        header("Location: view-patient.php?viewid=$vid&error=empty_medicamento");
        exit();
    }

    // Obtener user_id del paciente
    $result = mysqli_query($con, "SELECT user_id FROM tblpatient WHERE ID='$vid'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("Location: view-patient.php?viewid=$vid&error=paciente_not_found");
        exit();
    }

    $user_id = $row['user_id'];

    // Insertar receta
    $query = mysqli_query($con, "INSERT INTO recetas (paciente_id, doctor_id) VALUES ('$vid', '$doctor_id')");

    if ($query) {
        $receta_id = mysqli_insert_id($con);
        $success = true;

        // Insertar detalles de receta
        for ($i = 0; $i < count($medicamento_ids); $i++) {
            $medicamento_id = mysqli_real_escape_string($con, $medicamento_ids[$i]);
            $cantidad = mysqli_real_escape_string($con, $cantidades[$i]);
            $indicacion = mysqli_real_escape_string($con, $indicaciones[$i]);

            $query_detalle = mysqli_query($con, "INSERT INTO detalles_receta (receta_id, medicamento_id, cantidad, indicacion) 
                          VALUES ('$receta_id', '$medicamento_id', '$cantidad', '$indicacion')");

            if (!$query_detalle) {
                $success = false;
                break;
            }
        }

        if ($success) {
            header("Location: manage-patient.php?success=receta_emitida");
            exit();
        } else {
            header("Location: view-patient.php?viewid=$vid&error=detalle_error");
            exit();
        }
    } else {
        header("Location: view-patient.php?viewid=$vid&error=receta_error");
        exit();
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
                            $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE User_id='$vid'");
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
                                    <th>No.</th>
                                    <th>Presión arterial</th>
                                    <th>Peso</th>
                                    <th>Glucosa</th>
                                    <th>Temperatura corporal</th>
                                    <th>Examen físico</th>
                                    <th>Prescripción médica</th>
                                    <th>Ordenes médicas</th>
                                    <th>Evolución</th>
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
                                            <form id="addHistorialForm" method="POST">
                                                <input type="hidden" name="appointmentid" value="<?php echo isset($_GET['appointmentid']) ? $_GET['appointmentid'] : ''; ?>">
                                                <table class="table table-bordered table-hover data-tables">
                                                    <tr>
                                                        <th>Presión arterial :</th>
                                                        <td><input name="bp" id="bp" placeholder="Presión arterial" class="form-control wd-450" required></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Glucosa :</th>
                                                        <td><input name="bs" id="bs" placeholder="Nivel de glucosa" class="form-control wd-450" required></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Peso :</th>
                                                        <td><input name="weight" id="weight" placeholder="Peso" class="form-control wd-450" required></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Temperatura corporal :</th>
                                                            <td><input name="temp" id="temp" placeholder="Temperatura corporal" class="form-control wd-450" required></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Examen físico :</th>
                                                        <td><textarea name="exf" id="exf" placeholder="Examen físico" class="form-control wd-450" required></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Prescripción médica :</th>
                                                        <td><textarea name="pres" id="pres" placeholder="Prescripción médica" class="form-control wd-450" required></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Órdenes médicas :</th>
                                                        <td><textarea name="ord" id="ord" placeholder="Órdenes médicas" class="form-control wd-450" required></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Evolución :</th>
                                                        <td><textarea name="evo" id="evo" placeholder="Evolución" class="form-control wd-450" required></textarea></td>
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
                            <div class="modal fade" id="addRxAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Crear orden para rayos X</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="add-rxappointment" method="post" action="">
                                                <input type="hidden" name="user_id" value="<?php echo $vid; ?>"> <!-- Campo oculto para user_id -->
                                                <table class="table table-bordered table-hover data-tables">
                                                    <tr>
                                                        <th>Tipo de rayos X:</th>
                                                        <td>
                                                            <select id="rxType" name="rxType" class="form-control wd-450" required="true" onchange="updaterxOptions()">
                                                                <option value="">Seleccione un tipo de rayos X</option>
                                                                <?php
                                                                $query = mysqli_query($con, "SELECT DISTINCT tipo FROM rayosx");
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                echo "<option value='{$row['tipo']}'>{$row['tipo']}</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                         </td>
                                                        </tr>
                                                        <tr>
                                                            <th>ID de rayos X:</th>
                                                            <td>
                                                                <select id="rxId" name="rxId" class="form-control wd-450" required="true">
                                                                    <option value="">Seleccione un ID</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Costos de consultoría :</th>
                                                            <td><input name="consultancyFees" id="rxConsultancyFees" placeholder="Costos de consultoría" class="form-control wd-450" required="true" readonly></td>
                                                        </tr>
                                                         <tr>
                                                            <th>Fecha de la Cita :</th>
                                                            <td><input type="date" name="appointmentDate" placeholder="Fecha de la Cita" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                         <tr>
                                                            <th>Hora de la Cita :</th>
                                                            <td><input type="time" name="appointmentTime" placeholder="Hora de la Cita" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                    </tr>
                                                </table>
                                                 <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="submit_rx" class="btn btn-primary">Crear</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal para emitir receta -->
                            <div class="modal fade" id="emitirRecetaModal" tabindex="-1" role="dialog" aria-labelledby="emitirRecetaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="emitirRecetaModalLabel">Emitir Receta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="emitirRecetaForm" method="post" action="view-patient.php?viewid=<?php echo $_GET['viewid']; ?>" enctype="multipart/form-data">
                                                <input type="hidden" name="doctor_id" value="<?php echo $_SESSION['doctor_id']; ?>">
                                                <div id="medicamentosContainer">
                                                    <div class="medicamento-row">
                                                        <div class="form-group">
                                                            <label for="medicamento_id">Medicamento</label>
                                                            <select id="medicamento_id" name="medicamento_id[]" class="form-control" required>
                                                                <option value="">Seleccione un medicamento</option>
                                                                <?php
                                                                    $query = mysqli_query($con, "SELECT id, nombre FROM medicamentos");
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cantidad">Cantidad</label>
                                                            <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="indicacion">Indicación</label>
                                                            <textarea name="indicacion[]" class="form-control" placeholder="Indicación" required></textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-danger remove-medicamento">Eliminar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-success" id="addMedicamento">Agregar otro medicamento</button>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" name="emitir_receta" class="btn btn-primary">Emitir Receta</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.getElementById('addMedicamento').addEventListener('click', function() {
                                const container = document.getElementById('medicamentosContainer');
                                const newMedicamentoRow = document.createElement('div');
                                newMedicamentoRow.className = 'medicamento-row';
                                newMedicamentoRow.innerHTML = `
                                <div class="form-group">
                                    <label for="medicamento_id">Medicamento</label>
                                    <select name="medicamento_id[]" class="form-control" required>
                                        <option value="">Seleccione un medicamento</option>
                                        <?php
                                            $query = mysqli_query($con, "SELECT id, nombre FROM medicamentos");
                                            while ($row = mysqli_fetch_array($query)) {
                                            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                                </div>
                                <div class="form-group">
                                    <label for="indicacion">Indicación</label>
                                    <textarea name="indicacion[]" class="form-control" placeholder="Indicación" required></textarea>
                                </div>
                                <button type="button" class="btn btn-danger remove-medicamento">Eliminar</button>
                                `;
                                container.appendChild(newMedicamentoRow);

                                // Agregar detector de eventos al nuevo botón de eliminar
                                newMedicamentoRow.querySelector('.remove-medicamento').addEventListener('click', function() {
                                newMedicamentoRow.remove();
                                    });
                                });

                                // Agregar un detector de eventos al botón de eliminación existente
                                document.querySelectorAll('.remove-medicamento').forEach(function(button) {
                                button.addEventListener('click', function() {
                                button.parentElement.remove();
                                    });
                                });
                            </script>
                            <div class='text-center'>
                               <button class="btn btn-primary no-print" data-toggle="modal" data-target="#addHistorialModal">Añadir Historial Médico</button>
                               <button class="btn btn-primary no-print" data-toggle="modal" data-target="#addLabAppointmentModal">Orden de laboratorio</button>
                               <button class="btn btn-primary no-print" onclick="window.location.href='resultado-laboratorio.php?viewid=<?php echo $vid; ?>'">Resultados_lab</button>
                               <button class="btn btn-primary no-print" data-toggle="modal" data-target="#addRxAppointmentModal">Orden de rayos X</button>
                               <button class="btn btn-primary no-print" onclick="window.location.href='resultado-rayosx.php?viewid=<?php echo $vid; ?>'">Resultados_rx</button>
                               <button class="btn btn-primary no-print" style="background-color: orange; border-color: orange; color: white;" data-toggle="modal" data-target="#emitirRecetaModal">Emitir receta</button>
                               <button class="btn btn-primary no-print" onclick="printDiv('printIt')">Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php');?>
    <?php include('include/setting.php'); ?>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $("#addHistorialForm").submit(function(event) {
            event.preventDefault(); // Evita la recarga de la página

            let formData = {
                viewid: "<?php echo isset($_GET['viewid']) ? $_GET['viewid'] : ''; ?>",
                bp: $("#bp").val(),
                bs: $("#bs").val(),
                weight: $("#weight").val(),
                temp: $("#temp").val(),
                exf: $("#exf").val(),
                pres: $("#pres").val(),
                ord: $("#ord").val(),
                evo: $("#evo").val()
            };

            console.log("Enviando datos AJAX:", formData); // Debug en consola

            $.ajax({
                type: "POST",
                url: "add_medical_history.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                    console.log("Respuesta del servidor:", response); // Depuración
                    if (response.status === "success") {
                        alert(response.message);
                        $("#addHistorialModal").modal("hide"); // Cerrar modal
                        location.reload(); // Recargar la vista del paciente
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
                    alert("Error en la solicitud AJAX.");
                }
            });
        });
    });
    </script>
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

<!--Modal crear cita Rayos X-->
<script>
function updaterxOptions() {
    var rxType = document.getElementById('rxType').value;
    var rxIdSelect = document.getElementById('rxId');
    var consultancyFeesInput = document.getElementById('rxConsultancyFees');
    
    // Limpiar las opciones existentes
    rxIdSelect.innerHTML = '<option value="">Seleccione un ID</option>';
    consultancyFeesInput.value = '';
    
    if (rxType) {
        // Hacer una solicitud AJAX para obtener los laboratorios de ese tipo
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_rx_options.php?rxType=' + encodeURIComponent(rxType), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                response.forEach(function(rx) {
                    var option = document.createElement('option');
                    option.value = rx.id;
                    option.text = rx.codigo;
                    rxIdSelect.add(option);
                });
            }
        };
        xhr.send();
    }
}

// Actualiza el costo cuando cambia el ID del laboratorio
document.getElementById('rxId').addEventListener('change', function() {
    var rxId = this.value;
    var consultancyFeesInput = document.getElementById('rxConsultancyFees');
    
    if (rxId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_rx_cost.php?rxId=' + encodeURIComponent(rxId), true);
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
<script>
    $(document).ready(function() {
        $('#categoria').change(function() {
            var categoriaId = $(this).val();
            $.ajax({
                url: 'get_medicamentos.php',
                type: 'post',
                data: {categoria: categoriaId},
                dataType: 'json',
                success:function(response) {
                    var len = response.length;
                    $('#medicamento_id').empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var nombre = response[i]['nombre'];
                        $('#medicamento_id').append("<option value='"+id+"'>"+nombre+"</option>");
                    }
                }
            });
        });
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


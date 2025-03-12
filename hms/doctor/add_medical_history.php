<?php
include('include/config.php');
header('Content-Type: application/json'); // Forzar respuesta JSON

// Depuración: Activar para ver errores en PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar que la petición sea POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
    exit();
}

// Verificar que los datos existen
if (!isset($_POST['viewid']) || !isset($_POST['appointmentid']) || !isset($_POST['bp'])) {
    echo json_encode(["status" => "error", "message" => "Faltan datos en la solicitud"]);
    exit();
}

// Obtener los datos
$vid = mysqli_real_escape_string($con, $_POST['viewid']);
$appointmentid = mysqli_real_escape_string($con, $_POST['appointmentid']);
$bp = mysqli_real_escape_string($con, $_POST['bp']);
$bs = mysqli_real_escape_string($con, $_POST['bs']);
$weight = mysqli_real_escape_string($con, $_POST['weight']);
$temp = mysqli_real_escape_string($con, $_POST['temp']);
$exf = mysqli_real_escape_string($con, $_POST['exf']);
$pres = mysqli_real_escape_string($con, $_POST['pres']);
$ord = mysqli_real_escape_string($con, $_POST['ord']);
$evo = mysqli_real_escape_string($con, $_POST['evo']);

// Insertar historial médico
$query = mysqli_query($con, "INSERT INTO tblmedicalhistory 
    (PatientID, BloodPressure, BloodSugar, Weight, Temperature, ExamenFisico, MedicalPres, OrdenesMedicas, Evolucion) 
    VALUES ('$vid', '$bp', '$bs', '$weight', '$temp', '$exf', '$pres', '$ord', '$evo')");

if ($query) {
    // Actualizar la cita para marcarla como finalizada
    $updateQuery = mysqli_query($con, "UPDATE appointment SET doctorStatus = 2, updationDate = NOW() WHERE id = '$appointmentid'");

    if ($updateQuery) {
        echo json_encode(["status" => "success", "message" => "Historial médico agregado y cita finalizada"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar la cita: " . mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error en la consulta: " . mysqli_error($con)]);
}
?>
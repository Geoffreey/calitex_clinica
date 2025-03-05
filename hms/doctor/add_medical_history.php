<?php
session_start();
include 'include/config.php';

// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Asegurar respuesta JSON

if (!isset($_POST['viewid']) || empty($_POST['viewid'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID del paciente no recibido']);
    exit();
}

// Capturar datos del formulario
$viewid = $_POST['viewid'];
$bloodPressure = $_POST['bp']; 
$bloodSugar = $_POST['bs'];      
$weight = $_POST['weight']; 
$temperature = $_POST['temp'];
$examenFisico = $_POST['exf'];
$medicalPres = $_POST['pres'];
$ordenesMedicas = $_POST['ord'];
$evolucion = $_POST['evo'];

// Depuración: Verificar qué datos se están enviando
file_put_contents("debug_log.txt", json_encode($_POST) . PHP_EOL, FILE_APPEND);

// Insertar en la tabla `tblmedicalhistory`
$query = mysqli_query($con, "INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, ExamenFisico, MedicalPres, OrdenesMedicas, Evolucion) 
                             VALUES ('$viewid', '$bloodPressure', '$bloodSugar', '$weight', '$temperature', '$examenFisico', '$medicalPres', '$ordenesMedicas', '$evolucion')");

if ($query) {
    echo json_encode(['status' => 'success', 'message' => 'Historial médico agregado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error SQL: ' . mysqli_error($con)]);
}
?>
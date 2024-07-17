<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit'])) {
    $appointment_id = $_POST['appointmentId'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type
    $allowed_types = array("jpg", "png", "jpeg", "pdf", "doc", "docx", "xls", "xlsx");
    if(!in_array($file_type, $allowed_types)) {
        echo "Tipo de archivo no permitido.";
        exit;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "El archivo ya existe.";
        exit;
    }

    // Check file size (you can adjust this as per your requirement)
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
        echo "El archivo es demasiado grande.";
        exit;
    }

    // Move the file to the uploads directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Insert file details into the database
        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $query = "INSERT INTO tblfiles (AppointmentID, FileName, FileType, FilePath) VALUES ('$appointment_id', '$file_name', '$file_type', '$target_file')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "El archivo ha sido subido exitosamente.";
            // Redireccionar a la página de historial de citas
            header('Location: appointment-history.php');
            exit;
        } else {
            echo "Error al guardar la información del archivo: " . mysqli_error($con);
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>



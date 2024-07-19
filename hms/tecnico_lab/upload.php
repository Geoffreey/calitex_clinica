<?php
session_start();
include 'include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        $_SESSION['msg'] = "El archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['msg'] = "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf" && $fileType != "docx" && $fileType != "xlsx") {
        $_SESSION['msg'] = "Solo se permiten archivos JPG, JPEG, PNG, PDF, DOCX, y XLSX.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 por un error
    if ($uploadOk == 0) {
        $_SESSION['msg'] = "El archivo no fue subido.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $filePath = $target_file;
            $appointmentId = $_POST['appointmentId'];

            // Insertar el registro del archivo en la base de datos
            $query = "INSERT INTO tblfiles (FileName, FileType, FilePath, appointment_id) VALUES ('$fileName', '$fileType', '$filePath', '$appointmentId')";
            if (mysqli_query($con, $query)) {
                $_SESSION['msg'] = "El archivo " . htmlspecialchars($fileName) . " ha sido subido.";
            } else {
                $_SESSION['msg'] = "Error al subir el archivo: " . mysqli_error($con);
            }
        } else {
            $_SESSION['msg'] = "Hubo un error al subir el archivo.";
        }
    }

    header("Location: appointment-history.php");
    exit();
}
?>















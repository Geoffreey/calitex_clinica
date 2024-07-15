<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Debugging outputs
    echo "Target Directory: " . $target_dir . "<br>";
    echo "Target File: " . $target_file . "<br>";
    echo "File Type: " . $file_type . "<br>";

    // Check file type
    $allowed_types = array("jpg", "png", "jpeg", "pdf", "doc", "docx", "xls", "xlsx");
    if(in_array($file_type, $allowed_types)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "File has been uploaded to: " . $target_file . "<br>";
            $query = "INSERT INTO tblfiles (PatientID, FileName, FileType, FilePath) VALUES ('$patient_id', '".basename($_FILES["file"]["name"])."', '$file_type', '$target_file')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "El archivo ha sido subido exitosamente.";
                echo "<script>window.location.href ='manage-patient.php?viewid=$patient_id'</script>";
            } else {
                echo "Error al guardar la información del archivo: " . mysqli_error($con);
            }
        } else {
            echo "Error al subir el archivo.<br>";
            echo "move_uploaded_file error details:<br>";
            var_dump($_FILES["file"]["error"]);
        }
    } else {
        echo "Tipo de archivo no permitido.";
    }
}
?>




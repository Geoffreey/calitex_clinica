<?php

// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $vid = $_GET['viewid'];
    $tipo = $_POST['Tipo'];
    $nombre = $_POST['Nombre'];
    

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos
            include "db.php";
            $sql = "INSERT INTO tblresultadoslab (PatientID,Tipo, Nombre, archivo) 
            VALUES ( '$vid', '$tipo','$nombre', '$nombre_archivo')";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "<script language='JavaScript'>
                alert('Se cargo el resultado con exito');
                location.assign('../manage-patient.php');
                </script>";
            } else {

                echo "<script language='JavaScript'>
                alert('Error al subir resultado: ');
                location.assign('../manage-patient.php');
                </script>";
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Error al subir resultado. ');
            location.assign('../manage-patient.php');
            </script>";
        }
    } else {
        echo "<script language='JavaScript'>
        alert('Solo se permiten archivos PDF, DOC y DOCX.');
        location.assign('../manage-patient.php');
        </script>";
    }
}

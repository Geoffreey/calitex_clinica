<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

$receta_id = $_GET['id'];

$query = "SELECT r.fecha, r.notas, d.nombre AS doctor, p.nombre AS paciente 
          FROM recetas r
          JOIN tbldoctor d ON r.doctor_id = d.id
          JOIN tblpatient p ON r.paciente_id = p.id
          WHERE r.id = '$receta_id'";

$result = mysqli_query($con, $query);
$receta = mysqli_fetch_assoc($result);

$medicamentos_query = "SELECT medicamento, dosis, frecuencia, duracion FROM detalles_receta WHERE receta_id = '$receta_id'";
$medicamentos_result = mysqli_query($con, $medicamentos_query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Receta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Detalle de Receta</h2>
<p><strong>Fecha:</strong> <?php echo $receta['fecha']; ?></p>
<p><strong>Doctor:</strong> <?php echo $receta['doctor']; ?></p>
<p><strong>Paciente:</strong> <?php echo $receta['paciente']; ?></p>
<p><strong>Notas:</strong> <?php echo $receta['notas']; ?></p>

<h3>Medicamentos Recetados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Medicamento</th>
            <th>Dosis</th>
            <th>Frecuencia</th>
            <th>Duración</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($med = mysqli_fetch_assoc($medicamentos_result)) { ?>
        <tr>
            <td><?php echo $med['medicamento']; ?></td>
            <td><?php echo $med['dosis']; ?></td>
            <td><?php echo $med['frecuencia']; ?></td>
            <td><?php echo $med['duracion']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<a href="recetas.php">Volver</a>

</body>
</html>
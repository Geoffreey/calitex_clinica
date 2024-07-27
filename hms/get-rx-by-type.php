<?php
// Incluir archivo de configuración de la base de datos
include 'include/config.php';

// Obtener el tipo de laboratorio del POST
$rxtype = $_POST['rxtype'];

// Consulta SQL para obtener id, nombre y costo de los laboratorios del tipo especificado
$query = "SELECT id, nombre, costo FROM rayosx WHERE tipo = '$rxtype'";
$result = mysqli_query($con, $query);

// Verificar si se obtuvieron resultados
if (mysqli_num_rows($result) > 0) {
    // Generar opciones para el select basado en los resultados de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '" data-costo="' . $row['costo'] . '">' . $row['nombre'] . '</option>';
    }
} else {
    // Si no hay resultados, podrías devolver un mensaje o manejarlo según tus necesidades
    echo '<option value="">No hay laboratorios disponibles</option>';
}

// Cerrar la conexión a la base de datos (si es necesario)
mysqli_close($con);
?>
<?php
$ret=mysqli_query($con,"select * from tbllabresults where PatientID='$vid'");
if(mysqli_num_rows($ret) > 0) {
    echo "<h5>Historial de Laboratorios:</h5>";
    echo "<table class='table table-bordered'>";
    echo "<tr><th>Fecha</th><th>Resultados</th></tr>";
    while($row=mysqli_fetch_array($ret)) {
        echo "<tr>";
        echo "<td>".$row['LabDate']."</td>";
        echo "<td>".$row['Results']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay resultados de laboratorio.";
}
?>

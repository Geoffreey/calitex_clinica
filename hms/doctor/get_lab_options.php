<?php
include('include/config.php');

$labType = $_GET['labType'];

$query = mysqli_query($con, "SELECT id, codigo FROM laboratories WHERE tipo = '$labType'");
$labs = array();

while ($row = mysqli_fetch_assoc($query)) {
    $labs[] = $row;
}

echo json_encode($labs);
?>

<?php
include('include/config.php');

$rxType = $_GET['rxType'];

$query = mysqli_query($con, "SELECT id, codigo FROM rayosx WHERE tipo = '$rxType'");
$rxs = array();

while ($row = mysqli_fetch_assoc($query)) {
    $rxs[] = $row;
}

echo json_encode($rxs);
?>
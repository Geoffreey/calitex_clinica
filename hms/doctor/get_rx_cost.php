<?php
include('include/config.php');

$rxId = $_GET['rxId'];

$query = mysqli_query($con, "SELECT costo FROM rayosx WHERE id = '$rxId'");
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>
<?php
include('include/config.php');

$labId = $_GET['labId'];

$query = mysqli_query($con, "SELECT costo FROM laboratories WHERE id = '$labId'");
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
?>

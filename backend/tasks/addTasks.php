<?php

include '../config.php';
include '../function.php';

extract($_GET);
$db = dbConn();
$sql = "SELECT * FROM technicianitems WHERE AppointmentId='$AppointmentId'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

echo $row['AppointmentId'];
?>
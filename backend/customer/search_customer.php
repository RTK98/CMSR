<?php

include '../config.php';
include '../function.php';

extract($_GET);
$db = dbConn();
$sql = "SELECT * FROM customer WHERE NIC='$NIC'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

echo $row['FirstName'];
?>
<?php

session_start();
include'config.php';
include'function.php';

date_default_timezone_set("Asia/Colombo");

$userId = $_SESSION['userId'];
$LogoutDate = date('Y-m-d');
$LogoutTime = date("H:i");
$db = dbconn();
$sqlLogOut = "UPDATE attendance SET LogoutTime='$LogoutTime',LogoutDate='$LogoutDate',Status='0'WHERE UserId='$userId' AND LoggedDate='$LogoutDate'";
$db->query($sqlLogOut);
header("Location:login.php");
session_destroy();
?>
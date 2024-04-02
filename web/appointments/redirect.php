<?php

ob_start();
include '../header.php';

extract($_POST);

if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "redirectz") {


    echo $slotnameid;
    echo $requestdate;

    if (!isset($_SESSION['CustomerID'])) {
        $_SESSION['slotnameid'] = $slotnameid;
        $_SESSION['reqdate'] = $requestdate;
        header("Location:../customer/login.php?page=booking");
    } else {
        $_SESSION['slotnameid'] = $slotnameid;
        $_SESSION['reqdate'] = $requestdate;
        header("Location:addAppointment.php");
    }
}
ob_end_flush();
?>
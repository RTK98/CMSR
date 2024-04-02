<?php
date_default_timezone_set('Asia/Colombo');
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location:login.php');
}
include 'config.php';
include 'function.php';
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMSR - Dashboard</title>
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATH ?>assets/css/dashboard.css" rel="stylesheet">
        <script src="<?= SYSTEM_PATH ?>assets/js/sweetalert2.all.js"></script>
        <link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/sweetalert2.min.css">
    </head>

    <body style="background-color: #E8E7E7; color:black;">
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="<?= SYSTEM_PATH ?>../web/index.php">
                <img src="<?= SYSTEM_PATH ?>assets/img/logo.png" alt="Bootstrappin'">
            </a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h3 style="color:white;text-transform: uppercase;">Welcome <?= "" . $_SESSION["userrole"] ?>
                <?= "" . $_SESSION["FirstName"] ?></h3>
            <!--            <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">-->
            <div class="navbar-nav">
                <nav>
                    <img src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?=  $_SESSION['UserImage'] ?>" class="user-pic" onclick="toggleMenu()">
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <img src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?=  $_SESSION['UserImage'] ?>">
                                <h3><?= $_SESSION["FirstName"] ?><?= $_SESSION["LastName"] ?></h3>
                            </div>
                            <hr>
                            <a href="<?= SYSTEM_PATH ?>logout.php" class="sub-menu-link">
                                <img src="<?= SYSTEM_PATH ?>assets/img/logout.png">
                                <p>Log out</p>
                                <span>></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
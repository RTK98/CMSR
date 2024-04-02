<?php
$userRole=$_SESSION['userrole'];
$dashboard="user/dashboard/".$userRole.".php";
include $dashboard;
?>
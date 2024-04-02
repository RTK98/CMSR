<?php
$userRole=$_SESSION['userrole'];
$menu="user/menu/".$userRole.".php";
include $menu;

?>
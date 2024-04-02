

<?php
include '../function.php';
include '../config.php';

$id=$_GET['Id'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_category SET categoryStatus=$status WHERE categoryid=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:categories.php');




?>
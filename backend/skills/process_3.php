<?php

session_start();
include '../config.php';
include '../function.php';
extract($_POST);
@$emp_id = $_POST['option7'];
@$skill_id = $_POST['option8'];

////Best Skill Service
if (!empty($emp_id && $skill_id)) {
    $db = dbconn();
    $sql = "SELECT * FROM bestskills WHERE emp_id='$emp_id' AND skill_id='$skill_id'";
    $sql2 = "SELECT * FROM nskills WHERE emp_id='$emp_id' AND skill_id='$skill_id'";
    $result = $db->query($sql);
    $result1 = $db->query($sql2);

    $skillexist = false;
    $errormsg = '';
//    echo $result->num_rows;

    if (($result->num_rows > 0) || ($result1->num_rows > 0)) {
        $skillexist = true;
    }

    if (($result->num_rows > 0)) {
        $errormsg = 'The Best Skill Already Exists on Technician!';
    } else if ($result1->num_rows > 0) {
        $errormsg = 'This Skill Already Existsas General skill on this Technician!';
    }
    if ($skillexist) {
        echo $messages['error_Vehicle_TimeSlot_Date'] = $errormsg;
    } else {
        $db = dbConn();
        $AddDate = date('Y-m-d');
        echo $userId = $_SESSION['userId'];
        echo $sql = "INSERT INTO bestskills (emp_id,skill_id,AddUser,AddDate) VALUES ('$emp_id','$skill_id','$userId' ,'$AddDate') ";
        $result = $db->query($sql);
    }
}
?>
<?php

session_start();
include '../config.php';
include '../function.php';
extract($_POST);
@$emp_id = $_POST['options'];
@$skill_id = $_POST['options1'];

//Genral Skill Service
if (!empty($emp_id && $skill_id)) {
    $db = dbconn();
    $sql1 = "SELECT * FROM nskills WHERE emp_id='$emp_id' AND skill_id='$skill_id'";
    $result1 = $db->query($sql1);

    if ($result1->num_rows > 0) {
         $messages['error_Vehicle_TimeSlot_Date'] = "The General Skill Already Exists on Technician!";
    } else {
        $db = dbConn();
        $AddDate = date('Y-m-d');
        echo $userId = $_SESSION['userId'];
         $sql = "INSERT INTO nSkills (emp_id,skill_id,AddUser,AddDate) VALUES ('$emp_id','$skill_id','$userId' ,'$AddDate') ";
        $result = $db->query($sql);
    }
}
?>
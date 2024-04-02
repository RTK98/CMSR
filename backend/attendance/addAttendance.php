<?php

date_default_timezone_set('Asia/Colombo');
include '../config.php';
include '../function.php';
extract($_POST);
$UserId = $_POST["options1"];
?>
<?php

$UserId;
$Today = date('Y-m-d');
$currentTime = date('H:i:s');
$messages = array();
if (!empty($UserId)) {

    $Today = date('Y-m-d');
    $db = dbconn();
    $sqlSelect = "SELECT * FROM empattendance WHERE EmpId='$UserId' AND Date='$Today'";
    $resultSelectEmp = $db->query($sqlSelect);
    if ($resultSelectEmp->num_rows > 0) {
        $messages['error_Attendance_Checkin'] = "The Employee is Already Checked-in !";
    } else {
        $db = dbConn();
        $currentTime = date('H:i:s');
        $sql = "INSERT INTO empattendance (EmpId, CheckingTime, Date) VALUES ('$UserId', '$currentTime', '$Today')";
        $result = $db->query($sql);
        if ($result) {
            $messages['error_Attendance_Checkin_success'] = "Attendance checked-in successfully!";
        } else {
            $messages['error_Attendance_Checkin_error'] = "Error while checking in attendance.";
        }
    }
    // Generate HTML of state options list
    if (!empty($messages)) {
        echo '<div class="text-danger">' . @$messages['error_Attendance_Checkin'] . '</div>';
        echo '<div class="text-danger">' . @$messages['error_Attendance_Checkin_error'] . '</div>';
        echo '<div class="text-success">' . @$messages['error_Attendance_Checkin_success'] . '</div>';
    }
}


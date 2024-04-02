<?php

date_default_timezone_set('Asia/Colombo');
include '../config.php';
include '../function.php';
extract($_POST);
echo $UserId = $_POST["options3"];
?>
<?php

$Today = date('Y-m-d');
$currentTime = date('H:i:s');
$messages = array();
if (!empty($UserId)) {

    $Today = date('Y-m-d');
    $db = dbconn();
     $sql = "SELECT * FROM empattendance WHERE EmpId='$UserId' AND Date='$Today' AND CheckoutTime='$currentTime'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $messages['error_Attendance_Checkin'] = "The Employee is Already Checked-in !";
    }

    if (empty($UserId)) {
        $db = dbConn();
        $Today = date('Y-m-d');
        $currentTime = date('H:i:s');

         $sql = "UPDATE empattendance SET CheckoutTime='$currentTime' WHERE EmpId='$UserId' AND Date='$Today'";

        $result = $db->query($sql);
    }
    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class = "text-danger">' . @$messages["error_Attendance_Checkin"] . '</div>';
        }
    } else {
        echo '<option value="">City Not Selected</option>';
    }
}


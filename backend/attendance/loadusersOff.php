<?php

date_default_timezone_set('Asia/Colombo');
include '../config.php';
include '../function.php';
extract($_POST);
echo $UserId = $_POST["options2"];
?>
<?php

extract($_POST);

if (!empty($UserId)) {
    $db = dbConn();
    $db = dbConn();
    $Today = date('Y-m-d');
    
    $currentTime = date('H:i:s');
    $sql = "SELECT * FROM users WHERE UserId='$UserId' AND Status='1'";

    $sql2 = "UPDATE empattendance SET CheckoutTime='$currentTime' WHERE EmpId='$UserId' AND Date='$Today'";
    $result2 = $db->query($sql2);

    $result = $db->query($sql);

// Generate HTML of state options list 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Today = date('Y-m-d');
            $currentTime = date('H: i');
            $UserId = $row['UserId'];
            $UserRole = ucwords($row['UserRole']);
            $empName = ucwords($row['FirstName'] . ' ' . $row['LastName']);
            echo '<div class = "row">';
            echo '<div class = "col-6">Employee Name : </div>';
            echo '<div class = "col-6">' . "$empName" . '</div>';
            echo '</div>';
            echo '<div class = "row">';
            echo '<div class = "col-6">Date : ' . "$Today" . '</div>';
            echo '<div class = "col-6">Time :' . "$currentTime" . '</div>';
            echo '</div>';
            echo '<div class = "row">';
            echo '<div class = "col-6">Designation : ' . "$UserRole" . '</div>';
//            echo '<form action=viewAttendance.php>';
//            echo'</form>';
        }
    } else {
        echo '<option value="">City Not Selected 2</option>';
    }
}


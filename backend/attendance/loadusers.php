<?php

date_default_timezone_set('Asia/Colombo');
include '../config.php';
include '../function.php';
extract($_POST);
echo $UserId = $_POST["options"];
?>
<?php

extract($_POST);

if (!empty($UserId)) {
    $db = dbConn();
    $sql = "SELECT * FROM users WHERE UserId='$UserId' AND Status='1'";

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
            echo '<input type="hidden" name="UserId" id="UserIDTemp" value="'.$UserId.'">';
            echo "<div class = 'col-6'><button type='button' class='btn btn-sm btn-danger' action='add' onclick='InsertData()'>Add</button></div>";
//            echo'</form>';
        }
    } else {
        echo '<option value="">City Not Selected</option>';
    }
}


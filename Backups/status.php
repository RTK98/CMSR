<?php

include '../../header.php';?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'Deactive') {

    $db = dbConn();
    echo $UserId;

    echo $sqlselctuser = "SELECT * FROM tbl_users WHERE UserId='$UserId'";
    $resultselect = $db->query($sqlselctuser);
    $rowresult = $resultselect->fetch_assoc();
    $role = $rowresult['UserRole'];
    echo $checkuserrole = "SELECT * from tbl_users WHERE UserRole='$role' and Status='1'";
    $resultcheck = $db->query($checkuserrole);
    if ($resultcheck->num_rows == 1) {
        echo "only one user";
        echo "<script>
        Swal.fire({
            title: 'Warning!',
            text: 'Only one user created for this desigantion can not let the user deactivated. it may cause can not function the system well.',
            icon: 'warning',
            confirmButtonText: 'Go Back'
        }).then(() => {
            window.location.href = 'userManagement.php'; // Redirect to success page
        });
    </script>";
    } elseif ($resultcheck->num_rows >= 2) {
        
        
        
        
        $sqlupdatestatus = "UPDATE tbl_users SET  Status='0' WHERE UserId='$UserId'";
        $resultchange = $db->query($sqlupdatestatus);
        ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User Status change to activated',
                icon: 'warning',
                confirmButtonText: 'Go Back'
            }).then(() => {
                window.location.href = 'userManagement.php'; // Redirect to success page
            });
            </script><?php

    }
}
?>

        
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'Active') {

    $db = dbConn();
    echo $UserId;
        $sqlupdatestatus = "UPDATE tbl_users SET  Status='1' WHERE UserId='$UserId'";
        $resultchange = $db->query($sqlupdatestatus);
        ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User Status change to activated',
                icon: 'warning',
                confirmButtonText: 'Go Back'
            }).then(() => {
                window.location.href = 'userManagement.php'; // Redirect to success page
            });
            </script><?php

    
}
?>
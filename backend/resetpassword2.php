<?php
ob_start();
session_start();
include 'config.php';
include 'function.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMSR - Reset Password</title>
        <link href="assets/img/logo.png" rel="icon">
        <script src="<?= SYSTEM_PATH ?>assets/js/sweetalert2.all.js"></script>
        <link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/sweetalert2.min.css">
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet" >
        <link href="<?= SYSTEM_PATH ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto border border-3 border-info">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                extract($_POST);
                $resettokennumber = inputTrim($resettokennumber);
                $password = inputTrim($password);
                $confirmpassword = inputTrim($confirmpassword);

                $messages = array();
                if (empty($resettokennumber)) {
                    $messages['error_token'] = "The  Token  should not be blank!";
                }
                if (empty($password)) {
                    $messages['error_password'] = "The New password should not be blank!";
                }
                if (empty($confirmpassword)) {
                    $messages['error_confirmpassword'] = "The Confirm password should not be blank!";
                }

                if (!empty($password)) {
                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $specialChars = preg_match('@[^\w]@', $password);
                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                        $messages['error_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
                    }
                }


                if ((!empty($password)) && (!empty($confirmpassword))) {

                    if ($password != $confirmpassword) {
                        $messages['error_password'] = " Passwords are not match";
                    }
                }

                if (!empty($resettokennumber)) {
                    $sql = "SELECT * FROM users WHERE passwordreset= '$resettokennumber' ";
                    $db = dbConn();
                    $results = $db->query($sql);
                    if ($results->num_rows > 0) {
                        
                    } else {
                        $messages['error_token'] = "This code is invalid in the database";
                    }
                }


                if (empty($messages)) {
                    $password = sha1($password);
                    $resetuseridpassword2 = $_SESSION['UserId'];

                    $sql = "UPDATE  users SET Password= '$password' WHERE UserId= '$resetuseridpassword2' ";
                    $db = dbConn();
                    $results = $db->query($sql)
                    ?>

                    <script>
                        Swal.fire({
        //                            title: 'Success!',
        //                            text: 'Password has been reset',
        //                            icon: 'success',
        //                            position: 'top-right',
        //                            showConfirmButton: true,
                            toast: true,
                            icon: 'success',
                            title: 'Password has been reset Successfully',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = 'login.php'; // Redirect to success page
                        });
             </script><?php
                }
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <img class="mb-4 img-fluid" src="<?= SYSTEM_PATH ?>assets/img/logo.png" width="80px" style="border-radius: 50%;" alt="logo" >
                <h1 class="h3 mb-3 fw-normal"> New Password</h1>

                <div class="text-danger" >  
                    <?php echo @$messages['error_token']; ?>
                </div>
                <div class="text-danger"> 
                    <?php echo @$messages['error_password']; ?>
                </div>
                <div class="text-danger">  
                    <?php echo @$messages['error_confirmpassword']; ?>
                </div>

                <div class="form-floating mb-2" >
                    <input type="text" class="form-control" placeholder="name@example.com" name="resettokennumber" id="resettokennumber" value="<?= @$resettokennumber; ?>">
                    <label for="floatingInput">Reset Token Number</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control"  placeholder="Password" name="password" id="password" value="<?= @$password; ?>">
                    <label for="floatingPassword">New Password</label>
                </div>
                <div class="form-floating mb-2" >
                    <input type="password" class="form-control" placeholder="name@example.com" name="confirmpassword" id="confirmpassword" value="<?= @$confirmpassword; ?>">
                    <label for="floatingInput"> Confirm Password</label>
                </div>


                <button class="w-100 btn btn-lg btn-primary" type="submit">Reset Password</button>

            </form>
        </main>
    </body>
</html>
<?php ob_end_flush(); ?>
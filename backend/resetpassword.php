<?php
ob_start();
session_start();
include 'config.php';
include 'function.php';
include 'assets/phpmail/mail.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMSR - Reset Password</title>
        <link href="assets/img/logo.png" rel="icon">
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet" >
        <link href="<?= SYSTEM_PATH ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto border border-3 border-info">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                extract($_POST);
                $Email = inputTrim($Email);

                $messages = array();

                if (empty($Email)) {
                    $messages['error_username'] = "The email should not be blank!";
                }


                if (empty($messages)) {
                    $db = dbConn();

                    $sql = "SELECT Email,UserId FROM users WHERE Email='$Email' ";
                    $result = $db->query($sql);
                    $result->num_rows;
                    if ($result->num_rows <= 0) {
                        $messages['error_invalid'] = "Invalid email Address!";
                    } else {
                        $row = $result->fetch_assoc();
//                        Sessions creating for user

                        $_SESSION['UserId'] = $row['UserId'];
                        $resetuserid = $_SESSION['UserId'];
                        $sql = "SELECT * FROM users WHERE UserId= $resetuserid ";

//                        start
                        //these session used to send the mails once the password reset could not access previous method so create session storing customer name email title email 
                        $_SESSION['resetuseremail'] = $row['Email'];
                        $_SESSION['resetusertitle'] = $row['Title'];
                        $_SESSION['resetuserfname'] = $row['FirstName'];
                        $_SESSION['resetuserlname'] = $row['LastName'];

                        $titlecustomer = $row['Title'];
                        $firstnamecustomer = $row['FirstName'];
                        $lastnamecustomer = $row['LastName'];
                        $resetcustomerid = $_SESSION['UserId'];
                        $_SESSION['signedinTime'] = time();
                        //left side form value name eka ------ right side database column name eka
                        $resetcustomerid = $_SESSION['UserId'];
//                        end
                        //left side form value name eka ------ right side database column name eka
//                        $_SESSION['Title'] = $row['Title'];
//                        $_SESSION['FirstName'] = $row['FirstName'];
//                        $_SESSION['LastName'] = $row['LastName'];
//                        $_SESSION['UserRole'] = $row['UserRole'];
//                        create session to check users table password colum values
                        $_SESSION['passwordreset'] = $row['passwordreset'];
                        $resetuserdatabase = $_SESSION['passwordreset'];

                        $resettoken = uniqid();
                        $_SESSION['resettoken'] = $resettoken;

//                        create session to capture the users login time to use session time
                        $_SESSION['loggedinTime'] = time();

//                        insert the reset token for the first time
//                        check if the users table password reset column is empty or not
                        if ($resetuserdatabase == null) {
                            $UpdateDate = date('Y-m-d');
//                            if empty nm password reset that means first time resetting the password soe have to insert the value of resettoken to users table
                            $sql = "UPDATE users SET passwordreset = '$resettoken' WHERE UserId = '$resetuserid' ";
                            $sql2 = "UPDATE users SET UpdateDate = '$UpdateDate' WHERE UserId = '$resetuserid' ";
                            $db = dbConn();
                            $results = $db->query($sql);
                            $results = $db->query($sql2);

                            $to = $Email;
                            $toname = $titlecustomer . $firstnamecustomer . $lastnamecustomer;
                            $subject = "Password Reset Token - CMSR";
                            $body = '<!doctype html>
<html lang="en-US">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email">
    <style type="text/css">
    body{background-image:url(https://www.dropbox.com/s/d8fqrtfnmh6x3a0/background.png?raw=1);}
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="#" title="logo" target="_blank">
                            <img width="60" src="https://www.dropbox.com/s/h8nzlij6m45t6cr/logo.png?raw=1" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <h4>' . $resettoken . ' </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Replica Speed Motor Garage V.1.0</strong></p>
                        </td>
                    </tr>
                    <tr>
                       <td style="height:20px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
                            $alt = "Customer  Password Reset";
                            send_email($to, $toname, $subject, $body, $alt);
                            if ($results) {
                                echo "";
                                header("Location:resetpassword2.php");
                            }



                            //print_r($sql);
                        } else {
                            $UpdateDate = date('Y-m-d');
//                            if not empty mean this is not the first password is resetting so have to update the table of user with the new reset token
                            $sql = "UPDATE users SET passwordreset = '$resettoken', UpdateDate=$UpdateDate WHERE UserId = '$resetuserid' ";
                            $sql3 = "UPDATE users SET UpdateDate = '$UpdateDate' WHERE UserId = '$resetuserid' ";
                            $db = dbConn();
                            $results = $db->query($sql);
                            $results = $db->query($sql3);

                            $to = $Email;
                            $toname = $titlecustomer . $firstnamecustomer . $lastnamecustomer;
                            $subject = "Password Reset Token - CMSR";
                            $body = '<!doctype html>
<html lang="en-US">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="#" title="logo" target="_blank">
                            <img width="60" src="https://www.dropbox.com/s/h8nzlij6m45t6cr/logo.png?dl=0" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                       
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <h4>' . $resettoken . ' </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.rakeshmandal.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
                            $alt = "Customer  Password Reset";
                            send_email($to, $toname, $subject, $body, $alt);
                            if ($results) {
                                header("Location:resetpassword2.php");
                            }
                        }


                        echo "success";
                    }
                }
            }
            ?>


            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <img class="mb-4 img-fluid" src="<?= SYSTEM_PATH ?>assets/img/logo.png" width="80px" style="border-radius: 50%;" alt="logo" >
                <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

                <div class="text-danger" >  
                    <?php echo @$messages['error_username']; ?>
                </div>
                <div class="text-danger"> 
                    <?php echo @$messages['error_password']; ?>
                </div>
                <div class="text-danger">  
                    <?php echo @$messages['error_invalid']; ?>
                </div>

                <div class="form-floating mb-2" >
                    <input type="text" class="form-control" placeholder="name@example.com" name="Email" id="Email">
                    <label for="floatingInput">Enter Previous mail address</label>
                </div>



                <button class="w-100 btn btn-lg btn-primary" type="submit">Reset</button>

            </form>
        </main>
    </body>
</html>
<?php ob_end_flush(); ?>
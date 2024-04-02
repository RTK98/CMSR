<?php ob_start(); ?>
<?php $signin = 'active'; ?>

<?php include '../header.php'; ?>
<?php
//include '../menu.php';
?>
<?php include '../assets/phpmail/mail.php'; ?>


<?php
// getting the data from the post method
extract($_GET);
echo @$page;
//checking whether data coming from the method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    //creating email variable 
    $token = cleanInput($token);
    $newpassword = cleanInput($newpassword);
    $conpassword = cleanInput($conpassword);

    $resetcustomerid = $_SESSION['Customerid'];

    $Email = $_SESSION['resetcustomeremail'];
    $titlecustomer = $_SESSION['resetcustomertitle'];
    $firstnamecustomer = $_SESSION['resetcustomerfname'];
    $lastnamecustomer = $_SESSION['resetcustomerlname'];

    $messages = array();

    if (empty($token)) {
        $messages['error_token'] = "The token should not be blank!";
    }
    if (empty($newpassword)) {
        $messages['error_newpassword'] = "The new password should not be blank!";
    }
    if (empty($conpassword)) {
        $messages['error_conpassword'] = "The new confirm password should not be blank!";
    }
    //advanced password

    if (!empty($newpassword)) {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $newpassword);
        $lowercase = preg_match('@[a-z]@', $newpassword);
        $number = preg_match('@[0-9]@', $newpassword);
        $specialChars = preg_match('@[^\w]@', $newpassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newpassword) < 8) {
            $messages['error_newpassword'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
        }
    }

    if ((!empty($newpassword)) && (!empty($conpassword))) {

        if ($newpassword != $conpassword) {
            $messages['error_newpassword'] = " Passwords are not match";
        }
    }


    if (!empty($token)) {

//        print_r($resetcustomerid);
        $sql = "SELECT * FROM tbl_customers WHERE passwordreset='$token' AND CustomerId=$resetcustomerid";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            
        } else {
            $messages['error_token'] = "This Entered token is invalid";
        }
    }


    if (empty($messages)) {
        $db = dbConn();
        $newpassword = sha1($newpassword);
        $sql2 = "UPDATE tbl_customers SET Password = '$newpassword' WHERE CustomerId= '$resetcustomerid'";
        $result2 = $db->query($sql2);

        $to = $Email;
        $toname = $titlecustomer . $firstnamecustomer . $lastnamecustomer;
        $attachment= '../assets/img/signup/jpg';
        $subject = "Password Reset Success - Bluetech Electronics";
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
                          <a href="https://rakeshmandal.com" title="logo" target="_blank">
                            <img width="60" src='.$attachment .' title="logo" alt="logo">
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
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Sucessfully Reset the password !!</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            Your password have been changed.
                                        </p>
                                        <h4> </h4>
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
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong> Bluetechelectronics</strong></p>
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
        $alt = "Customer  Password Reset Success !";
        send_email($to, $toname, $subject, $body, $alt);

        if ($results) {
            echo "";
        }




        header("Location:signin.php");
    }
}
?>


<section class="section-bg">
    <div class="container py-5">
        
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="section-title" >
            <h2>Reset Your Password </h2>
        </div>
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../assets/images/f.png"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <h5>Your password reset token has been sent to the given email. Please check you email and enter the password reset token. . . </h5>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


                    <div class="text-danger">  
                       <?php echo @$messages['error_invalid']; ?>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form1Example13" class="form-control form-control-lg" name="token" value="<?= @$token; ?>"/>
                        <label class="form-label" for="form1Example13">Enter  Reset Token</label>
                        <div class="text-danger" >  
                            <?php echo @$messages['error_token']; ?>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example13" class="form-control form-control-lg" name="newpassword" value="<?= @$newpassword; ?>"/>
                        <label class="form-label" for="form1Example13">Enter  New Password</label>
                        <div class="text-danger" >  
                            <?php echo @$messages['error_newpassword']; ?>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example13" class="form-control form-control-lg" name="conpassword" value="<?= @$conpassword; ?>"/>
                        <label class="form-label" for="form1Example13">Enter  Confirm New Password</label>
                        <div class="text-danger" >  
                            <?php echo @$messages['error_conpassword']; ?>
                        </div>
                    </div>



                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                    </div>


                    <input type="hidden" name="page" value="<?= $page ?>">
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../footer.php'; ?>
<?php ob_end_flush(); ?>
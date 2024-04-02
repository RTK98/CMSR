<?php ob_start(); ?>
<?php $signin = 'active'; ?>

<?php // include 'header.php'; ?>
<?php
include '../header.php';
include '../menu.php';
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
    $Email = cleanInput($Email);

    //createing error messages array
    $messages = array();

    if (empty($Email)) {
        $messages['error_email'] = "The email should not be blank!";
    }


    if (!empty($Email)) {
        $db = dbConn();
//checking whether there have a record where matches with the customer inputs 
        $sql = "SELECT * FROM tbl_customers WHERE Email='$Email'";
        $result = $db->query($sql);
        $result->num_rows;
        if ($result->num_rows <= 0) {
            //if there is no any matched this error message will show
            $messages['error_invalid'] = "The Email is invalid!";
        } else {
            //if there have match it will assigned $row varibale
            $row = $result->fetch_assoc();
            //assign sessions to customer details
            $_SESSION['Customerid'] = $row['CustomerId'];

            //these session used to send the mails once the password reset could not access previous method so create session storing customer name email title email 
            $_SESSION['resetcustomeremail'] = $row['Email'];
            $_SESSION['resetcustomertitle'] = $row['Title'];
            $_SESSION['resetcustomerfname'] = $row['FirstName'];
            $_SESSION['resetcustomerlname'] = $row['LastName'];

            $titlecustomer = $row['Title'];
            $firstnamecustomer = $row['FirstName'];
            $lastnamecustomer = $row['LastName'];
            $resetcustomerid = $_SESSION['Customerid'];
            $_SESSION['signedinTime'] = time();
            //left side form value name eka ------ right side database column name eka
            $resetcustomerid = $_SESSION['Customerid'];

            //creating a unique token to send customer
            $customerresettoken = uniqid();
            //assign that toker to a session
            $_SESSION['resettoken'] = $customerresettoken;

            //checking whetether there have already passowrd reset column have value if there have value assign that value to session password reset then it is easy to chekc the below logic
            echo $_SESSION['passwordreset'] = $row['passwordreset'];

            $customerpasswordreset = $_SESSION['passwordreset'];

            if ($customerpasswordreset == null) {

//              if empty nm password reset that means first time resetting the password soe have to insert the value of resettoken to users table
                // insert ekk kiwwta customerawa hadankotama me field eka null wela thiyenne eka nisa update ekk damme
                $sql = "UPDATE tbl_customers SET passwordreset = '$customerresettoken' WHERE CustomerId = '$resetcustomerid' ";
                print_r($sql);
                $db = dbConn();
                $results = $db->query($sql);
                $to = $Email;
                $toname = $titlecustomer . $firstnamecustomer . $lastnamecustomer;
                $subject = "Password Reset Token - Bluetech Electronics";
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
                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
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
                                        <h4>' . $customerresettoken . ' </h4>
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
                    echo "";
                }
                header("Location:resetpassword2.php");
                //print_r($sql);
                echo '123';
            } else {
//      if not empty mean this is not the first password is resetting so have to update the table of user with the new reset token
                $sql = "UPDATE tbl_customers SET passwordreset = '$customerresettoken' WHERE CustomerId = '$resetcustomerid' ";
                print_r($sql);
                $db = dbConn();
                $results = $db->query($sql);

                $to = $Email;
                $toname = $titlecustomer . $firstnamecustomer . $lastnamecustomer;
                $subject = "Password Reset Token - Bluetech Electronics";
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
                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
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
                                            We cannot simply send you your old password. A unique reset token to  reset your
                                            password has been generated for you. To reset your password, enter the below unique token number and and follow the instructions.
                                        </p>
                                       
                                        <h4>' . $customerresettoken . ' </h4>
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
                    echo "";
                }
                header("Location:resetpassword2.php");
                echo 'abc';
            }
        }
    }
}
?>
<section class="section-bg">
    <div class="container py-5">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="section-title" >
                <h2>Reset Your Password </h2>
            </div>
            <p>To reset your password first you need to verufy that this is legist customer who owns the account. To prove that customer must enter the registered email address with </p>
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../assets/images/f.png"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


                    <!--                    <div class="text-danger">  
                    <?php echo @$messages['error_invalid']; ?>
                                        </div>-->
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <?php if (@$messages['error_email']) { ?>
                            <div class="alert alert-danger" role="alert"> <?= @$messages['error_email']; ?></div> <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (@$messages['error_invalid']) { ?>
                            <div class="alert alert-danger" role="alert"> <?= @$messages['error_invalid']; ?></div> <?php
                        } else {
                            
                        }
                        ?>
                        <h4>Enter the Previous Credentials </h4>
                        <label class="form-label" for="form1Example13">Enter the email address which used to signup process </label>
                        <input type="email" id="form1Example13" class="form-control form-control-lg" name="Email" value="<?= @$Email; ?>"/>
                        <!--                        <label class="form-label" for="form1Example13">Enter  Email address</label>-->
                        <div class="text-danger" >  


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
<?php
session_start();

include'../config.php';
include'../function.php';
?>
<style>
<?php include '/assets/css/login.css';
?>
</style>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMSR - Login</title>

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/login.css" rel="stylesheet">
    </head>

    <body class="text-center" id="main">
        <main class="form-signin w-100 m-auto">
            <?php
            extract($_GET);
            @$page;
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                extract($_POST);
                $Email = inputTrim($Email);
                $Password = inputTrim($Password);
                $pagez;
                $messages = array();
                if (empty($Email)) {
                    $messages['error_email'] = "Username of Password Inavlid";
                }
                if (empty($Password)) {
                    $messages['error_password'] = "Username of Password Inavlid";
                }
//                $_SESSION['Email'] = $Email;
                if (empty($messages)) {
                    $db = dbconn();
                    $Password = sha1($Password);
                    $sql = "SELECT * FROM customer WHERE Email='$Email' AND Password='$Password'";
                    $result = $db->query($sql);
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
//                        echo $row['FirstName'];
                        $_SESSION['FirstName'] = $row['FirstName'];
                        $_SESSION['CustomerID'] = $row['CustomerID'];
                        $_SESSION['LastName'] = $row['LastName'];
                        $_SESSION['Email'] = $row['Email'];
                        $_SESSION['HouseNo'] = $row['HouseNo'];
                        $_SESSION['ContactNo'] = $row['ContactNo'];
                        $_SESSION['Lane'] = $row['Lane'];
                        $_SESSION['Street'] = $row['Street'];
                        $_SESSION['City'] = $row['City'];
                        $_SESSION['NIC'] = $row['NIC'];

//                        $messages['error_valid'] = "Succesfully Login";

                        if (@$pagez) {
                            header("Location:../appointments/addAppointment.php");
                        } else {
                            header("Location:../index.php");
                        }
                    } else {
                        $messages['error_invalid'] = "The Email or Password invalid..!!!";
                    }
                }
            }
            ?>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <img class="mb-4 img-fluid" src="../assets/img/logo" alt="logo" width="80px">
                <h3 class="h3 mb-3 fw-normal">Customer Portal Login</h3>
                <div class="text-danger"><?= @$messages['error_invalid']; ?></div>
                <div class="text-danger"><?= @$messages['error_email']; ?></div>
                <div class="text-danger"><?= @$messages['error_password']; ?></div>
                <div class="form-floating">
                    <!--<input type="email" class="form-control" id="floatingInput Email " name="Email" placeholder="name@example.com" value="<?= @$Email; ?>"-->
                    <input type="email" pattern="[^ @]*@[^ @]*" class="form-control" id="floatingInput Email " name="Email"
                           placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword Password" name="Password"
                           placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <a href="addCustomer.php"value="remember-me" style="color:black;"> Haven't Account? Register!!
                    </label>
                     
                </div>
                   <div class="checkbox mb-3">
                <label>
<!--                        <a href="resetpassword.php"value="restPassword" style="color:black;"> Forgotten password?</a>-->
                    </label>
                         </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

                <input type="hidden" name="pagez" value="<?= @$page ?>">
                <p class="mt-5 mb-3 text-muted">&copy; Replica Speed 2022–<?= date('Y'); ?></p>
            </form>
        </main>



    </body>

</html>
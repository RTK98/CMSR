<?php
ob_start();
include'../../header.php';
include'../../menu.php';
include "../../assets/phpqrcode/phpqrcode/qrlib.php";
include '../../assets/phpmail/mail.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Employee</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewEmp.php" class="btn btn-sm btn-dark">View Employee</a>
            </div>
        </div>
    </div>
    <style type="text/css">
        #passwordInput{
            width: 30%;
            display: flex;
            position: relative;
        }
        #passwordInput input[type="password"], #passwordInput input[type="text"]{
            width: 100%;
            padding: 10px;
            border: 1px solid lightgrey;
            font-size: 15px;

        }
        #passwordInput #showHide{
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            color:red;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
        }
        #passwordStrength{
            width: 30%;
            height: 5px;
            margin: 5px 0;
            display: none;
        }
        #passwordStrength span{
            position: relative;
            height: 100%;
            width: 100%;
            background: lightgrey;
            border-radius: 5px;
        }
        #passwordStrength span:nth-child(2){
            margin: 0 3px;
        }
        #passwordStrength span.active:before{
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            border-radius: 5px;
        }
        #passwordStrength span#poor:before{
            background-color: #ff4757;
        }
        #passwordStrength span#weak:before{
            background-color: orange;
        }
        #passwordStrength span#strong:before{
            background-color: #23ad5c;
        }
        #passwordInfo{
            font-size: 15px;
        }
        #passwordInfo #poor{
            color: red;
        }
        #passwordInfo #weak{
            color: orange;
        }
        #passwordInfo #strong{
            color: green;
        }
    </style>
    <div class="card" style="background-color: #e1e3ef; font-weight: bold;">
        <div class="card-header" style="background-color: #cfd2e5;">
            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                 style="
                 width:60px;
                 display: block;
                 margin: 0 auto;
                 ">
            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
            <p class='m-1' style="text-align: center; font-weight: bold;">130A, Horahena Rd, Pannipitiya.</p>
            <p class='m-1' style="text-align: center; font-weight: bold;">0779 200 480</p>

        </div>
        <?php
        extract($_POST);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $FirstName = inputTrim($FirstName);
            $LastName = inputTrim($LastName);
            echo $NIC = inputTrim($NIC);
            $HouseNo = inputTrim($HouseNo);
            $Lane1 = inputTrim($Lane1);
            $Lane2 = inputTrim($Lane2);
            $ContactNo = inputTrim($ContactNo);
            $Email = inputTrim($Email);
            $BirthDay = inputTrim($BirthDay);
            $PasswordEmail = inputTrim($Password);
            $Password = inputTrim($Password);
            $cPassword = inputTrim($cPassword);
            $UserImage = $_FILES['UserImage'];

            $messages = array();
            if ($UserRole == "") {
                $messages['error_User_Role'] = "Select the Desgination..!";
            }
            if ($Department == "") {
                $messages['error_Department'] = "Select the Employee Department..!";
            }
            if ($Title == "") {
                $messages['error_Title'] = "Select the Employee Title..!";
            }
            if (empty($FirstName)) {
                $messages['error_First_Name'] = "The First Name should not be blank..!";
            }
            if (empty($LastName)) {
                $messages['error_Last_Name'] = "The Last Name should not be blank..!";
            }
            if (empty($BirthDay)) {
                $messages['error_Birthday'] = "The Birthday should not be blank..!";
            }
            if (empty($NIC)) {
                $messages['error_NIC'] = "The NIC should not be blank..!";
            }
            if (!empty($NIC)) {
                echo $length = strlen($NIC);
                if ($length == 10 || $length == 12) {
                    
                } else {
                    $messages['error_mNic'] = "The NIC have only 10 or 12 Digits";
                }
            }
            if ($_FILES['UserImage']['name'] == "") {
                $messages['error_UserImage'] = "Please Upload the Image..!";
            }
            if (empty($HouseNo)) {
                $messages['error_House_No'] = "The House No should not be blank..!";
            }
            if (empty($Lane1)) {
                $messages['error_Lane_1'] = "The Lane 1 should not be blank..!";
            }
            if ($ProvinceName == "") {
                $messages['error_City1'] = "The Province should not be blank..!";
            }
            if ($DistrictName == "") {
                $messages['error_City2'] = "The District should not be blank..!";
            }
            if ($CityName == "") {
                $messages['error_City3'] = "The City should not be blank..!";
            }
            if (empty($Email)) {
                $messages['error_Email'] = "The Email should not be blank..!";
            }
            //Password Validation
            if (empty($Password)) {
                $messages['error_Password_Type'] = "The Password should not be blank..!";
            }
            if (empty($cPassword)) {
                $messages['error_confirm_Password'] = "The Confirm Password should not be blank..!";
            }
            if (!isset($Gender)) {
                $messages['error_Gender'] = "The Gender should not be blank..!";
            }
            if (!isset($Title)) {
                $messages['error_Title'] = "Please Select the Title..!";
            }
            if (empty($ContactNo)) {
                $messages['error_Phone_No'] = "Phone No Should Not be Blank..!";
            }
            if (!empty($NIC)) {
                $sql = "SELECT * FROM users WHERE NIC='$NIC'";
                $db = dbConn();
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_mNic'] = "This member is already exsist..!";
                }
            }
            //NIC advanced validation

            if (!empty($BirthDay)) {

                $niclength = strlen($NIC);

                if ($niclength == 10) {


                    $nicv = substr($NIC, -1);
                    $nicv = strtolower($nicv);
                    if ($nicv == 'x' || $nicv == 'v') {
                        
                    } else {

                        $messages['error_mNic'] = "The NIC  Should have X or V ..!";
                    }


                    if (!empty($Gender)) {

                        echo "<br>";
                        $nicbirth = substr($NIC, 0, 2);
                        echo "<br>";
                        $birthdaybirthday = substr($BirthDay, 2, 2);
                        echo "<br>";
//                                               
                        if ($nicbirth == $birthdaybirthday) {
                            
                        } else {
                            $messages['error_mNic'] = "The NIC  birthday and entered Date of birthday are not matched!";
                            $messages['error_mDob'] = "The NIC  birthday and entered Date of birthday are not matched!";
                        }
                    }
                    if (isset($Gender)) {

                        $nicgender = substr($NIC, 2, 3);
                        if ($nicgender < 500 && $Gender != 1) {
                            $messages['error_mNic'] = "The NIC  gender and seleted gender  are not matched!";
                            $messages['error_mDob'] = "The NIC  gender and seleted gender  are not matched!";
                        }

                        if ($nicgender > 500 && $Gender != 2) {
                            $messages['error_mNic'] = "The NIC  gender and seleted gender  are not matched!";
                            $messages['error_mDob'] = "The NIC and Birthday is not Matched!";
                        }
                    }
                }

                //nic 12 digits validation
                if ($niclength == 12) {

                    if (preg_match('/[a-zA-Z]/', $NIC)) {
                        $messages['error_mNic'] = "The 12 Digits NIC should not contains any characters!";
                    } else {
                        
                    }


                    if (!empty($BirthDay)) {
                        echo "<br>";
                        $nicbirth = substr($NIC, 0, 4);
                        echo "<br>";
                        $birthdaybirthday = substr($BirthDay, 0, 4);
                        echo "<br>";
                        if ($nicbirth == $birthdaybirthday) {
                            
                        } else {
                            $messages['error_mNic'] = "The NIC  birthday and entered Date of birthday are not matched!";
                            $messages['error_mDob'] = "The NIC  birthday and entered Date of birthday are not matched!";
                        }
                    }
                    if (isset($Gender)) {
                        $nicgender = substr($NIC, 4, 3);
                        die();
                        if ($nicgender < 500 && $Gender != 'Male') {
                            $messages['error_mNic'] = "The NIC  gender and seleted gender  are not matched!";
                            $messages['error_gender'] = "The NIC  gender and seleted gender  are not matched!";
                        }

                        if ($nicgender > 500 && $Gender != 'Female') {
                            $messages['error_mNic'] = "The NIC  gender and seleted gender  are not matched!";
                            $messages['error_gender'] = "The NIC and Birthday is not Matched!";
                        }
                    }
                }
            }
            if (!empty($ContactNo)) {


                $providerCodeRegex = '/^(077|078|071|072|075|076|070)\d{7}$/';

                // Remove any non-digit characters from the input
                $cleanedNumber = preg_replace('/\D/', '', $ContactNo);

                // Check if the cleaned number matches the provider code regex
                if (preg_match($providerCodeRegex, $cleanedNumber)) {

//                    return true; // Valid Sri Lankan mobile number
//                     
                } else {
                    $messages['error_Invalid_Phone_No'] = "Invalid Phone No!";
                }
            }

            // if(!isset($Size)){
            //     $messages['error_Product_size'] = "The Product Size should not be blank..!";
            // }

            if ($_FILES['UserImage']['name'] != "") {
                $customerImage = $_FILES['UserImage'];
                $filename = $customerImage['name'];
                $filetmpname = $customerImage['tmp_name'];
                $filesize = $customerImage['size'];
                $fileerror = $customerImage['error'];
                //take file extension
                $file_ext = explode(".", $filename);
                $file_ext = strtolower(end($file_ext));
                //select allowed file type
                $allowed = array("jpg", "jpeg", "png", "gif");
                //check wether the file type is allowed
                if (in_array($file_ext, $allowed)) {
                    if ($fileerror === 0) {
                        //file size gives in bytes
                        if ($filesize <= 40000000) {
                            //giving appropriate file name. Can be duplicate have to validate using function
                            $file_name_new = $NIC . uniqid('', true) . '.' . $file_ext;
                            //directing file destination
                            $file_path = "../../assets/img/UserImages/" . $file_name_new;
                            //moving binary data into given destination
                            if (move_uploaded_file($filetmpname, $file_path)) {
                                "The file is uploaded successfully";
                            } else {
                                $messages['file_error'] = "File is not uploaded";
                            }
                        } else {
                            $messages['file_error'] = "File size is invalid";
                        }
                    } else {
                        $messages['file_error'] = "File has an error";
                    }
                } else {
                    $messages['file_error'] = "Invalid File type";
                }
            }
            //advance validation email
            if (!empty($Email)) {
                $db = dbconn();
                $sql = "SELECT * FROM users WHERE Email='$Email'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Email'] = "The Email Already Exists!";
                }
            }
            //advance validation email
            if (!empty($Password != $cPassword)) {
                $messages['error_Password_Mistmach'] = "The Password Mismatch..!";
            }
            if (!empty($PasswordEmail)) {
                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $PasswordEmail);
                $lowercase = preg_match('@[a-z]@', $PasswordEmail);
                $number = preg_match('@[0-9]@', $PasswordEmail);
                $specialChars = preg_match('@[^\w]@', $PasswordEmail);
                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($PasswordEmail) < 8) {
                    $messages['error_Password_Chars'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
                }
            }

            if (empty($messages)) {
                echo $Password = sha1($Password);
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
//                echo $sql = "INSERT INTO users (Title,UserImage,UserRole,Email,Password,NIC,FirstName,LastName,HouseNo,Lane,Street,Province,District,City,Gender,Status)VALUES "
//                . "('$Title','$file_name_new','$UserRole','$Email', '$Password', '$NIC', '$FirstName', '$LastName','$HouseNo','$Lane1','$Lane2','$ProvinceName','$DistrictName','$CityName','$Gender','1')";
                $sql = "INSERT INTO users(Title,UserImage,FirstName,LastName,Email, Password,UserRole,depId,HouseNo,Lane,Street,Province,District,City,Gender,NIC,Dob,Status,ContactNo,AddUser,AddDate)"
                . " VALUES('$Title', '$file_name_new', '$FirstName', '$LastName', '$Email', '$Password', '$UserRole', '$Department', '$HouseNo', '$Lane1', '$Lane2', '$ProvinceName','$DistrictName', '$CityName', '$Gender', '$NIC','$BirthDay', '1','$ContactNo', '$AddUser', '$AddDate')";
                $results = $db->query($sql);
                $UserId = $db->insert_id;

                $qr_path = '../../assets/qr/';

                if (!file_exists($qr_path))
                    mkdir($qr_path);
                //correction level L=Low , H=High
                $errorCorrectionLevel = "L";
                $matrixPointSize = 4;

                $data = $UserId;
                $filename = $qr_path . 'EMP' . md5($data . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
                //QR Code generating
                QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                //$qrcode - new QRcode();
                //$qrcode->png();
                //display generated file
                echo'<img src="' . $qr_path . basename($filename) . '"/>';

                $FirstName;
                $LastName;
                $Email;
                $PasswordEmail;

                $to = $Email;
                $toname = $FirstName . ' ' . $LastName;
                $subject = "Welcome To Replica Speed";
                $body = '<!doctype html>
    <html lang="en-US">
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Appointment Successfully Added</title>
            <meta name="description" content="Reset Password Email">
            <style type="text/css">
                body{
                    background-image:url(https://www.dropbox.com/s/d8fqrtfnmh6x3a0/background.png?raw=1);
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center;
                }
                a:hover {
                    text-decoration: underline !important;
                }
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
                                                <h3> Welcome To Replica Speed Famliy..!</h3>
                                                <br/>
                                                    <p style="font-weight: bold;">Dear,' . $FirstName . '' . $LastName . '</p>
                                                    <br/>
                                                    <p style="font-weight: bold;">Congratulations on successfully registering for our company system! We are thrilled to have you onboard. This system will play a crucial role in supporting your work and ensuring a smooth workflow.
                                                    Here are a few key points to get you started:</p>
                                                    <br/>
                                                    <p style = "color:red; font-weight: bold;">User Name :' . $Email . '</p>
                                                    <br/>
                                                    <p style = "color:red; font-weight: bold;">Password :' . $PasswordEmail . '</p>
                                                    <br/>
                                                    <p style = "color:red; font-weight: bold;">After First Logoin Upon your first login, you will be prompted to create a new password.</p>
                                                    <br/>
                                                    <p>We are confident that this system will greatly enhance your efficiency and contribute to your success in your new role. Should you have any questions or require further guidance, do not hesitate to reach out to your supervisor or the HR department.
                                                    </p>
                                                    <br/>
                                                    <p>Once again, welcome to our company system!We are excited to have you join us on this digital journey.</p>
                                                    <br/> 
                                                    <p style ="text-align: left;">
                                                    Best regards,
                                                    <br/>
                                                    HR Department,
                                                    <br/>
                                                    Replica Speed Motor Garage.
                                                    <br/>
                                                    </p>
                                                <br/>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                          <img src="https://www.dropbox.com/scl/fi/jhe2ls8u4s44hhyd1gbuh/WelcomeTeam.jpg?rlkey=sz7kefd56u361cq039hodp24m&dl=1" style="display: block;
                                                margin-left: auto;
                                                margin-right: auto;
                                                width: 75%;">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td style = "height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                <td style = "height:20px;">&nbsp; </td>
    
                    <tr>
                        <td style = "text-align:center;">
                            <p style = "font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Replica Speed Motor Garage V.1.0</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style = "height:20px;">&nbsp;</td>
                    </tr>
                </td>
            </tr>
        </table>  
    </body>         
</html>';
                echo $alt = "EplyoeeReg";
                send_email($to, $toname, $subject, $body, $alt);

                if ($results) {
                    echo "ssssssssss";

                    header("Location: viewEmp.php?success=true");
                }
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="card-body row g-3" >

                <h5 class='m-1'style="text-align: center; font-weight: bold;">Employee Registration Form</h5>
                <div class="text-danger"><?= @$messages['error_Password_Mistmach']; ?></div>
                <?php
                $db = dbconn();
                $sql = "SELECT UserRole FROM desgination WHERE UserRole<>'admin' ";
                $result = $db->query($sql);
                ?>
                <div class="col-md-4">
                    <lable for="UserRole" class="form-label">Designation</lable>
                    <select for="UserRole" id='UserRole' name="UserRole"class="form-select" aria-label="Default select example">
                        <option value="">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['UserRole'] ?>" <?php
                                if (@$UserRole == $row['UserRole']) {
                                    echo "selected";
                                }
                                ?>><?= ucwords($row['UserRole']) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                    <?php
//                    var_dump(@$messages);
                    ?>
                    <div class="text-danger"><?= @$messages['error_User_Role']; ?></div>
                    <div class="text-danger"><?= @$messages['error_Password_Mistmach']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sqlDep = "SELECT depId,DepartmentName FROM department";
                $resultDep = $db->query($sqlDep);
                ?>
                <div class="col-md-4">
                    <lable for="Department" class="form-label">Department</lable>
                    <select for="Department" id="Department" name="Department"class="form-select" aria-label="Default select example">
                        <option value="">--</option>
                        <?php
                        if ($resultDep->num_rows > 0) {

                            while ($rowDep = $resultDep->fetch_assoc()) {
                                ?>
                                <option value="<?= $rowDep['depId'] ?>" <?php
                                if (@$Department == $rowDep['depId']) {
                                    echo "selected";
                                }
                                ?>><?= $rowDep['DepartmentName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>


                    </select>
                    <div class="text-danger"><?= @$messages['error_Department']; ?></div>

                </div>
                <div class="col-md-4">
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT titleId,Name FROM title";
                $result = $db->query($sql);
                ?>
                <div class="col-md-2">
                    <lable for="Title" class="form-label">Title</lable>
                    <select for="Title" name="Title" class="form-select" aria-label="Default select example">
                        <option value="">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['Name'] ?>" <?php
                                if (@$Title == $row['Name']) {
                                    echo "selected";
                                }
                                ?>><?= $row['Name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                    <div class="text-danger"><?= @$messages['error_Title']; ?></div>
                </div>
                <div class="col-md-4">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName"
                           placeholder="Enter First Name" value="<?= @$FirstName ?>">
                    <div class="text-danger"><?= @$messages['error_First_Name']; ?></div>
                </div>
                <div class="col-md-4">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName"
                           placeholder="Enter Last Name" value="<?= @$LastName ?>">
                    <div class="text-danger"><?= @$messages['error_Last_Name']; ?></div>
                </div>
                <div class="col-md-2">
                    <?php
                    $maxyearz = 365 * 18;
                    $minyearz = 365 * 50;
                    ?>
                    <label for="BirthDay" class="form-label">Birth Day</label>
                    <input type="date" class="form-control" id="BirthDay" name="BirthDay"  value="<?= @$BirthDay; ?>"  min="<?php echo date("Y-m-d", strtotime("-$minyearz days")); ?>"   max='<?php echo date("Y-m-d", strtotime("-$maxyearz days")); ?>'>
                    <div class="text-danger"><?= @$messages['error_Birthday']; ?></div>
                </div>
                <div class="col-md-4">
                    <label for="Nic" class="form-label">NIC</label>
                    <input type="text" class="form-control" id="NIC" name="NIC"
                           placeholder="Enter NIC" maxlength="12" value="<?= @$NIC; ?>">
                    <div class="text-danger"><?= @$messages['error_mNic']; ?></div>
                    <div class="text-danger"><?= @$messages['error_NIC']; ?></div>
                </div>
                <div class="col-md-6">
                    <label for="UserImage" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="UserImage" name="UserImage">
                    <div class="text-danger"><?= @$messages['error_UserImage']; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="HouseNo" class="form-label">House No</label>
                    <input type="text" class="form-control" id="HouseNo" name="HouseNo"
                           placeholder="Enter House No"  value="<?= @$HouseNo; ?>">
                    <div class="text-danger"><?= @$messages['error_House_No']; ?> </div>
                </div>
                <div class="col-md-9">
                    <label for="Lane1" class="form-label">Lane 1</label>
                    <input type="text" class="form-control" id="Lane1" name="Lane1"
                           placeholder="Enter Address Lane 1"  value="<?= @$Lane1; ?>">
                    <div class="text-danger"><?= @$messages['error_Lane_1']; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="Lane2" class="form-label">Lane 2</label>
                    <input type="text" class="form-control" id="Lane2" name="Lane2"
                           placeholder="Enter Address Lane 2" value="<?= @$Lane2; ?>">
                </div>
                <div class="col-md-4">
                    <label for="ContactNo" class="form-label">Mobile Phone No :</label>
                    <input type="text" class="form-control" id="ContactNo" name="ContactNo"
                           placeholder="Enter Mobile Phone No" value="<?= @$ContactNo; ?>">
                    <div class="text-danger"><?= @$messages['error_Invalid_Phone_No']; ?></div>
                    <div class="text-danger"><?= @$messages['error_Phone_No']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT * FROM provinces";
                $result = $db->query($sql);
                ?>
                <div class="col-md-3">
                    <lable for="Province" class="form-label">Province</lable>
                    <select for="ProvinceName" id="ProvinceName" name="ProvinceName" class="form-select" aria-label="Default select example" onChange='loadDistrict()'>
                        <option value=''>--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['id'] ?>" <?php
                                if (@$ProvinceName == $row['ProvinceName']) {
                                    echo "selected";
                                }
                                ?>><?= $row['ProvinceName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                    <div class="text-danger"><?= @$messages['error_City1']; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="DistrictName" class="form-label">District</label>
                    <select id='DistrictName' for="DistrictName" name="DistrictName" class="form-select" aria-label="Default select example" onChange='loadCity()' >
                        <option value=''>--</option>

                    </select>
                    <div class="text-danger"><?= @$messages['error_City2']; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="CityName" class="form-label">City</label>
                    <select id='CityName' for="CityName" name="CityName" class="form-select" aria-label="Default select example">
                        <option value=''>--</option>

                    </select>
                    <div class="text-danger"><?= @$messages['error_City3']; ?></div>
                </div>
                <div class="col-md-3">
                    <label for="Gender" class="form-label">Gender</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="Male" value="1" <?php
                        if (@$Gender == '1') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="Male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="Female" value="2" <?php
                        if (@$Gender == '2') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="Female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="Other" value="3" <?php
                        if (@$Gender == '3') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="Other">Other</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Gender']; ?></div>
                </div>
                <div class="col-md-5">
                    <label for="Email" class="form-label">Email</label>
                    <input type="text" class="form-control" pattern="[^ @]*@[^ @]*" id="Email" name="Email"
                           placeholder="Email" value='<?= @$Email ?>'>
                    <div class="text-danger"><?= @$messages['error_Email']; ?></div>
                </div>
                <div class="col-md-7">

                </div>
                <div class="col-md-12">

                    <label for="password" class="form-label">Password</label>

                    <ul>
                        <li>Minimum 1 UpperCase Letter</li>
                        <li>Minimum 1 LowerCase Letter</li>
                        <li>Numbers</li>
                        <li>Minimum 1 Special Character </li>
                    </ul>
                    <div class="text-danger"><?= @$messages['error_Password_Type']; ?></div>
                </div>
                <div id="passwordInput" class="col-md-6">

                    <input type="password" id="password" class="form-control" name="Password" placeholder="Enter Password">
                    <br>
                    <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()">
                    <label for="showPasswordCheckbox" class="form-label">Show Password</label>

                </div>
                <!--                <div id="passwordInput" class="col-md-6">
                
                                </div>-->
                <div class="col-md-12">
                    <div id="passwordStrength">
                        <span id="poor"></span>
                        <span id="weak"></span>
                        <span id="strong"></span>
                    </div>
                    <div id="passwordInfo"></div>
                </div>
                <div class="col-md-6">

                    <label for="cPassword" class="form-label">Confirm Password</label>
                    <input type="password" id="cPassword" class="form-control" name="cPassword" placeholder="Enter Password">
                    <br>
                    <input type="checkbox" id="showPasswordCheckbox1" onchange="togglePasswordVisibility1()">
                    <label for="showPasswordCheckbox1" class="form-label">Show Password</label>
                    <div class="text-danger"><?= @$messages['error_confirm_Password']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php
include'../../footer.php';
ob_end_flush();
?>

<script>
    function loadDistrict()
    {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#ProvinceName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadDistrict.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#DistrictName').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<script>
    function loadCity()
    {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#DistrictName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCities.php',
            data: {options1: selectedOption},
            success: function (response) {
                $('#CityName').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
<script>
    function togglePasswordVisibility1() {
        var cPasswordInput = document.getElementById("cPassword");
        var showPasswordCheckbox1 = document.getElementById("showPasswordCheckbox1");

        if (showPasswordCheckbox1.checked) {
            cPasswordInput.type = "text";
        } else {
            cPasswordInput.type = "password";
        }
    }
</script>

<script>
    let passwordInput = document.querySelector('#passwordInput input[type="password"]');
    let passwordStrength = document.getElementById('passwordStrength');
    let poor = document.querySelector('#passwordStrength #poor');
    let weak = document.querySelector('#passwordStrength #weak');
    let strong = document.querySelector('#passwordStrength #strong');
    let passwordInfo = document.getElementById('passwordInfo');

    let poorRegExp = /[a-z]/;
    let weakRegExp = /(?=.*?[0-9])/;
    ;
    let strongRegExp = /(?=.*?[#?!@$%^&*-])/;
    let whitespaceRegExp = /^$|\s+/;
    passwordInput.oninput = function () {

        let passwordValue = passwordInput.value;
        let passwordLength = passwordValue.length;
        let poorPassword = passwordValue.match(poorRegExp);
        let weakPassword = passwordValue.match(weakRegExp);
        let strongPassword = passwordValue.match(strongRegExp);
        let whitespace = passwordValue.match(whitespaceRegExp);
        if (passwordValue != "") {
            passwordStrength.style.display = "block";
            passwordStrength.style.display = "flex";
            passwordInfo.style.display = "block";
            passwordInfo.style.color = "black";
            if (whitespace)
            {
                passwordInfo.textContent = "whitespaces are not allowed";
            } else {
                poorPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword);
                weakPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword);
                strongPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword);
            }

        } else {

            passwordStrength.style.display = "none";
            passwordInfo.style.display = "none";

        }
    }
    function poorPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword) {
        if (passwordLength <= 3 && (poorPassword || weakPassword || strongPassword))
        {
            poor.classList.add("active");
            passwordInfo.style.display = "block";
            passwordInfo.style.color = "red";
            passwordInfo.textContent = "Your password is too Poor";

        }
    }
    function weakPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword) {
        if (passwordLength >= 4 && poorPassword && (weakPassword || strongPassword))
        {
            weak.classList.add("active");
            passwordInfo.textContent = "Your password is Weak";
            passwordInfo.style.color = "orange";

        } else {
            weak.classList.remove("active");

        }
    }
    function strongPasswordStrength(passwordLength, poorPassword, weakPassword, strongPassword) {
        if (passwordLength >= 6 && (poorPassword && weakPassword) && strongPassword)
        {
            poor.classList.add("active");
            weak.classList.add("active");
            strong.classList.add("active");
            passwordInfo.textContent = "Your password is strong";
            passwordInfo.style.color = "green";
        } else {
            strong.classList.remove("active");

        }
    }
    let showHide = document.querySelector('#passwordInput #showHide');
    showHide.onclick = function () {
        showHidePassword()
    }
    function showHidePassword() {
        if (passwordInput.type == "password") {
            passwordInput.type = "text";
            showHide.textContent = "HIDE";
            showHide.style.color = "green";
        } else {
            passwordInput.type = "password";
            showHide.textContent = "SHOW";
            showHide.style.color = "red";
        }
    }
</script>
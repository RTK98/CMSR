
<?php ob_start(); ?><?php
include '../header.php';
include '../menu.php';
?>


<?php $signup = 'active'; ?>

<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'editcustomer') {
    extract($_POST);
    echo $sessioncustomerid = $_SESSION['CustomerId'];
    echo $CustomerId;
    if ($sessioncustomerid == $CustomerId) {
        
    } else {
        echo "403";
        //header("Location:403file.php");
    }


    extract($_POST);
     $sqlcutomer = "SELECT * FROM tbl_customers WHERE CustomerId ='$CustomerId' ";
    $resultcustomer = $db->query($sqlcutomer);
    if ($resultcustomer->num_rows <= 0) {
        
    } else {
        $rowcustomer = $resultcustomer->fetch_assoc();

        $Title = $rowcustomer['Title'];
        $cFirstName = $rowcustomer['FirstName'];
        $cLastName = $rowcustomer['LastName'];

        $cEmail = $rowcustomer['Email'];
        $cNIC = $rowcustomer['NIC'];
        $cMobile = $rowcustomer['Mobile'];
//    $cGender = cleanInput($Gender);
        $cAddress = $rowcustomer['Address'];
        $cAddress2 = $rowcustomer['Address2'];
         $cityid = $rowcustomer['City'];
        $cGender = $rowcustomer['Gender'];
        $dateofbirth = $rowcustomer['dateofbirth'];
         $image = $rowcustomer['CustomerImage'];
    }
}
?>
<?php include '../assets/phpmail/mail.php'; ?>

<?php
//check form submit method
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'updateprofile') {


    //seperate variables and values from the form
    extract($_POST);
     $daetofbirth;

    //data clean
    $Title = cleanInput($Title);
    $cFirstName = cleanInput($FirstName);
    $cLastName = cleanInput($LastName);

    $cNIC = cleanInput($NIC);

    $cMobile = cleanInput($Mobile);
//    $cGender = cleanInput($Gender);
    $cAddress = cleanInput($Address);
    $cAddress2 = cleanInput($Address2);
     $cityid = cleanInput($cityid);
    $dateofbirth = cleanInput($daetofbirth);

    //create array variable store validation messages
    $messages = array();

    //validate required fields

    if (empty($Title)) {
        $messages['error_title'] = "Customer Title  should not be empty!";
    }

    if (!isset($cGender)) {
        $messages['error_gender'] = "The Gender should be selected..!";
    }

    if (empty($cFirstName)) {
        $messages['error_firstname'] = "Customer First Name should not be empty!";
    }
    if (empty($cLastName)) {
        $messages['error_lastname'] = "Customer Last Name should not be empty!";
    }

    if (empty($cNIC)) {
        $messages['error_nic'] = "The NIC  should not be empty..!";
    }

    if (empty($cMobile)) {
        $messages['error_mobile'] = "The mobile should not be empty..!";
    }
//    if (empty($cGender)) {
//        $messages['error_gender'] = "The gender should not be empty..!";
//    }
    if (empty($cAddress)) {
        $messages['error_address'] = "The address should be selected..!";
    }
    if (empty($cityid)) {
        $messages['error_city'] = "The city should be selected..!";
    }



    if (empty($daetofbirth)) {
        $messages['error_dob'] = "The Date of birth should selected..!";
    }

    //adavnced validation

    if (!empty($daetofbirth)) {
        $checkdob = strtotime($daetofbirth);
        $cons = 1214517600;
        if ($checkdob > $cons) {
            $messages['error_dob'] = "At least registered person should be more than 15 years..!";
        }
    }

    if (!empty($cNIC)) {

        $niclength = strlen($cNIC);
        if ($niclength == 10 || $niclength == 12) {
            
        } else {
            $messages['error_nic'] = "The NIC  length should 10 or 12!";
        }
    }

    if (!empty($cNIC)) {
        $niclength = strlen($cNIC);
        if ($niclength == 10) {


            if (!empty($daetofbirth)) {
                echo "<br>";
                echo $nicbirth = substr($cNIC, 0, 2);
                echo "<br>";
                echo $birthdaybirthday = substr($daetofbirth, 2, 2);
                echo "<br>";
                if ($nicbirth == $birthdaybirthday) {
                    
                } else {
                    $messages['error_nic'] = "The NIC  birthday and entered Date of birthday are not matched!";
                    $messages['error_dob'] = "The NIC  birthday and entered Date of birthday are not matched!";
                }
            }
            if (isset($cGender)) {
                $nicgender = substr($cNIC, 2, 3);
                if ($nicgender < 500 && $cGender != 'male') {
                    $messages['error_nic'] = "The NIC  gender and seleted gender  are not matched!";
                    $messages['error_gender'] = "The NIC  gender and seleted gender  are not matched!";
                }

                if ($nicgender > 500 && $cGender != 'female') {
                    $messages['error_nic'] = "The NIC  gender and seleted gender  are not matched!";
                    $messages['error_gender'] = "The NIC  gender and seleted gender  are not matched!";
                }
            }
        }
        //nic 12 digits validation
        if ($niclength == 12) {


            if (!empty($daetofbirth)) {
                echo "<br>";
                 $nicbirth = substr($cNIC, 0, 2);
                echo "<br>";
                 $birthdaybirthday = substr($daetofbirth, 2, 2);
                echo "<br>";
                if ($nicbirth == $birthdaybirthday) {
                    
                } else {
                    $messages['error_nic'] = "The NIC  birthday and entered Date of birthday are not matched!";
                    $messages['error_dob'] = "The NIC  birthday and entered Date of birthday are not matched!";
                }
            }
            if (isset($cGender)) {
                $nicgender = substr($cNIC, 2, 3);
                if ($nicgender < 500 && $cGender != 'male') {
                    $messages['error_nic'] = "The NIC  gender and seleted gender  are not matched!";
                    $messages['error_gender'] = "The NIC  gender and seleted gender  are not matched!";
                }

                if ($nicgender > 500 && $cGender != 'female') {
                    $messages['error_nic'] = "The NIC  gender and seleted gender  are not matched!";
                    $messages['error_gender'] = "The NIC  gender and seleted gender  are not matched!";
                }
            }
        }
    }

    if (!empty($Mobile)) {

        if ($Mobile == 10) {

            if ($Mobile === '0000000000') {
                $message['error_mobile'] = "Please enter a valid mobile number";
            } elseif ($Mobile === '1111111111') {
                $message['error_mobile'] = "Please enter a valid 111 mobile number";
            } elseif ($Mobile === '0123456789') {
                $message['error_mobile'] = "Please enter a valid 11112323534645 mobile number";
            }
        } else {
            $message['error_mobile'] = "The mobile number must have 10 numbers";
        }
    }

        if ($_FILES['cImage']['name'] != "") {
        $customerImage = $_FILES['cImage'];
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
                    $file_name_new = uniqid('', true) . $cFirstName . $cLastName . '.' . $file_ext;
                    //directing file destination
                    $file_path = "../../system/assets/images/customers/" . $file_name_new;
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
    }else{
       $file_name_new =$previousimage;
    }
    
    
    





    if (empty($messages)) {

        $db = dbConn();

        $referencenumber = rand();

        echo $checkcity = "SELECT * FROM tbl_customers WHERE CustomerId='$CustomerId'";
        $resultscity = $db->query($checkcity);
        $rowcity = $resultscity->fetch_assoc();

        echo $previouscity = $rowcity['City'];
        echo $cityid;
        if ($cityid == $previouscity) {
             $sql = "UPDATE tbl_customers SET Title='$Title',FirstName='$cFirstName',LastName='$cLastName',NIC='$cNIC',Mobile='$cMobile',Gender='$cGender',Address='$cAddress',Address2='$cAddress2',City='$cityid',CustomerImage='$file_name_new' where CustomerId='$CustomerId'";
            $results = $db->query($sql);
        } else {
             $sql = "UPDATE tbl_customers SET Title='$Title',FirstName='$cFirstName',LastName='$cLastName',NIC='$cNIC',Mobile='$cMobile',Gender='$cGender',Address='$cAddress',Address2='$cAddress2',City='$cityid',provinceid='$provinceid',districtid='$districtid',CustomerImage='$file_name_new' where CustomerId='$CustomerId'";
            $results = $db->query($sql);
        }


  

        $to = $cEmail;
        $toname = $Title . $cFirstName . $cLastName;
        $subject = "Welcome to BlueTech Electronics" . $Title . $cFirstName . $cLastName;
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap" rel="stylesheet">
    <!--<![endif]-->
</head>

<body>
    <div class="es-wrapper-color">
        <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#ffffff"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="es-m-p0r esd-container-frame" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_90.png" alt="Logo" style="display: block;" height="50" title="Logo"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" bgcolor="#F3E2D8" style="background-color: #f3e2d8;">
                                        <table class="es-content-body" style="background-color: #f3e2d8;" width="600" cellspacing="0" cellpadding="0" bgcolor="#F3E2D8" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_89_Ouc.png" alt style="display: block;" width="515"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p30t">
                                                                                        <h1>' . $referencenumber . '</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p20t es-p20b">
                                                                                        <p>Hi! Welcome! Thanks for joining!&nbsp;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-button">
                                                                                        <!--[if mso]><a href="https://viewstripo.email" target="_blank" hidden>
	<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://viewstripo.email" 
                style="height:51px; v-text-anchor:middle; width:274px" arcsize="51%" stroke="f"  fillcolor="#bc2919">
		<w:anchorlock></w:anchorlock>
		<center style= "color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px" >START A PROJECT</center>
	</v:roundrect></a>
<![endif]-->
                                                                                        <!--[if !mso]><!-- --><span class="es-button-border msohide"><a href="https://viewstripo.email" class="es-button" target="_blank">START A PROJECT</a></span>
                                                                                        <!--<![endif]-->
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_T5s.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_T5s.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group1.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">Discover new projects</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_5Fp.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_5Fp.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group2.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">From idea to market</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Interdum velit euismod in pellentesque. Nec feugiat in fermentum posuere urna. Velit dignissim sodales ut eu sem integer vitae justo eget. Aliquam eleifend mi in nulla posuere sollicitudin aliquam.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_lfP.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_lfP.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">Start a project</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" esd-custom-block-id="648189">
                                        <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" align="left" class="esd-container-frame">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p5t es-p5b">
                                                                                        <h2>Questions?</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p20b">
                                                                                        <p><a href="https://viewstripo.email" target="_blank">Learn more about us</a>&nbsp;and&nbsp;<a href="https://viewstripo.email" target="_blank">sign up to receive updates</a>&nbsp;from our team.</p>
                                                                                        <p>Reply to this email or call to connect with us.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-button es-p40b"><span class="es-button-border"><a href="tel:" class="es-button" target="_blank">+ (000) 123 456 789</a></span></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p10t es-p20b" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_90.png" alt="Logo" style="display: block;" height="40" title="Logo"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-social es-p20b" style="font-size:0">
                                                                                        <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Facebook" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/facebook-rounded-black.png" alt="Fb" height="24"></a></td>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Twitter" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/twitter-rounded-black.png" alt="Tw" height="24"></a></td>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Instagram" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/instagram-rounded-black.png" alt="Inst" height="24"></a></td>
                                                                                                    <td align="center" valign="top"><a target="_blank" href="https://viewstripo.email"><img title="Youtube" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/youtube-rounded-black.png" alt="Yt" height="24"></a></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-menu" esd-tmp-menu-color="#ffffff" esd-tmp-divider="0|solid|#efefef" esd-tmp-menu-font-size="12px">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" class="es-menu">
                                                                                            <tbody>
                                                                                                <tr class="links">
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Location</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Contact</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Help</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Privacy</a></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p15t es-p15b">
                                                                                        <p style="font-size: 12px;">You are receiving this email because you have visited our site or asked us about the regular newsletter. Make sure our messages get to your Inbox (and not your bulk or junk folders).<br><a target="_blank" href="https://viewstripo.email/" style="font-size: 12px;">Privacy police</a>&nbsp;|&nbsp;<a target="_blank" style="font-size: 12px;">Unsubscribe</a></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="esd-footer-popover es-footer" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="left">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-infoblock made_with" style="font-size:0"><a target="_blank" href="https://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=crowdfunding_2&utm_content=turn_your_ideas_into_reality"><img src="https://tlr.stripocdn.email/content/guids/CABINET_09023af45624943febfa123c229a060b/images/7911561025989373.png" alt width="125" style="display: block;"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>';
        $alt = "Customer  Registration";
        send_email($to, $toname, $subject, $body, $alt);

              ?><script>
        Swal.fire({
            title: 'Success!',
            text: 'Successfully Updated User Account.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../logout.php'; // Redirect to success page
        });
    </script><?php 
        
    }

  

 
}
?>



<section id="signup" class="section-bg ">
    <div class="section-title" data-aos="fade-up">
        <h2>Update The User Details </h2>
    </div>

    <div class="container" >
        <div class="row d-flex align-items-center justify-content-center ">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../assets/images/signup.jpg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form id="formcustomer" method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <!-- Email input -->
                    <h1 class="title"> Personal Details </h1>
                    <div class="form-outline mb-4">
                        <div class="form-outline mb-2">
                            <label for="title" class="form-label">Select Title </label>
                            <select id="title" name="Title" class="form-control">
                                <option value="">- -</option>                                
                                <option value="Mr" <?php
                                if (@$Title == "Mr") {
                                    echo "selected";
                                }
                                ?>>Mr.</option>
                                <option value="Miss"<?php
                                if (@$Title == "Miss") {
                                    echo "selected";
                                }
                                ?>>Miss.</option>

                            </select>
                            <div class="text-danger"> <?= @$messages['error_title']; ?></div> 
                        </div>


                        <div class="orm-outline mb-2">
                            <label>Select Gender</label>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="cGender" id="male" value="male" <?php
                                if (@$cGender == 'male') {
                                    echo "checked";
                                }
                                ?>>
                                <label class="form-check-label" for="sell">Male</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="cGender" id="female" value="female" <?php
                                if (@$cGender == 'female') {
                                    echo "checked";
                                }
                                ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            <div class="text-danger"> <?= @$messages['error_gender']; ?></div>
                        </div>


                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">First Name</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="first_name" name="FirstName" value="<?= @$cFirstName; ?>">
                            <div class="text-danger"> <?= @$messages['error_firstname']; ?></div>  
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Last Name</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="last_name" name="LastName" value="<?= @$cLastName; ?>">
                            <div class="text-danger"> <?= @$messages['error_lastname']; ?></div>
                        </div>
                        
                        <div class="form-outline mb-2">
                            <label for="ProductImage" class="form-label">File upload</label>
                            <input class="form-control" type="file" id="ProductImage"  name="cImage">
                            <div class="text-danger"> <?= @$messages['error_cimage']; ?></div>
                            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <img style="width:20rem" src="../../system/assets/images/customers/<?=$image?>">
                            
                            
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">NIC</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="nic_number" name="NIC" value="<?= @$cNIC; ?>">
                            <div class="text-danger"> <?= @$messages['error_nic']; ?></div>
                        </div>

                        <div class="form-outline mb-2">
                            <?php
                            $max = -365 * 15; //assume it like 2008
                            $min = -365 * 70; // assume it 70 year back from current date
                            ?>
                            <label class="form-label" for="form1Example13">Date of Birth </label>
                            <input type="date" name="daetofbirth" class="form-control form-control-sm"  min='<?php echo date("Y-m-d", strtotime("$min days")); ?>'   max='<?php echo date("Y-m-d", strtotime("$max days")); ?>'  value="<?= @$dateofbirth; ?>">
                            <div class="text-danger"> <?= @$messages['error_dob']; ?></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Address Line 1</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address" value="<?= @$cAddress; ?>">
                            <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Address Line 2</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address2" value="<?= @$cAddress2; ?>">
                            <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Mobile Number</label>
                            <input type="number" placeholder="" class="form-control form-control-sm" id="phone" name="Mobile" value="<?= @$cMobile; ?>">
                            <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <?php
                            $sqlcity = "SELECT * FROM tbl_cities ";
                            $db = dbConn();
                            $resultcity = $db->query($sqlcity);
                            ?>
                            <label><strong>Select City</strong></label>
                            <select id="psupplier" name="cityid" class="form-control" onchange="loaddistrictprovince()">
                                <option value="">-Select Selected-</option>
                                <?php
                                if ($resultcity->num_rows > 0) {

                                    while ($rowcity = $resultcity->fetch_assoc()) {
                                        ?>

                                        <option value="<?= $rowcity['cityid'] ?>" <?php
                                        if (@$cityid == $rowcity['cityid']) {
                                            echo "selected";
                                        }
                                        ?> ><?= $rowcity['cityname'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <div class="text-danger"> <?= @$messages['error_city']; ?></div>
                        </div>


                        <div class="form-outline mb-2" id="productlist">

                        </div>


                    </div>

                    <!-- Password input -->




                    <!-- Submit button -->
                    <input type="hidden" name="CustomerId" value="<?= $CustomerId ?>">
                      <input type="hidden" name="previousimage" value="<?= $image ?>">
                    <button type="submit" name="action" value="updateprofile" class="btn btn-primary btn-lg btn-block">Update</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                        <a href=""></a>
                    </div>
                    </form>
                <form action="customerDashboard.php" method="POST">
                 <input type="hidden" name="CustomerId" value="<?= $CustomerId ?>">
                    <button type="submit" name="action" value="updateprofile" class="btn btn-primary btn-lg btn-block">Back Dashboard</button>

                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>
<script>
    function loaddistrictprovince() {


        var formData = $('#formcustomer').serialize();
        alert(formData);
        $.ajax({
            type: 'POST',
            url: 'citylist.php',
            data: formData,

            success: function (response) {
                $('#productlist').html(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<?php
ob_end_flush();
?>




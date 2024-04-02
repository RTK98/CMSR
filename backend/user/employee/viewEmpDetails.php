<?php ob_start(); ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<?php include "../../assets/phpqrcode/phpqrcode/qrlib.php"; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewEmp.php" class="btn btn-sm btn btn-dark position-relative">Emplyoee List</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == "edit" || @$action == "update" )) {
        $UserId;
        $db = dbConn();
        $sql = "SELECT u.UserId,u.UserImage,u.Status,u.UserRole,u.NIC,u.FirstName,u.LastName,u.HouseNo,u.Lane,u.Street,u.Email,u.Gender,u.ContactNo,"
                . "dep.DepartmentName,pro.ProvinceName,dis.DistrictName,ci.name_en FROM users u "
                . "LEFT JOIN department dep ON dep.depId=u.depId "
                . "LEFT JOIN provinces pro ON pro.id=u.Province "
                . "LEFT JOIN districts dis ON dis.id = u.District "
                . "LEFT JOIN cities ci ON ci.id=u.City "
                . "WHERE u.UserId='$UserId';";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
//        print_r($row);
//        die();
        $UserRole = $row["UserRole"];
        $FirstName = $row["FirstName"];
        $LastName = $row["LastName"];
        $NIC = $row["NIC"];
        $HouseNo = $row["HouseNo"];
        $Lane1 = $row["Lane"];
        $Lane2 = $row["Street"];
        $DepartmentName = $row["DepartmentName"];
        $ProvinceName = $row["ProvinceName"];
        $DistrictName = $row["DistrictName"];
        $City = $row["name_en"];
        $Email = $row["Email"];
        $UserRole = $row["UserRole"];
        $UserImage = $row["UserImage"];
        $ContactNo = $row["ContactNo"];
    }?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "update") {
        $empImg;

        $messages = array();

        if (!isset($UserRole)) {
            $messages['error_Designation'] = "Please Select the Employee Desgination..!";
        }

        if ($_FILES['empImg']['name'] != "") {
                $customerImage = $_FILES['empImg'];
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
                            $file_name_new = uniqid('', true) . '.' . $file_ext;
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
            }else {
            $file_name_new = $PreviousImage;
        }
        if (empty($messages)) {
            $db = dbconn();
            $AddDate = date('Y-m-d');
            $sql = "UPDATE users SET UserRole='$UserRole',UpdateUser='1',`UpdateDate`='$AddDate', UserImage='$file_name_new' ,ContactNo = '$ContactNo' WHERE UserId='$UserId'";
            $db->query($sql);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "cancel") {
        header("Location:viewEmp.php");
    }
    ?>
    <div>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?= $UserImage ?>" alt="UserImg" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>  <?php echo $FirstName . " " . $LastName ?></h4>
                                        <p class="text-secondary mb-1"><?= ucwords($UserRole) ?></p>
                                        <p class="text-muted font-size-sm">
                                            <?= ucwords($HouseNo . ',' . $Lane1 . ',' . $Lane2 . ',' . $City . ',' . '<br>' . $DistrictName . ',' . $ProvinceName) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <?php
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
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-3">Edit Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" id="empImg" name="empImg">
                                        <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                                               value="<?= $FirstName . ' ' . $LastName ?>" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NIC</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="NIC" name="NIC"
                                               value="<?= $NIC ?>" readonly>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="Email" name="Email"
                                               value="<?= $Email ?>" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="ContactNo" name="ContactNo"
                                               value="<?= '0' . $ContactNo ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">
                                            House No</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="HouseNo" name="HouseNo"
                                               value="<?= $HouseNo . ',' ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">
                                            Lane 1</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                                               value="<?= $Lane1 . ',' ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">
                                            Lane 2</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                                               value="<?= $Lane2 . ',' ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">
                                            Province</h6>
                                    </div>
                                    <?php
                                    $db = dbconn();
                                    $sql = "SELECT * FROM provinces";
                                    $result = $db->query($sql);
                                    ?>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="col-md-3">
                                            <lable for="Province" class="form-label">Province</lable>
                                            <select for="ProvinceName" id="ProvinceName" name="ProvinceName" class="form-select" aria-label="Default select example" onChange='loadDistrict()'>
                                                <option value="">--</option>
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
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">
                                            Desgination</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php
                                        $db = dbconn();
                                        $sqlUserRole = "SELECT UserRole FROM desgination WHERE UserRole != 'admin'";
                                        $resultUserRole = $db->query($sqlUserRole);
                                        ?>
                                        <div class="mb-3">
                                            <select for="UserRole" name="UserRole"class="form-select" aria-label="Default select example">
                                                <option value="NoUserRole">--</option>
                                                <?php
                                                if ($resultUserRole->num_rows > 0) {

                                                    while ($row = $resultUserRole->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $row['UserRole'] ?>" <?php
                                                        if ($UserRole == $row['UserRole']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?= ucwords($row['UserRole']) ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger"><?= @$messages['error_Designation']; ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="UserId" value="<?= $UserId ?>">
                                        <input type="hidden" name="PreviousImage" value="<?= $UserImage ?>">
                                        <button type="submit" class="btn btn-primary" name="action" value="update">Submit</button>
                                        <input type="hidden" name="UserId" value="<?= $UserId ?>">
                                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include'../../footer.php'; ?>

<?php ob_end_flush(); ?>
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
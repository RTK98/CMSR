<?php ob_start(); ?>
<?php
include'../header.php';
include'rand.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
    </div>
    <div class="card">
        <div class="card-header">
            New Inspection
        </div>
        <?php
        print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $FirstName = inputTrim($FirstName);
            $LastName = inputTrim($LastName);
            $NIC = inputTrim($NIC);
            $HouseNo = inputTrim($HouseNo);
            $Lane1 = inputTrim($Lane1);
            $Lane2 = inputTrim($Lane2);
            $City = inputTrim($City);
            $Email = inputTrim($Email);
            $Password = sha1($Password);
            $Millege = inputTrim($Millege);

            $customerImage = $_FILES['VehicleImage'];
            $registerLetter = inputTrim($registerLetter);
            $regsitrationNo = inputTrim($regsitrationNo);
            $VehicleName = inputTrim($VehicleName);

            $messages = array();
            if (empty($FirstName)) {
                $messages['error_First_Name'] = "The First Name should not be blank..!";
            }
            if (empty($LastName)) {
                $messages['error_Last_Name'] = "The Last Name should not be blank..!";
            }
            if (empty($NIC)) {
                $messages['error_NIC'] = "The NIC should not be blank..!";
            }
            if (empty($HouseNo)) {
                $messages['error_House_No'] = "The House No should not be blank..!";
            }
            if (empty($Lane1)) {
                $messages['error_Lane_1'] = "The Lane 1 should not be blank..!";
            }
            if (empty($Lane2)) {
                $messages['error_Lane_2'] = "The Lane 2 should not be blank..!";
            }
            if (empty($City)) {
                $messages['error_City'] = "The City should not be blank..!";
            }
            if (empty($Email)) {
                $messages['error_Email'] = "The Email should not be blank..!";
            }
            if (empty($Password)) {
                $messages['error_Password'] = "The Password should not be blank..!";
            }
            if (!isset($Gender)) {
                $messages['error_Gender'] = "The Gender should not be blank..!";
            }
            if (empty($Millege)) {
                $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
            }
            // if(!isset($ProductStatus)){
            //     $messages['error_Product_status'] = "The Product Status should not be blank..!";
            // }
//            if (!isset($InspectionStatus)) {
//                $messages['error_Product_size'] = "The S Size should not be blank..!";
//            }
            //advance validation
//            if (!empty($VehicleNo)) {
//                $db = dbconn();
//                $sql = "SELECT * FROM inspections WHERE VehicleNo='$VehicleNo'";
//                $result = $db->query($sql);
//
//                if ($result->num_rows > 0) {
//                    $messages['error_Product_size'] = "The Product Name Already Exists!";
//                }
//            }
            //image add
            if ($_FILES['VehicleImage']['name'] != "") {
                $customerImage = $_FILES['VehicleImage'];
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
                            $file_path = "../../web/assets/img/myVehicleImage/" . $file_name_new;
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
            print_r($messages);
            if (empty($messages)) {
                $db = dbConn();
                $AddDate = date('Y-m-d');

                 $sql = "INSERT INTO customer (Email,Password,NIC,FirstName,LastName,HouseNo,Lane,Street,City,Gender,Status)VALUES ('$Email', '$Password', '$NIC', '$FirstName', '$LastName','$HouseNo','$Lane1','$Lane2','$City','$Gender','1')";
                print_r($sql);
                $db->query($sql);
                $CustomerId = $db->insert_id;
                 $sqlVehicle = "INSERT INTO customervehicles (VehicleType,VehicleImage,VehicleModel,registerLetter,RegistrationNo,CustomerID) VALUES ('$VehicleType','$file_name_new','$VehicleName','$registerLetter', '$regsitrationNo','$CustomerId')";
                $db->query($sqlVehicle);
                $Vehicle = $db->insert_id;
                
                
                $timestamp = strtotime($AddDate);
                $currentdatenumber = date('Ymd', $timestamp);
                $randomNumber;
                $InspectionNo = 'INS' . $currentdatenumber . $randomNumber;
                $sql = "INSERT INTO inspections(VehicleNo,InspectionNo,CustomerName,Millege,AddUser,AddDate )VALUES ('$VehicleNo','$InspectionNo', '$CustomerName', '$Millege', '1','$AddDate')";
                print_r($sql);
                $db->query($sql);
                $InspectionId = $db->insert_id;
                foreach ($InspectionStatus as $value) {
                    $sql = "INSERT INTO inspectionsreport(InspectionId,InspectionStatus) VALUES ('$InspectionId','$value')";
                    print_r($sql);
                    $db->query($sql);
                }
                header('Location:addSuccess.php');
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="card-body">
                <section class="m-1">
                    <h6 class="btn btn-success">Customer Info.</h6>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="FirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName"
                                   placeholder="Enter First Name">
                            <div class="text-danger"><?= @$messages['error_First_Name']; ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="LastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="LastName" name="LastName"
                                   placeholder="Enter Last Name">
                            <div class="text-danger"><?= @$messages['error_Last_Name']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="TimeSlotEnd" class="form-label">NIC</label>
                            <input type="text" class="form-control" id="NIC" name="NIC"
                                   placeholder="Enter NIC">
                            <div class="text-danger"><?= @$messages['error_NIC']; ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="HouseNo" class="form-label">House No</label>
                            <input type="text" class="form-control" id="HouseNo" name="HouseNo"
                                   placeholder="Enter Last Name">
                            <div class="text-danger"><?= @$messages['error_House_No']; ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Lane1" class="form-label">Lane 1</label>
                        <input type="text" class="form-control" id="Lane1" name="Lane1"
                               placeholder="Enter Address Lane 1">
                        <div class="text-danger"><?= @$messages['error_Last_Name']; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="Lane2" class="form-label">Lane 2</label>
                        <input type="text" class="form-control" id="Lane2" name="Lane2"
                               placeholder="Enter Address Lane 2">
                        <div class="text-danger"><?= @$messages['error_Last_Name']; ?></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="City" class="form-label">City</label>
                            <input type="text" class="form-control" id="City" name="City"
                                   placeholder="Enter Address Lane 2">
                            <div class="text-danger"><?= @$messages['error_Last_Name']; ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="mb-3">
                                <label for="Gender" class="form-label">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Gender" id="Male" value="1">
                                    <label class="form-check-label" for="Yes">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Gender" id="Female" value="2">
                                    <label class="form-check-label" for="Female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Gender" id="Other" value="3">
                                    <label class="form-check-label" for="Other">Other</label>
                                </div>
                                <div class="text-danger"><?= @$messages['error_Gender']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" class="form-control" pattern="[^ @]*@[^ @]*" id="Email" name="Email"
                                   placeholder="Email">
                            <div class="text-danger"><?= @$messages['error_email']; ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" pattern=".{8,}" class="form-control" id="Password" name="Password"
                                   placeholder="Enter Password">
                            <div class="text-danger"><?= @$messages['error_Email']; ?></div>
                        </div>
                    </div>
                </section>
                <section class="m-1">
                    <h6 class="btn btn-warning">Vehicle Info</h6>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="VehicleImage" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="VehicleImage" name="VehicleImage"
                                   placeholder="Enter Catergory Name">
        <!--                    <div class="text-danger"><?= @$messages['error_Vehicle_image']; ?></div>-->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Millege" class="form-label">Milage</label>
                            <input type="text" class="form-control" id="Millege" name="Millege" placeholder="Enter Millege">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $db = dbconn();
                        $sql = "SELECT VCatergoryId,CatergoryName FROM vehicle_catergories";
                        $result = $db->query($sql);
                        ?>
                        <div class="form-group col-md-6">
                            <label for="VehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-select" aria-label="Default select example" name="VehicleType">
                                <option value="NoCatergory">--</option>
                                <?php
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['VCatergoryId'] ?>" <?php
                                if (@$VehicleType == $row['CatergoryName']) {
                                    echo "selected";
                                }
                                        ?>><?= $row['CatergoryName'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="VehicleName" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" id="VehicleName" name="VehicleName"
                                   placeholder="Evolution X">
                            <div class="text-danger"><?= @$messages['error_vehicle_Model']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $db = dbconn();
                        $sql = "SELECT VCatergoryId,CatergoryName FROM vehicle_catergories";
                        $result = $db->query($sql);
                        ?>
                        <div class="form-group col-md-6">
                            <label for="registerLetter" class="form-label">Regsitration Letter</label>
                            <input type="text" class="form-control" id="registerLetter" name="registerLetter"
                                   placeholder="ABC">
                            <div class="text-danger"><?= @$messages['error_vehicle_letter']; ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="regsitrationNo" class="form-label">Regsitration No</label>
                            <input type="text" class="form-control" id="regsitrationNo" name="regsitrationNo"
                                   placeholder="1234">
                            <div class="text-danger"><?= @$messages['error_vehicle_letter']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <lable for="FuelType" class="form-label">Fuel Type</lable>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>--</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Gasoline">Gasoline</option>
                            </select>
                        </div>
                    </div>
                </section>
                <div class="container m-1">
                    <table class="table m-1">
                        <thead>
                            <tr style="background-color: #d2d2d2">
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col" style="background-color:#48da3a;">Good</th>
                                <th scope="col" style="background-color:#ff5858;">Bad</th>
                                <th scope="col" style="background-color:#ff9c6b;">Need To Replace</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbconn();
                            $sqlEngine = "SELECT * FROM inspectionitems WHERE insCat_id=1 AND InsItemStatus=1";
                            $resultEngine = $db->query($sqlEngine);
                            ?>
                            <tr>
                                <th scope="row" style="background-color: #d2d2d2">A</th>
                                <th scope="row">Engine</th>
                            </tr>
                            <?php
                            if ($resultEngine->num_rows > 0) {
                                $n = 1;
                                while ($rowengineItems = $resultEngine->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="background-color: #d2d2d2"><?= $n ?></td>
                                        <td><?= $rowengineItems['InsItemName'] ?></td>
                                        <td style="background-color:#48da3a;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-21" id="Good" value="1">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff5858;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-21" id="Bad" value="2">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff9c6b;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-21" id="NeedToReplace" value="3">
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                            <!--                           end of the engine part     -->

                            <?php
                            $db = dbconn();
                            $sqlElectric = "SELECT * FROM inspectionitems WHERE insCat_id=2 AND InsItemStatus=1";
                            $resultElectric = $db->query($sqlElectric);
                            ?>
                            <tr>
                                <th scope="row" style="background-color: #d2d2d2">B</th>
                                <th scope="row">Electrical</th>
                            </tr>
                            <?php
                            if ($resultElectric->num_rows > 0) {
                                $n = 1;
                                while ($rowElectricalItems = $resultElectric->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="background-color: #d2d2d2"><?= $n ?></td>
                                        <td><?= $rowElectricalItems['InsItemName'] ?></td>
                                        <td style="background-color:#48da3a;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-22">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff5858;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-22">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff9c6b;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-22">
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                            <!-- end of electrical part-->
                            <?php
                            $db = dbconn();
                            $sqlGear = "SELECT * FROM inspectionitems WHERE insCat_id=3 AND InsItemStatus=1";
                            $resultGear = $db->query($sqlGear);
                            ?>
                            <tr>
                                <th scope="row" style="background-color: #d2d2d2">C</th>
                                <th scope="row">Gear Box</th>
                            </tr>
                            <?php
                            if ($resultGear->num_rows > 0) {
                                $n = 1;
                                while ($rowGear = $resultGear->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="background-color: #d2d2d2"><?= $n ?></td>
                                        <td><?= $rowGear['InsItemName'] ?></td>
                                        <td style="background-color:#48da3a;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-23" id="Good" value="1">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff5858;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-23" id="Bad" value="2">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff9c6b;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-23" id="NeedToReplace" value="3">
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                            <!--end of gear box part-->
                            <?php
                            $db = dbconn();
                            $sqlBody = "SELECT * FROM inspectionitems WHERE insCat_id=4 AND InsItemStatus=1";
                            $resultBody = $db->query($sqlBody);
                            ?>
                            <tr>
                                <th scope="row" style="background-color: #d2d2d2">D</th>
                                <th scope="row">Body</th>
                            </tr>
                            <?php
                            if ($resultBody->num_rows > 0) {
                                $n = 1;
                                while ($rowBodyItems = $resultBody->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="background-color: #d2d2d2"><?= $n ?></td>
                                        <td><?= $rowBodyItems['InsItemName'] ?></td>
                                        <td style="background-color:#48da3a;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-24" id="Good" value="1">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff5858;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-24" id="Bad" value="2">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff9c6b;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-24" id="NeedToReplace" value="3">
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <label for="ProductDescription" class="form-label">Special Notes</label>
                        <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription"></textarea>
                        <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                    </div>
                </div>
                            <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
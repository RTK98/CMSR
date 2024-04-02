<?php ob_start(); ?>
<?php
include'../header.php';
include'../menu.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="
         position: relative;
         z-index: 1;
         ">
        <h1 class="h2">Add Vehicle</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button class="btn btn-info" onclick="history.back()">Go Back</button>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card" style="
         gap: 20px;
         ">
        <div class="card-header">
            New Vehicle
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $customerImage = $_FILES['VehicleImage'];
            $registerLetter = inputTrim($registerLetter);
            $regsitrationNo = inputTrim($regsitrationNo);
            $modelName = inputTrim($modelName);
            $Millege = inputTrim($Millege);
            $messages = array();
            if (empty($Millege)) {
                $messages['error_Millege'] = "The Millege should not be Image..!";
            }
            if (empty($VehicleType)) {
                $messages['error_Vehicle_type'] = "The Vehicle Type should not be blank..!";
            }
            if (empty($modelName)) {
                $messages['error_vehicle_Model'] = "The Vehicle Model should not be blank..!";
            }
            if (!empty($registerLetter && $regsitrationNo)) {
                $db = dbconn();
                $sql = "SELECT * FROM customervehicles WHERE registerLetter='$registerLetter' AND RegistrationNo='$regsitrationNo';";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_vehicle_letter'] = "The Vehicle Already Exists!";
                }
            }
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
                            $file_path = "../assets/img/myVehicleImage/" . $file_name_new;
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
            if (empty($messages)) {
                $db = dbconn();

                 $sql1 = "SELECT * FROM vehiclemodels WHERE VehicleModelsId='$modelName'";
                $result = $db->query($sql1);
                $row1 = $result->fetch_assoc();
                $vehicleBrand = $row1['VBrand'];

                $AddUser = $_SESSION['CustomerID'];
                 $sql = "INSERT INTO customervehicles (VehicleType,VehicleImage,VehicleModel,VehicleBrand,registerLetter,RegistrationNo,CustomerID,Millege) "
                . "VALUES ('$VehicleType','$file_name_new','$modelName','$vehicleBrand','$registerLetter','$regsitrationNo','$AddUser','$Millege')";
                $db->query($sql);
                ?>
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Vehicle has been Create Successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewVehicle.php'; // Redirect to success page
                    });
            </script><?php
            }
            if (!empty($messages)) {
                ?>
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Something went wrong!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'add.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?> " enctype="multipart/form-data">
            <div class="card-body">
                <div class="mb-3">
                    <label for="VehicleImage" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="VehicleImage" name="VehicleImage"
                           placeholder="Enter Catergory Name">
<!--                    <div class="text-danger"><?= @$messages['error_Vehicle_image']; ?></div>-->
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT VCatergoryId,CatergoryName FROM vehicle_catergories";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="VehicleType" class="form-label">Vehicle Type</label>
                    <select class="form-select" aria-label="Default select example" name="VehicleType" id='VehicleType' onChange='LoadVehicle()'>
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
                    <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                </div>
                <div class="col-md-3">
                    <label>Vehicle Model:</label>
                    <select id='modelName' for="modelName" name="modelName" aria-label="Default select example">
                        <option value=''>--</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="registerLetter" class="form-label">Regsitration Letter</label>
                    <input type="text" class="form-control" id="registerLetter" name="registerLetter"
                           placeholder="ABC">
                    <div class="text-danger"><?= @$messages['error_vehicle_letter']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="regsitrationNo" class="form-label">Regsitration No</label>
                    <input type="text" class="form-control" id="regsitrationNo" name="regsitrationNo"
                           placeholder="1234">
                    <div class="text-danger"><?= @$messages['error_vehicle_letter']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="Millege" class="form-label">Millege (KM.)</label>
                    <input type="text" class="form-control" id="Millege" name="Millege"
                           placeholder="1234">
                    <div class="text-danger"><?= @$messages['error_vehicle_letter']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
<script>
    function LoadVehicle()
    {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#VehicleType').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadVehicleBrand.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#modelName').html(response);
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
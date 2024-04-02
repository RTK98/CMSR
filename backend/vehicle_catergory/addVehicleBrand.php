<?php  $Vehicle="active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Vehicle Brands</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewVehicleCatergory.php" class="btn btn-sm btn-outline-secondary">View Vehicle Catergory</a>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Vehicle Brand
        </div>
        <?php
//        print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $VehicleBrand = inputTrim(strtolower($VehicleBrand));
            $messages = array();
            if (empty($VehicleBrand)) {
                $messages['error_Catergory_Name'] = "The catergory Name should not be blank..!";
            }

            //image upload 
            if ($_FILES['VehicleBrandImage']['name'] != "") {
                $VehicleBrandImage = $_FILES['VehicleBrandImage'];
                $filename = $VehicleBrandImage['name'];
                $filetmpname = $VehicleBrandImage['tmp_name'];
                $filesize = $VehicleBrandImage['size'];
                $fileerror = $VehicleBrandImage['error'];
                //take file extension
                $file_ext = explode(".", $filename);
                $file_ext = strtolower(end($file_ext));
                //select allowed file type
                $allowed = array("jpg", "jpeg", "png", "gif");
                //check wether the file type is allowed
                if (in_array($file_ext, $allowed)) {
                    if ($fileerror === 0) {
                        //file size gives in bytes
                        if ($filesize <= 2097152) {
                            //giving appropriate file name. Can be duplicate have to validate using function
                            $file_name_new = uniqid('', true) . $VehicleBrand . '.' . $file_ext;
                            //directing file destination
                            $file_path = "../assets/img/vehicleBrand/" . $file_name_new;
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
            //advance validation
            if (!empty($VehicleBrand)) {
                $db = dbconn();
                $sql = "SELECT * FROM vehiclebrand WHERE VehicleBrandName='$VehicleBrand'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Brand_Name'] = "The Vehicle Brand Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                $sql = "INSERT INTO VehicleBrand(VehicleBrandName,BrandLogo,Status,AddUser,AddDate) VALUES ('$VehicleBrand', '$file_name_new','1' ,'$AddUser','$AddDate')";
                $db->query($sql);
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <div class="mb-3">
                    <label for="VehicleBrandImage" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="VehicleBrandImage" name="VehicleBrandImage">
                    <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="VehicleBrand" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="VehicleBrand" name="VehicleBrand"
                           placeholder="Enter Vehicle Brand Name ex. Toyota">
                    <div class="text-danger"><?= @$messages['error_Repair_Code']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </div>
</div>


</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
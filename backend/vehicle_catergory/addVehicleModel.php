<?php  $Vehicle="active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Vehicle Model</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewVehicleCatergory.php" class="btn btn-sm btn-outline-secondary">View Vehicle Category</a>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Vehicle Model
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $VehicleModel = inputTrim(strtolower($VehicleModel));
            $VEngineCC;
            $VBrand;
            $VCategory;
            $VBrand;
            $VFuel;
            $VMakeYearStart;

            $mfgYearStart = date("Y", strtotime($VMakeYearStart));
            $mfgMonthStart = date("m", strtotime($VMakeYearStart));

            $VmakeStartdate = sprintf("%04d-%02d-01", $mfgYearStart, $mfgMonthStart);

            $VMakeYearEnd;

            $mfgYearEnd = date("Y", strtotime($VMakeYearEnd));
            $mfgMonthEnd = date("m", strtotime($VMakeYearEnd));

            $VmakeEndtdate = sprintf("%04d-%02d-01", $mfgYearEnd, $mfgMonthEnd);

            $messages = array();
            if (empty($VehicleModel)) {
                $messages['error_Catergory_Name'] = "The catergory Name should not be blank..!";
            }

            //image upload 
            if ($_FILES['VBrandImage']['name'] != "") {
                $VBrandImage = $_FILES['VBrandImage'];
                $filename = $VBrandImage['name'];
                $filetmpname = $VBrandImage['tmp_name'];
                $filesize = $VBrandImage['size'];
                $fileerror = $VBrandImage['error'];
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
                            $file_name_new = uniqid('', true) . $VehicleModel . '.' . $file_ext;
                            //directing file destination
                            $file_path = "../assets/img/vehicleModel/" . $file_name_new;
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
                $sql = "INSERT INTO vehiclemodels(BrandImage,ModelName,VCatergoryName,VBrand,VFuelType,MfgStart,MfgEnd,EngineCC,Status,AddUser,AddDate) "
                . "VALUES ('$file_name_new','$VehicleModel','$VCategory','$VBrand','$VFuel','$VmakeStartdate',' $VmakeEndtdate','$VEngineCC','1','$AddUser','$AddDate')";
                $db->query($sql);
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="VBrandImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="VBrandImage" name="VBrandImage">
                        <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                    </div>
                    <?php
                    $db = dbconn();
                    $sql = "SELECT * FROM vehicle_catergories";
                    $result = $db->query($sql);
                    ?>
                    <div class="col-3">
                        <lable for="VCategory" class="form-label">Vehicle Category</lable>
                        <select for="VCategory" id="VCategory" name="VCategory" class="form-select" aria-label="Default select example">
                            <option value="">--</option>
                            <?php
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['VCatergoryId'] ?>" <?php
                                    if (@$VCategory == $row['CatergoryName']) {
                                        echo "selected";
                                    }
                                    ?>><?= $row['CatergoryName'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                        <div class="text-danger"><?= @$messages['error_City1']; ?></div>
                    </div>
                    <?php
                    $db = dbconn();
                    $sqlVBrand = "SELECT * FROM vehiclebrand";
                    $resultVBrand = $db->query($sqlVBrand); // Run Query
                    ?>
                    <div class="col-3">
                        <lable for="VBrand" class="form-label">Vehicle Brand</lable>
                        <select for="VBrand" id="VBrand" name="VBrand" class="form-select" aria-label="Default select example">
                            <option value="">--</option>
                            <?php
                            if ($resultVBrand->num_rows > 0) {

                                while ($rowVBrand = $resultVBrand->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $rowVBrand['VehicleBrandId'] ?>" <?php
                                    if (@$VBrand == ucwords($rowVBrand['VehicleBrandName'])) {
                                        echo "selected";
                                    }
                                    ?>><?= ucwords($rowVBrand['VehicleBrandName']) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                    <?php
                    $db = dbconn();
                    $sqlVFuel = "SELECT * FROM fueltype";
                    $resultVFuel = $db->query($sqlVFuel); // Run Query
                    ?>
                    <div class="col-3">
                        <lable for="VFuel" class="form-label">Fuel Type</lable>
                        <select for="VBrand" id="VFuel" name="VFuel" class="form-select" aria-label="Default select example">
                            <option value="">--</option>
                            <?php
                            if ($resultVFuel->num_rows > 0) {

                                while ($rowVFuel = $resultVFuel->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $rowVFuel['FuelTypeId'] ?>" <?php
                                    if (@$VFuel == ucwords($rowVFuel['FuelType'])) {
                                        echo "selected";
                                    }
                                    ?>><?= ucwords($rowVFuel['FuelType']) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="VehicleModel" class="form-label">Model Name</label>
                        <input type="text" class="form-control" id="VehicleModel" name="VehicleModel"
                               placeholder="Enter Vehicle Model Name ex. Evolution IV">
                        <div class="text-danger"><?= @$messages['error_Repair_Code']; ?></div>
                    </div>
                    <div class="col-2">
                        <lable for="VMakeYearStart" class="form-label">Starting Manufacture Year</lable><br>
                        <input type="month" id="VMakeYearStart" name="VMakeYearStart">
                    </div>
                    <div class="col-2">
                        <lable for="VMakeYearEnd" class="form-label">End Manufacture Year</lable><br>
                        <input type="month" id="VMakeYearEnd" name="VMakeYearEnd" placeholder="1000cc">
                    </div>
                    <div class="col-2">
                        <lable for="VEngineCC" class="form-label">Engine Capaity CC.</lable><br>
                        <input type="number" id="VEngineCC" name="VEngineCC">
                    </div>
                    <br>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </div>
    </div>
</div>


</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
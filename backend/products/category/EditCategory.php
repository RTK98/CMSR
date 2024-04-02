<?php  $Category="active" ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Catergories</h1>
    </div>
    <div class="card">
        <div class="card-header">
            New Catergory
        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && ($action == 'edit' || $action == 'update')) {
            $CatergoryID;
            $db = dbconn();
            $sql = "SELECT * FROM catergories WHERE CatergoryID='$CatergoryID'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $CatergoryName = ucwords($row['CatergoryName']);
            $CatergoryDescription = ucwords($row['CatergoryDescription']);
            $categoryImage = $row['CatergoryImage'];
        }
        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST" && $action == 'update') {
            $CatergoryID;
            $CatergoryName = strtolower(inputTrim($CatergoryName));
            $CatergoryDescription = inputTrim($CatergoryDescription);
            $messages = array();
            if (empty($CatergoryName)) {
                $messages['error_Catergory_name'] = "The Catergory Name should not be blank..!";
            }
            if (empty($CatergoryDescription)) {
                $messages['error_Catergory_des'] = "The CAtergory Description should not be blank..!";
            }
            //advance validation
            if (!empty($CatergoryName)) {
                $db = dbconn();
                $sql = "SELECT * FROM catergories WHERE CatergoryName='$CatergoryName' AND CatergoryID<>'$CatergoryID'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Catergory_name'] = "The Catergory Name Already Exists!";
                }
            }
            //image upload 
            if ($_FILES['CatergoryImageNew']['name'] != "") {
                $categorytimage = $_FILES['CatergoryImageNew'];
                $filename = $categorytimage['name'];
                $filetmpname = $categorytimage['tmp_name'];
                $filesize = $categorytimage['size'];
                $fileerror = $categorytimage['error'];
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
                            $file_name_new = uniqid('', true) . $CatergoryName . '.' . $file_ext;
                            //directing file destination
                            $file_path = "../../assets/img/catergory/" . $file_name_new;
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
            } else {
                $file_name_new = $PreviousImage;
            }
            if (empty($messages)) {
                echo $CatergoryID;
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];

                 $sql1 = "UPDATE catergories  SET CatergoryImage='$file_name_new', CatergoryName='$CatergoryName', CatergoryDescription='$CatergoryDescription' WHERE CatergoryID='$CatergoryID'";
                $result1 = $db->query($sql1);
                ?>

                <script>
                    Swal.fire({
        //                            title: 'Success!',
        //                            text: 'Password has been reset',
        //                            icon: 'success',
        //                            position: 'top-right',
        //                            showConfirmButton: true,
                        toast: true,
                        icon: 'success',
                        title: 'Catergory has been Successfully Updated',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewCategoryList.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data" >
            <div class="card-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="CatergoryImageNew" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="CatergoryImageNew" name="CatergoryImageNew">
                        <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="CatergoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="CatergoryName" name="CatergoryName"
                           placeholder="Enter Catergory Name" value="<?= @$CatergoryName ?>">
                    <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="CatergoryDescription" class="form-label">Category Description</label>
                <textarea class="form-control" id="CatergoryDescription" rows="3" name="CatergoryDescription"><?php if (!empty($CatergoryDescription)) echo $CatergoryDescription; ?></textarea>
                <div class="text-danger"><?= @$messages['error_Catergory_des']; ?></div>
            </div>
    </div>
    <div class="card-footer">
        <input type="text" name="PreviousImage" value="<?= $categoryImage ?>">
        <input type="text" name="CatergoryID" value="<?= $CatergoryID ?>">
        <button type="submit" name='action' value='update' class="btn btn-primary">Update</button>
    </div>
</form>
</div>
</div>
</main>
<?php include'../../footer.php'; ?>
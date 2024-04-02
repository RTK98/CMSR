<?php ob_start(); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a> -->
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Product
        </div>
        <?php
        extract($_POST);
//        print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && ($action == 'edit' || $action == 'save')) {
            $ProductId;

            $db = dbconn();
            $sql = "SELECT * from products WHERE ProductId='$ProductId'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $ProductName = $row['ProductName'];
            $ProductCategory = $row['ProductCatergory'];
            $SupplierName = $row['SupplierName'];
            $ReorderLevel = $row['ReorderLevel'];
            $ProductDescription = $row['ProductDescription'];
            $categoryImage = $row['ProductImage'];
        }
        ?>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && $action == 'save') {
            $ProductId;

            $ReorderLevelNew = inputTrim($ReorderLevelNew);

            $messages = array();

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
                            $file_name_new = uniqid('', true) . $ProductName . '.' . $file_ext;
                            //directing file destination
                            $file_path = "../assets/img/products/" . $file_name_new;
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
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                 $sql = "UPDATE products SET ProductImage='$file_name_new', ReorderLevel='$ReorderLevelNew',UpdateUser='$AddUser',`UpdateDate`='$AddDate' WHERE ProductId='$ProductId'";
                $db->query($sql);
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
                        title: 'Product has been Update Successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewProducts.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="CatergoryImageNew" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="CatergoryImageNew" name="CatergoryImageNew">
                        <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ProductName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="ProductName" name="ProductName"
                           placeholder="Enter Product Name" value='<?= @$ProductName ?>' readonly>
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT SupplierId, SupplierName FROM supplier";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <lable for="SupplierName" class="form-label">Category Product</lable>
                    <select class="form-select" name="SupplierName" id='SupplierName' aria-label="Default select example" onchange='loadCategories()' disabled>
                        <option selected>--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['SupplierId'] ?>" <?php
                                if (@$SupplierName == $row['SupplierId']) {
                                    echo 'selected';
                                }
                                ?>>
                                            <?= ucwords($row['SupplierName']) ?>
                                </option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <lable for="ProductCatergory" class="form-label">Category Product</lable>
                    <select class="form-select" name="ProductCatergory" id='ProductCatergory' aria-label="Default select example" disabled>
                        <option value="">--</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="$ReorderLevelNew" class="form-label">Re-order Level</label>
                    <input type="number" class="form-control" id="ReorderLevelNew" name="ReorderLevelNew"
                           min="5" value=<?= @$ReorderLevel ?>>
                </div>
            </div>
            <div class="mb-3">
                <label for="ProductDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription"><?= $ProductDescription ?></textarea>
                <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
            </div>
    </div>
    <div class="card-footer">
        <input type="text" name="PreviousImage" value="<?= $categoryImage ?>">
        <input type="hidden" name="ProductId" value="<?= $ProductId ?>">
        <button type="submit" name='action' value='save' class="btn btn-primary">Save</button>
    </div>
</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
<script>
    function loadCategories() {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#SupplierName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#ProductCatergory').html(response);
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
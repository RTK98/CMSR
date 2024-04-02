<?php ob_start(); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                 <a href="viewProducts.php" class="btn btn-sm btn-dark">View Products</a> 
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Product
        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $ProductName = strtolower(inputTrim($ProductName));
            $ProductDescription = inputTrim($ProductDescription);
            $ReorderLevel = inputTrim($ReorderLevel);
            $SupplierName;
            $ProductCatergory;
            $messages = array();
            if (empty($ProductName)) {
                $messages['error_Product_name'] = "The Product Name should not be blank..!";
            }
            if (empty($ProductDescription)) {
                $messages['error_Product_des'] = "The Product Description should not be blank..!";
            }
            //advance validation
            if (!empty($ProductName)) {
                $db = dbconn();
                $sql = "SELECT * FROM products WHERE ProductName='$ProductName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Product_size'] = "The Product Already Exists!";
                }
            }

            //image upload 
            if ($_FILES['CatergoryImage']['name'] != "") {
                $categorytimage = $_FILES['CatergoryImage'];
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
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                 $sql = "INSERT INTO products (ProductImage,ProductName,ProductCatergory,SupplierName,ProductDescription,ReorderLevel,ProductStatus,AddUser,AddDate)VALUES "
                        . "('$file_name_new','$ProductName','$ProductCatergory','$SupplierName','$ProductDescription','$ReorderLevel', '1','$AddUser','$AddDate')";
                $db->query($sql);
                ?>

                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Product has been Create Successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewProducts.php'; // Redirect to success page
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
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data" >
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="CatergoryImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="CatergoryImage" name="CatergoryImage">
                        <div class="text-danger"><?= @$messages['error_Catergory_name']; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ProductName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="ProductName" name="ProductName"
                           placeholder="Enter Product Name" value=<?= @$ProductName ?>>
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT SupplierId, SupplierName FROM supplier";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <lable for="SupplierName" class="form-label">Category Product</lable>
                    <select class="form-select" name="SupplierName" id='SupplierName' aria-label="Default select example" onchange='loadCategories()'>
                        <option selected>--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['SupplierId'] ?>" <?php
                                if (@$SupplierName == ucwords($row['SupplierName'])) {
                                    echo 'selected';
                                }
                                ?>>
                                            <?= $row['SupplierName'] ?>
                                </option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <lable for="ProductCatergory" class="form-label">Category Product</lable>
                    <select class="form-select" name="ProductCatergory" id='ProductCatergory' aria-label="Default select example">
                        <option selected>--</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ReorderLevel" class="form-label">Product Name</label>
                    <input type="number" class="form-control" id="ReorderLevel" name="ReorderLevel"
                           min="1" value=<?= @$ProductName ?>>
                </div>
            </div>
            <div class="mb-3">
                <label for="ProductDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="ProductDescription" name="ProductDescription"></textarea>
                <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
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
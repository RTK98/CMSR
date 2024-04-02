<?php ob_start();?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
        print_r($_POST);
         if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $ProductName = inputTrim($ProductName);
            $ProductPrice = inputTrim($ProductPrice);
            $ProductQty = inputTrim($ProductQty);
            $ProductDescription = inputTrim($ProductDescription);
            $messages = array();
            if(empty($ProductName)){
                $messages['error_Product_name'] = "The Product Name should not be blank..!";
            }
            if(empty($ProductPrice)){
                $messages['error_Product_price'] = "The Product Price should not be blank..!";
            }
            if(empty($ProductQty)){
                $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
            }
            if(empty($ProductDescription)){
                $messages['error_Product_des'] = "The Product Description should not be blank..!";
            }
            if(!isset($ProductStatus)){
                $messages['error_Product_status'] = "The Product Status should not be blank..!";
            }
            if(!isset($Size)){
                $messages['error_Product_size'] = "The Product Size should not be blank..!";
            }
            //advance validation
            if(!empty($ProductName)){
                $db = dbconn();
                $sql="SELECT * FROM products WHERE ProductName='$ProductName'";
                $result=$db->query($sql);
                
                if($result->num_rows>0){
                    $messages['error_Product_size'] = "The Product Name Already Exists!";
                }
            }
             if(empty($messages)){
                $db=dbconn();
                $AddDate=date('Y-m-d');
                $sql="INSERT INTO products(ProductName,ProductPrice,ProductQty,ProductDescription,ProductStatus,AddUser,AddDate)VALUES ('$ProductName', '$ProductPrice', '$ProductQty', '$ProductDescription', '$ProductStatus','1','$AddDate')";
                print_r($sql);
                $db->query($sql);
                $ProductId=$db->insert_id;
                foreach($Size as $value){
                    $sql="INSERT INTO productsize(ProductId,SIze) VALUES ('$ProductId','$value')";
                    $db->query($sql);
                }
                header('Location:addSuccess.php');
             }  
                
         }
        ?>
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="ProductName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="ProductName" name="ProductName"
                        placeholder="Enter Product Name" value=<?=@$ProductName?>>
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="ProductPrice" class="form-label">Product Price (Rs.)</label>
                    <input type="text" class="form-control" id="ProductPrice" name="ProductPrice"
                        placeholder="Enter Product Price" value=<?=@$ProductPrice?>>
                    <div class="text-danger"><?= @$messages['error_Product_price']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="ProductQty" class="form-label">Product Qty</label>
                    <input type="text" class="form-control" id="ProductQty" name="ProductQty"
                        placeholder="Enter Product Quantity" value=<?=@$ProductQty?>>
                    <div class="text-danger"><?= @$messages['error_Product_qty']; ?></div>
                </div>
                <div class="mb-3">
                    <lable for="SellingType" class="form-label">Selling Type</lable>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>--</option>
                        <option value="onlineSell">Online Sell</option>
                        <option value="inquiry">Inquiry</option>
                        <option value="both">Online Sell & Inquiry</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ProductStatus" class="form-label">Product Availability</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ProductStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ProductStatus" id="No" value="-">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Product_status']; ?></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="ProductSize" class="form-label">Select Product Size</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="Small" value="S" name="Size[]">
                    <label class="form-check-label" for="Small">Small (S)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="Medium" value="M" name="Size[]">
                    <label class="form-check-label" for="Medium">Medium (M)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="Large" value="L" name="Size[]">
                    <label class="form-check-label" for="Large">Large (L)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="ExLarge" value="XL" name="Size[]">
                    <label class="form-check-label" for="ExLarge">Extra Large (XL)</label>
                </div>
                <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
            </div>
            <div class="mb-3">
                <label for="ProductDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription"></textarea>
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
<?php ob_end_flush();?>
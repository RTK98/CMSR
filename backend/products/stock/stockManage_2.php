<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Stocks</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/viewStock.php" class="btn btn-sm btn-outline-secondary">View Stock List</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
            </div>
        </div>

    </div>
    <h2>Add Stock</h2>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {

        $SupplierName;
        $CatergoryName;
        $ProductName;
        $BatchNo;
        $serialNo = inputTrim($serialNo);
        $Cost = inputTrim($Cost);
        $SalePrice = inputTrim($SalePrice);
        echo $MfgDate;
        $ExpDate;
        $AddDate = date("Y-m-d");
        $AddUser = $_SESSION['userId'];

        $messages = array();

        if (empty($serialNo)) {
            $messages['error_serialNo'] = "The Product Serial No should not be blank..!";
        }
        if (empty($Cost)) {
            $messages['error_Cost'] = "The Product Price should not be blank..!";
        }
        if (empty($SalePrice)) {
            $messages['error_SalePrice'] = "The Product Sale Price should not be blank..!";
        }
        if ($Cost > $SalePrice) {
            $messages['error_Product_price'] = "The Product Price should not be Lesser than Cost..!";
        }
        if ($MfgDate > $ExpDate) {
            $messages['error_mfg'] = "The Product Expire Date leser than MFG date..!";
        }
        if (!empty($ProductName)) {
            $db = dbconn();
            $sql = "SELECT * FROM stockitems WHERE SerialNo='$serialNo'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                $messages['error_Product_size'] = "The Product Already Exists!";
            }
        }


        if (empty($messages)) {
            $db = dbConn();
            echo $sql = "INSERT INTO stockitems(SupplierName, CatergoryName, ProductName, BatchNo, SerialNo,Cost, SalePrice,MfgDate,ExpDate,Status,AddUser,AddDate) "
            . "VALUES ('$SupplierName','$CatergoryName','$ProductName','$BatchNo','$serialNo','$Cost','$SalePrice','$MfgDate','$ExpDate','1','$AddUser','$AddDate')";
            $db->query($sql);

            echo $sqlProductQty = "SELECT Qty FROM Products WHERE ProductId='$ProductName'";
            $result = $db->query($sqlProductQty);
            $row = $result->fetch_assoc();

            $ProductQty = $row['Qty'];
            echo $ProductQty += 1;
            echo '<br>';
            echo $sqlUpdateQty = "UPDATE products SET Qty='$ProductQty' WHERE  ProductId='$ProductName'";
            $db->query($sqlUpdateQty);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'addBatch') {
        extract($_POST);
        $db = dbConn();

        $SupplierName1;
        $CatergoryName1;
        $ProductName1;

        $messages = array();

        if (empty($messages)) {
            $date = date("ymd");

            $AddDate = date("Y-m-d");
            $AddUser = $_SESSION['userId'];

            echo $sql = "INSERT INTO batchno(SupplierId,CategoryId,ProductId,AddUser,AddDate) VALUES ('$SupplierName1','$CatergoryName1','$ProductName1','$AddUser','$AddDate')";
            $result = $db->query($sql);

            $batchId = $db->insert_id;

            $LastValue = sprintf("%'.04d\n", $batchId);
            $batchNo = 'BC' . $date . 'S' . $SupplierName1 . 'C' . $CatergoryName1 . 'P' . $ProductName1 . $LastValue;

            echo $sql1 = "UPDATE batchno  SET BatchNo='$batchNo' WHERE BatchId='$batchId'";
            $result1 = $db->query($sql1);
        }
    }
    ?>
    <div class="row">
        <div class="col-md-9">
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <div class="row m-1">
                    <div class="card">
                        <div class="row g-3">
                            <div class="text-danger"><?= @$messages['error_Product_price']; ?></div>
                            <div class="text-danger"><?= @$messages['error_mfg']; ?></div>
                            <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                            <div class="col-md-4">
                                <label>Select Supplier</label>
                                <?php
                                $db = dbConn();
                                $sqlCategory = "SELECT * FROM supplier WHERE Status='1' ";
                                $resultCategory = $db->query($sqlCategory);
                                ?>
                                <select name="SupplierName" id='SupplierName' onChange='loadSupplierCatergory()'>
                                    <option value="">--</option>
                                    <?php
                                    if ($resultCategory->num_rows > 0) {
                                        while ($row = $resultCategory->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['SupplierId'] ?>" <?php
                                            if (@$SupplierName == ucwords($row['SupplierName'])) {
                                                echo "selected";
                                            }
                                            ?>><?= ucwords($row['SupplierName']) ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Select Category Name</label>
                                <select id='CatergoryName' for="CatergoryName" name="CatergoryName" aria-label="Default select example" onChange='loadSupplierProduct()'>
                                    <option value=''>--</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label>Select Product Name</label>
                                <select id='ProductName' for="ProductName" name="ProductName" aria-label="Default select example" onChange='loadSupplierBatch()'>
                                    <option value=''>--</option>
                                </select>
                            </div>

                        </div>
                        <div class="row m-1">
                            <div class="col-md-3">
                                <label>Select Batch No :</label>
                                <select id='BatchNo' for="BatchNo" name="BatchNo" aria-label="Default select example">
                                    <option value=''>--</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Serial No : </label>
                                <input type='text' name='serialNo'>
                                <div class="text-danger"><?= @$messages['error_serialNo']; ?></div>
                            </div>
                            <div class="col-md-3">
                                <label>Enter Product Cost (Rs.) : </label>
                                <input type='number' name='Cost'>
                                <div class="text-danger"><?= @$messages['error_Cost']; ?></div>
                            </div>
                            <div class="col-md-3">
                                <label>Enter Product Sale Price (Rs.) :</label>
                                <input type='number' name='SalePrice'>
                                <div class="text-danger"><?= @$messages['error_SalePrice']; ?></div>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-md-3">
                                <label>Enter Manufacture Date :</label>
                                <input type='date' name='MfgDate'>
                            </div>
                            <div class="col-md-3">
                                <label>Enter Expire Date :</label>
                                <input type='date' name='ExpDate'>
                            </div>
                            <div class="col-md-3">
                                <button class='btn btn-primary btn-sm' type="submit" name="action" value="save">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>


            <?php
//    $db = dbConn();
//    echo $sql = "SELECT i.ProductName,s.Price,s.Qty,s.SalePrice,s.Date,s.IssueQty,(s.Qty-s.IssueQty) AS 'Balance' FROM stock s LEFT JOIN stockitems i ON i.Id=s.ProductId";
//    $result = $db->query($sql);
            $db = dbConn();
            echo $sql = "SELECT p.ProductId,p.ProductName,ProductCatergory,p.SupplierName,p.Qty,p.ProductStatus,c.CatergoryName,sp.SupplierName FROM products p "
                    . "LEFT JOIN catergories c ON c.CatergoryID=p.ProductCatergory"
                    . " LEFT JOIN supplier sp ON sp.SupplierId=p.SupplierName" ;
//            echo $sql = "SELECT p.ProductId,p.Qty, p.IssuedQty,p.ProductStatus,p.ProductName,s.AddDate, (Qty-IssuedQty) AS 'Balance',"
//            . "b.BatchNo,s.SerialNo, s.Cost,s.SalePrice,s.MfgDate,s.ExpDate,s.Status FROM products p "
//            . "LEFT JOIN stockitems s ON s.ProductName=p.ProductId "
//            . "LEFT JOIN batchno b ON b.BatchId = s.BatchNo "
//            . "WHERE p.ProductId=1 AND p.ProductStatus='1'";
//            echo $sql = "SELECT p.ProductName, s.Price, s.Qty, s.SalePrice, s.Date,IssueQty,(s.Qty-s.IssueQty) AS 'Balance' FROM stock s LEFT JOIN products p ON p.ProductId=s.id";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Batch No</th>
                        <th>Serial No</th>
                        <th>Product Cost (Rs.(</th>
                        <th>Sale Price (Rs.)</th>
                        <th>Qty</th>
                        <th>Issued Items</th>
                        <th>Balance</th>
                        <th>System Added Date</th>
                        <th>Mfg.Date</th>
                        <th>Exp.Date</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['ProductName'] ?></td>
                                <td><?= $row['BatchNo'] ?></td>
                                <td><?= $row['SerialNo'] ?></td>
                                <td><?= $row['Cost'] ?></td>
                                <td><?= $row['SalePrice'] ?></td>
                                <td><?= $row['Qty'] ?></td>
                                <td><?= $row['IssuedQty'] ?></td>
                                <td><?= $row['Balance'] ?></td>
                                <td><?= $row['AddDate'] ?></td>
                                <td><?= $row['MfgDate'] ?></td>
                                <td><?= $row['ExpDate'] ?></td>
                                <td><?= $row['Status'] ?></td>

                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                        $db = dbConn();
                        $sqlCategory1 = "SELECT * FROM supplier WHERE Status='1' ";
                        $resultCategory1 = $db->query($sqlCategory1);
                        ?>
                        <h5 class="card-title">Create Batch No</h5>
                        <div class="mb-3">
                            <label for="SupplierName1" class="form-label">Supplier</label>
                            <select id='SupplierName1' for="SupplierName1" name="SupplierName1" class="form-select" aria-label="Default select example" onChange='loadSupplierCatergory1()'>
                                <option>--</option>
                                <?php
                                if ($resultCategory1->num_rows > 0) {
                                    while ($row = $resultCategory1->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['SupplierId'] ?>" <?php
                                        if (@$SupplierName == ucwords($row['SupplierName'])) {
                                            echo "selected";
                                        }
                                        ?>><?= ucwords($row['SupplierName']) ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="CatergoryName1" class="form-label">Category</label>
                            <select id='CatergoryName1' for="CatergoryName1" name="CatergoryName1" class="form-select" aria-label="Default select example" onChange='loadSupplierProduct1()'>
                                <option>--</option>

                            </select>
                            <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="ProductName1" class="form-label">Product Name</label>
                            <select id='ProductName1' for="ProductName1" name="ProductName1" class="form-select" aria-label="Default select example">
                                <option value=''>--</option>

                            </select>
                            <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                        </div>
                        <button type="submit" name="action" value="addBatch" class="btn btn-dark ">Create Batch No</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</main>
<?php include '../../footer.php'; ?>
<script>
    function loadSupplierCatergory() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();

        $("#BatchNo").empty();
        var selectedOption = $('#SupplierName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCatergories.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#CatergoryName').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }



    function loadSupplierProduct() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        $("#BatchNo").empty();
        var selectedOption = $('#CatergoryName').val();
        var selectedOption1 = $('#SupplierName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption, batch: false},
            success: function (response) {
                $('#ProductName').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }


    function loadSupplierBatch() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CatergoryName').val();
        var selectedOption1 = $('#SupplierName').val();
        var selectedOption3 = $('#ProductName').val();

//        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadBatch.php',
            data: {suppId: selectedOption1, catId: selectedOption, proId: selectedOption3},
            success: function (response) {
                $('#BatchNo').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
//----------------------------------------------------------------------------------------------//
//Add Batch
    function loadSupplierCatergory1() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();

        $("#BatchNo").empty();
        var selectedOption = $('#SupplierName1').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCatergories.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#CatergoryName1').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
//
//
//
    function loadSupplierProduct1() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        $("#BatchNo").empty();
        var selectedOption = $('#CatergoryName1').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption, batch: false},
            success: function (response) {
                $('#ProductName1').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
//
//
//    function loadSupplierBatch() {
//        ////        alert("loadCustomerName");
//        //        var formData = $('#addSkills').serialize();
//        var selectedOption = $('#CatergoryName').val();
//        var selectedOption1 = $('#SupplierName').val();
//        var selectedOption3 = $('#ProductName').val();
//
////        console.log(selectedOption);
//        $.ajax({
//            type: 'POST',
//            url: 'loadBatch.php',
//            data: {suppId: selectedOption1, catId: selectedOption, proId: selectedOption3},
//            success: function (response) {
//                $('#BatchNo').html(response);
//                //                alert(response);
//                //$('#citylist').modal('show');
//                //alert(response)
//            },
//            error: function () {
//                alert('Error submitting the form!');
//            }
//        });
//    }


</script>
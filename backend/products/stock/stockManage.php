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
        $PoNumber;

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

             $sql = "INSERT INTO stockitems(SupplierName, CatergoryName, ProductName, BatchNo,PoNo, SerialNo,Cost, SalePrice,MfgDate,ExpDate,Status,AddUser,AddDate) "
            . "VALUES ('$SupplierName','$CatergoryName','$ProductName','$BatchNo','$PoNumber','$serialNo','$Cost','$SalePrice','$MfgDate','$ExpDate','1','$AddUser','$AddDate')";
            $db->query($sql);

             $sqlProductQty = "SELECT Qty FROM Products WHERE ProductId='$ProductName'";
            $result = $db->query($sqlProductQty);
            $row = $result->fetch_assoc();

            $ProductQty = $row['Qty'];
            echo $ProductQty += 1;
            echo '<br>';
             $sqlUpdateQty = "UPDATE products SET Qty='$ProductQty' WHERE  ProductId='$ProductName'";
            $db->query($sqlUpdateQty);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'addBatch') {
        extract($_POST);
        $db = dbConn();

        $AddDate = date("Y-m-d");
        $AddUser = $_SESSION['userId'];

        $SupplierName1;
        $CatergoryName1;
        $ProductName1;

        $messages = array();

        if (empty($messages)) {
            $date = date("ymd");

            $AddDate = date("Y-m-d");
            $AddUser = $_SESSION['userId'];

             $sql = "INSERT INTO batchno(SupplierId,CategoryId,ProductId,BatchStatus,AddUser,AddDate) VALUES ('$SupplierName1','$CatergoryName1','$ProductName1','1','$AddUser','$AddDate')";
            $result = $db->query($sql);

            $batchId = $db->insert_id;

            $LastValue = sprintf("%'.04d\n", $batchId);
            $batchNo = 'BC' . $date . 'S' . $SupplierName1 . 'C' . $CatergoryName1 . 'P' . $ProductName1 . $LastValue;

             $sql1 = "UPDATE batchno  SET BatchNo='$batchNo' WHERE BatchId='$batchId'";
            $result1 = $db->query($sql1);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'closeBatchNo') {
        extract($_POST);
        $db = dbConn();

        $AddDate = date("Y-m-d");
        $AddUser = $_SESSION['userId'];

        $batchNo1;
        $ProductName2;
        $CatergoryName2;
        $SupplierName2;

        $messages = array();

        if (empty($messages)) {

             $sql3 = "UPDATE batchno  SET BatchStatus='0', UpdateUser='$AddUser', UpdateDate='$AddDate' WHERE BatchId='$batchNo1'";
            $result3 = $db->query($sql3);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'closePO') {
        extract($_POST);
        $db = dbConn();

        $AddDate = date("Y-m-d");
        $AddUser = $_SESSION['userId'];

        $poNo;
        $SupplierName3;
        $CatergoryName3;
        $ProductName3;

        $messages = array();

        if (empty($messages)) {

             $sql4 = "UPDATE purchasingorders  SET Status='0',  UpdateUser='$AddUser', UpdateDate='$AddDate' WHERE PoId='$poNo'";
            $result4 = $db->query($sql4);

             $sql5 = "UPDATE products  SET OrderStatus='2',  UpdateUser='$AddUser', UpdateDate='$AddDate' WHERE ProductId='$ProductName3'";
            $result5 = $db->query($sql5);
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
                                <select class="form-control"  name="SupplierName" id='SupplierName' onChange='loadSupplierCatergory()'>
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
                                <select class="form-control"  id='CatergoryName' for="CatergoryName" name="CatergoryName" aria-label="Default select example" onChange='loadSupplierProduct()'>
                                    <option value=''>--</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label>Select Product Name</label>
                                <select  class="form-control"  id='ProductName' for="ProductName" name="ProductName" aria-label="Default select example" onChange='loadSupplierBatch()'>
                                    <option value=''>--</option>
                                </select>
                            </div>

                        </div>
                        <div class="row m-1">
                            <div class="col-md-3">
                                <label>Select Batch No :</label>
                                <select class="form-control"  id='BatchNo' for="BatchNo" name="BatchNo" aria-label="Default select example">
                                    <option value=''>--</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Serial No : </label>
                                <input class="form-control"  type='text' name='serialNo'>
                                <div class="text-danger"><?= @$messages['error_serialNo']; ?></div>
                            </div>
                            <div class="col-md-3">
                                <label>Enter Product Cost (Rs.) : </label>
                                <input class="form-control"  type='number' name='Cost' min="0">
                                <div class="text-danger"><?= @$messages['error_Cost']; ?></div>
                            </div>
                            <div class="col-md-3">
                                <label>Enter Product Sale Price (Rs.) :</label>
                                <input class="form-control"  type='number' name='SalePrice' min="0">
                                <div class="text-danger"><?= @$messages['error_SalePrice']; ?></div>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-md-3">
                                <?php
                                $mindate = date("Y-m-d");
                                $mindate1 = date("Y-m-d", strtotime("-90 days"));
                                ?>
                                <label>Enter Manufacture Date :</label>
                                <input class="form-control"  type='date' min="<?= $mindate1 ?>"  max="<?= $mindate ?>" name='MfgDate'>
                            </div>
                            <?php
                            $maxdate = date("Y-m-d", strtotime("+90 days"));
                            ?>
                            <div class="col-md-3">
                                <label>Enter Expire Date :</label>
                                <input class="form-control" min="<?= $maxdate ?>"  type='date' name='ExpDate'>
                            </div>
                            <div class="col-md-3">
                                <label>Select Purchasing Order No</label>
                                <select class="form-control"  id='PoNumber' for="PoNumber" name="PoNumber" aria-label="Default select example">
                                    <option value=''>--</option>
                                </select>
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
             $sql = "SELECT p.ProductId,p.ProductName,p.Qty,p.ProductStatus,p.IssuedQty,(p.Qty-p.IssuedQty) AS 'Balance',c.CatergoryName,sp.SupplierName FROM products p "
            . "LEFT JOIN catergories c ON c.CatergoryID=p.ProductCatergory"
            . " LEFT JOIN supplier sp ON sp.SupplierId=p.SupplierName";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Supplier Name</th>
                        <th>Qty</th>
                        <th>Issued Qty</th>
                        <th>Balance</th>
                        <th>Product Status</th>
                        <th>ACtion</th>

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
                                <td><?= $row['CatergoryName'] ?></td>
                                <td><?= ucwords($row['SupplierName']) ?></td>
                                <td><?= $row['Qty'] ?></td>
                                <td><?= $row['IssuedQty'] ?></td>
                                <td><?= $row['Balance'] ?></td>
                                <td><?php
                                    $ProductStatus = $row['ProductStatus'];
                                    $statusDescription = '';

                                    switch ($ProductStatus) {
                                        case 1:
                                            $statusDescription = "Active";
                                            $statusColor = "btn btn-success btn-sm";
                                            break;
                                        case 0:
                                            $statusDescription = "Deactive";
                                            $statusColor = "btn btn-danger btn-sm";
                                            break;

                                        default:
                                            $statusDescription = "Not Available";
                                            $statusColor = "btn btn-secondary btn-sm";
                                            break;
                                    }
                                    ?>
                                    <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                    <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                </td>

                                <td>
                                    <?php
                                    $appointmentStatus;
                                    if ($ProductStatus == 0) {
                                        $disabled = "disabled";
                                    } else {
                                        $disabled = "";
                                    }
                                    ?>
                                    <form method='post' action="ViewProducts.php" class="btn-group">
                                        <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                        <button type="submit" class="btn btn-primary" name="action" value="view" <?= @$disabled ?>>View</button>
                                    </form>
                                </td>
                                <td>
                                </td>
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
            <section>
                <div class="row">
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
            </section>
            <section  style="margin-top:10px;">
                <div class="row">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
                        <div class="card">
                            <div class="card-body text-center">
                                <?php
                                $db = dbConn();
                                $sqlCategory2 = "SELECT * FROM supplier WHERE Status='1' ";
                                $resultCategory2 = $db->query($sqlCategory2);
                                ?>
                                <h5 class="card-title">Close Batch No</h5>
                                <div class="mb-3">
                                    <label for="SupplierName2" class="form-label">Supplier</label>
                                    <select id='SupplierName2' for="SupplierName2" name="SupplierName2" class="form-select" aria-label="Default select example" onChange='loadSupplierCatergory2()'>
                                        <option>--</option>
                                        <?php
                                        if ($resultCategory2->num_rows > 0) {
                                            while ($row = $resultCategory2->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row['SupplierId'] ?>" <?php
                                                if (@$SupplierName2 == ucwords($row['SupplierName'])) {
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
                                    <label for="CatergoryName2" class="form-label">Category</label>
                                    <select id='CatergoryName2' for="CatergoryName2" name="CatergoryName2" class="form-select" aria-label="Default select example" onChange='loadSupplierProduct2()'>
                                        <option>--</option>

                                    </select>
                                    <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="ProductName2" class="form-label">Product Name</label>
                                    <select id='ProductName2' for="ProductName2" name="ProductName2" class="form-select" aria-label="Default select example" onChange='loadSupplierBatch1()'>
                                        <option value=''>--</option>
                                    </select>
                                </div>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                <div class="md-3">
                                    <label for="batchNo1" class="form-label">Batch No</label>
                                    <select id='batchNo1' for="batchNo1" name="batchNo1" class="form-select" aria-label="Default select example">
                                        <option value=''>--</option>
                                    </select>
                                    </select>
                                </div>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                <button type="submit" name="action" value="closeBatchNo" class="btn btn-dark ">Close Batch No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section  style="margin-top:10px;">
                <div class="row">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
                        <div class="card">
                            <div class="card-body text-center">
                                <?php
                                $db = dbConn();
                                $sqlCategory3 = "SELECT * FROM supplier WHERE Status='1' ";
                                $resultCategory3 = $db->query($sqlCategory3);
                                ?>
                                <h5 class="card-title">Close Purchasing Order</h5>
                                <div class="mb-3">
                                    <label for="SupplierName3" class="form-label">Supplier</label>
                                    <select id='SupplierName3' for="SupplierName3" name="SupplierName3" class="form-select" aria-label="Default select example" onChange='loadSupplierCatergory3()'>
                                        <option>--</option>
                                        <?php
                                        if ($resultCategory3->num_rows > 0) {
                                            while ($row = $resultCategory3->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row['SupplierId'] ?>" <?php
                                                if (@$SupplierName3 == ucwords($row['SupplierName'])) {
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
                                    <label for="CatergoryName3" class="form-label">Category</label>
                                    <select id='CatergoryName3' for="CatergoryName3" name="CatergoryName2" class="form-select" aria-label="Default select example" onChange='loadSupplierProduct3()'>
                                        <option>--</option>

                                    </select>
                                    <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="ProductName3" class="form-label">Product Name</label>
                                    <select id='ProductName3' for="ProductName3" name="ProductName3" class="form-select" aria-label="Default select example" onChange='loadPONo()'>
                                        <option value=''>--</option>
                                    </select>
                                </div>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                <div class="md-3">
                                    <label for="poNo" class="form-label">PO No</label>
                                    <select id='poNo' for="poNo" name="poNo" class="form-select" aria-label="Default select example">
                                        <option value=''>--</option>
                                    </select>
                                    </select>
                                </div>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                                <button type="submit" name="action" value="closePO" class="btn btn-dark " onclick="return confirm('Are you sure to Close PO?')">Close Purchasing No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
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

        $.ajax({
            type: 'POST',
            url: 'loadPO.php',
            data: {suppId: selectedOption1, catId: selectedOption, proId: selectedOption3},
            success: function (response) {
                $('#PoNumber').html(response);
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
//        $("#BatchNo").empty();
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

//-------------------------Batch No Close------------------------------------------------
//
    function loadSupplierCatergory2() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();

//        $("#BatchNo1").empty();
        var selectedOption = $('#SupplierName2').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCatergories.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#CatergoryName2').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
////
////
////
    function loadSupplierProduct2() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
//        $("#BatchNo1").empty();
        var selectedOption = $('#CatergoryName2').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption, batch: false},
            success: function (response) {
                $('#ProductName2').html(response);
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
    function loadSupplierBatch1() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CatergoryName2').val();
        var selectedOption1 = $('#SupplierName2').val();
        var selectedOption3 = $('#ProductName2').val();

        console.log(selectedOption3);
        $.ajax({
            type: 'POST',
            url: 'loadBatch.php',
            data: {suppId: selectedOption1, catId: selectedOption, proId: selectedOption3},
            success: function (response) {
                $('#batchNo1').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
    //----------------------------------------------------------------------------


    function loadSupplierCatergory3() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();

//        $("#BatchNo1").empty();
        var selectedOption = $('#SupplierName3').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCatergories.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#CatergoryName3').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
    function loadSupplierProduct3() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
//        $("#BatchNo1").empty();
        var selectedOption = $('#CatergoryName3').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption, batch: false},
            success: function (response) {
                $('#ProductName3').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }

    function loadPONo() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CatergoryName3').val();
        var selectedOption1 = $('#SupplierName3').val();
        var selectedOption3 = $('#ProductName3').val();

//        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadPO.php',
            data: {suppId: selectedOption1, catId: selectedOption, proId: selectedOption3},
            success: function (response) {
                $('#poNo').html(response);
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
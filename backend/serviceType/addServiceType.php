<?php $Service = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Service Managment</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                 style="
                 display: block;
                 margin-left: auto;
                 margin-right: auto;
                 ">
            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
            <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
            <p class='m-1' style="text-align: center;">0779 200 480</p>

        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $ServiceName = inputTrim($ServiceName);
            $ServiceCost = inputTrim($ServiceCost);
            $ServicePrice = inputTrim($ServicePrice);
            $messages = array();
            if (empty($ServiceName)) {
                $messages['error_Service_name'] = "The Service Name should not be blank..!";
            }
            if (empty($ServiceCost)) {
                $messages['error_Service_price'] = "The Service Price should not be blank..!";
            }
            if (empty($ServicePrice)) {
                $messages['error_Service_price'] = "The Service price should not be blank..!";
            }
            if (empty($VehicleType)) {
                $messages['error_Vehicle_type'] = "The Vehicle Type should not be blank..!";
            }
            if (!isset($ServiceStatus)) {
                $messages['error_Service_status'] = "The Service Status should not be blank..!";
            }
            if (!isset($Items)) {
                $messages['error_Service_Items'] = "The Service Items should not be blank..!";
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $sql = "INSERT INTO service(ServiceName,ServiceCost,ServicePrice,CatergoryName,ServiceStatus,AddUser,AddDate) VALUES ('$ServiceName', '$ServiceCost' ,'$ServicePrice','$VehicleType','$ServiceStatus','1','$AddDate')";

                $db->query($sql);
                $ServiceId = $db->insert_id;
                foreach ($Items as $value) {
                    $sql = "INSERT INTO servicetypes(Service_Id,VCatergory_Id,Product_Id) VALUES ('$ServiceId','$VehicleType','$value')";
                    $db->query($sql);
                }
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Service</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                    <label for="ServiceName" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="ServiceName" name="ServiceName"
                           placeholder="Enter Service Name" value='<?= @$ServiceName ?>'>
                </div>
                <div class="mb-3">
                    <label for="ServiceCost" class="form-label">Service Cost (Rs.)</label>
                    <input type="text" class="form-control" id="ServiceCost" name="ServiceCost"
                           placeholder="Enter Service Cost" value='<?= @$ServiceCost ?>'>
                </div>
                <div class="mb-3">
                    <label for="ServicePrice" class="form-label">Service Price (Rs.)</label>
                    <input type="text" class="form-control" id="ServicePrice" name="ServicePrice"
                           placeholder="Enter Service Price" value="<?= @$ServicePrice ?>">
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT VCatergoryId,CatergoryName FROM vehicle_catergories";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="VehicleType" class="form-label">Vehicle Type</label>
                    <select class="form-select" aria-label="Default select example" name="VehicleType">
                        <option value="NoCatergory">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['VCatergoryId'] ?>" <?php
                                if (@$VehicleType == $row['VCatergoryId']) {
                                    echo "selected";
                                }
                                ?>><?= $row['CatergoryName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ServiceStatus" class="form-label">Service Availability</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ServiceStatus" id="Yes" value="1" <?php
                        if (@$ServiceStatus == '1') {
                            echo "checked";
                        }
                        ?>>
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ServiceStatus" id="No" value="0"<?php
                        if (@$ServiceStatus == '0') {
                            echo "checked";
                        }
                        ?>>
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Service_status']; ?></div>
                </div>
                <div class="col-sm-2">
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM catergories";
                    $result = $db->query($sql);
                    ?>
                    <select name="modelvehicle" class="form-control">
                        <option value="">--Products--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['CatergoryID'] ?>"><?= $row['CatergoryName'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-warning">Search</button>
                </div>
        </form> 
        <?php
        $db = dbConn();
        $where = null;
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($modelvehicle)) {
                $where .= " cat.CatergoryID='$modelvehicle' AND";
            }
        }
        if (!empty($where)) {
            $where = substr($where, 0, -3);
            $where = " WHERE $where";
        }

        $sql = "SELECT p.ProductId,"
                . "p.ProductName,"
                . "cat.CatergoryName FROM catergories cat "
                . "LEFT JOIN products p ON p.ProductCatergory=cat.CatergoryID $where";

        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $total = $result->num_rows;
        } else {
            $total = 0;
        }
        ?>

        <table class="table table-striped table-sm">
            <h5><span class="badge bg-primary"><?= $total ?></span> Products</h5>
            <div class="text-danger"><?= @$messages['error_Service_Items']; ?></div>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['ProductName'] ?></td>
                            <td>
                            </td>
                            <td>
                                <input type="checkbox" value="<?= $row['ProductId'] ?>" name="Items[]"
                                <?php
                                if (isset($Items)) {
                                    if (in_array($row['ProductId'], $Items)) {
                                        echo "checked";
                                    }
                                }
                                ?>>
                                &nbsp;
                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    echo'<td></td>'
                    . '<td colspan="5"><strong><h5 class="btn btn-warning" style="align-items:center;">No Result Found</h5></strong></td>'
                    . '<td></td>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</main>
<?php include'../footer.php'; ?>
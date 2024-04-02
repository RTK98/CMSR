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
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "edit") {
//            extract($_POST);
            $db = dbConn();
            $sqlStype = "SELECT * FROM service WHERE ServiceId='$ServiceId'";
            $resultSname = $db->query($sqlStype);
            $row1 = $resultSname->fetch_assoc();
            $ServiceName = $row1["ServiceName"];
            $ServiceCost = $row1["ServiceCost"];
            $ServicePrice = $row1["ServicePrice"];
            $VehicleType = $row1["CatergoryName"];

             $sql = "SELECT * FROM servicetypes WHERE Service_Id='$ServiceId'";
            $result = $db->query($sql);

            while ($row = $result->fetch_assoc()) {
                $Items[] = $row['Product_Id'];
            }
        }
        ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "update") {

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
            if (!isset($Items)) {
                $messages['error_Service_status'] = "The Service Status should not be blank..!";
            }

            if (!empty($ServiceCost)) {
                if ($ServiceCost < 0) {
                    $messages['error_pCost'] = "The price should not be less than 0!";
                }
            }
            if (!empty($ServicePrice)) {
                if ($ServicePrice < 0) {
                    $messages['error_pprice'] = "The price should not be less than 0!";
                }
            }
            if (!empty($ServiceName)) {
                $sql = "SELECT * FROM service WHERE ServiceName='$ServiceName' AND ServiceId<>'$ServiceId'";

                $db = dbConn();
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_pcode'] = "This Service already exsist..!";
                }
            }
//            die();
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                 $sql = "UPDATE service SET ServiceName='$ServiceName', ServiceCost='$ServiceCost', ServicePrice='$ServicePrice', CatergoryName='$VehicleType', UpdateUser='$AddUser', UpdateDate='$AddDate' WHERE ServiceId='$ServiceId'";
             
                $db->query($sql);

                 $sql = "DELETE FROM servicetypes WHERE Service_Id='$ServiceId'";
                $db->query($sql);

                foreach ($Items as $value) {
                     $sql = "INSERT INTO servicetypes(Service_Id,VCatergory_Id,Product_Id) VALUES ('$ServiceId','$VehicleType','$value')";
                    $db->query($sql);
                }
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Service has been updated Successfully',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = '<?= SYSTEM_PATH ?>serviceType/ViewServiceType.php'; // Redirect to success page
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
                    timer: 3000,
                }).then(() => {
                });
            </script><?php
        }
        ?>  
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Edit Service</h4>
            </div>
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_pcode']; ?></div>
                <div class="mb-3">
                    <label for="ServiceName" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="ServiceName" name="ServiceName" value="<?= @$ServiceName ?>"
                           placeholder="Enter Service Name">
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="ServiceCost" class="form-label">Service Cost (Rs.)</label>
                    <input type="text" class="form-control" id="ServiceCost" name="ServiceCost" value="<?= @$ServiceCost ?>"
                           placeholder="Enter Service Cost">
                    <div class="text-danger"><?= @$messages['error_pCost']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="ServicePrice" class="form-label">Service Price (Rs.)</label>
                    <input type="text" class="form-control" id="ServicePrice" name="ServicePrice" value="<?= @$ServicePrice ?>"
                           placeholder="Enter Service Price">
                    <div class="text-danger"><?= @$messages['error_pprice']; ?></div>
                </div>
                <?php
                $db = dbconn();
                 $sqlVehicleCat = "SELECT * FROM vehicle_catergories";
                $resultVehicleCat = $db->query($sqlVehicleCat);
                ?>
                <div class="mb-3">
                    <label for="VehicleType" class="form-label">Vehicle Type</label>
                    <select class="form-select" aria-label="Default select example" name="VehicleType">
                        <option value="NoCatergory">--</option>
                        <?php
                        if ($resultVehicleCat->num_rows > 0) {

                            while ($rowCat = $resultVehicleCat->fetch_assoc()) {
                                ?>
                                <option value="<?= $rowCat['VCatergoryId'] ?>" <?php
                                if (@$VehicleType == $rowCat['VCatergoryId']) {
                                    echo "selected";
                                }
                                ?>><?= $rowCat['CatergoryName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
                <?php
                $db = dbconn();
                $sqlProduct = "SELECT * FROM products";
                $resultProduct = $db->query($sqlProduct);
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        if ($resultProduct->num_rows > 0) {
                            $n = 1;
                            while ($rowProduct = $resultProduct->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><?= $rowProduct['ProductName'] ?></td>
                                    <td>
                                    </td>
                                    <td>
                                        <input type="checkbox" value="<?= $rowProduct['ProductId'] ?>" name="Items[]"
                                        <?php
                                        if (isset($Items)) {
                                            if (in_array($rowProduct['ProductId'], $Items)) {
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
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">

                <input type="hidden" name="ServiceId" value="<?= $ServiceId ?>">
                <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Update</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
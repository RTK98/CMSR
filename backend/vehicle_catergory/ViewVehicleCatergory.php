<?php  $Vehicle="active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Vehicles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addVehicleCatergory.php" class="btn btn-sm btn-dark">Add Vehicle Category</a>
            </div>
            <div class="btn-group me-2">
                <a href="addVehicleBrand.php" class="btn btn-sm btn-dark">Add Vehicle Brand</a>
            </div>
            <div class="btn-group me-2">
                <a href="addVehicleModel.php" class="btn btn-sm btn-dark">Add Vehicle Model</a>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <hr>
    <section>
        <div class="row">
            <div class="col" id="report">
                <h4 style="font-weight: bold;">Vehicle Category list</h4>
                <div class="table-responsive">
                    <?php
                    $db = dbconn();
                    $sql = "SELECT * FROM vehicle_catergories";
                    $result = $db->query($sql); // Run Query
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vehicle Category Name</th>
                                <th scope="col">Status</th>
<!--                                <th scope="col">Actions</th>-->
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
                                        <td><?= $row['CatergoryName'] ?></td>
                                        <td><?= $row['CatergoryStatus'] == 1 ? "Available" : 'Not Availble' ?></td>
<!--                                        <td>
                                            <form method='post' action="edit.php">
                                                <input type="hidden" name="ProductId" value="<?= $row['VCatergoryId'] ?>">
                                                <button type="submit" name="action" value="edit" class="btn btn-sm btn-warning">Edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='post' action="delete.php">
                                                <input type="hidden" name="ProductId" value="<?= $row['VCatergoryId'] ?>">
                                                <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>-->
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col" id="report">
                <h4 style="font-weight: bold;">Vehicle Brand list</h4>
                <div class="table-responsive">
                    <?php
                    $db = dbconn();
                    $sqlVBrand = "SELECT * FROM vehiclebrand";
                    $resultVBrand = $db->query($sqlVBrand); // Run Query
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vehicle Brand Name</th>
<!--                                <th scope="col">Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultVBrand->num_rows > 0) {
                                $n = 1;
                                while ($rowVBrand = $resultVBrand->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= ucwords($rowVBrand['VehicleBrandName']) ?></td>
                                        <td><?= $rowVBrand['Status'] == 1 ? "Available" : 'Not Availble' ?></td>
<!--                                        <td>
                                            <form method='post' action="edit.php">
                                                <input type="hidden" name="ProductId" value="<?= $rowVBrand['VehicleBrandId'] ?>">
                                                <button type="submit" name="action" value="edit" class="btn btn-sm btn-warning">Edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='post' action="delete.php">
                                                <input type="hidden" name="ProductId" value="<?= $rowVBrand['VehicleBrandId'] ?>">
                                                <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>-->
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="col" id="report">
                <h4 style="font-weight: bold;">Vehicle Model list</h4>
                <div class="table-responsive">
                    <?php
                    $db = dbconn();
                    $sqlVModel = "SELECT *,vc.CatergoryName,vb.VehicleBrandName,ft.FuelType FROM vehiclemodels vm LEFT JOIN vehicle_catergories vc ON vm.VCatergoryName=vc.VCatergoryId "
                            . "LEFT JOIN vehiclebrand vb ON vm.VBrand=vb.VehicleBrandId "
                            . "LEFT JOIN fueltype ft ON ft.FuelTypeId=vm.VFuelType;";
                    $resultVModel = $db->query($sqlVModel); // Run Query
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vehicle Brand Image</th>
                                <th scope="col">Model Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Fuel Type</th>
                                <th scope="col">Mfg Start Date</th>
                                <th scope="col">Mfg End Date</th>
                                <th scope="col">Engine (CC.)</th>
                                <th scope="col">Status</th>
<!--                                <th scope="col">Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultVBrand->num_rows > 0) {
                                $n = 1;
                                while ($rowVModel = $resultVModel->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td> <img class="img-fluid" width="100"
                                                  src="<?= SYSTEM_PATH ?>assets/img/vehicleModel/<?= $rowVModel['BrandImage'] ?>"></td>
                                        <td><?= ucwords($rowVModel['VehicleBrandName']) ?></td>
                                        <td><?= ucwords($rowVModel['CatergoryName']) ?></td>
                                        <td><?= ucwords($rowVModel['ModelName']) ?></td>
                                        <td><?= ucwords($rowVModel['FuelType']) ?></td>
                                        <td><?= $rowVModel['MfgStart'] ?></td>
                                        <td><?= $rowVModel['MfgEnd'] ?></td>
                                        <td><?= $rowVModel['EngineCC'] ?></td>
                                        <td><?= $rowVModel['Status'] == 1 ? "Available" : 'Not Availble' ?></td>
<!--                                        <td>
                                            <form method='post' action="edit.php">
                                                <input type="hidden" name="ProductId" value="<?= $rowVModel['VehicleModelsId'] ?>">
                                                <button type="submit" name="action" value="edit" class="btn btn-sm btn-warning">Edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='post' action="delete.php">
                                                <input type="hidden" name="ProductId" value="<?= $rowVModel['VehicleModelsId'] ?>">
                                                <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>-->
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include'../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWindow = window.open('', 'Print-Window');

        newWindow.document.open();

        newWindow.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWindow.document.close();

        setTimeout(function () {
            newWindow.close();
        }, 10);
    }
    var doc = new jsPDF();

    function exportReport(divid, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById('report').innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>
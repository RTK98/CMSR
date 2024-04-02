<?php $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Stocks</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group ">
                <a href="<?= SYSTEM_PATH?>report/report.php" class="btn btn-sm btn-dark">Reports</a>
            </div>
            <!--            <div class="btn-group me-2">
                            <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
            
                        </div>
                        <div class="btn-group me-2">
                            <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
            
                        </div> <div class="btn-group me-2">
                            <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
            
                        </div> <div class="btn-group me-2">
                            <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
            
                        </div> <div class="btn-group me-2">
                            <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
            
                        </div>-->

        </div>

    </div>


    <hr>
    <h2> </h2>
    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="row g-3">
            <div class="col-sm-2">
                <input type="text" name="VehicleID" value="<?= @$VehicleID ?>" class="form-control" placeholder="Serial No.">
            </div>
            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM products";
                $result = $db->query($sql);
                ?>
                <select name="Model" class="form-control">
                    <option value="">--Products--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['ProductId'] ?>"><?= $row['ProductName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM `batchno`";
                $result = $db->query($sql);
                ?>
                <select name="batch" class="form-control">
                    <option value="">--Batch No--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['BatchId'] ?>"><?= $row['BatchNo'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="col-sm-2">

                <select name="stockstatus" class="form-control">
                    <option value="">--Status--</option>

                    <option value="0">Issued</option>
                    <option value="1">In Stock</option>
                    <option value="3">Expired</option>
                    <option value="4">Mnf Damage</option>
                     <option value="5">Physical Damage</option>


                </select>
            </div>


            <div class="col-sm-2">
                <input type="date" class="form-control" name="from" placeholder="Enter From Date" max="<?php echo date("Y-m-d") ?>">
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="to" placeholder="Enter To Date" max="<?php echo date("Y-m-d") ?>" >
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-secondary" onclick="printReport('report')">Print</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-dark" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
            </div>


        </div>
    </form>

    <?php
    $db = dbConn();
    $where = null;
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($VehicleID)) {
            $where .= " si.SerialNo='$VehicleID' AND";
        }

        if (!empty($Model)) {
            $where .= " pro.ProductId='$Model' AND";
        }

        if (!empty($batch)) {
            $where .= " b.BatchId='$batch' AND";
        }
          if (!empty($stockstatus)) {
            $where .= " si.Status='$stockstatus' AND";
        }

        if (!empty($from) && empty($to)) {
            $where .= " si.AddDate  = '$from' AND";
        }
        if (empty($from) && !empty($to)) {
            $where .= " si.AddDate  = '$to' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " si.AddDate  BETWEEN '$from' AND '$to' AND";
        }
    }

    if (!empty($where)) {
        $where = substr($where, 0, -3);
        $where = " WHERE $where";
    }

    $userId = $_SESSION['userId'];
    $adddate = date("Y-m-d");
    $db = dbconn();
     $sqlStock = "SELECT si.StockId,"
    . "pro.ProductId,"
    . "pro.ProductName,"
    . "si.SupplierName AS 'supplierId',"
    . "si.SerialNo,"
    . "si.Status,"
    . "b.BatchId,"
    . "b.BatchNo,"
    . "po.PoId,"
    . "po.PoNo,"
    . "si.AddDate,"
    . "sup.SupplierName,"
    . "si.ExpDate "
    . "FROM stockitems si "
    . "LEFT JOIN supplier sup ON si.SupplierName=sup.SupplierId "
    . "LEFT JOIN products pro ON si.ProductName=pro.ProductId "
    . "LEFT JOIN batchno b ON si.BatchNo=b.BatchId "
    . "LEFT JOIN purchasingorders po ON si.PoNo=po.PoId $where";

    $resultStock = $db->query($sqlStock);

    if ($resultStock->num_rows > 0) {
        $total = $resultStock->num_rows;
    } else {
        $total = 0;
    }
    ?>

    <div class="col-lg-12" id='report'>
        <h2>Products</h2>
        <h5><span class="badge bg-primary"><?= $total ?></span> Products</h5>

        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Serial No</th>
                        <th scope="col">Batch No</th>
                        <th scope="col">Purchasing Order No</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Expire Date</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultStock->num_rows > 0) {
                        $n = 1;
                        while ($rowStock = $resultStock->fetch_assoc()) {
                            $expireDate = $rowStock['ExpDate'];
                            $today = date('Y-m-d');
                            $ShowButton = ($expireDate == $today);
                            ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= ucwords($rowStock['ProductName']) ?></td>
                                <td><?= $rowStock['SerialNo'] ?></td>
                                <td><?= $rowStock['BatchNo'] ?></td>
                                <td><?= $rowStock['PoNo'] ?></td>
                                <td><?= ucwords($rowStock['SupplierName']) ?></td>
                                <td><?= $rowStock['ExpDate'] ?></td>
                                <td>
                                    <?php
                                    $Status = $rowStock['Status'];
                                    $statusDescription = '';

                                    switch ($Status) {
                                        case 0:
                                            $statusDescription = "Issued";
                                            $statusColor = "badge rounded-pill bg-warning text-dark";
                                            break;
                                        case 1:
                                            $statusDescription = "In Stock";
                                            $statusColor = "badge rounded-pill bg-success";
                                            break;
                                        case 3:
                                            $statusDescription = "Expired";
                                            $statusColor = "badge rounded-pill bg-danger";
                                            break;
                                        case 4:
                                            $statusDescription = "Mnf Damage";
                                            $statusColor = "badge rounded-pill bg-primary";
                                            break;
                                        case 5:
                                            $statusDescription = "Physical Damage";
                                            $statusColor = "badge rounded-pill bg-secondary";
                                            break;
                                        default:
                                            $statusDescription = "Not Available";
                                            $statusColor = "badge rounded-pill bg-dark";
                                            break;
                                    }
                                    ?>
                                    <span class='<?= $statusColor ?>'><?= $statusDescription ?> </span> 


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

</main>
<?php include'../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
    var doc = new jsPDF();
    function exportReport(divId, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>
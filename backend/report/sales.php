<?php $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group ">
                <a href="<?= SYSTEM_PATH ?>report/report.php" class="btn btn-sm btn-dark">Reports</a>
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

                <select name="servicetype" class="form-control">
                    <option value="">--Service--</option>

                    <option value="1">Appointment</option>
                    <option value="2">Repair</option>
                   

                </select>
            </div>
               <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM users where UserRole='technician'";
                $result = $db->query($sql);
                ?>
                <select name="users" class="form-control">
                   <option value="">--Employee Name--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['UserId'] ?>"><?= $row['FirstName'] . $row['LastName'] ?></option>
                            <?php
                        }
                    }
                    ?>
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
        if (!empty($servicetype)) {
            $where .= " JobCardType='$servicetype' AND";
        }
        
         if (!empty($users)) {
            $where .= " empId='$users' AND";
        }
     
        if (!empty($from) && empty($to)) {
            $where .= " jbr.AddDate  = '$from' AND";
        }
        if (empty($from) && !empty($to)) {
            $where .= " jbr.AddDate  = '$to' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " jbr.AddDate  BETWEEN '$from' AND '$to' AND";
        }
    }

    if (!empty($where)) {
        $where = substr($where, 0, -3);
        $where = " AND $where";
    }


     $sql = "SELECT *,u.FirstName as efname,u.LastName as elname, jbr.AddDate as date FROM job_cards jbr LEFT JOIN users u ON u.UserId=jbr.empId LEFT JOIN customer cus ON cus.CustomerId=jbr.CustomerId WHERE jbr.Status=6 $where";

    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $total = $result->num_rows;
    } else {
        $total = 0;
    }
    ?>

    <div class="table-responsive" id='report'>
        <h5><span class="badge bg-primary"><?= $total ?></span> Appointments</h5>

        <?php
//        $db = dbconn();
//        $sql = "SELECT * FROM appointments";
//        $result = $db->query($sql); // Run Query
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appoinment No</th>
                    <th scope="col">Repair No</th>
                    <th scope="col">Customer Name</th>

                    <th scope="col">Employee</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Total sale</th>
                    <th scope="col">Profit</th>

                    <th scope="col">Appointment Date</th>

                    <th scope="col">Service Type</th>


                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    $tcost = 0;
                    $tsale = 0;
                    $tprofit = 0;
                    while ($row = $result->fetch_assoc()) {
                        $tcost += $row['JobCardCost'];
                        $tsale += $row['JobCardPrice'];
                        $tprofit += $row['TotalRepairProfit'];
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['AppointmentNo'] ?></td>
                            <td>
                                <?= $row['JobCardNo'] ?>
                            </td>
                            <td>
                                <?= $row['efname'] . "-" . $row['elname']; ?>
                            </td>
                            <!--VehicleType Find-->
                            <td>
                                <?= $row['FirstName'] . "-" . $row['LastName']; ?>
                            </td>
                            <td>
                                <?= number_format($row['JobCardCost'], 2) ?>
                            </td>
                            <td>
                                <?= number_format($row['JobCardPrice'], 2) ?>
                            </td>
                            <td> <?= number_format($row['TotalRepairProfit'], 2) ?></td>

                            <td>
                                <?= $row['date'] ?>

                            </td>
                            <td>
                                <?php
                                $Types = $row['JobCardType'];
                                if ($Types == 1) {
                                    echo "Appoitnment";
                                } else {
                                    echo "Repair";
                                }
                                ?>

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
            <tfoot>
            <td class='text-center ' style="font-size: 24px" colspan="5">Total</td>
            <td style="font-size: 24px" ><?= number_format(@$tcost, 2) ?></td>
            <td style="font-size: 24px"><?= number_format(@$tsale, 2) ?></td>
            <td style="font-size: 24px"><?= number_format(@$tprofit, 2) ?></td> 
            </tfoot>
        </table>
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
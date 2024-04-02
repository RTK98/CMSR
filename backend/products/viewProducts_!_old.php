<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Search Vehicle</h1>

    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        extract($_POST);
        $where = null;

        if (!empty($VehicleID)) {
            $where .= " VehicleID='$VehicleID' AND";
        }
        if (!empty($Model)) {
            $where .= " Model='$Model' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " RegisteredDate BETWEEN '$from' AND '$to' AND";
        }

        if (!empty($where)) {
            $where = substr($where, 0, -3);
            $where = " WHERE $where";
        }


        $db = dbConn();
        $sql = "SELECT * FROM vehicle $where";
        $result_data = $db->query($sql);
    }
    ?>

    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="row g-3">
            <div class="col-sm-4">
                <input type="text" name="VehicleID" value="<?= @$VehicleID ?>" class="form-control" placeholder="Enter Vehicle No.">
            </div>
            <div class="col-sm">
                <?php
                $db = dbConn();
                $sql = "SELECT DISTINCT Model FROM vehicle";
                $result = $db->query($sql);
                ?>
                <select name="Model" class="form-control">
                    <option value="">--Model--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['Model'] ?>"><?= $row['Model'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm">
                <input type="date" class="form-control" name="from" placeholder="Enter From Date" >
            </div>
            <div class="col-sm">
                <input type="date" class="form-control" name="to" placeholder="Enter To Date" >
            </div>
            <div class="col-sm">
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
        </div>
    </form>
    <button type="button" class="btn btn-warning" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-warning" onclick="exportReport('report','Vehicle Info')">Export PDF</button>
    <div id="report">
       <h1>Sample</h1>
    </div>
</main>
<?php include '../footer.php'; ?>
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
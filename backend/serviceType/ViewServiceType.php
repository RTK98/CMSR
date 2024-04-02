<?php  $Service="active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="AddServiceType.php" class="btn btn-sm btn-dark">Add Service Type</a>
            </div>
        </div>
    </div>
    <h2>Products List</h2>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <div id="report">
        <div class="table-responsive">
            <?php
            $db = dbconn();
            $sql = "SELECT * FROM service";
            $result = $db->query($sql);
//            $row = $result->fetch_assoc();
//            var_dump($row); // Run Query
            ?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
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
                                <td><?= $row['ServiceName'] ?></td>
                                <td>
                                    <?php
                                    $VCatergoryName = $row['CatergoryName'];
                                    $db = dbconn();
                                    $sqlVname = "SELECT * FROM vehicle_catergories WHERE VCatergoryId=$VCatergoryName";
                                    $resultVname = $db->query($sqlVname);
                                    $rowName = $resultVname->fetch_assoc();
                                    ?>


                                    <?= $rowName['CatergoryName'] ?></td>
                                <td><?= $row['ServiceStatus'] == 1 ? "Activated" : 'Deactivated' ?></td>
                                
                                <td>
                                    <form method='post' action="editServiceType.php">
                                        <input type="hidden" name="ServiceId" value="<?= $row['ServiceId'] ?>">
                                        <button type="submit" name="action" value="edit" class="btn btn-warning btn-sm">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form method='post' action="delete.php">
                                        <input type="hidden" name="ServiceId" value="<?= $row['ServiceId'] ?>">
                                        <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
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
    </div>
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
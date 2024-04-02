<?php  $Category="active" ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/addCategory.php" class="btn btn-sm btn-dark">Add Category</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/addCategory.php" class="btn btn-sm btn-dark">Add Product</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/view.php" class="btn btn-sm btn-dark">View Categories</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/viewDeativeCatList.php" class="btn btn-sm btn-dark">View Deactive Categories</a>
            </div>
        </div>
    </div>
    <h2>Products List</h2>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <div id="report">
        <div class="table-responsive" style="border:1px solid black">
            <?php
            $db = dbconn();
            $sql = "SELECT * FROM catergories";
            $result = $db->query($sql); // Run Query
            ?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr style="background-color:#5C5C5C; color:white">
                        <th scope="col">#</th>
                        <th scope="col">Category Code</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $n = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr style="font-weight:bold;">
                                <td  style="background-color:#5C5C5C; color:white;"><?= $n ?></td>
                                <td><?= $row['CatergoryCode'] ?></td>
                                <td><?= $row['CatergoryName'] ?></td>
                                <td><?= $row['CatergoryDescription'] ?></td>
                                <td>
                                    <?php
                                    $CategoroyStatus = $row['CatergoryStatus'];
                                    $statusDescription = '';

                                    switch ($CategoroyStatus) {
                                        case 1:
                                            $statusDescription = "Available";
                                            $statusColor = "btn btn-success btn-sm";
                                            break;
                                        case 2:
                                            $statusDescription = "Not Avaiable";
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
                                    <form method='post' action="EditCategory.php">
                                        <input type="hidden" name="CatergoryID" value="<?= $row['CatergoryID'] ?>">
                                        <button type="submit" name="action" value="edit" class="btn btn-am" style="background-color: #0D98BA; color:white; border-color: white;">Edit</button>
                                    </form>

                                </td>
                                <td>
                                    <form method='post' action="delete.php">
                                        <input type="hidden" name="CatergoryID" value="<?= $row['CatergoryID'] ?>">
                                        <button type="submit" name="action" value="delete" class="btn btn-am" style="background-color: #E32227; color:white; border-color: white;">Deactive</button>
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
<?php include'../../footer.php'; ?>
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
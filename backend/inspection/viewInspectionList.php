<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addInspectionCatergory.php" class="btn btn-sm btn-outline-secondary">Add Inspection Catergory</a>
            </div>
            <div class="btn-group me-2">
                <a href="addInspectionItem.php" class="btn btn-sm btn-outline-secondary">Add Inspection</a>
            </div>
        </div>
    </div>
    <h2>Inspection List</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM inspections";
        $result = $db->query($sql); // Run Query"
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">inspection Id</th>
                    <th scope="col">inspection No</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Customer Name</th>
                    <th>Actions</th>
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
                            <td><?= $row['InspectionId'] ?></td>
                            <td><?= $row['InspectionNo'] ?></td>
                            <td><?= $row['VehicleNo'] ?></td>
                            <td><?= $row['CustomerName'] ?></td>
                            <td>
                            <td>
                                <form method='post' action="InspectionReport.php">
                                    <input type="text" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                    <button type="submit" name="action" value="view">View</button>
                                </form>
                            </td>
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
</main>
<?php include'../footer.php'; ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Cards</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addJobCard.php" class="btn btn-sm btn-outline-secondary">Add Job Card</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>Job Card List</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
         $sql = "SELECT * FROM job_cardsrepair WHERE Status=1 ORDER BY job_cardsrepair.AddDate AND job_cardsrepair.AddTime DESC;";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Inspection No</th>
                    <th scope="col">Job Card No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
//                        print_r($row)
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['InspectionId'] ?></td>
                            <td><?= $row['JobCardNo'] ?></td>
                            <td>
                                <?= $row['Status'] ?></td>
                            <td>

                            </td>
                            <td></td>
                            <td>
                                <form method='post' action="editJobCard.php">
                                    <input type="hidden" name="id" value="<?= $row['jobCardsRepairId'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-primary">Edit</button>
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
</main>
<?php include'../footer.php'; ?>
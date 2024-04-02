<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Holiday</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addHoliday.php" class="btn btn-sm btn-dark">Add Holiday</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {
        echo $HolidayId;
        $db = dbConn();
        $sqlDeactiveItems = "UPDATE holidays SET HolidayStatus='0' WHERE HolidayId='$HolidayId'";
        $db->query($sqlDeactiveItems);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Product has been Deactive Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
            }).then(() => {
                //                window.location.href = 'viewProducts.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>



    <h2>Holiday List</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM holidays";
        $result = $db->query($sql); // Run Query
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Holiday Name</th>
                    <th scope="col">Holiday Date</th>
                    <th scope="col">Holiday Status</th>
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
                            <td><?= ucwords($row['HolidayName']) ?></td>
                            <td><?= $row['HolidayDate'] ?></td>
                            <td> <?php
                                $HolidayStatus = $row['HolidayStatus'];
                                $statusDescription = '';

                                switch ($HolidayStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showDelete = true;
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showDelete = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <?php if ($showDelete) { ?>
                                    <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <input type="hidden" name="HolidayId" value='<?= $row['HolidayId'] ?>'>
                                        <button type="submit" name="action" value="edit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to deactive this item?')">Deactive</button>
                                    </form>
                                </td>
                            <?php } ?>
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
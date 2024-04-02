<?php ob_start(); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Card</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewJobCard.php" class="btn btn-sm btn-outline-secondary">view Job Cards</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {
        $db = dbConn();
        $sql = "SELECT * FROM job_cards WHERE id='$id'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        print_r($result);
        $AppointmentNo = $row["AppointmentNo"];
        $CustomerID = $row["CustomerId"];
        $VehicleNo = $row["VehicleNo"];
//        $AppDate = $row["AppDate"];
        // echo $sql = "INSERT INTO job_cards(AppointmentNo, CustomerId,VehicleNo,CustomerNo) VALUES ('$AppointmentNo','$CustomerName','$VehicleNo','$CustomerNo')";
        // $db->query($sql);
    }
    ?>
    <div class="card">
        <div class="card-header">
            New Job Card
        </div>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="AppointmentNo" class="form-label">Appointment No</label>
                <input type="text" class="form-control" id="AppointmentNo" name="AppointmentNo" value="<?= @$AppointmentNo ?>"
                       disabled>
                <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
            </div>
            <div class="mb-3">
                <label for="AppointmentDate" class="form-label">Appointment Date</label>
                <input type="text" class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?= @$AppDate ?>"
                       disabled>
            </div>
            <div class="mb-3">
                <label for="CustomerName" class="form-label">Name</label>
                <input type="text" class="form-control" id="CustomerName" name="CustomerName" value="<?= @$CustomerID ?>"
                       disabled>
                <div class="text-danger"><?= @$messages['error_Product_price']; ?></div>
            </div>
            <div class="mb-3">
                <label for="CustomerNo" class="form-label">Telephone</label>
                <input type="text" class="form-control" id="CustomerNo" name="CustomerNo" value="<?= @$CustomerID ?>"
                       disabled>

            </div>
            <div class="mb-3">
                <label for="CustomerAddres" class="form-label">Address</label>
                <input type="text" class="form-control" id="CustomerAddres" name="CustomerAddres"
                       value="<?= @$AppointmentNo ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="VehicleNo" class="form-label">Vehicle No.</label>
                <input type="text" class="form-control" id="VehicleNo" name="VehicleNo" value="<?= @$VehicleNo ?>" disabled>
                <div class="text-danger"><?= @$messages['error_Product_qty']; ?></div>
            </div>
            <?php
            echo @$_POST["ProductName"];
//        print_r($_POST);
            ?>

            <div>
                <form  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <label>Select Repair Name</label>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM repaircatergory";
                    $result = $db->query($sql);
                    ?>
                    <select name="RepairId">
                        <option value="">--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['RepairId'] ?>"><?= $row['RepairName'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Enter Qty</label> <input type='text' name='Qty'>
                    <label>Enter Sale Price</label> <input type='text' name='SalePrice'>
                    <button type="submit" name="action" value="add" class="btn btn-secondary">add</button>
                </form>
            </div>
            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                <label>Select Product Name</label>
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM products";
                $result = $db->query($sql);
                ?>
                <select name="ProductId">
                    <option value="">--</option>
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
                <label>Enter Qty</label>
                <input type='text' name='Qty'>
                <label>Enter Sale Price</label>
                <input type='text' name='SalePrice'>
                <label>Enter Date</label>
                <input type='date' name='Date'>
                <button type="submit" name="action" value="add" class="btn btn-secondary">Add</button>
            </form>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Description</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <input type="text" name="AppointmentId" value="<?= $id ?>">
                <button type="submit" class="btn btn-primary">Submit 1</button>
                <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function loadCity() {
        var formData = $('#form_customer').serialize();
        $.ajax({
            type: 'POST',
            url: 'repairList.php',
            data: formData,
            success: function (response) {
                $('#content').html(response);
                $('#citylist').modal('show');
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<?php ob_end_flush(); ?>
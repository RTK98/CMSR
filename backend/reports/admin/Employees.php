<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Reports</h1>  
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/index.php" class="btn btn-sm btn-dark">Home</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>user/supplier/viewSupplier.php" class="btn btn-sm btn-dark">Supplier Managment</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>reports/admin/ActiveEmployees.php" class="btn btn-sm btn-dark">Active Employees</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>reports/admin/NonActiveSuppliers.php" class="btn btn-sm btn-dark">Non Activated Employees</a>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center   mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button  class="btn btn-sm btn-warning" onclick="history.back();">Go Back</button>
            </div>
        </div>
    </div>
    <h2>All Employee Report</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        extract($_POST);
        $where = null;

        if (!empty($VehicleID)) {
            $where .= " VehicleID='$VehicleID' AND";
        }
        if (!empty($Department)) {
            $where .= "depId='$Department' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " RegisteredDate BETWEEN '$from' AND '$to' AND";
        }

        if (!empty($where)) {
            $where = substr($where, 0, -3);
            $where = " WHERE $where";
        }


        $db = dbConn();
         $sql = "SELECT * FROM users $where";
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
                $sql = "SELECT DISTINCT depId,DepartmentName FROM department";
                $result = $db->query($sql);
                ?>
                <select name="Department" class="form-control">
                    <option value="">--Model--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['depId'] ?>"><?= $row['DepartmentName'] ?></option>
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
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT u.UserId,u.UserImage,u.Status,u.UserRole,u.NIC,u.FirstName,u.LastName,u.HouseNo,u.Lane,u.Street,u.Email,u.Gender,dep.DepartmentName,pro.ProvinceName,dis.DistrictName,ci.name_en FROM users u "
                . "LEFT JOIN department dep ON dep.depId=u.depId "
                . "LEFT JOIN provinces pro ON pro.id=u.Province "
                . "LEFT JOIN districts dis ON dis.id = u.District "
                . "LEFT JOIN cities ci ON ci.id=u.City "
                . "WHERE u.UserRole<>'admin';";
        $result = $db->query($sql);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Department</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Province</th>
                    <th scope="col">District</th>
                    <th scope="col">City</th>
                    <th scope="col">Dob</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows >= 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><img class="img-fluid" width="80"
                                     src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?= $row['UserImage'] ?>"></td>
                            <td><?= ucwords($row['UserRole']) ?></td>
                            <td><?= ucwords($row['DepartmentName']) ?></td>
                            <td><?= ucwords($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                            <td><?= ucwords($row['HouseNo'] . ',' . $row['Lane'] . ',' . $row['Street']) ?></td>
                            <td><?= ucwords($row['ProvinceName']) ?></td>
                            <td><?= ucwords($row['DistrictName']) ?></td>
                            <td><?= ucwords($row['name_en']) ?></td>
                            <td><?= ucwords($row['name_en']) ?></td>
                            <td><?= ucwords($row['NIC']) ?></td>
                            <td>
                                <?php
                                $SupplierStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($SupplierStatus) {
                                    case 1:
                                        $statusDescription = "Male";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 2:
                                        $statusDescription = "Femaie";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    case 3:
                                        $statusDescription = "Other";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <span><?= $statusDescription; ?> </span>
                            </td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td>  <?php
                                $UserStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($SupplierStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span></td>
                            <td>
                                <input type="hidden" name="SupplierId" value="<?= $row['UserId'] ?>">
                                <!--                                <button type="button" class="btn btn-sm" style="background-color: #6161FF;color:white;" 
                                                                        name="action" value="view">View More Details</button>-->
                                <a href="#myModal" role="button" class="btn btn-sm" style="background-color: #6161FF;color:white;" data-id="<?= $row['UserId'] ?>"   data-bs-toggle="modal">View More Details</a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    $n++;
                }
            }
            ?>
        </table>
        <!-- Modal -->


        <!-- Modal HTML -->
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTest"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-12">
                                    <div class="card" style="background-color:#F0F0FF">
                                        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                            <div class="card-body">
                                                <section class="m-1">
                                                    <div class="card-header">
                                                        <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                                             style="
                                                             width:60px;
                                                             display: block;
                                                             margin: 0 auto;
                                                             ">
                                                        <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
                                                        <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                                        <p class='m-1' style="text-align: center;">0779 200 480</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class='m-1'style="text-align: center; font-weight: bold;">Supplier Summary</h5>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div>
                                                                    <p> Supplier Name : 
                                                                    </p>
                                                                </div>
                                                                <div>
                                                                    <p>Contact No :</p>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div>
                                                                    <p>Email :</p>
                                                                </div>
                                                                <div>
                                                                    <p>Supplier Status : <?php
//                                                            $Status = $row['Status'];
                                                                        $statusDescription = '';

                                                                        switch (1) {
                                                                            case 1:
                                                                                $statusDescription = "Active";
                                                                                $statusColor = "btn btn-success btn-sm";
                                                                                break;
                                                                            case 2:
                                                                                $statusDescription = "Deactive";
                                                                                $statusColor = "btn btn-danger btn-sm";
                                                                                break;
                                                                            default:
                                                                                $statusDescription = "Not Available";
                                                                                $statusColor = "btn btn-secondary btn-sm";
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="container m-1">
                                                        <section>
                                                            <h6>Categories</h6>
                                                            <table class="table m-1">
                                                                <thead>
                                                                    <tr style="background-color: #d2d2d2">
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Category Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody><tr>
                                                                        <td></td>
                                                                        <td>ddd</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </section>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="viewReqItems.php" class="btn btn-sm btn-danger">Close</a>
                                                    </div>
                                                </section> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

<script>

    $('#myModal').on('shown.bs.modal', function (event) {


        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('id');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        $.ajax({
            type: 'POST',
            url: 'loadSupplier.php',
            data: {options: recipient},
            success: function (response) {
                console.log(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });

        modal.find('#modalTest').text('View More Details ' + recipient);
//        modal.find('.modal-body input').val(recipient);
        $('#myModal').modal(options);
    })

</script>
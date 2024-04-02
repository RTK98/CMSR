<?php $login = "active" ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Employee</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addEmp.php" class="btn btn-sm btn-dark">Add Employee</a>
            </div>
        </div>
    </div>
    <h2>Employee List</h2>
    <div class="table-responsive" >
        <?php
        $db = dbconn();
        $sql = "SELECT UserId,FirstName,Lastname,Email,HouseNo,Lane,Street,City,Gender,NIC,Status,UserRole FROM users WHERE UserRole<>'admin'";
        $result = $db->query($sql); // Run Query
//        $row = $result->fetch_all();
//        echo $result->num_rows;
//        var_dump($row);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Desgination</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
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
                            <td><?= $row['FirstName'] ?></td>
                            <td><?= $row['Lastname'] ?></td>
                            <td><?= $row['HouseNo'] . "," . $row['Lane'] . "," . $row['Street'] . "," . $row['City'] ?></td>
                            <td><?= ucwords($row['UserRole']) ?></td>
                            <td><?= $row['NIC'] ?></td>
                            <td>
                            
                                <?php
                                $StatusUser = $row['Status'];
                                $statusDescription = '';

                                switch ($StatusUser) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "badge bg-warning text-dark btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = true;
                                        break;
                                    case 0:
                                        $statusDescription = "Deactivated";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            
                            
                            
                            </td>
                            <td><?= $row['Email'] ?></td>
                            <td> 
                                <?php if ($row['UserRole'] == 'admin') { ?>
                                    <form method='post' action="viewEmpDetails.php">
                                        <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>">
                                        <button type="submit"  class="btn btn-sm" style='background-color: #F4D300;' name="action" value="edit" disabled>Edit</button>
                                    </form>
                                <td>
                                    <form method='post' action="delete.php">
                                        <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>">
                                        <button type="submit" class="btn btn-sm" style="background-color: #900700" name="action" value="delete" disabled>Delete</button>
                                    </form>
                                </td>
                                <td>
                                <?php } else {
                                    ?>
                                    <form method='post' action="viewEmpDetails.php">
                                        <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>">
                                        <button type="submit"  class="btn btn-sm" style='background-color: #F4D300;' name="action" value="edit">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form method='post' action="delete.php">
                                        <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>">
                                        <button type="submit" class="btn btn-sm" style="background-color: #F40035" name="action" value="delete">Delete</button>
                                    </form>
                                <?php }
                                ?>
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
<?php include'../../footer.php'; ?>

<?php if (isset($_GET['success'])) { ?>
    <script>


        //    var toastMixin = Swal.mixin({
        //    toast: true,
        //    icon: 'success',
        //    title: 'General Title',
        //    animation: false,
        //    position: 'top-right',
        //    showConfirmButton: false,
        //    timer: 3000,
        //    timerProgressBar: true,
        //  });
        //
        //toastMixin.fire({
        //    animation: true,
        //    title: 'Signed in Successfully'
        //  });

        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'Employee Created Successfully!',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
        });
    </script>
<?php } ?>



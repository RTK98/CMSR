<?php  $attend="active" ?>
<?php
ob_start();
include'../header.php';
include'../menu.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Attendance</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewAttandance.php" class="btn btn-sm btn-dark">View Attendance Employees</a>
            </div>
        </div>
    </div>

    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] === "POST" && action == 'add') {
        echo $UserId;
    }
    ?>
    <hr>
    <div class="row">
        <div class ='col-12' style='background-color: white;'>
            <h2> Absent Employees Today</h2>
            <div class="table-responsive" style='border:1px black solid;'>
                <?php
                $db = dbconn();
                $Today = date('Y-m-d');

                $sqlAttendance = "SELECT u.FirstName,u.LastName,u.UserRole,u.UserId,emp.Date FROM empabsent emp "
                        . "LEFT JOIN users u ON emp.empId = u.UserId WHERE emp.Date='$Today'";
                $resultAttendance = $db->query($sqlAttendance);
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Id</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultAttendance->num_rows > 0) {
                            $n = 1;
                            while ($row = $resultAttendance->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td  scope="row"><?= $n ?></td>
                                    <td><?= $row['UserId'] ?></td>
                                    <td><?= $row['FirstName'] . ' ' . $row['LastName'] ?></td> 
                                    <td><?= ucwords($row['UserRole']) ?></td>
                                    <td><?= $row['Date'] ?></td>
                                </tr>
                                <?php
                                $n++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" style="color: red; text-align: center;font-weight: bold;">No one attended yet.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='col-12'>
            <h2>All Absent Employees</h2>
            <div class="table-responsive" style='border:1px black solid;'>
                <?php
                $db = dbconn();
                $Today = date('Y-m-d');

                $sqlAttendanceAll = "SELECT u.FirstName,u.LastName,u.UserRole,u.UserId,emp.Date FROM empabsent emp "
                        . "LEFT JOIN users u ON emp.empId = u.UserId";
                $resultAttendanceAll = $db->query($sqlAttendanceAll);
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Id</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultAttendanceAll->num_rows > 0) {
                            $n = 1;
                            while ($row1 = $resultAttendanceAll->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td  scope="row"><?= $n ?></td>
                                    <td><?= $row1['UserId'] ?></td>
                                    <td><?= $row1['FirstName'] . ' ' . $row1['LastName'] ?></td> 
                                    <td><?= ucwords($row1['UserRole']) ?></td>
                                    <td><?= $row1['Date'] ?></td>
                                </tr>
                                <?php
                                $n++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" style="color: red; text-align: center;font-weight: bold;">No one attended yet.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
include'../footer.php';
ob_end_flush();
?>
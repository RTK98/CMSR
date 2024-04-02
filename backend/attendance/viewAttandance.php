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
                <a href="viewAbsentEmp.php" class="btn btn-sm btn-dark">View Absent Employees</a>
            </div>
        </div>
    </div>

    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'add') {
        echo $UserId;
        $db = dbconn();
        $Today = date('Y-m-d');
        $sqlAbsent = "INSERT INTO empAbsent (empId,Date) VALUES ('$UserId','$Today') ";
        $db->query($sqlAbsent);
         header("Location: viewAttandance.php");
    }
    ?>
    <section>
        <div class="row">
            <div class="col">
                <h5>Attendance Mark Checked-In</h5>
                <div style="background-color:#dce0e1;">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters" style="background-color:#C1FF9A;">
                            <div class="col-md-7">
                                <video  id="scan_job" height="200" width="250"></video>
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h5 class="card-title">Attendance Mark</h5>
                                    <button type="button" class='btn btn-sm btn-success' onclick="scanjob()">Scan</button>
                                    <br>
                                    <button type="button" class='btn btn-sm btn-danger' onclick="window.location.reload();">Camera Off</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "vertical" 
                 style=" border-left: 6px solid black;
                 height: 160px;
                 position:absolute;
                 left: 60%;
                 top:30%;">

            </div>
            <div class="col">
                <h5 style="margin-left:30px;">Employee Detail</h5>
                <div id='error'>
                </div>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin-left:30px;">
                    <div id="user_details"class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section>
        <div class="row">
            <div class="col">
                <h5>Attendance Mark Checked Out</h5>
                <div style="background-color:#dce0e1;">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters" style="background-color:#FF7E94;">
                            <div class="col-md-7">
                                <video  id="scan_qr" height="200" width="250"></video>
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h5 class="card-title">Attendance Mark</h5>
                                    <button type="button" class='btn btn-sm btn-success' onclick="scanQr()">Scan</button>
                                    <br>
                                    <button type="button" class='btn btn-sm btn-danger' onclick="window.location.reload();">Camera Off</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "vertical" 
                 style=" border-left: 6px solid black;
                 height: 160px;
                 position:absolute;
                 left: 60%;
                 top:65%;">
            </div>
            <div class="col">
                <h5 style="margin-left:30px;">Employee Detail</h5>
                <div id='error_Update'>
                </div>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin-left:30px;">
                    <div id="user_details1"class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <div class="row">
        <div class ='col-6' style='background-color: white;'>
            <?php $Today = date('Y-m-d'); ?>
            <h4 style='font-weight: bold'> Today Attendance Employees - <?= $Today ?></h4>
            <div class="table-responsive" style='border:1px black solid;'>
                <?php
                $db = dbconn();
                $Today = date('Y-m-d');

                $sqlAttendance = "SELECT u.FirstName,u.LastName,u.UserRole,emp.EmpId,emp.CheckingTime,emp.CheckOutTime FROM empattendance emp "
                        . "LEFT JOIN users u ON emp.EmpId = u.UserId WHERE emp.Date='$Today'";
                $resultAttendance = $db->query($sqlAttendance);
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Checking Time</th>
                            <th scope="col">Checkout Time</th>
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
                                    <td><?= $row['EmpId'] ?></td>
                                    <td><?= $row['FirstName'] . ' ' . $row['LastName'] ?></td> 
                                    <td><?= $row['CheckingTime'] ?></td>
                                    <td><?= $row['CheckOutTime'] ?></td>
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
        <div class='col-6' style='background-color: #F7F9FA;'>
            <h4 style='font-weight: bold'> Mark Absent Employees - <?= $Today ?></h4>
            <div class="table-responsive" style='border:1px black solid;'>
                <?php
                $db = dbconn();
                $Today = date('Y-m-d');

                $sqlNotAttendance = "SELECT u.userId, u.FirstName,u.LastName,u.UserRole FROM users u "
                        . "LEFT JOIN empattendance a ON u.UserId = a.EmpId AND a.Date = '$Today'"
                        . "LEFT JOIN empabsent empAb ON u.UserId = empAb.empId AND empAb.Date= '$Today'"
                        . "WHERE a.EmpId IS NULL AND empAb.empId IS NULL AND u.UserRole != 'admin';";
                $resultNotAttendance = $db->query($sqlNotAttendance);
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Mark As Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultNotAttendance->num_rows > 0) {
                            $n = 1;
                            while ($rowNotAtt = $resultNotAttendance->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><?= $rowNotAtt['FirstName'] . ' ' . $rowNotAtt['LastName'] ?></td>
                                    <td><?= ucwords($rowNotAtt['UserRole']) ?></td>
                                    <td>
                                        <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <input type="hidden" name="UserId" value="<?= $rowNotAtt['userId'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="action" value="add">Absent</button>
                                        </form>
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
    </div>
</main>
<?php
include'../footer.php';
ob_end_flush();
?>
<script>
    function redirectToPage(url) {
        window.location.href = url;
    }

</script>
<script src="<?= SYSTEM_PATH ?>assets/qr_scanner/instascan.min.js"></script>

<script>
    function scanjob() {
        let scanner = new Instascan.Scanner({video: document.getElementById('scan_job')});
        scanner.addListener('scan', function (content) {
//            alert(content);

            $.ajax({
                type: 'POST',
                url: 'loadusers.php',
                data: {options: content},
                success: function (response) {
                    $('#user_details').html(response);
////                alert(response);
//                    //$('#citylist').modal('show');
                    //alert(response)
                    console.log(response);
                },
                error: function () {
                    alert('Error submitting the form!');
                }
            });
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
</script>
<script>
    function InsertData()
    {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var UserId = $('#UserIDTemp').val();
        console.log(UserId);
        $.ajax({
            type: 'POST',
            url: 'addAttendance.php',
            data: {options1: UserId},
            success: function (response) {
//                console.log(response);
                $('#error').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<script>
    function scanQr() {
        let scanner = new Instascan.Scanner({video: document.getElementById('scan_qr')});
        scanner.addListener('scan', function (content) {
//            alert(content);

            $.ajax({
                type: 'POST',
                url: 'loadusersOff.php',
                data: {options2: content},
                success: function (response) {
                    $('#user_details1').html(response);
////                alert(response);
//                    //$('#citylist').modal('show');
                    //alert(response)
                    console.log(response);
                },
                error: function () {
                    alert('Error submitting the form!');
                }
            });
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
</script>
<script>
    function UpdateData()
    {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var UserId1 = $('#UserIDTemp1').val();
        alert(UserId1);
        console.log(UserId);
        $.ajax({
            type: 'POST',
            url: 'updateAttendance.php',
            data: {options3: UserId1},
            success: function (response) {
//                console.log(response);
                $('#error_Update').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<!--<script>

    Swal.fire({
        toast: true,
        icon: 'success',
        title: 'Employee Attendance Marked Successfully!',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
    });
</script>-->

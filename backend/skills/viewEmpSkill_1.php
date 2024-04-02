<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Skills</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addSkills.php" class="btn btn-sm btn-outline-secondary">Add Skills</a>
            </div>
            <div class="btn-group me-2">
                <a href="addSkills.php" class="btn btn-sm btn-outline-secondary">Add Skill Catergory</a>
            </div>
            <div class="btn-group me-2">
                <a href="addSkills.php" class="btn btn-sm btn-outline-secondary">Employee Skills</a>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <section id="addSkillForm">
        <form name="addSkills" form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" id="addSkills">
            <div class="row">
                <div class="col">
                    <h5><strong>Add Best Skills For Service Technician</strong></h5>
                    <div class="row">
                        <div class="card bg-light md-4" style="max-width: 38rem;">
                            <div class="card-header">Add Service Skills</div>
                            <div class="card-body">
                                <?php
                                $db = dbconn();
                                $sql = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=2;";
                                $result = $db->query($sql);
                                ?>
                                <div class="mb-3">
                                    <label for="VehicleType" class="form-label">Technician Name</label>
                                    <select class="form-select" aria-label="Default select example" name="VehicleType">
                                        <option value="NoCatergory">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {

                                            while ($row1 = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row1['UserId'] ?>" <?php
                                                if (@$VehicleType == $row1['UserId']) {
                                                    echo "selected";
                                                }
                                                ?>><?= $row1['FirstName'] . " " . $row1['LastName'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                    <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                </div>
                                <?php
                                $db = dbconn();
                                $sqlSkills = " SELECT * FROM skills WHERE SCatergory_Id=1;";
                                $resultSkill = $db->query($sqlSkills);
                                ?>
                                <div class="mb-3">
                                    <label for="SkillName" class="form-label">Select Skill</label>
                                    <select class="form-select" aria-label="Default select example" name="SkillName" id='SkillName'>
                                        <option value="NoCatergory">--</option>
                                        <?php
                                        if ($result->num_rows > 0) {

                                            while ($row2 = $resultSkill->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row2['SId'] ?>" <?php
                                                if (@$VehicleType == $row2['SId']) {
                                                    echo "selected";
                                                }
                                                ?>><?= $row2['SkillName'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                    <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                </div>
                                <button type="button" class="btn btn-primary" name="submitBSkill" onclick='loadCustomerName()'>Add Skill</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h5><strong>Add Skills For Service Technician</strong></h5>
                    <div class="col">
                        <div class="row">
                            <div class="card bg-light md-4" style="max-width: 38rem;">
                                <div class="card-header">Add Service Skills</div>
                                <div class="card-body">
                                    <?php
                                    $db = dbconn();
                                    $sql = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=2;";
                                    $result = $db->query($sql);
                                    ?>
                                    <div class="mb-3">
                                        <label for="VehicleType" class="form-label">Technician Name</label>
                                        <select class="form-select" aria-label="Default select example" name="VehicleType">
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {

                                                while ($row1 = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row1['UserId'] ?>" <?php
                                                    if (@$VehicleType == $row1['UserId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row1['FirstName'] . " " . $row1['LastName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <?php
                                    $db = dbconn();
                                    $sqlSkills = " SELECT * FROM skills WHERE SCatergory_Id=1;";
                                    $resultSkill = $db->query($sqlSkills);
                                    ?>
                                    <div class="mb-3">
                                        <label for="SkillName" class="form-label">Select Skill</label>
                                        <select class="form-select" aria-label="Default select example" name="VehicleType">
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {

                                                while ($row2 = $resultSkill->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row2['SId'] ?>" <?php
                                                    if (@$VehicleType == $row2['SId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row2['SkillName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <button type="button" class="btn btn-primary">Add Skill</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            end of the first in Best skill adding-->
                <div id="success">
                </div>
                <div class="row">
                    <div class="col">
                        <h5><strong>Add General Skills For Repair Technician</strong></h5>
                        <div class="row">
                            <div class="card bg-light mb-3" style="max-width: 38rem;">
                                <div class="card-header">Add Repair Skills</div>
                                <div class="card-body">
                                    <?php
                                    $db = dbconn();
                                    $sql = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=3;";
                                    $result = $db->query($sql);
                                    ?>
                                    <div class="mb-3">
                                        <label for="VehicleType" class="form-label">Technician Name</label>
                                        <select class="form-select" aria-label="Default select example" name="VehicleType">
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row['UserId'] ?>" <?php
                                                    if (@$VehicleType == $row['UserId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row['FirstName'] . " " . $row['LastName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="SkillName" class="form-label">Select Skill</label>
                                        <select class="form-select" aria-label="Default select example" name="VehicleType">
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row['VCatergoryId'] ?>" <?php
                                                    if (@$VehicleType == $row['CatergoryName']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row['CatergoryName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <button type="button" class="btn btn-primary">Add Skill</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End of the 2nd row 1st column-->
                    <div class="col">
                        <h5><strong>Add Best Skills For Repair Technician</strong></h5>
                        <div class="col">
                            <div class="row">
                                <div class="card bg-light mb-3" style="max-width: 38rem;">
                                    <div class="card-header">Add Repair Skills</div>
                                    <div class="card-body">
                                        <?php
                                        $db = dbconn();
                                        $sql = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=3;";
                                        $result = $db->query($sql);
                                        ?>
                                        <div class="mb-3">
                                            <label for="VehicleType" class="form-label">Technician Name</label>
                                            <select class="form-select" aria-label="Default select example" name="VehicleType">
                                                <option value="NoCatergory">--</option>
                                                <?php
                                                if ($result->num_rows > 0) {

                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $row['UserId'] ?>" <?php
                                                        if (@$VehicleType == $row['UserId']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?= $row['FirstName'] . " " . $row['LastName'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                            <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="SkillName" class="form-label">Select Skill</label>
                                            <select class="form-select" aria-label="Default select example" name="VehicleType">
                                                <option value="NoCatergory">--</option>
                                                <?php
                                                if ($result->num_rows > 0) {

                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $row['VCatergoryId'] ?>" <?php
                                                        if (@$VehicleType == $row['CatergoryName']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?= $row['CatergoryName'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                            <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Add Skill</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <h5><strong>Skill List</strong></h5>
    <div id="report">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <?php
                        $db = dbconn();
                        $sql = "SELECT * FROM skills";
                        $result = $db->query($sql); // Run Query
                        ?>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Department Name</th>
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
                                            <td><?= $row['SkillName'] ?></td>
                                            <td><?= $row['SCatergory_Id'] ?></td>
                                            <td><?= $row['Status'] == 1 ? "Active" : 'Deactive' ?></td>
                                            <td>
                                                <form method='post' action="edit.php">
                                                    <input type="hidden" name="depId" value="<?= $row['SId'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-warning">Edit</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method='post' action="delete.php">
                                                    <input type="hidden" name="depId" value="<?= $row['SId'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
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
                <div class="col-md-2">

                    2nd Card

                </div>
            </div>
        </section>
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
<script>
    function loadCustomerName() {
//        alert("loadCustomerName");
        var formData = $('#addSkills').serialize();
        
        var e = document.getElementById("SkillName");
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: formData,e,
            success: function (response) {
                $('#success').html(response);
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
    $("form").on("submitBSkill", function(e) {
    alert('Hi');
    var dataString = $(this).serialize();
            // alert(dataString); return false; 
            $.ajax({
            type: "POST",
                    url: "process.php",
                    data: formData
,                    success: function () {
                    $("#addSkillForm").html("<div id='message'></div>");
                            $("#message")
                            .html("<h2>Contact Form Submitted!</h2>")
                            .append("<p>We will be in touch soon.</p>")
                            .hide()
                            .fadeIn(1500, function () {
                            $("#message").append(
//                                    "<img id='checkmark' src='images/check.png' />"
                                    );
                            });
                    }
            });
            e.preventDefault();
    });
    }
    );
</script>-->
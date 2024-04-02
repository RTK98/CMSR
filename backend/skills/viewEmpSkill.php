<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Skills</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addSkills.php" class="btn btn-sm btn-dark">Add Skills</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewSkills.php" class="btn btn-sm btn-dark">View Skill List</a>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <section id="addSkillForm">
        <form name="addSkills" form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" id="addSkills">
            <div class="row">
                <div class="col">
                    <h5><strong>Add General Skills For Service Technician</strong></h5>
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
                                    <label for="UserName" class="form-label">Technician Name</label>
                                    <select class="form-select" aria-label="Default select example" name="UserName" id='UserNameCol1'>
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
                                    <select class="form-select" aria-label="Default select example" name="SkillName" id='SkillNameCol1'>
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
                                <button type="button" class="btn btn-sm btn-primary" name="submitBSkill" id='submitBSkill' onclick='loadCustomerName()'>Add Skill</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h5><strong>Add Best Skills For Service Technician</strong></h5>
                    <div class="col">
                        <div class="row">
                            <div class="card bg-light md-4" style="max-width: 38rem;">
                                <div class="card-header">Add Service Skills</div>
                                <div class="card-body">
                                    <?php
                                    $db = dbconn();
                                    $sql3 = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=2;";
                                    $result3 = $db->query($sql3);
                                    ?>
                                    <div class="mb-3">
                                        <label for="UserNameGeneralSkill" class="form-label">Technician Name</label>
                                        <select class="form-select" aria-label="Default select example" name="UserNameGeneralSkill" id='UserNameGeneralSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($result3->num_rows > 0) {

                                                while ($row3 = $result3->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row3['UserId'] ?>" <?php
                                                    if (@$VehicleType == $row3['UserId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row3['FirstName'] . " " . $row3['LastName'] ?></option>
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
                                        <label for="SkillNameGeneralSkill" class="form-label">Select Skill</label>
                                        <select class="form-select" aria-label="Default select example" name="SkillNameGeneralSkill" id='SkillNameGeneralSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($resultSkill->num_rows > 0) {

                                                while ($row4 = $resultSkill->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row4['SId'] ?>" <?php
                                                    if (@$VehicleType == $row4['SId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row4['SkillName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" name="submitBSkill" id='submitBSkill' onclick='addGeneralSkill()'>Add Skill</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class='m-4'>
                <!--            end of the first in Best skill adding-->
                <div id="success">
                </div>
                <!--                Starting Repair Catergory 2 cards-->







                <div class="col">
                    <h5><strong>Add General Skills For Repair Technician</strong></h5>
                    <div class="col">
                        <div class="row">
                            <div class="card bg-light mb-3" style="max-width: 38rem;">
                                <div class="card-header">Add Repair Skills</div>
                                <div class="card-body">
                                    <?php
                                    $db = dbconn();
                                    $sqlRepairTech = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=3;";
                                    $resultRTechName = $db->query($sqlRepairTech);
                                    ?>
                                    <div class="mb-3">
                                        <label for="RTechNameGeneralSkill" class="form-label">Technician Name</label>
                                        <select class="form-select" aria-label="Default select example" name="RTechNameGeneralSkill" id='RTechNameGeneralSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($resultRTechName->num_rows > 0) {

                                                while ($row5 = $resultRTechName->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row5['UserId'] ?>" <?php
                                                    if (@$VehicleType == $row5['UserId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row5['FirstName'] . " " . $row5['LastName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <?php
                                    $db = dbconn();
                                    $sqlRepairSkills = " SELECT * FROM skills WHERE SCatergory_Id=2;";
                                    $resultRepairSkill = $db->query($sqlRepairSkills);
                                    ?>
                                    <div class="mb-3">
                                        <label for="RSkillNameGeneralSkill" class="form-label">Select Skill</label>
                                        <select class="form-select" aria-label="Default select example" name="RSkillNameGeneralSkill" id='RSkillNameGeneralSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($resultRepairSkill->num_rows > 0) {

                                                while ($row6 = $resultRepairSkill->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row6['SId'] ?>" <?php
                                                    if (@$VehicleType == $row6['SkillName']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row6['SkillName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" onClick='addGeneralSkillRepair()'>Add Skill</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                end of 1 of 2 Repair catergory card-->

                <div class="col">
                    <h5><strong>Add Best Skills For Service Technician</strong></h5>
                    <div class="col">
                        <div class="row">
                            <div class="card bg-light md-4" style="max-width: 38rem;">
                                <div class="card-header">Add Service Skills</div>
                                <div class="card-body">
                                    <?php
                                    $db = dbconn();
                                    $sqlRepairTech1 = "SELECT UserId,FirstName,LastName,UserRole,depId FROM users WHERE UserRole='technician' AND depId=3;";
                                    $resultRepairTechName = $db->query($sqlRepairTech1);
                                    ?>
                                    <div class="mb-3">
                                        <label for="RUserNameBestSkill" class="form-label">Technician Name</label>
                                        <select class="form-select" aria-label="Default select example" name="RUserNameBestSkill" id='RUserNameBestSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($resultRepairTechName->num_rows > 0) {

                                                while ($row7 = $resultRepairTechName->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row7['UserId'] ?>" <?php
                                                    if (@$VehicleType == $row7['UserId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row7['FirstName'] . " " . $row7['LastName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <?php
                                    $db = dbconn();
                                    $sqlSkillsRepair = " SELECT * FROM skills WHERE SCatergory_Id=2;";
                                    $resultRSkillName = $db->query($sqlSkillsRepair);
                                    ?>
                                    <div class="mb-3">
                                        <label for="RSkillNameBestSkill" class="form-label">Select Skill</label>
                                        <select class="form-select" aria-label="Default select example" name="RSkillNameBestSkill" id='RSkillNameBestSkill'>
                                            <option value="NoCatergory">--</option>
                                            <?php
                                            if ($resultRSkillName->num_rows > 0) {

                                                while ($row8 = $resultRSkillName->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row8['SId'] ?>" <?php
                                                    if (@$VehicleType == $row8['SId']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $row8['SkillName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                        <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" name="submitBSkill" id='submitBSkill' onclick='addBestSkillRepair()'>Add Skill</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                end of 2 of 2 Repair catergory card-->

            </div>
        </form>
    </section>
    <section>
        <h5><strong>Skill List</strong></h5>

        <?php
        $db = dbconn();
        //$sqlTechnician = "SELECT nskills.emp_id, users.FirstName,users.lastName, nskills.skill_id FROM nskills INNER JOIN users ON nskills.emp_id=users.UserId;";
        $sqlTechnician = "SELECT * FROM users where UserRole='technician'";
        $resultName = $db->query($sqlTechnician);
        ?>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row11 = $resultName->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card-deck">
                            <div class="card">
                                <img class="card-img-top" src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?= $row11['UserImage'] ?>" 
                                     alt="Card image cap" style="width:20rem; height:15rem;  display: flex; justify-content: center;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row11["FirstName"] . " " . $row11["LastName"] ?></h4>
                                    <h5>Best Skills</h5>
                                    <?php
                                    $usertechid1 = $row11["UserId"];
                                    $sqlbestskill = "SELECT * FROM bestskills WHERE emp_id='$usertechid1'";
                                    $resultskills1 = $db->query($sqlbestskill);
//                                   $row123=$resultskills1->fetch_assoc();
//                                   var_dump($row123);
                                    if ($resultskills1->num_rows > 0) {

                                        while ($rowskills1 = $resultskills1->fetch_assoc()) {
                                            $skill_id1 = $rowskills1['skill_id'];
                                            $sqlSkillName1 = "SELECT * FROM skills WHERE SId='$skill_id1'";
                                            $resultSkillName1 = $db->query($sqlSkillName1);
                                            $row13 = $resultSkillName1->fetch_assoc();
                                            ?>
                                            <div class = "btn btn-success m-1">
                                                <?= $row13['SkillName']; ?> </div> <?php
                                            echo"<br>";
                                        }
                                    } else {
                                        echo "<div class='btn btn-danger'>No Best Skill Assgined</div>";
                                    }
                                    ?>

                                    <h5>General Skills</h5>
                                    <?php
                                    $usertechid = $row11["UserId"];
                                    $sqlGeneralskill = "SELECT * FROM nskills WHERE emp_id='$usertechid'";
                                    $resultGskills = $db->query($sqlGeneralskill);

                                    if ($resultGskills->num_rows > 0) {

                                        while ($rowGskills = $resultGskills->fetch_assoc()) {
                                            $skill_id = $rowGskills['skill_id'];
                                            $sqlSkillName = "SELECT * FROM skills WHERE SId='$skill_id'";
                                            $resultSkillName = $db->query($sqlSkillName);
                                            $row12 = $resultSkillName->fetch_assoc();
                                            ?>
                                            <div class = "btn btn-warning m-1">
                                                <?= $row12['SkillName']; ?> </div> <?php
                                                echo"<br>";
                                            }
                                        } else {
                                            echo "<div class='btn btn-danger'>No General Skill Assgined</div>";
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </section>


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
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#UserNameCol1').val();
        var selectedOption1 = $('#SkillNameCol1').val();
        console.log(selectedOption);
        console.log(selectedOption1);
        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {options: selectedOption, options1: selectedOption1},
            success: function (response) {
                $('#success').html(response);
                alert(response);
                location.reload();
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
    function addGeneralSkill() {
//        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption2 = $('#UserNameGeneralSkill').val();
        var selectedOption3 = $('#SkillNameGeneralSkill').val();
        console.log(selectedOption2);
        console.log(selectedOption3);
        $.ajax({
            type: 'POST',
            url: 'process_1.php',
            data: {option3: selectedOption2, option4: selectedOption3},
            success: function (response) {
                $('#success').html(response);
                alert(response);
                location.reload();
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
    function addGeneralSkillRepair() {
//        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption4 = $('#RTechNameGeneralSkill').val();
        var selectedOption5 = $('#RSkillNameGeneralSkill').val();
        console.log(selectedOption4);
        console.log(selectedOption4);
        $.ajax({
            type: 'POST',
            url: 'process_2.php',
            data: {option3: selectedOption4, option4: selectedOption5},
            success: function (response) {
                $('#success').html(response);
                alert(response);
                location.reload();
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<!--udatika hadala denna-->

<script>
    function addBestSkillRepair() {
//        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption6 = $('#RUserNameBestSkill').val();
        var selectedOption7 = $('#RSkillNameBestSkill').val();
        console.log(selectedOption6);
        console.log(selectedOption7);
        $.ajax({
            type: 'POST',
            url: 'process_3.php',
            data: {option7: selectedOption6, option8: selectedOption7},
            success: function (response) {
                $('#success').html(response);
                alert(response);
                location.reload();
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
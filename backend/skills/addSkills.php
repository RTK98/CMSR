<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Skills</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewSkills.php" class="btn btn-sm btn-dark">View Skill List</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewEmpSkill.php" class="btn btn-sm btn-dark">Employee Skills</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Skill
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $SkillName = inputTrim($SkillName);
            $messages = array();
            if (empty($SkillName)) {
                $messages['error_Department_Name'] = "The Skill Name should not be blank..!";
            }
            if (!isset($SkillStatus)) {
                $messages['error_Department_Status'] = "The Skiill Status not be blank..!";
            }
            if (empty($SkillType)) {
                $messages['error_Skill_type'] = "The Skill Type should not be blank..!";
            }
            //advance validation
            if (!empty($SkillName)) {
                $db = dbconn();
                $sql = "SELECT * FROM skills WHERE SkillName='$SkillName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Department_Name'] = "The Skill Already Exists!";
                }
            }
            if (empty($messages)) {
                $UserId = $_SESSION['userId'];
                $db = dbconn();
                $AddDate = date('Y-m-d');
                 $sql = "INSERT INTO skills(SkillName,SCatergory_Id,Status,AddUser,AddDate) VALUES ('$SkillName','$SkillType' ,'$SkillStatus' ,'$UserId','$AddDate')";
                $db->query($sql);
                ?>

                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Skill has been Create Successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewSkills.php'; // Redirect to success page
                    });
            </script><?php
            }
            if (!empty($messages)) {
                ?>
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Something went wrong!',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'addSkills.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="SkillName" class="form-label">Skill Name</label>
                    <input type="text" class="form-control" id="SkillName" name="SkillName"
                           placeholder="Enter Skill Name" value='<?= @$SkillName ?>'>
                    <div class="text-danger"><?= @$messages['error_Department_Name']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT SCatergoryId,CatergoryName FROM skillcatergory";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="SkillType" class="form-label">Skill Type</label>
                    <select class="form-select" aria-label="Default select example" name="SkillType">
                        <option value="NoCatergory">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['SCatergoryId'] ?>" <?php
                                if (@$SkillType == $row['SCatergoryId']) {
                                    echo "selected";
                                }
                                ?>><?= $row['CatergoryName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                    <div class="text-danger"><?= @$messages['error_Vehicle_type']; ?></div>
                    <div class="mb-3">
                        <label for="CatergoryStatus" class="form-label">Skill Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SkillStatus" id="Yes" value="1">
                            <label class="form-check-label" for="Yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SkillStatus" id="No" value="0">
                            <label class="form-check-label" for="No">No</label>
                        </div>
                        <div class="text-danger"><?= @$messages['error_DeptStatus_Status']; ?></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
    </div>


</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
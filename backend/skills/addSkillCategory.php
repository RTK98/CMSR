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
            New Skill Category
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $SkillCatName = inputTrim($SkillCatName);
            $messages = array();
            if (empty($SkillCatName)) {
                $messages['error_Department_Name'] = "The Skill Name should not be blank..!";
            }
            if (!isset($SkillCatStatus)) {
                $messages['error_Department_Status'] = "The Skiill Status not be blank..!";
            }
            //advance validation
            if (!empty($SkillName)) {
                $db = dbconn();
                $sql = "SELECT * FROM skillcatergory WHERE CatergoryName='$SkillCatName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Department_Name'] = "The Skill Already Exists!";
                }
            }
            if (empty($messages)) {
                $UserId = $_SESSION['userId'];
                $db = dbconn();
                $AddDate = date('Y-m-d');
                 $sql = "INSERT INTO skills(CatergoryName,Status,AddUser,AddDate) VALUES ('$SkillCatName','$SkillCatStatus' ,'$UserId','$AddDate')";
                $db->query($sql);
                ?>

                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Skill Category has been Create Successfully',
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
                        window.location.href = 'addSkillCategory.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="SkillCatName" class="form-label">Skill Name</label>
                    <input type="text" class="form-control" id="SkillCatName" name="SkillCatName"
                           placeholder="Enter Skill Name" value='<?= @$SkillName ?>'>
                    <div class="text-danger"><?= @$messages['error_Department_Name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="$SkillCatStatus" class="form-label">Skill Category Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="SkillCatStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="SkillCatStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_DeptStatus_Status']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
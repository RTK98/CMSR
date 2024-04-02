<?php $categorypagemenu = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>questions/faq.php" class="btn btn-sm btn-outline-secondary">FAQ</a>

            </div>

        </div>
    </div>
    <?php
    extract($_POST);
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'edit') {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $questionname;
        $questionanswer;
    }
    ?>

    <?php
    extract($_POST);
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'update') {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $questionname;

        $messages = array();

        //validate required fields
        if (empty($questionanswer)) {
            $messages['error_questionanswer'] = "This Description  should not be empty ..!";
        }

        if (empty($questionname)) {
            $messages['error_resultquestionname'] = "This Question  should not be empty ..!";
        }

        if (!empty($questionanswer)) {
            $questionanswer = strtolower($questionanswer);
            $db = dbConn();

            $sqlnamecheck = "SELECT * FROM frequentasked WHERE questionanswer='$questionanswer'";
            $resultname = $db->query($sqlnamecheck);
            if ($resultname->num_rows > 0) {
                $messages['error_questionanswer'] = "You should make changes for updates description for update  ..!";
            }
        }

        if (!empty($questionname)) {
            $questionname = strtolower($questionname);
            $db = dbConn();

            $sqlquestionname = "SELECT * FROM frequentasked WHERE questionname='$questionname'";
            $resultquestionname = $db->query($sqlquestionname);
            if ($resultquestionname->num_rows > 0) {
                $messages['error_resultquestionname'] = "You should make changes for updates question for update  ..!";
            }
        }


        if (empty($messages)) {

            $db = dbConn();
            $status = 1;
            $adduser = $_SESSION['userId'];
            $adddate = date('Y-m-d');
            $questionanswer = strtolower($questionanswer);
             $sqlfaqupdate = "UPDATE frequentasked SET  questionanswer='$questionanswer',questionname='$questionname' where questionid='$questionid'";
           $db->query($sqlfaqupdate);
       
        ?>
            <script>
        Swal.fire({
            title: 'Success!',
            text: 'Frequant Asked question updated.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'faq.php'; // Redirect to success page
        });
    </script>
    <?php
            
        }
        
        
    }
    ?>    




    <?php echo @$_SESSION['project_title']; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  >

        <div class="mb-3">
            <label for="category_name" class="form-label">Enter Question</label>
            <input type="text" class="form-control" id="category_name" name="questionname"  value="<?= @$questionname; ?>">
            <div class="text-danger"> <?= @$messages['error_resultquestionname']; ?></div>
        </div>



        <div class="mb-3">
            <label for="category_description" class="form-label">Enter Answer</label>
            <textarea  class="form-control" id="category_description" rows="5" name="questionanswer"><?= @$questionanswer; ?></textarea>
            <div id="errorPDescription" class="form-text">/100</div>
            <div class="text-danger"> <?= @$messages['error_questionanswer']; ?></div>
            <!--<?php echo $p_dec_count; ?>   </div>                                                                                                                                             -->

        </div>
        <input type="hidden" name="questionid" value="<?= $questionid ?>" >
        <button name="action" value="update" type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            
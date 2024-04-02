<?php ob_start(); ?>

<?php $faq = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 

<?php
extract($_POST);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'deactive') {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    $questionname;
    $questionanswer;
    $questionid;
    $status = 0;
}
?>

<?php
extract($_POST);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'active') {


    //seperate variables and values from the form
    extract($_POST);
    $status = 1;
    //data clean
    $questionname;
    $questionanswer;
    $questionid;
}
?>

<?php
extract($_POST);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'yes') {


    //seperate variables and values from the form
    extract($_POST);
    echo $status;
     $db= dbConn();
   echo $sqlfaqupdate="UPDATE frequentasked SET status='$status' where questionid='$questionid' ";

  $db->query($sqlfaqupdate); ?>
  <script>
        Swal.fire({
            title: 'Success!',
            text: 'Status Has been changes!.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/cmsr/backend/questions/faq.php'; // Redirect to success page
        });
    </script>
    <?php
}
?>
<?php
extract($_POST);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'no') {


    //seperate variables and values from the form
    extract($_POST);
    echo $status;?>
     <script>
        Swal.fire({
            title: 'Success!',
            text: 'Frequant Asked question update did not changed.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/cmsr/backend/questions/faq.php'; // Redirect to success page
        });
    </script><?php

}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Change Status OF FAQ's</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>questions/faqnew.php" class="btn btn-sm btn-outline-secondary">New FAQ</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>questions/questions.php" class="btn btn-sm btn-outline-secondary">Questions</a>

                </div>


            </div>
        </div>



    </section>

    <section>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
                    <div class="card text-center ">
                        <div class="card-header">
                            Do you want change the status?
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= @$questionname ?></h5>
                            <p class="card-text"><?= @$questionanswer ?></p>
                            <input type="hidden" name="status" value="<?= $status ?>" >
                            <input type="hidden" name="questionid" value="<?= $questionid ?>" >
                            <button name="action" value="yes" class="btn btn-danger"> Yes</button> 
                            <button name="action" value="no" class="btn btn-success"> No</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>


    </section>
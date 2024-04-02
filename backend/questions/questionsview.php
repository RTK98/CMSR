<?php ob_start(); ?>

<?php $faq = 'active'; ?>
<?php
include '../header.php';
include '../assets/phpmail/mail.php';
?>
<?php include '../menu.php'; ?> 



<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action = 'responseclick') {
    
}
?>


<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'sendreply') {
    $sql = "SELECT * FROM tblcontactus where contactid='$questionid'";
    $db = dbConn();
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $responseemail = $row['customeremail'];
    $customername = $row['customername'];
}
?>

<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'responseclick') {
    extract($_POST);
    $db = dbConn();
    echo "<br>";
     $questionid;

     $responseofquestion;
    $curretntdate = date("Y-m-d");
    $sqlupdate = "UPDATE tblcontactus SET response='$responseofquestion' , responsedate='$curretntdate' , status='1' where contactid='$questionid'";
    $result = $db->query($sqlupdate);

    $to = $responseemail;
    $toname = $customername;
    $subject = "Bluetech Electronics Regarding your question";
    $body = $responseofquestion;
    $alt = "Responding to customer question";
    echo "<br>";
    send_email($to, $toname, $subject, $body, $alt);

    echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Response send to the customer',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/cmsr/backend/questions/questions.php'; // Redirect to success page
        });
    </script>";
}
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage  Customer Questions</h1>
            <div class="btn-toolbar mb-2 mb-md-0">



            </div>
        </div>
    </section>
    <section>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  >

            <div class="mb-3">
                <strong>  <label for="category_name" class="form-label"> Customer  Name</label></strong>
                <br>
<?= @$row['customername'] ?>
                <div class="text-danger"> <?= @$messages['error_cname']; ?></div>
            </div>

            <div class="mb-3">
                <strong> <label for="categoryimage" class="form-label">Question Regarding About</label></strong>
                <br>
<?= @$row['subject'] ?>

            </div>

            <div class="mb-3">
                <strong>  <label for="categoryimage" class="form-label">Question</label></strong>
                <br>
<?= @$row['customermatter'] ?>

            </div>

            <div class="mb-3">
                <strong>  <label for="category_description" class="form-label">Enter answer</label></strong>
                <textarea  class="form-control" id="category_description" rows="5" name="responseofquestion"><?= @$cDescription; ?></textarea>
                <div id="errorPDescription" class="form-text">/100</div>
                <div class="text-danger"> <?= @$messages['error_description']; ?></div>
<?php // echo $p_dec_count;    ?> 
            </div>                                                                                                                                             
            <input type="hidden" name="questionid" value="<?= $questionid ?>" >
            <input type="hidden" name="responseemail" value="<?= $responseemail ?>" >
            <input type="hidden" name="customername" value="<?= $customername ?>" >

            <button class=" btn btn-primary" type="submit" name="action" value="responseclick">Send</button>
        </form>

    </section>

<?php include '../footer.php'; ?>       



















































</main>
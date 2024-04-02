<?php ob_start(); ?>

<?php $faq = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 

<?php include '../assets/phpmail/mail.php';?>
<?php 
extract($_POST);

 if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action= 'sendreply') {
     
      $answer = cleanInput($answer);
         $messages = array();
        if (empty($answer)) {
            $messages['error_answer'] = "The description should not be empty..!";
        }
     
 }

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage  Customer Questions</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
 <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>questions/faq.php" class="btn btn-sm btn-outline-secondary">FAQ Home</a>

                </div>
     

            </div>
        </div>
        <?php 
       $sql = "SELECT * FROM tblcontactus   ";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span> Products</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th >#</th>

                        <th >Customer Name</th>
                        <th>Question</th>
                       
                        <th col-50 >Answer</th>
                       
                        <th>Status</th>
                      

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                            <td> <?= $i ?> </td>
                            <td col-5> <?= $row['customername'] ?> </td>
                           <td > <?= $row['customermatter'] ?> </td>
                           <td>
                               <?php 
                               if ($row['status'] == '1'){
                                  ?>
                               <form action="questionsview.php" method="post" >
                                   <input type="hidden" name="questionid" value="<?= $row['contactid'] ?>">
                                   <button name="action" class="btn btn-outline-dark" value="sendreply" disabled>Send </button>
                                   
                                    <div class="text-danger"> <?= @$messages['error_answer']; ?></div>
                               </form><?php 
                               }else{?>
                               <form action="questionsview.php" method="post" >
                                   <input type="hidden" name="questionid" value="<?= $row['contactid'] ?>">
                                   <button class="btn btn-outline-dark" name="action" value="sendreply">Send </button>
                                   
                                    <div class="text-danger"> <?= @$messages['error_answer']; ?></div>
                               </form><?php
                                    
                               }
                               ?>
                                </td>
                           <td> <?php if ($row['status'] == 1){?>
                               <span class="badge badge-pill badge-success" style="background-color: green">Reply sent</span><?php
                               
                           }else{?>
                               <span class="badge badge-pill badge-danger" style="background-color: red">Reply not sent</span><?php
                           } ?> </td>
                           <td></td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
                <!--                             <td width="100" ><?php
                if ($row['ProductStatus'] == 1) {
                    echo '<p><a href="status.php?ProductID=' . $row['ProductID'] . '&ProductStatus=0" class="text-success">Active</a></p>';
                } else {
                    echo'<p><a href="status.php?ProductID=' . $row['ProductID'] . '&ProductStatus=1" class="text-danger">Dective</a></p>';
                }
                ?></td> -->
            </table>
        </div>
        
        
  <?php include '../footer.php'; ?>       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
</main>
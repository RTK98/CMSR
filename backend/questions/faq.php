<?php ob_start(); ?>

<?php $faq = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>questions/faqnew.php" class="btn btn-sm btn-outline-secondary">New FAQ</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>questions/questions.php" class="btn btn-sm btn-outline-secondary">Questions</a>

                </div>


            </div>
        </div>

        <?php
        $db = dbConn();
        $sqlfaq = "SELECT * FROM frequentasked ";
        $resultfaq = $db->query($sqlfaq);
        if ($resultfaq->num_rows > 0) {
            $totalProducts = $resultfaq->num_rows;
        }
        ?>

        <h5><span class="badge bg-primary"><?= @$totalProducts ?></span> FAQ</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th >#</th>

                        <th >Question</th>
                        <th>Answer</th>
                        <th >Status</th>
                        <th >Update Status</th>
                        <th>ACtion</th>                                    
                        <th >Add Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultfaq->num_rows > 0) {
                        $i = 1;
                        while ($rowfaq = $resultfaq->fetch_assoc()) {
                            ?>
                            <tr>
                                <td ><?= $i ?></td>

        <!--                                <td class="text-truncate" ><?= ucfirst($rowfaq['questionname']) ?></td>-->
                                <td  ><?= ucfirst($rowfaq['questionname']) ?></td>
        <!--                                <td ><?= ucfirst(substr($rowfaq['questionanswer'], 0, 200)) ?></td>-->
                                <td ><?= ucfirst(substr($rowfaq['questionanswer'], 0,)) ?></td>

                                <td  ><?php
                                    $faqstatus = $rowfaq['status'];
                                    if ($faqstatus == 1) {
                                        ?><button class="btn btn-success btn-sm" readonly> Active</button><?php
                                    } else {
                                        ?><button class="btn btn-danger btn-sm" readonly> Deactive</button><?php
                                    }
                                    ?></td>

                                <td>
                                    <?php
                                    $faqstatus = $rowfaq['status'];
                                    if ($faqstatus == 1) {
                                        ?><form action="statusupdate.php" method="POST">
                                        <input type="hidden" name="questionname" value="<?= $rowfaq['questionname'] ?>" >
                                        <input type="hidden" name="questionanswer" value="<?= $rowfaq['questionanswer'] ?>" >
                                        <input type="hidden" name="questionid" value="<?= $rowfaq['questionid'] ?>" >
                                        
                                        <button class="btn btn-outline-danger btn-sm" name="action" value="deactive"> Deactivate</button>
                                    </form><?php
                                    } else {
                                        ?><form action="statusupdate.php" method="POST">
                                        <input type="hidden" name="questionname" value="<?= $rowfaq['questionname'] ?>" >
                                        <input type="hidden" name="questionanswer" value="<?= $rowfaq['questionanswer'] ?>" >
                                        <input type="hidden" name="questionid" value="<?= $rowfaq['questionid'] ?>" >
                                        
                                        <button class="btn btn-outline-success btn-sm" name="action" value="active"> Activate </button>
                                    </form><?php
                                    }
                                    ?>
                                    
                                </td>
                                <td ><?= $rowfaq['adddate'] ?></td>                                  

                                <td>
                                    <form action="faqupdate.php" method="POST" >
                                        <input type="hidden" name="questionname" value="<?= $rowfaq['questionname'] ?>" >
                                        <input type="hidden" name="questionanswer" value="<?= $rowfaq['questionanswer'] ?>" >
                                        <input type="hidden" name="questionid" value="<?= $rowfaq['questionid'] ?>" >
                                        <button name="action" value="edit" class="btn btn-outline-dark"> Update</button>
                                    </form>

                                </td>
                               
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>

            </table>
        </div>
    </section>
    <?php include '../footer.php'; ?>       



















































</main>
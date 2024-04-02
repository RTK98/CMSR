<?php $categorypagemenu = 'active'; ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manage Services</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>services/add.php" class="btn btn-sm btn-outline-secondary">Add Category</a>

            </div>

        </div>
    </div>
    <?php
    $sql = "SELECT * FROM tbl_category";
    $db = dbConn();
    $result = $db->query($sql);

    $totalCategories = $result->num_rows;
    ?>

    <section>
        <h5><span class="badge bg-primary"><?= $totalCategories ?></span> Categories</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th >ID</th>
                        <th >Category Name</th>
<!--                        <th >Category description</th>-->
                        <th >Category Image</th>
                        <th >Status </th>                                    
                        <th>Add Date </th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td ><?= $i ?></td>
                                <td ><?= $row['CategoryName'] ?></td>
<!--                                <td><?= $row['CategoryDescription'] ?></td>-->
                                <td><img style="width:10rem; justify-content: center; align-items: center" class="img-fluid" width="20"  src="<?= SYSTEM_PATH ?>assets/img/services/<?= $row['categoryimage'] ?>"></td>


                                <td>
                                    <?php
                                    if ($row['categoryStatus'] == 1) {
                                        ?>
                                        <p><a href="statuscategory.php?Id=<?= $row['categoryid'] ?>.&Status=0" class="text-success text-decoration-none">Active</a></p> <?php } else {
                                        ?>
                                        <p><a href="statuscategory.php?Id=<?= $row['categoryid'] ?>.&Status=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                                    }
                                    ?>
                                               </td>

                                <td ><?= $row['AddDate'] ?></td>   

                                           <!--   <td width="50" ><?php
                                if ($row['categoryStatus'] == 1) {
                                    echo '<p><a href="statuscategory.php?Id=' . $row['categoryid'] . '&Status=0" class="text-success">Active</a></p>';
                                } else {
                                    echo'<p><a href="statuscategory.php?Id=' . $row['categoryid'] . '&Status=1" class="text-danger">Dective</a></p>';
                                }
                                ?></td>  --> 
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </section><!-- -->

</main>

<?php include '../footer.php'; ?>      
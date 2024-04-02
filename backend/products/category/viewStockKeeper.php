<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<style>
<?php include '../../assets/css/styles.css';
?>
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 Maincontainer">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/addCategory.php" class="btn btn-sm btn-dark">View Orders</a>
            </div>
        </div>
    </div>
    <hr>
    <h2>Product Category List</h2>
    <section>
        <?php
        $db = dbconn();
        $sql2 = "SELECT * FROM catergories WHERE CatergoryStatus='1'";
        $result = $db->query($sql2);
        ?>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="catergory">
                            <div class="image">
                                <img class="img-fluid" width="20"
                                     src="<?= SYSTEM_PATH ?>assets/img/catergory/<?= $row['CatergoryImage'] ?>">
                            </div>
                            <div class="catergoryName">
                                <h3><?= ucwords($row['CatergoryName']) ?></h3>
                            </div>
                            <p><?= $row['CatergoryDescription'] ?></p>
                        </div>

                    </div>
                <?php
                }
            }
            ?>

        </div>

    </section>



</main>
<?php include'../../footer.php'; ?>
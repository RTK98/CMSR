<?php include'../../header.php' ; ?>
<?php include'../../menu.php' ; ?>
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
                <a href="category/addCategory.php" class="btn btn-sm btn-outline-secondary">Add Catergory</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewProducts.php" class="btn btn-sm btn-outline-secondary">View Catergory List</a>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button> -->
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>
    <h2>Products List</h2>
    <div class="catergories row">
    <div class="col-md-4">abc</div>
    <div class="col-md-4">abc</div>
    <div class="col-md-4">abc</div>
        <p>From Catergories</p>
        <?php 
            $db=dbconn();
            $sql2="SELECT * FROM catergories";     
            $result=$db->query($sql2);
        ?>
        <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            
        <!-- <div class="catergory">
        <p>From Catergory</p>
            <div class="image">
                <img class="img-fluid" width="20"
                    src="<?= SYSTEM_PATH ?>assets/img/catergory/<?= $row['CatergoryImage'] ?>">
            </div>
            <div class="catergoryName">
                <h3><?= $row['CatergoryName'] ?></h3>
            </div>
            <p><?= $row['CatergoryDescription'] ?></p>
            <div class="button">
                <a href="../add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
            <?php
           }
        }
           ?>
        </div> -->



    </div>
</main>
<?php include'../../footer.php' ; ?>
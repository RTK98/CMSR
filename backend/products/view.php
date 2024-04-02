<?php include'../header.php' ; ?>
<?php include'../menu.php' ; ?>
<style>
<?php include '../assets/css/styles.css';
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
                <a href="viewProducts.php" class="btn btn-sm btn-outline-secondary">View Product List</a>
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
    <div class="catergories">
        <div class="catergory">
            <div class="image">
                <img src="../assets/img_2/oilIcon.png" alt="catergoryIcon">
            </div>
            <div class="catergoryName">
                <h3>Oil</h3>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <div class="button">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
        </div>

        <?php 
        
            $db=dbconn();
            echo  $sql2="SELECT * FROM catergories WHERE CatergoryID='5'";     
            $result=$db->query($sql2);
            
            
        ?>
        <div class="catergory">
            <div class="image">
            <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
            <img class="img-fluid" width="20" src="<?= SYSTEM_PATH ?>assets/img/catergory/<?= $row['CatergoryImage'] ?>">
            </div>
            <?php 
           }}
           ?>
            <div class="catergoryName">
                <h3>Shobs</h3>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <div class="button">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
        </div>
        <div class="catergory">
            <div class="image">
                <img src="../assets/img_2/oilIcon.png" alt="catergoryIcon">
            </div>
            <div class="catergoryName">
                <h3>Mounts</h3>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <div class="button">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
        </div>
        <div class="catergory">
            <div class="image">
                <img src="../assets/img_2/oilIcon.png" alt="catergoryIcon">
            </div>
            <div class="catergoryName">
                <h3>Filters</h3>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <div class="button">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
        </div>
        <div class="catergory">
            <div class="image">
                <img src="../assets/img_2/oilIcon.png" alt="catergoryIcon">
            </div>
            <div class="catergoryName">
                <h3>Plugs</h3>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <div class="button">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a>
            </div>
        </div>
        <h3></h3>
    </div>
</main>
<?php include'../footer.php' ; ?>
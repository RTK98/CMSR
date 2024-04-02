<?php
$Service='active';
include 'header.php';
include 'menu.php';
?>

<head class="container">
    <meta name='viewport' content="width=device-width, initial-scale=1.8">
    <title>Replica Speed</title>
<!--        <link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/style.css">-->
    <link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/style.css">
    <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet">
<!--        <script src="<?= SYSTEM_PATH ?>assets/js/sweetalert2.all.js"></script>-->
</head>
<!--<h1 class="slide-left">KEEP YOUR <br> AUTO MOVING </h1>-->
<!--<p class="slide-left"> Maintain a smooth and efficient ride with our expert help. Take care of your car, keep it in motion, and worry-free. 
    Our services ensure your vehicle stays in great condition, 
    so you can drive without a hitch. 
    Join us today for a hassle-free driving experience!</p>-->
<!--<div class="links slide-left">
</div>-->
</div>        

    <div class="container-fluid card-custom">
        <div class="container">
            <div class="row">
                   <?php
         $sql = "SELECT * FROM tbl_category WHERE categoryStatus='1' ORDER BY tbl_category.CategoryDescription ASC";
        $db = dbConn();
        $result = $db->query($sql);
        ?>
        <?php
        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-3 mb-4 pr-2 card portfolio-item" style="max-width: 18rem; box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.06);">
    <div class="portfolio-wrap">
        <img src="http://localhost/CMSR/backend/assets/img/services/<?= $row['categoryimage'] ?>" class="card-img-top" style="width: 100%; height: 17rem; object-fit: cover; border-radius: 8px 8px 0 0;" alt="...">
        <div class="portfolio-info">
            <div class="card-body">
                <h5 class="card-title mb-3"><?= $row['CategoryName'] ?></h5>
                <p class="card-text"><?= $row['CategoryDescription'] ?></p>
               
            </div>
        </div>
    </div>
</div>
            <?php }
        } ?>
            </div>  
        </div>
    </div>


<?php 
include 'footer.php'

?>
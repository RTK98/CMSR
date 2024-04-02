<?php 
$Gallery='active';
include 'header.php';
include 'menu.php';
?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0px;
            padding: 20px;
        }

        .gallery-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .gallery-item h3 {
            margin: 10px 0;
            text-align: center;
        }
    </style>


    </div>
    <header>
        <h1>Replica Speed Gallery</h1>
    </header>
    <div class="gallery-container">
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/1.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/2.jpg" alt="Image 1">
            
        </div>
       <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/3.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/4.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/5.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/6.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/7.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/8.jpg" alt="Image 1">
            
        </div>
        <div class="gallery-item">
            <img src="<?= SYSTEM_PATH ?>assets/img/9.jpg" alt="Image 1">
            
        </div>
        <!-- Add more gallery items as needed -->
    </div>
<?php include 'footer.php'; ?>

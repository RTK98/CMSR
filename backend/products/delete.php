<?php ob_start();?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="add.php" class="btn btn-sm btn-outline-secondary">Delete Product</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <?php
    extract($_POST);
   
     if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action=="yes") {
         
         $db= dbConn();
         $sql="DELETE FROM products WHERE ProductId='$ProductId'";
         $db->query($sql);
         $sql="DELETE FROM productsize WHERE ProductId='$ProductId'";
         $db->query($sql);
         header("Location:view.php");
     }
    
    ?>
    <div class="card text-center">
        <div class="card-header bg-danger text-white">
            Delete Confirmation
        </div>
        <div class="card-body">
            <h5 class="card-title">Are your sure want to delete this Item?</h5>
            <form method="post"  action="<?= $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="ProductId" value="<?= $ProductId ?>">
                <button type="submit" name="action" value="yes" class="btn btn-danger">Yes</button>
                <button type="submit" name="action" value="no" class="btn btn-warning">No</button>
            </form>
            
        </div>
        <div class="card-footer text-muted bg-warning">
            
        </div>
    </div>
</main>




<?php include'../footer.php'; ?>
<?php ob_end_flush();?>
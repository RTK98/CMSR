<?php ob_start(); ?>
<?php
include'../header.php';
include'../menu.php';
include'rand.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Order</h1>
    </div>

</main>

<?php
ob_ <?php
extract($_POST);
print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeProduct') {
    $JobCardId;
    @$AppointmentId;
    @$Inspectionid;
    $addeduser = $_SESSION['userId'];
    $adddate = date("Y-m-d");
    echo $ProductId;
    echo'<br>';
    echo $stockIdz;
    echo'<br>';
    $db = dbConn();
    echo $sqlDeleteItems = "DELETE FROM orderreleaseitem  WHERE StockId='$stockIdz' AND ProductId='$ProductId' ";
    $db->query($sqlDeleteItems);

    $sqlRetunStock = "UPDATE stockitems SET Status='1' WHERE stockId='$stockIdz'";
    $db->query($sqlRetunStock);

    $sqlProductQty = "SELECT UpdateDate,UpdateUser,IssuedQty,Qty FROM Products WHERE ProductId='$ProductId'";
    $resultProductQty = $db->query($sqlProductQty);
    $rowProductQty = $resultProductQty->fetch_assoc();

    $ProductQty = $rowProductQty['Qty'];
    $IssuedQty = $rowProductQty['IssuedQty'];
    $ProductQty += 1;
    '<br>';
    $IssuedQty -= 1;
    echo '<br>';
    $sqlUpdateQty1 = "UPDATE products SET Qty='$ProductQty', IssuedQty='$IssuedQty' ,"
            . "IssueLastDate='$adddate',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE  ProductId='$ProductId'";
    $db->query($sqlUpdateQty1);
}
?>end_flush(); ?>
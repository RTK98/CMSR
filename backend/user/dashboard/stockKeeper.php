<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard  <?= $_SESSION['FirstName'] ?> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    <h2>Section title</h2>
    <?php
    $adddate = date("Y-m-d");
    $addeduser = $_SESSION['userId'];
    $db = dbconn();
    $sql = "SELECT * FROM stockitems WHERE Status = '1' AND ExpDate <= '$adddate'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $StockId = $row['StockId'];
            $CatergoryName = $row['CatergoryName'];
            $ProductId = $row['ProductName'];
            $SerialNo = $row['SerialNo'];
            $BatchId = $row['BatchNo'];
            $PoId = $row['PoNo'];
            $supplierId = $row['SupplierName'];
            $ExpDate = $row['ExpDate'];
            $Cost = $row['Cost'];
            $SalePrice = $row['SalePrice'];

            $sqlExpire = "INSERT INTO expireitems(stockId,CategoryName,ProductName,serialNo,batchNo,poNo,SupplierId,ExpireDate,Cost,SalePrice,Status,AddUser,AddDate) VALUES "
                    . "('$StockId','$CatergoryName','$ProductId','$SerialNo','$BatchId','$PoId','$supplierId','$ExpDate','$Cost','$SalePrice','1','$addeduser','$adddate')";
            $db->query($sqlExpire);

            $sqlUpdateStock = "UPDATE stockitems SET Status='3', UpdateUser='$addeduser',UpdateDate='$adddate' WHERE StockId='$StockId' ";
            $db->query($sqlUpdateStock);
        }
    }
    ?>
</main>
<?php include'footer.php'; ?>
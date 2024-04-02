<?php
ob_start();
include'../../header.php';
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    </head>
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
        }
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left:-15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>
    <body>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
<!--                <i class="checkmark">✓</i>-->
                <i class="checkmark"><img src="../../assets/img/Success.png" alt="alt" style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;"/></i>
            </div>
            <h1>Success fully Added Purchasing Order</h1> 
            <?php
            $empId = $_SESSION['userId'];
            $db = dbconn();
            $sql = "SELECT po.PoNo,po.Product_Name,po.Product_Name,po.PoQty,po.AddDate, p.ProductName,s.SupplierName,u.FirstName FROM purchasingorders po LEFT JOIN products p ON po.Product_Name=p.ProductId "
                    . "LEFT JOIN supplier s ON s.SupplierId=po.Supplier_Name "
                    . "LEFT JOIN users u ON u.UserId=po.AddUser "
                    . "WHERE po.AddUser='$empId' ORDER BY po.PoId DESC LIMIT 1";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <p><strong> Your Purchasing No : <?= $row["PoNo"] ?></strong><br/>
            <p style="color:red; font-weight: bold;">Product Name : <?= ucwords($row["ProductName"]) ?><br/>
            <p style="color:red; font-weight: bold;">Supplier Name : <?= ucwords($row["SupplierName"]) ?><br/>
            <p style="color:red; font-weight: bold;">Product Qty: <?= $row["PoQty"] ?><br/>
            <p>Order Date : <?= $row["AddDate"] ?><br/>
            <p>Order By : <?= $row["FirstName"] ?><br/>
            <div class="btn-group me-2">
                <a href="reorderItems.php" class="btn btn-danger">Close</a>
            </div>
        </div>
    </body>
</html>
<?php include'../../footer.php'; ?>
<?php ob_end_flush(); ?>
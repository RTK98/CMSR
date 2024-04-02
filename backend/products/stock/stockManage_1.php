<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Stocks</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/viewStock.php" class="btn btn-sm btn-outline-secondary">View Stock List</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
            </div>
        </div>

    </div>
    <h2>Add Stock</h2>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {
        $db = dbConn();
        echo $sql = "INSERT INTO stock(Product_Id, Price, Qty, SalePrice, Date, Status) VALUES ('$ProductId','$Price','$Qty','$SalePrice','$Date','1')";
        $db->query($sql);
    }
    ?>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <label>Select Category</label>
        <?php
        $db = dbConn();
        $sql = "SELECT * FROM catergories";
        $result = $db->query($sql);
        ?>
        <select name="CatergoryID">
            <option value="">--</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?= $row['CatergoryID'] ?>"><?= $row['CatergoryName'] ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Select Product Name</label>
        <?php
        $db = dbConn();
        $sql = "SELECT * FROM products";
        $result = $db->query($sql);
        ?>
        <select name="ProductId">
            <option value="">--</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?= $row['ProductId'] ?>"><?= $row['ProductName'] ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Enter Price</label>
        <input type='text' name='Price'>
        <label>Enter Qty</label>
        <input type='text' name='Qty'>
        <label>Enter Sale Price</label>
        <input type='text' name='SalePrice'>
        <label>Enter Date</label>
        <input type='date' name='Date'>
        <button class='btn btn-primary btn-sm' type="submit" name="action" value="save">Save</button>
    </form>
    <?php
//    $db = dbConn();
//    echo $sql = "SELECT i.ProductName,s.Price,s.Qty,s.SalePrice,s.Date,s.IssueQty,(s.Qty-s.IssueQty) AS 'Balance' FROM stock s LEFT JOIN stockitems i ON i.Id=s.ProductId";
//    $result = $db->query($sql);
    $db = dbConn();
    echo $sql = "SELECT p.ProductName, s.Price, s.Qty, s.SalePrice, s.Date,IssueQty,(s.Qty-s.IssueQty) AS 'Balance' FROM stock s LEFT JOIN products p ON p.ProductId=s.id";
    $result = $db->query($sql);
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Sale Price</th>
                <th>Date</th>
                <th>Issue</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['ProductName'] ?></td>
                        <td><?= $row['Price'] ?></td>
                        <td><?= $row['Qty'] ?></td>
                        <td><?= $row['SalePrice'] ?></td>
                        <td><?= $row['Date'] ?></td>
                        <td><?= $row['IssueQty'] ?></td>
                        <td><?= $row['Balance'] ?></td>

                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>

</main>
<?php include '../../footer.php'; ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
    </div>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {
        $db = dbConn();
         $sql = "INSERT INTO orders(ProductId,Qty,Date,Status) VALUES ('$ProductId','$Qty','$Date','1')";
        $db->query($sql);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'Issue' ) {
        $db = dbConn();
        $date = date('Y-m-d');
         $sql = "UPDATE stock SET IssueQty=IssueQty+'$issue_qty',IssueLastDate='$date' WHERE ProductId='$ProductId'";
        $db->query($sql);

        $sql2 = "UPDATE orders SET IssueQty='$issue_qty', IssueLastDate='$date', Status='2' WHERE ProductId='$ProductId'";
        $db->query($sql2);
    }
    ?>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
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

        <label>Enter Qty</label>
        <input type='text' name='Qty'>
        <label>Enter Date</label>
        <input type='date' name='Date'>
        <button class='btn btn-primary btn-sm'type="submit" name="action" value="save">Save</button>
    </form>
    <?php
//    $db = dbConn();
//    echo $sql = "SELECT i.ProductName,s.Price,s.Qty,s.SalePrice,s.Date,s.IssueQty,(s.Qty-s.IssueQty) AS 'Balance' FROM stock s LEFT JOIN stockitems i ON i.Id=s.ProductId";
//    $result = $db->query($sql);
    $db = dbConn();
     $sql = "SELECT o.ProductId, p.ProductName,o.Qty,o.Date FROM orders o LEFT JOIN products p ON p.ProductId=o.id";
    $result = $db->query($sql);
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Date</th>
                <th>Issue</th>
                <th>Action</th>
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
                        <td><?= $row['Qty'] ?></td>
                        <td><?= $row['Date'] ?></td>
                        <td>
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <input type='text' name='issue_qty' onChange="form.submit()">
                                <input type='hidden' name='action' value='Issue'>
                                <input type='hidden' name='ProductId' value="<?= $row['ProductId'] ?>">

                            </form>
                        </td>
                        <td>
                                               <!--                                    <input type='hidden' name='issue_qty' value="<?= $row['issue_qty'] ?>>
                                                                                   <input type='hidden' name='ProductId' value="<?= $row['ProductId'] ?>">
                                                                                   <button class='btn btn-success btn-sm' type="submit" name="action" value="Issue">Issue</button>-->
                        </td>

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
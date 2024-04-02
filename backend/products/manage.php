<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>

    </div>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {

        $db = dbConn();
        $sql = "INSERT INTO `order_items`(`ProductId`, `Qty`, `Date`,`Status`) VALUES ('$ProductId','$Qty','$Date','1')";
        $db->query($sql);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'issue') {

        $db = dbConn();
        $date = date('Y-m-d');

        $order = $issue_qty;

        $i = 0;

        while ($i < $order) {
            $sql = "SELECT * FROM tbl_stock WHERE ProductId='$ProductId' AND Status='1' ORDER BY Date ASC LIMIT 1";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stock = $row['Qty'] - $row['IssueQty'];
                    if ($stock >= $order) {
                        if ($stock == $order) {
                            $status = 0;
                        } else {
                            $status = 1;
                        }
                        $sql = "UPDATE tbl_stock  SET IssueQty= IssueQty +'" . $order . "', Status='$status' WHERE Id='" . $row['Id'] . "'";
                        $db->query($sql);
                        $i += $order;
                    } else {
                        $issue = $order - $i;
                        if ($issue >= $stock) {
                            $issue = $stock;
                            $status = 0;
                        } else {
                            $status = 1;
                        }
                        $sql = "UPDATE tbl_stock  SET IssueQty= IssueQty + '" . $issue . "', Status='$status' WHERE Id='" . $row['Id'] . "'";
                        $db->query($sql);
                        $i += $issue;
                    }
                }
            } else {
                $i = $order;
            }
        }


//         echo $sql="UPDATE tbl_stock SET IssueQty=IssueQty + '$issue_qty', IssueLastDate='$date' WHERE ProductId='$ProductId'";
//         $db->query($sql);
//         
//         $sql="UPDATE order_items SET IssueQty='$issue_qty', IssueDate='$date',Status='2' WHERE ProductId='$ProductId'";
//         $db->query($sql);
    }
    ?>
    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <label>Select Product Name</label>
        <?php
        $db = dbConn();
        $sql = "SELECT * FROM tbl_items";
        $result = $db->query($sql);
        ?>
        <select name="ProductId">
            <option value="">--</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?= $row['Id'] ?>"><?= $row['ProductName'] ?></option>
                    <?php
                }
            }
            ?>
        </select>

        <label>Enter Qty</label>
        <input type='text' name='Qty'>

        <label>Enter Date</label>
        <input type='date' name='Date'>
        <button type="submit" name="action" value="save">Save</button>
    </form>
    <?php
    $db = dbConn();
    $sql = "SELECT ProductId,ProductName,ProductQty,AddDate FROM products o LEFT JOIN tbl_items i ON i.Id=o.ProductId";
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
                            <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <input type="text" name="issue_qty" onchange="form.submit()">
                                <input type='hidden' name='action' value='issue'>
                                <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                            </form>
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
<?php include '../footer.php'; ?>

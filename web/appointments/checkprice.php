<?php
include '../config.php';
include '../function.php';
extract($_POST);

$db = dbConn();

if ($ServiceType != 0) {

    $sql = "Select st.Service_Id,st.Product_Id,pro.ProductName from servicetypes st "
            . "LEFT JOIN products pro ON pro.ProductId=st.Product_Id "
            . "WHERE Service_Id='$ServiceType'";
    $result = $db->query($sql);

    $db = dbConn();
     $sqlSType = "Select ServiceName from service where ServiceId='$ServiceType'";
    $resultSname = $db->query($sqlSType);
    $row3 = $resultSname->fetch_assoc();
    ?>
    <link href="../assets/css/style.css">


    <div class="mb-3" style="background-color: white;">

        <h5 style="text-align: center;"><strong>Estimated Service Amount <br>
                <?= $row3['ServiceName'] ?></strong></h5>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Rate (Rs.)</th>
                    <th scope="col">Amount (Rs.)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    $total = 0;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td>
                                <?= $row['ProductName'] ?></td>
                            <td>
                                <?php
                                $productId = $row['Product_Id'];
                                $db = dbConn();
                                $sqlPrice = "SELECT ProductName,SalePrice FROM stockitems WHERE stockitems.ProductName='$productId' AND stockitems.Status='1' ORDER BY stockitems.AddDate ASC LIMIT 1";
                                $resultPrice = $db->query($sqlPrice);
                                $rowPrice = $resultPrice->fetch_assoc();
                                ?>
                                <?= $price = $rowPrice['SalePrice'] ?>
                            </td>
                            <td>


                                <?php
                                $sum = @$price;

                                echo number_format($sum, 2);
                                ?>
                            </td>

                            <td>

                            </td>
                        </tr>
                        <?php
                        $n++;
                        @$total += $sum;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Sum</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong><?= number_format(@$total, 2) ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5"> <p style="color: red; text-align: center;">**Prices and availability are subject to change without notice</p>
                        &nbsp;</td>
                </tr>
            </tfoot>
        </table>

    </div>


<?php } ?>

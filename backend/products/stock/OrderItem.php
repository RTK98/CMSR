<?php ob_start(); ?>
<?php
include'../../header.php';
include'../../menu.php';
include '../../assets/phpmail/mail.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Re-Order</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="reorderItems.php" class="btn btn-sm btn-outline-secondary">View Re-oder Items</a>
            </div>
            <div class="btn-group me-2">
                <a href="addAppointment.php" class="btn btn-sm btn-outline-secondary">View Purchasing Orders</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'Order') {

        echo $ProductId;
        $current = date("Y-m-d");
        $empId = $_SESSION['userId'];

        $db = dbconn();
        $sqlReorder = "SELECT p.ProductId,p.ProductName, p.SupplierName,p.OrderStatus,s.SupplierName,s.SupplierId FROM products p "
                . "LEFT JOIN supplier s ON p.SupplierName=s.SupplierId WHERE p.ProductId='$ProductId'AND p.ProductStatus='1'";
        $resultReorder = $db->query($sqlReorder);
        $row = $resultReorder->fetch_assoc();
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addPO') {

        echo $ProductId;
        $current = date("Y-m-d");
        $empId = $_SESSION['userId'];

        $db = dbconn();
        $sqlReorder = "SELECT p.ProductId,p.ProductName, p.SupplierName,p.OrderStatus,s.SupplierName,s.SupplierId,s.email FROM products p "
                . "LEFT JOIN supplier s ON p.SupplierName=s.SupplierId WHERE p.ProductId='$ProductId'AND p.ProductStatus='1'";
        $resultReorder = $db->query($sqlReorder);
        $row = $resultReorder->fetch_assoc();

        echo $suuplierName = $row['SupplierId'];
        $supplierEmail = $row['email'];
        $ProductEmailName = $row['ProductName'];
        $suplierEmailName = ucwords($row['SupplierName']);
        $Orderby;

        $ProductId;
        $current;
        $empId;
        $PoQty;
        $messages = array();
        if (empty($PoQty)) {
            $messages['error_serialNo'] = "The Product Qty No should not be blank..!";
        }
        if (!empty($PoQty >= 100)) {
            $messages['error_Qty_limit'] = "The Product Qty Exceeded..!";
        }
        if (empty($messages)) {
            $date = date("ymd");

             $sql = "INSERT INTO purchasingorders(Product_Name, Supplier_Name, PoQty, Status,AddUser, AddDate) VALUES ('$ProductId','$suuplierName','$PoQty','1','$empId','$current')";
            $result = $db->query($sql);

            $PoId = $db->insert_id;

            $LastValue = sprintf("%'.04d\n", $PoId);
            $PoNo = 'PO' . $date . 'S' . $suuplierName . 'P' . $ProductId . $LastValue;

             $sql1 = "UPDATE purchasingorders  SET PoNo='$PoNo' WHERE PoId='$PoId'";
            $result1 = $db->query($sql1);

             $sql2 = "UPDATE products  SET OrderStatus='1' WHERE ProductId='$ProductId'";
            $result2 = $db->query($sql2);

            echo $to = $supplierEmail;
            echo $toname = $suplierEmailName;
            echo $subject = "Purchading Order || Replica Speed Motor Garage" . ' ' . $PoNo;
            $body = '<!doctype html>
                 <html lang="en-US">
                    <head>
                        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                        <title>Appointment Successfully Added</title>
                        <meta name="description" content="Reset Password Email">
                        <style type="text/css">
                            body{
                                background-image:url(https://www.dropbox.com/s/d8fqrtfnmh6x3a0/background.png?raw=1);
                            }
                            a:hover {
                                text-decoration: underline !important;
                            }
                        </style>
                    </head>

                    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                        <!--100% body table-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                               style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
                            <tr>
                                <td>
                                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                           align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                                <a href="#" title="logo" target="_blank">
                                                    <img width="60" src="https://www.dropbox.com/s/h8nzlij6m45t6cr/logo.png?raw=1" title="logo" alt="logo">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                       style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:40px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
                                                          <h3 class="m-1"style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h3>
                                                                <p class="m-1" style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                    <p class="m-1" style="text-align: center;">0779 200 480</p>
                                      <h4 class="m-1"style="text-align: center; font-weight: bold;">Purchasing Order</h4>
                                    
            
            <h5>Purchasing Order No :' . $PoNo . '</h5>
            <p style="color:red; font-weight: bold;">Product Name :' . $ProductEmailName . '</p><br/>
            <p style="color:red; font-weight: bold;">Product Qty : ' . $PoQty . '</p><br/>
            <p style="font-weight: bold;">Order Date : ' . $current . '</p><br/>
            <p>Order By  : ' . $Orderby . "</p><br/>
           <p style='text-align: justify;
            text-justify: auto;
            list-style:disc outside none;
            display:list-item;
            '>
                                            Any question regarding this order should be directed to : The Manager |  Contact No : 0779200480 </p>

                                        <p style='text-align: justify;
            text-justify: auto;
            list-style:disc outside none;
            display:list-item;
            font-weight: bold;
            '><em> Thank you for your prompt and expeditious handling of this order</em>
                                        </p>
                                    </div>
                                    <p style='text-align: justify;
            text-justify: auto;
            '>Thank You,<br>
                                        Best Regards,<br>
                                        Manager,<br>
                                        Replica Speed Motor Garage<br>
                                    </p>
                </td>
                </tr>
                <tr>
                <td style = 'height:40px;'>&nbsp;
                </td>
                </tr>
                </table>
                </td>
                <tr>
                <td style = 'height:20px;'>&nbsp;
                </td>
                </tr>
                <tr>
                <td style = 'text-align:center;'>
                <p style = 'font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>&copy;
                <strong>Replica Speed Motor Garage V.1.0</strong></p>
                </td>
                </tr>
                <tr>
                <td style ='height:20px;'>&nbsp;
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                <!--/100% body table-->
                </body>

                </html>";
            echo $alt = "Appointment";
            send_email($to, $toname, $subject, $body, $alt);

            if ($results) {
                echo "";
            }
            header("Location:successMessage.php");
        }
    }
    ?>
    <h2> Purchasing Order</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <div class="card-body">
                            <section class="m-1">
                                <div class="card-header">
                                    <img  src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                          style="
                                          width:60px;
                                          display: block;
                                          margin: 0 auto;
                                          ">
                                    <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
                                    <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                    <p class='m-1' style="text-align: center;">0779 200 480</p>
                                </div>
                                <div class="card-body">
                                    <h5 class='m-1'style="text-align: center; font-weight: bold;">Purchasing Order</h5>
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <p> Supplier Name : <?= ucwords($row['SupplierName']) ?>
                                                </p>
                                            </div>
                                            <div>
                                                <p>Product Name : <?= $row['ProductName'] ?> </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <p> Order Date :  <?= $current ?></p>
                                            </div>
                                            <div>
                                                <?php
                                                $db = dbconn();
                                                $sqlAddUser = "SELECT FirstName,LastName FROM users WHERE UserId='$empId'";
                                                $resultAddUser = $db->query($sqlAddUser);
                                                $rowAddUser = $resultAddUser->fetch_assoc();
                                                ?>
                                                <p>Order By : <?php echo $Orderby = $rowAddUser['FirstName'] . ' ' . $rowAddUser['LastName']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="container m-1">
                                    <section>
                                        <h6>Product Details</h6>
                                        <table class="table m-1">
                                            <thead>
                                                <tr style="background-color: #d2d2d2">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Supplier Name</th>
                                                    <th scope="col">Product Qty</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><?= $row['ProductName'] ?></td>
                                                    <td><?= ucwords($row['SupplierName']) ?></td>
                                                    <td>
                                                        <input type="number" name="PoQty" placeholder="Enter PO Qty" min="0">
                                                        <div class="text-danger"><?= @$messages['error_serialNo']; ?></div>
                                                        <div class="text-danger"><?= @$messages['error_Qty_limit']; ?></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <div class="mb-3">
                                        <p style='text-align: justify;
                                           text-justify: auto;
                                           list-style:disc outside none;
                                           display:list-item; '>
                                            Any question regarding this order should be directed to : The Manager |  Contact No : 0779200480 </p>

                                        <p style='text-align: justify;
                                           text-justify: auto;
                                           list-style:disc outside none;
                                           display:list-item; '><em> Thank you for your prompt and expeditious handling of this order</em>
                                        </p>
                                    </div>
                                    <p style='text-align: justify;
                                       text-justify: auto; '>Thank You,<br>
                                        Best Regards,<br>
                                        Manager,<br>
                                        Replica Speed Motor Garage<br>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                    <button type="submit" name="action" value="addPO" class="btn btn-primary ">Submit</button>
                                </div>
                            </section> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

<?php ob_end_flush(); ?>

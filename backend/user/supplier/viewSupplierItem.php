<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewReqItems.php" class="btn btn-sm btn-outline-secondary">View Orders</a>
            </div>
        </div>
    </div>
    <h2>Order List</h2>
    <div class="container">
        <div class="row">
            <?php
            extract($_POST);
            if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'view') {
                $SupplierId;

                $db = dbconn();
                $sql = "SELECT sc.SupCatId,s.SupplierName,s.ContactNo,s.email,s.Status,cat.CatergoryName FROM suppliercatergories sc "
                        . "LEFT JOIN supplier s ON sc.SupplierId=s.SupplierId "
                        . "LEFT JOIN catergories cat ON sc.CatergoryId=cat.CatergoryID WHERE sc.SupCatId='$SupplierId';";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
            }
            ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="col-md-6">
                        <div class="card" style="background-color:#F0F0FF">
                            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                <div class="card-body">
                                    <section class="m-1">
                                        <div class="card-header">
                                            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Supplier Summary</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <p> Supplier Name : <?= ucwords($row['SupplierName']) ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>Contact No : <?= $row['ContactNo'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p>Email : <?= $row['email']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Supplier Status : <?php
                                                            $Status = $row['Status'];
                                                            $statusDescription = '';

                                                            switch ($Status) {
                                                                case 1:
                                                                    $statusDescription = "Active";
                                                                    $statusColor = "btn btn-success btn-sm";
                                                                    break;
                                                                case 2:
                                                                    $statusDescription = "Deactive";
                                                                    $statusColor = "btn btn-danger btn-sm";
                                                                    break;
                                                                default:
                                                                    $statusDescription = "Not Available";
                                                                    $statusColor = "btn btn-secondary btn-sm";
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="container m-1">
                                            <section>
                                                <h6>Categories</h6>
                                                <table class="table m-1">
                                                    <thead>
                                                        <tr style="background-color: #d2d2d2">
                                                            <th scope="col">#</th>
                                                            <th scope="col">Category Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><tr>
                                                            <td></td>
                                                            <td><?= $row['CatergoryName'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                        <div class="card-footer">
                                            <a href="viewReqItems.php" class="btn btn-sm btn-danger">Close</a>
                                        </div>
                                    </section> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

<?php ob_start();?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
    </div>
    <div class="card">
        <div class="card-header">
            New Inspection
        </div>
        <?php
         if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $VehicleNo = inputTrim($VehicleNo);
            $CustomerName = inputTrim($CustomerName);
            $Millege = inputTrim($Millege);
            $messages = array();
            if(empty($VehicleNo)){
                $messages['error_Product_name'] = "The Product Name should not be blank..!";
            }
            if(empty($CustomerName)){
                $messages['error_Product_price'] = "The Product Price should not be blank..!";
            }
            if(empty($Millege)){
                $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
            }
            // if(!isset($ProductStatus)){
            //     $messages['error_Product_status'] = "The Product Status should not be blank..!";
            // }
            if(!isset($InspectionStatus)){
                $messages['error_Product_size'] = "The S Size should not be blank..!";
            }
            //advance validation
            if(!empty($VehicleNo)){
                $db = dbconn();
                $sql="SELECT * FROM inspections WHERE VehicleNo='$VehicleNo'";
                $result=$db->query($sql);
                
                if($result->num_rows>0){
                    $messages['error_Product_size'] = "The Product Name Already Exists!";
                }
            }
            $AddDate=date('Y-m-d');
            $rand=rand();
            $currentdate = $AddDate.$rand;
            echo $currentdate;

      

             if(empty($messages)){
                $db=dbconn();
                $AddDate=date('Y-m-d');
                $timestamp = strtotime($AddDate);
                $currentdatenumber = date('Ymd', $timestamp);
               $rand=rand();
               $InspectionNo = $currentdatenumber.$rand;
                $sql="INSERT INTO inspections(VehicleNo,InspectionNo,CustomerName,Millege,AddUser,AddDate )VALUES ('$VehicleNo','$InspectionNo', '$CustomerName', '$Millege', '1','$AddDate')";
      
                $db->query($sql);
                $InspectionId=$db->insert_id;
                foreach($InspectionStatus as $value){
                   $sql="INSERT INTO inspectionsreport(InspectionId,InspectionStatus) VALUES ('$InspectionId','$value')";
         
                    $db->query($sql);
                }
                header('Location:addSuccess.php');
             }  
                
         }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="VehicleNo" class="form-label">Vehicle No</label>
                    <input type="text" class="form-control" id="VehicleNo" name="VehicleNo"
                        placeholder="Enter Vehicle Number">
                </div>
                <!-- <div class="mb-3">
                    <label for="InspectionDate" class="form-label">Inspection Date</label>
                    <input type="text" class="form-control" id="InspectionDate" name="InspectionDate"
                        placeholder="Enter Vehicle Number">
                </div> -->
                <div class="mb-3">
                    <label for="CustomerName" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="CustomerName" name="CustomerName"
                        placeholder="Enter Customer Name">
                </div>
                <div class="mb-3">
                    <label for="Millege" class="form-label">Millege</label>
                    <input type="text" class="form-control" id="Millege" name="Millege" placeholder="Enter Millege">
                </div>
                <div class="mb-3">
                    <lable for="FuelType" class="form-label">Fuel Type</lable>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>--</option>
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Gasoline">Gasoline</option>
                    </select>
                </div>
                <?php
                $db=dbconn();
                $sql="SELECT RepairId, RepairName, RepairPrice,WarrantyType FROM repaircatergory";
                $result=$db->query($sql);
                
                ?>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Repair Name</th>
                            <th scope="col">Repair warranty</th>
                            <th scope="col">Repair Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            if($result->num_rows>0){
                $n=1;
                while($row=$result->fetch_assoc()){
                ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?=$row['RepairName']?></td>
                            <td><?=$row['WarrantyType']?></td>
                            <td><?=$row['RepairPrice']?></td>
                            <td></td>
                            <td><input type="checkbox" value="<?= $row['RepairId']?>" name="InspectionStatus[]"
                                    <?php if(isset($InspectionStatus) && in_array(@$RepairId, @$InspectionStatus)) {echo 'checked'; }?> />
                                &nbsp;
                            </td>
                        </tr>
                        <?php
                $n++;
            }
                }
                ?>
                    </tbody>
                </table>
                <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </form>
    </div>
    </div>
</main>
<?php include'../footer.php'; ?>

<?php print_r(@$messages); ?>
<?php ob_end_flush();?>
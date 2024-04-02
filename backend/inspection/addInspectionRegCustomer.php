<?php ob_start(); ?>
<?php
include'../header.php';
include'rand.php';
include'../menu.php';
?>
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
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);

            $inspectionNotes = inputTrim($inspectionNotes);
            $Millege = inputTrim($Millege);
            $CustomerName;
            $VehicleNo;

            $messages = array();
            if ($CustomerName == '') {
                $messages['error_Customer'] = "Please Select the Customer..!";
            }
            if ($VehicleNo == '') {
                $messages['error_Vehcile_No'] = "Please Select the Vehicle..!";
            }
            if (empty($Millege)) {
                $messages['error_Millege'] = "The Vehicle Millege should not be blank..!";
            }
            if (empty($messages)) {
                $db = dbConn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];

                $timestamp = strtotime($AddDate);
                $currentdatenumber = date('Ymd', $timestamp);
                $randomNumber;
                $InspectionNo = 'INS' . $currentdatenumber . $randomNumber;
                $sql = "INSERT INTO inspections(VehicleNo,InspectionNo,CustomerName,Millege,AddUser,AddDate,Status,inspectionNotes )VALUES ('$VehicleNo','$InspectionNo', '$CustomerName', '$Millege', '$AddUser','$AddDate','1','$inspectionNotes')";
                $db->query($sql);
                $InspectionId = $db->insert_id;

                ///

                foreach ($_POST as $key => $value) {
                    // Check if the key starts with "radio-"
                    if (strpos($key, 'radio-') === 0) {
                        // Extract the InspectionItemId from the key
                        $inspectionItemId = substr($key, strlen('radio-'));

                        // Retrieve the selected value
                        $selectedValue = $value;

                        // Perform database operations to save the selected value
                        // Example using MySQLi:
                        $db = dbconn();
                        $sqlInsItems = "INSERT INTO InspectionRecord(InspectionId,InspectionItemId,VehicleCondition) VALUE ('$InspectionId','$inspectionItemId','$selectedValue')";
//                        $sqlInsItems = "UPDATE inspectionitems SET InsItemValue=$selectedValue WHERE InspectionItemId=$inspectionItemId";
                        $db->query($sqlInsItems);

                        // You can also use prepared statements or ORM methods to securely insert/update the values
                        // Display a success message or perform other actions as needed
                        echo "Selected value for InspectionItemId $inspectionItemId: $selectedValue <br>";
                    }
                }
//                foreach ($InspectionStatus as $value) {
//                    $sql = "INSERT INTO inspectionsreport(InspectionId,InspectionStatus) VALUES ('$InspectionId','$value')";
//                    print_r($sql);
//                    $db->query($sql);
//                }
//                 
                ?>
                <script>
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Inspection has been successfully added',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewInspection.php'; // Redirect to success page
                    });
            </script><?php
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <section class="m-1">
                    <h6 class="btn btn-success">Customer Info.</h6>
                    <div class="row">
                        <?php
                        $db = dbconn();
                        $sql = "SELECT CustomerID,FirstName, LastName FROM customer";
                        $result = $db->query($sql);
                        ?>
                        <div class="mb-3">
                            <lable for="CustomerName" class="form-label">Customer Name :<span style='color: red'>*</span> </lable>
                            <select class="form-select" name="CustomerName" id="CustomerName" onclick="loadCustomerName()" aria-label="Default select example">
                                <option value=''>Select the Customer</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($rowCustomerName = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $rowCustomerName['CustomerID'] ?>" <?php
                                        if (@$CustomerName == $rowCustomerName['CustomerID']) {
                                            echo "selected";
                                        }
                                        ?>><?= $rowCustomerName['FirstName'] . ' ' . $rowCustomerName['LastName'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <div class="text-danger"><?= @$messages['error_Customer'] ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="VehicleNo" class="form-label">Vehicle No :<span style='color: red'>*</span></label>
                            <select id='VehicleNo' for="VehicleNo" name="VehicleNo" class="form-select" aria-label="Default select example">
                                <option value=''></option>

                            </select>
                            <div class="text-danger"><?= @$messages['error_Vehcile_No'] ?></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Millege" class="form-label">Millage (KM.)<span style='color: red'>*</span></label>
                        <input type="number" class="form-control" id="Millege" name="Millege" min='0' placeholder="Enter Millege">
                        <div class="text-danger"><?= @$messages['error_Millege'] ?></div>
                    </div>
                </section>

                <div class="container m-1">
                    <table class="table m-1">
                        <thead>
                            <tr style="background-color: #d2d2d2">
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col" style="background-color:#48da3a;">Good</th>
                                <th scope="col" style="background-color:#ff5858;">Bad</th>
                                <th scope="col" style="background-color:#ff9c6b;">Need To Replace</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbconn();
                            $sqlEngine = "SELECT * FROM inspectionitems WHERE InsItemStatus=1";
                            $resultEngine = $db->query($sqlEngine);
                            ?>
                            <?php
                            if ($resultEngine->num_rows > 0) {
                                $n = 1;
                                while ($rowengineItems = $resultEngine->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td style="background-color: #d2d2d2"><?= $n ?></td>
                                        <td><?= $rowengineItems['InsItemName'] ?></td>
                                        <td style="background-color:#48da3a;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-<?= $rowengineItems['InspectionItemId'] ?>" id="Good" value="1">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff5858;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-<?= $rowengineItems['InspectionItemId'] ?>" id="Bad" value="2">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="background-color:#ff9c6b;">
                                            <label class="form-check-custom danger">
                                                <input type="radio" name="radio-<?= $rowengineItems['InspectionItemId'] ?>" id="NeedToReplace" value="3">
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <label for="inspectionNotes" class="form-label">Special Notes</label>
                        <textarea class="form-control" id="inspectionNotes" rows="3" name="inspectionNotes"></textarea>
                        <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                    </div>
                </div>
                            <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
            </div>
            <div class="card-footer">

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
<script>
    function loadCustomerName() {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CustomerName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadCustomers.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#VehicleNo').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
//    $(document).ready(function(){
//    $('#CategoryName').on('change', function(){
//    var CategoryId = $(this).val();
//            console.log('CategoryId');
//            if (CategoryId){
//    $.ajax({
//    type:'POST',
//            url:'loadProducts.php',
//            data:'CatergoryID=' + CategoryId,
//            success:function(html){
//            $('#ProductName').html(html);
//            }
//    });
//    });
//    }};
</script>

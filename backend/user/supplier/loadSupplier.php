<?php


include '../../config.php';
include '../../function.php';
extract($_POST);
echo $suppId = $_POST["options"];



if (!empty($suppId)) {
    $db = dbConn();
    $sql = "SELECT sc.SupCatId,s.SupplierName,s.ContactNo,s.email,s.Status,cat.CatergoryName FROM suppliercatergories sc "
                        . "LEFT JOIN supplier s ON sc.SupplierId=s.SupplierId "
                        . "LEFT JOIN catergories cat ON sc.CatergoryId=cat.CatergoryID WHERE sc.SupCatId='$suppId';";
    
    $result = $db->query($sql);
    

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
       return $result;
    } else {
        echo '<option value="">District Not Selected</option>';
    }
}

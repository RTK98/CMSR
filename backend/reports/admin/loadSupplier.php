<?php

include '../../config.php';
include '../../function.php';
extract($_POST);
echo $suppId = $_POST["options"];

if (!empty($suppId)) {
    $db = dbConn();
    $sql = "SELECT sc.SupCatId,s.SupplierName,s.ContactNo,s.email,s.Status,cat.CatergoryName FROM suppliercatergories sc "
            . "LEFT JOIN supplier s ON sc.SupplierId=s.SupplierId "
            . "LEFT JOIN catergories cat ON sc.CatergoryId=cat.CatergoryID WHERE sc.SupplierId ='$suppId';";

    $sql2 = "SELECT cat.CatergoryID,cat.CatergoryName FROM  suppliercatergories sc INNER JOIN catergories cat ON sc.CatergoryId = cat.CatergoryID WHERE sc.SupplierId ='$suppId';";

    $result = $db->query($sql2);
//    $row = $result->fetch_assoc();
    // Generate HTML of state options list 
    if($result->num_rows>0){
    while ($row = $result->fetch_assoc()){
        ?>
        <tr>
             <td><?= $row['CatergoryID'] ?></td>
            <td><?= $row['CatergoryName'] ?></td>
        </tr>
   
    <?php
    }
}
}

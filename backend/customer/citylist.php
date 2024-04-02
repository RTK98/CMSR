<?php
include '../config.php';
include '../function.php';
extract($_POST);
$db= dbConn();
$sql="SELECT * FROM tbl_city WHERE DistrictCode='$district'";
$result=$db->query($sql);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>City Name</th>
        </tr>
    </thead>
    <tbody>
<?php

if($result->num_rows>0){
    while ($row=$result->fetch_assoc()){
        ?>
        <tr>
            <td><?= $row['City'] ?></td>
        </tr>
   
    <?php
    }
}


?>
</tbody>
</table>

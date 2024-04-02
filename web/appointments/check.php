<?php
include '../config.php';
include '../function.php';
extract($_POST);

$db = dbConn();
$sql = "Select * from tbl_products where categoryid='$pCategory'";
$result = $db->query($sql);
?>


<div class="mb-3">
    <label>Select Name</label>
    <select id="product_name" name="pName" class="form-control" >
        <option value="">--</option>
        <?php
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                ?>

                <option value="<?= $row['productnameid'] ?>" <?php
                if (@$pName == $row['productnameid']) {
                    echo "selected";
                }
                ?> ><?php echo $namezz = $row['ProductName'] ?></option>
                        <?php
                    }
                }
                ?>
    </select>
</div>


<?php
?>

<?php
include '../config.php';
include '../function.php';
extract($_POST);
$db = dbConn();
$sql = "SELECT * FROM`repaircatergory` WHERE RepairId=";
$result = $db->query($sql);
?>

<label>Select City</label>
<select id="repair" name="repair">
    <option value="">--</option>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <option value="<?= $row['RepairId'] ?>"><?= $row['RepairName'] ?><?= $row['RepairPrice'] ?></option>
            <?php
        }
    }
    ?>
</select>
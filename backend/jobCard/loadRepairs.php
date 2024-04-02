<?php

include '../config.php';
include '../function.php';
if (isset($_POST["query"])) {
    extract($_POST);

    $output = '';
    $db = dbConn();
    $sql = "SELECT * FROM`repaircatergory` WHERE RepairName LIKE '%" . $_POST["query"] . "%'";
    $result = $db->query($sql);
    $output = '<ul class="list-unstyled" id="mylist">';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<li id="'.$row["RepairId"].'">' . $row["RepairName"] . '</li>';
        }
    } else {
        $output .= '<li>RepairName Not Found</li>';
    }
    $output .= '</ul>';
    echo $output;
}

if (isset($_POST["search"])) {
    extract($_POST);
    $db=dbConn();
          $sql="SELECT * FROM repaircatergory WHERE RepairId = ".$_POST['search'];
//          print_r($sql);
          $result=$db->query($sql);
          $row = $result->fetch_assoc();
    echo json_encode($row);
}


if (isset($_POST["stock"])) {
    extract($_POST);
    $db=dbConn();
    $sql="SELECT * FROM stock INNER JOIN products ON products.ProductId = stock.ProductId WHERE stock.id = ".$_POST['stock'];
//          print_r($sql);
    $result=$db->query($sql);
    $row = $result->fetch_assoc();
      echo json_encode($row);
}

?>

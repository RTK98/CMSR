<?php

//Sample Qr Generate code
//QR_PATH variable for - QR file storing path
$qr_path = 'assets/qr/';
include "assets/phpqrcode/phpqrcode/qrlib.php";
if (!file_exists($qr_path))
    mkdir($qr_path);
//correction level L=Low , H=High
$errorCorrectionLevel = "L";
$matrixPointSize = 4;

$data = 88888;
$filename = $qr_path . 'appointments' . md5($data . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
//QR Code generating
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
//$qrcode - new QRcode();
//$qrcode->png();
//display generated file
echo'<img src="'.$qr_path.basename($filename).'"/>';
?>




<td>
                                <?php if ($row['UserRole'] == 'admin') { ?> 

                                    <form method='post' action="viewEmpDetails.php">
                                        <input type="text" name="UserId" value="<?= $row['UserRole'] ?>">
                                        <button type="submit"  class="btn btn-warning" name="action" value="edit" disabled>Edit</button>
                                    </form>
                                    <form method='post' action="delete.php">
                                        <input type="text" name="UserId" value="<?= $row['UserRole'] ?>">
                                        <button type="submit" class="btn btn-danger" name="action" value="delete" disabled>Delete</button>
                                    </form>
                                <?php} else { ?>
                                    <form method='post' action="viewEmpDetails.php">
                                        <input type="text" name="UserId" value="<?= $row['UserRole']?>">
                                        <button type="submit"  class="btn btn-warning" name="action" value="edit">Edit</button>
                                    </form>
                                    <form method='post' action="delete.php">
                                        <input type="text" name="UserId" value="<?= $row['UserRole'] ?>">
                                        <button type="submit" class="btn btn-danger" name="action" value="delete" >Delete</button>
                                    </form>
                                    <?php
                                }
                                ?>

                            </td>
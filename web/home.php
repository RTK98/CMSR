<?php
ob_start();
date_default_timezone_set("Asia/Colombo");
?>

<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                extract($_POST);
                $messages = array();
                echo $AppDate;

                if ($AppDate == null) {
                    $messages['error_service_closed'] = "Please Select the date!";
                } else {

                    $db = dbConn();
                    $holidaysql = "SELECT * FROM `holidays` WHERE HolidayDate = '$AppDate' AND HolidayStatus='1' ;";
                    $result = $db->query($holidaysql);
                    if ($result->num_rows > 0) {
                        $messages['error_service_closed'] = "Selected date is a holiday";
                    } else {
                        //getting the current date for validation
                        $currentdate = date('Y-m-d');
                        $timestampcurrent = strtotime($currentdate);
                        $timestampcurrentz = date('Ymd', $timestampcurrent);
                        $timestamp = date('H');
                        $today = date('Y-m-d');

                        if ($AppDate == $today) {
                            if ($timestamp >= 16) {
                                $messages['error_service_closed'] = "We are goning to Closed Now!";
                            } else {
                                echo 'Closed';
                            }
                        }
                        $time;

                        // assigning the requesting date to a variable for further validation
                        $AppDatez = $AppDate;

                        $timestamp = strtotime($AppDatez);
                        $timestamprequest = date('Ymd', $timestamp);

                        if ($timestampcurrentz > $timestamprequest) {
                            $messages['error_Appointment_TimeSlot'] = "Cannot select the back dates!";
                        }

                        $dayNumber = date('N', strtotime($AppDate));

                        if ($dayNumber === '7') {
                            $messages['error_cloesd_suday'] = "We are Closed";
                        }
                        if (empty($messages)) {

                            header("Location:appointments/viewAppointment.php?date=$AppDate ");
                        }
                    }
                }
            }
            ?>

            <h1 class="slide-left">KEEP YOUR <br> AUTO MOVING </h1>
            <p class="slide-left"> Maintain a smooth and efficient ride with our expert help. Take care of your car, keep it in motion, and worry-free. 
                Our services ensure your vehicle stays in great condition, 
                so you can drive without a hitch. 
                Join us today for a hassle-free driving experience!</p>

            <?php if (!isset($_SESSION['CustomerID'])) { ?>
                <div class="links slide-left">
                    <a href="customer/addCustomer.php" class="btn reg-btn">Become a Registerd Member</a>
                </div><?php }
            ?>

            <div class="links slide-right">
                <img src="">
            </div>
        </div>
        <div class="col-lg-6 text-sm-start appointment-form">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" id="form">
                <div class="md-4 row text-start">
                    <div class="col-md-6">
                        <?php
                        $maxDate = date("Y-m-d", strtotime("+7 days"));
                        ?>
                        <input type="date" name="AppDate" value="<?= @$AppDate ?>" min="<?= date('Y-m-d') ?>" max="<?= $maxDate ?>">

                    </div>
                    <div class="col-md-6 " style="padding-right: 10px;padding-bottom: 5px; padding-left: 30px; padding-top:5px;">
                        <button type="submit" class="btn btn-primary btn-sm text-end search-btn" name="action" value="appointment"">Search Appointment</button>
                    </div>
                </div>
                <div class="text-danger bg-light home-error-msg"><?= @$messages['error_service_closed']; ?></div>
                <div class="text-danger bg-light home-error-msg"><?= @$messages['error_cloesd_suday']; ?></div>
                <div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--belows this div ending tag closing tag applied to finsh that image showing and header thing to stop-->
</div>

<?php
$sql = "SELECT * FROM frequentasked WHERE status='1'";
$db = dbConn();
$result = $db->query($sql);
?>

<!-- ======= F.A.Q Section ======= -->
<style>
    .faq-item {
        border-top-left-radius: 15px;
        margin-bottom: 20px;
        padding: 22px 15px;
        background-color: #f9f9f9;
        box-shadow: 0 0 32px -17px black;
        transition: 500ms;
        border-left: 4px solid blue;
    }
    .faq-item:hover{
        transition: 800ms;
        transform: scale(1.02);
        border-left: 0px solid blue;
        border-right: 4px solid blue;
    }

    .faq-item i {
        font-size: 24px;
        margin-right: 10px;
        color: #007bff; /* Change the color to your preference */
    }

    .faq-item h4 {
        font-family: 'Noto Sans', sans-serif;
        font-size: 21px;
        margin: 5px 0;
        color: #68a0ff;
        line-height: 29px;
    }

    .faq-item h6 {
        color: #333;
        line-height: 27px;
    }
    .home-faq{
        background: aliceblue;
        padding: 25px 0px;
    }
    .home-faq h2{
        letter-spacing: 2px;
        padding-bottom: 17px;
        font-size: 36px;
        font-weight: 500;
    }
</style>
<section class="container-fluid home-faq" >
    <div class="container">
        <div class="row">
            <div>
                <h2 >Frequently Asked Questions</h2>
            </div>
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="faq-item">
                        <div>

                            <h4><?= ucwords($row['questionname']) ?></h4>
                        </div>
                        <div>
                            <h6><?= ucwords($row['questionanswer']) ?></h6>
                        </div>
                    </div><!-- End F.A.Q Item-->
                    <?php
                    $i++;
                }
            }
            ?>

        </div>
    </div>
</section><!-- End F.A.Q Section -->


<?php
ob_flush();
?>
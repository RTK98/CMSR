<?php
ob_start();
date_default_timezone_set("Asia/Colombo");
include'footer.php'
?>
<div class="content">
    <div class="row">
        <div class="col">
            <?php
//        print_r($_POST);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                extract($_POST);
                $messages = array();
                echo $AppDate;
                "<br>";
                //getting the current date for validation
                $currentdate = date('Y-m-d');
                $timestampcurrent = strtotime($currentdate);
                $timestampcurrentz = date('Ymd', $timestampcurrent);
                "<br>";
                //IST time
//                echo $currenttime = time();
                '<br>';
//                $time = "15:30";
                echo $timestamp = date('H');
                if ($timestamp <= 16) {
                    echo 'Show Time';
                } else {
                    echo 'Closed';
                }
//$timeFormatted = date("H:i", $timestamp);
                // New Time Validation Pasan
//                echo $timestamp; // Output: 15:30
//                echo "<br>";
//
//                $time2 = date("H:i");
//                echo $timestamp2 = strtotime($time2);
//
//                if ($time < $time2) {
//                    echo "business houes are closed";
//                } else {
//                    echo "we are open ";
//                }
//End Time Validation
                '<br>';

                if ($currentdate == $AppDate) {
                    if ($time > $time2) {
                        $messages['error_Appointment_TimeSlot'] = "We are gonna closed can not book now";
                    } else {
                        
                    }
                }

                echo '<br>';
//                if ($time > $time2) {
//                        $messages['error_Appointment_TimeSlot'] = "We are gonna closed can not book now";
//                    } else {
//                        
//                    }
//             
//                if ($currentdate == $AppDate) {
//                    if ($time > $time2) {
//                        $messages['error_Appointment_TimeSlot'] = "We are gonna closed can not book now";
//                    } else {
//                        
//                    }
//                }

                echo '<br>';
                $time;
                "<br>";

                // assigning the requesting date to a variable for further validation
                "<br>";
                $AppDatez = $AppDate;
                "<br>";

                $timestamp = strtotime($AppDatez);
                $timestamprequest = date('Ymd', $timestamp);

                if ($timestampcurrentz > $timestamprequest) {
                    $messages['error_Appointment_TimeSlot'] = "Cannot select the back dates!";
                }



                if (empty($messages)) {

                    header("Location:appointments/viewAppointment.php?date=$AppDate ");
                }
            }
            ?>
            <div class="col-md-4 text-sm-start">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" id="form">
                    <div class="md-3 row text-start">
                        <div class="col-md-6">
                            <?php
                            $maxDate = date("Y-m-d", strtotime("+5 days"));
                            ?>
                            <input type="date" name="AppDate" value="<?= @$AppDate ?>" min="<?= date('Y-m-d') ?>" max="<?= $maxDate ?>">

                        </div>
                        <div class="col-md-6 " style="padding-right: 10px;padding-bottom: 5px; padding-left: 30px; padding-top:5px;">
                            <button type="submit" class="btn btn-primary btn-sm text-end" name="action" value="appointment"">Search Appointment</button>
                        </div>
                    </div>
                    <div class="text-danger bg-light"><?= @$messages['error_Appointment_TimeSlot']; ?></div>
                    <div>
                    </div>
                </form>
            </div>
            <h1 class="slide-left">KEEP YOUR <br> AUTO MOVING </h1>
            <p class="slide-left"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et
                dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat.</p>
            <div class="links slide-left">
                <a href="customer/addCustomer.php" class="btn">Become a Registerd Member</a>
            </div>
            <div class="links slide-right">
                <img src="">
            </div>
        </div>
    </div>
    <script>
        var holidays = ["06/22/2023"];
        $("#from").datepicker({
            beforeShowDay: function (date) {
                var datestring = jQuery.datepicker.formatDate('mm/dd/yyyy', date);
                return [holidays.indexOf(datestring) == -1]
            }
        });
    </script>
    <?php ob_flush(); ?>
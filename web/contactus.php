<?php
$Contact = 'active';
include 'header.php';
include 'menu.php';
?>
<?php
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    $name = inputTrim($name);
    $email = inputTrim($email);
    $mobile = inputTrim($mobile);
    $subject = inputTrim($subject);
    $message = inputTrim($message);

    //create array variable store validation messages
    $messages = array();

    //validate required fields
    if (empty($name)) {
        $messages['error_name'] = "The Name should not be empty..!";
    }

    if (empty($email)) {
        $messages['error_email'] = "The email should not be empty..!";
    }
    if (empty($mobile)) {
        $messages['error_mobile'] = "The Mobile Category should not be empty..!";
    }

    if (empty($subject)) {
        $messages['error_subject'] = "The Subject qty should not be empty..!";
    }

    if (empty($message)) {
        $messages['error_message'] = "The Message should not be empty..!";
    }

    if (empty($messages)) {

        $db = dbConn();
        $adddate = date('Y-m-d');
        $status = 0;
        $sql = "INSERT INTO tblcontactus(customername, customeremail, customernumber,subject, customermatter, adddate, status) VALUES ('$name','$email','$mobile','$subject','$message','$adddate','$status')";
        $results = $db->query($sql);
//         echo "<script>
//        Swal.fire({
//            title: 'Success!',
//            text: 'YOur message has been sent !.',
//            icon: 'success',
//            confirmButtonText: 'OK'
//        }).then(() => {
//            window.location.href = 'http://localhost/cmsr/web/contactus.php'; // Redirect to success page
//        });
//    </script>";
    }

}
?>
</div>
<br><br>
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container-fluid">
        <div class="container">
            <div class="section-title" >
                <h2>Contact Us</h2>
            </div>
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-about">
                        <!--                        <h3>Location</h3>-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15844.996836616063!2d79.9725021!3d6.8607078!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2510653645ae9%3A0x74945f0767960696!2sReplica%20Speed%20Motor%20Garage!5e0!3m2!1sen!2slk!4v1691065644679!5m2!1sen!2slk" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="info">
                        <div>
                            <i class="ri-map-pin-line"></i>
                            <p>136/1/A ,  Horahena Rd,<br> Pannipitiya</p>
                        </div>

                        <div>
                            <i class="ri-mail-send-line"></i>
                            <p>info@blutechelectronics.com</p>
                        </div>

                        <div>
                            <i class="ri-phone-line"></i>
                            <p>077 920 0480</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="200">

                    <form method="post" action="contactus.php"  >
                        <div class="form-group p-3">

                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" >
                            <div class="text-danger"> <?= @$messages['error_name']; ?></div>
                        </div>
                        <div class="form-group p-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" >
                            <div class="text-danger"> <?= @$messages['error_email']; ?></div>
                        </div>

                        <div class="form-group p-3">
                            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Your Number" >
                            <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                        </div>

                        <div class="form-group p-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" >
                            <div class="text-danger"> <?= @$messages['error_subject']; ?></div>
                        </div>
                        <div class="form-group p-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" ></textarea>
                            <div class="text-danger"> <?= @$messages['error_message']; ?></div>
                        </div>

                        <div class="form-group p-3 text-right">
                            <button class="btn-send"  type="submit" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Contact Section -->
<?php include 'footer.php'; ?>
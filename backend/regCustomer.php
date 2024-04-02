<?php
include 'assets/phpmail/mail.php';

$to="rajindratharindu@gmail.com";
$toname="Rajindra Tharindu";
$subject="Registerd as Customer";
$body="<img src='assets\img\logo.png'>You are successfully registered with our system";
$altbody="You are successfully registered with our system";

send_email($to,$toname,$subject,$body,$altbody);

?>
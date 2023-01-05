<?php

$headers = "From: no-reply@heytuts.com\r\n";
$to = "shafia@netquall.com";
$subject = "Sending a basic email with php";
$message = "Checkout this super simple script to send a basic text email!";

if ( mail($to, $subject, $message, $headers) )
    echo 'Success!';
else
    echo 'UNSUCCESSFUL...';

    ?>
<?php

		$to   = 'sidlamini15@alustudent.com';
        $from = 'sidlamini15@alustudent.com';

        $subject = "Oui Deliver: Verify your account."; 

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body><br><br>';
        $message .= '<img src="img/Truck.png" style="height: 10vh;margin: 0;position: absolute;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);"><br><br>'; 
        $message .= '<h1 style="text-align: center; font-family: Avenir">Hi, Sisekelo. Welcome to Oui Deliver.</h1> <br>';
        $message .= '<h2 style="text-align: center; font-family: Avenir">Let us verify your account.</h2><br>';
        $message .= '<p style="text-align: center; font-family: Avenir"> Please click on link below to verify your account.</p><br>';
        $message .= '<p style="text-align: center;font-family: Avenir;border: 1px solid blue;background: #04b4aa;padding: 5%;text-decoration: none;color: black;font-size: 150%;margin: 0;"><a href="" style="text-decoration: none; color: black;padding: 5%">Verify me please!</a></p>";
        $message .= "</body></html>';

        mail($to, $subject, $message, $headers);

?>
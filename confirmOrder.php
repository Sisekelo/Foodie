<?php
session_start();
ob_start();
require 'db.php';

$number= $_GET["number"];
$id = $_GET["id"];
$free = $_GET["free"];

//check Id

$queryCheck = "SELECT Confirm from sales where id='$id'";

$check = $mysqli->query($queryCheck) or die($mysqli->error());


$checkFetch = $check->fetch_assoc();

        
$checkFinal = $checkFetch['Confirm'];



if($checkFinal == 1){
    $_SESSION['emoji'] = "&#x1F625;";
        $_SESSION['message'] = "This order has already been confirmed";
        header("location: notification.php");
    
}
else{

$received = "UPDATE sales SET Confirm='1' WHERE id='$id'";
$payer = "UPDATE sales SET Free='$free' WHERE id='$id'";

$mysqli->query($payer) or die($mysqli->error());

$mysqli->query($received) or die($mysqli->error());


include ( "Nexmo-PHP-lib-master/NexmoMessage.php" ); 
$conmessage = 'Your order has just been confirmed. It is coming soon ;) Home: http://ouideliver.xyz/index.php';
// Step 1: Declare new NexmoMessage.
$nexmo_sms = new NexmoMessage('d6726b9a', '005e2f3453ccb56c');
// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
$info = $nexmo_sms->sendText( $number, 'MyApp',$conmessage);

    $_SESSION['emoji'] = "&#x1F60A;";
    $_SESSION['message'] = "Order confirmed";
    header("location: notification.php");
}
?>
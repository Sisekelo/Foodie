<?php
ob_start();
session_start();
require 'db.php';

    $first_name = $_SESSION['first_name'];
    $room = $_SESSION['room'];

    $_SESSION['meal'] = $_POST['meal'];
    $_SESSION['flavour'] = $_POST['flavour'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['Drink'] = $_POST['drink'];

    $meal = $_SESSION['meal'];
    $flavour = $_SESSION['flavour'];
    $price = $_SESSION['price'];
    $Drink = $_SESSION['Drink'];
    $number = $_SESSION['number'];
    
    
    //check if this person has ordered before
    
    $first = $mysqli->query("SELECT * FROM sales WHERE number='$number'") or die($mysqli->error());
    
    if($first->num_rows == 0){
        $referal = $mysqli->query("SELECT Referer FROM details WHERE number='$number'") or die($mysqli->error());
        
         $user = $referal->fetch_assoc();
        
        $emailReferer = $user['Referer'];
        
        if($emailReferer != ""){
             $givepoints =$mysqli->query("UPDATE details SET Points=Points+2 WHERE email='$emailReferer'") or die($mysqli->error());
        }
    }
    
    //check if the person has 10 or more points
    
    $pointsCheck = $mysqli->query("SELECT Points FROM details WHERE number='$number'") or die($mysqli->error());
    
    $points = $pointsCheck->fetch_assoc();
    
    $TotalPoints = $points['Points'];
    
    if($TotalPoints >= 10 ){
         $givepoints =$mysqli->query("UPDATE details SET Points=Points-10 WHERE number='$number'") or die($mysqli->error());
        $_SESSION['emoji'] = "&#x1F603;";
        $_SESSION['message'] = "Great News, ".$first_name.".YOUR MEAL IS FREE.Please wait for confirmation SMS";
        $free = "yes";
    }
    else{
        $_SESSION['emoji'] = "&#x1F603;";
        $_SESSION['message'] = "Your order has been taken, ".$first_name.".Please wait for confirmation SMS";
        $free = "no";
    }
    
    $sql = "INSERT INTO sales (name,number,room,Meal,flavour,Price,Drink,Date,Time)
            VALUES ('$first_name','$number','$room','$meal','$flavour','$price','$Drink',curdate(),curtime())";

    if ($mysqli->query($sql) === TRUE) {

     $last_id = $mysqli->insert_id;
        echo $last_id;

        include ( "Nexmo-PHP-lib-master/NexmoMessage.php" );
        $link = 'http://ouideliver.xyz/confirmOrder.php?number='.$number.'&id='.$last_id.'&free='.$free;
        // Step 1: Declare new NexmoMessage.
        $nexmo_sms = new NexmoMessage('d6726b9a', '005e2f3453ccb56c');
        // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
        $info = $nexmo_sms->sendText( +27629286975, 'MyApp',$link);
        header("location: notification.php");

    } 
    else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
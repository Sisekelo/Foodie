    <?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
// Set session variables to be used on profile.php page

if( isset($_POST['referer']) AND !empty($_POST['referer']) ): 
        $refer= $_POST['referer'];    
    else:
        $refer= "";
        endif;
        
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['number'] = $_POST['cellnumber'];
$_SESSION['picURL'] = $_POST['picURL'];
$_SESSION['room'] = $_POST['room'];
$_SESSION['referer'] = $_POST['referer'];
$_SESSION['residence'] = $_POST['residence'];



// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$number = $mysqli->escape_string($_POST['cellnumber']);
$picURL = $mysqli->escape_string($_POST['picURL']);
$room = $mysqli->escape_string($_POST['room']);
$referer = $mysqli->escape_string($_POST['referer']);
$residence = $mysqli->escape_string($_POST['residence']);

/*if (strpos($email, 'alustudent') === false) {
    $_SESSION['message'] = 'We are open to ALU students only for now';
    header("location: notification.php"); 
}*/

      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM details WHERE email='$email' OR number = '$number'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['emoji'] = "&#x1F625;";
    $_SESSION['message'] = 'User with this number already exists!';
    header("location: notification.php"); 
}
else { // Email doesnt already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here
     $sql = "INSERT INTO details (name,surname,email,number,picture,RoomNumber,Referer)
            VALUES ('$first_name','$last_name','$email','$number','$picURL','$room $residence','$referer')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['Active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message! \n Check your spam to make sure email has arrived";
                 $_SESSION['superURL'] = 'https://ouideliver.xyz/Foodie/verify.php?email='.$email;

                 //send a text message

                  // Send registration confirmation link (verify.php)

     $thanks = 'https://ouideliver.xyz/Foodie/verify.php?email='.$email;
     $done = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $thanks);

    include ( "Nexmo-PHP-lib-master/NexmoMessage.php" );  
    // Step 1: Declare new NexmoMessage.
    $nexmo_sms = new NexmoMessage('d6726b9a', '005e2f3453ccb56c');
    // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
    $info = $nexmo_sms->sendText( $number, 'MyApp',''.$thanks);


    //send email

        $to   = $email;
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
        $message .= '<p style="text-align: center;font-family: Avenir;border: 1px solid blue;background: #04b4aa;padding: 5%;text-decoration: none;color: black;font-size: 150%;margin: 0;"><a href="'.$thanks.'" style="text-decoration: none; color: black;padding: 5%">Click here to verify account</a></p>"';
        $message .= "</body></html>'";

        mail($to, $subject, $message, $headers);

    header("location: profile.php");
    }
    else {
        $_SESSION['emoji'] = "&#x1F625;";
        $_SESSION['message'] = 'Registration failed!';
       header("location: error.php");
    }
}

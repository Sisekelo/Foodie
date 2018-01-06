<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
require 'db.php';
session_start();

// Make sure email aren't empty
if(isset($_GET['email']) && !empty($_GET['email']))
{
    $email = $mysqli->escape_string($_GET['email']); 
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM details WHERE email='$email' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        header("location: notification.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";
        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE details SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        header("location: index.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: notification.php");
}     
?>
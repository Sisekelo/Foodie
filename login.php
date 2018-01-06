<?php
ob_start();
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM details WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist

    $_SESSION['email'] = $email;
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['surname'] = $_POST['surname1'];
    $_SESSION['picture'] = $_POST['picNew'];
    $_SESSION['referer'] = $_POST['referer'];
    $_SESSION['message'] = "Do you want to register for Oui Eat?";
    header("location: registering.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ($_POST['email'] ==$user['email']){
        
        $_SESSION['first_name'] = $user['name'];
        $_SESSION['last_name'] = $user['surname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['number'] = $user['number'];
        $_SESSION['meal_choice'] = $user['meal_choice'];
        $_SESSION['picURL'] = $user['picture'];
        $_SESSION['room'] = $user['RoomNumber'];
        $_SESSION['Active'] = $user['Active'];
        $_SESSION['points'] = $user['Points'];
        $_SESSION['message'] = "Let's eat, fam :)";
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        header("location: profile.php");
    }
    else {
        $_SESSION['emoji'] = "&#x1F625;";
        $_SESSION['message'] = "You are not registered yet";
        header("location: notification.php");
    }
}


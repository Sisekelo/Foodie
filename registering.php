<?php
/* Displays user information and some useful messages */
session_start();
    // Makes it easier to read
    $email = $_SESSION['email'];
    $first_name = $_SESSION['firstname'];
    $surname = $_SESSION['surname'];
    $picture = $_SESSION['picture'];
    $referer =  $_SESSION['referer'];

    if(!isset($email)){
      header("location: index.php");
    };
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="img/truck.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome <?= $first_name ?></title>
  <?php include 'css/css.html'; ?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in
        require 'login.php';
    }
    
    elseif (isset($_POST['register'])) { //user registering
        require 'register.php';
    }
}
?>
</head>

<body>
 <div class="wrapper" style="overflow: scroll">
  <div class="container">
    <img src="<?= $picture ?>" id="profile">
    <h1>Please give us some more info, <?= $first_name ?>  </h1>

    <form action="index.php" method="post" class="form" id="registerform">

           <div id="else">
            <input type="text" required name='firstname' placeholder="First name" value="<?= $first_name?>"  />
              <input type="text" required name='lastname' placeholder="Last Name" value="<?= $surname ?>" style="display: none" />
              <input type="text" name='referer' placeholder="referer" value="<?= $referer ?>" style="display: none" />
            <input type="email" required autocomplete="off" name='email' placeholder="Email" value="<?= $email ?>" style="display: none" />
            <input  type="tel" id="number" pattern="[+]{1}[0-9]{11}" name="cellnumber" title="Please use your number starting with '+230' " onblur="FixNumber()" placeholder ="+XXXXXXXXXXX" required>
            <input type="text" autocomplete="off" name='room' placeholder="room number" style="display: none"  />
            <input type="text" class="form-control"  style="display: none" required autocomplete="off" name='picURL' placeholder="pictureURL" value="<?= $picture ?>" /> 
            </div>

          <button id="submitregisterbutton" type="submit" class="button button-block" name="register" >Register</button>
          </form>
  </div>
<ul class="bg-bubbles">
    <li style="font-size: 30px">&#x1F601;</li>
    <li style="font-size: 40px">&#x1F604;</li>
    <li style="font-size: 40px">&#x1F614;</li>
    <li style="font-size: 30px">&#x1F611;</li>
    <li style="font-size: 40px">&#x1F644;</li>
  </ul>
</div>
    
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js?v2"></script>

</body>
</html>

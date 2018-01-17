<?php
ob_start();
include('db.php');
/* Displays user information and some useful messages */
session_start();
$message = $_SESSION['message'];
$active =  $_SESSION['Active'];
$number = $_SESSION['number'];

date_default_timezone_set('Africa/Mbabane');
$date = date('H:i:s');

//make sure shop opens and closes at exact times
if("00:00:00" <= $date && $date < "23:59:59"){
// Check if user is logged in using the session variable
    if($active == 0){

    $_SESSION['emoji'] = "&#x1F60A;";
    $_SESSION['message'] = "A link has been sent to ".$number.".\n Please click on link to confirm your number";
    header("location: notification.php");  
  }

  if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['emoji'] = "&#x1F625;";
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: notification.php");    
  }
  else {
      // Makes it easier to read
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];
      $email = $_SESSION['email'];
      $number = $_SESSION['number'];
      $meal_choice = $_SESSION['meal_choice'];
      $picURL =  $_SESSION['picURL'];
      $room = $_SESSION['room'];
      $active = $_SESSION['Active'];
      $points = $_SESSION['points'];

      //check how many orders this person has done
      $result = $mysqli ->query("SELECT count(*) FROM  Orders2 WHERE Buyer_Number=$number") or die($mysqli->error());
      $result1 = $result->fetch_assoc();     
      $result2 = $result1['count(*)'];

      //checks how many new people this person has referred
      $share = $mysqli ->query("SELECT count(*) FROM details where Referer ='$email' ") or die($mysqli->error());
      $share1 = $share->fetch_assoc();
      $share2 = $share1['count(*)'];
      
  };
}
else{
  $_SESSION['emoji'] = "&#x1F625;";
  $_SESSION['message'] = "Sorry we are closed for now. \n our opening times are from \n 6 am to midnight SA time";
  header("location: notification.php");    
};
?>
<!DOCTYPE html>
<html style="background: #04b4aa">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <!-- Bootstrap -->
    <script type="text/javascript"> /*Loader*/
      $(window).load(function() {
          $(".loader").fadeOut("slow");
      });
    </script>

    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a2452f631a40500136712dd&product=sticky-share-buttons"></script> <!-- sharing button plugin -->
  
    <link rel="shortcut icon" type="image/png" href="img/truck.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome, <?= $first_name ?></title>
    <?php include 'css/true.html'; ?>
</head>

<div class="loader"><p></p>
   </div>

<body> 

  <div id="first" class="mega" id="first" class="mega">
    <div id="mainbackground" style="background: #04c8ba">
      <div id="mainPage">
        <div id="message">
            
        <div class="sidebar" style="height: 100vh;z-index: 10000;background: #04b4aa">
          <div class="cancel" style="z-index: 10000" onclick="cancel(this.className)">✕</div>

          <div id="picInfo" style="height: 20%" class="center">
            <img style="height: 50%; float: left;position: absolute;top: 25%; left: 5%;-ms-transform: translate(-50%, -50%); " src="<?=$picURL?>">

            <p style="display: inline-block; font-family: Avenir; font-size: 100%;">Hi,<?= $first_name ?><br><?= $points ?> Points || <?= $result2 ?> Orders || <?=$share2?> Referals</p>
          </div>

          <hr width="70%" style="color: black">

           <ul id="list">
              <li><a href="#" onclick="changeClass2()" style="cursor: pointer;">Free Meals</a></li>
              <li><a href="pastOrders.php?number=<?=$number?>&name=<?=$first_name?>">Past Orders</a></li>
              <li><a href="SoftwareChallenge3.html">Contact Us</a></li>
              <!-- <li ><a id = "contactProf" onClick="contactUs()">Log Out</a></li> -->
            </ul>
        </div>

        <div class="sharebar" style="height: 100vh;z-index: 10000;background: #04b4aa">

          <div style="height: 10vh" id="topTitle" class="center">
            <h2>Share to get a discount</h2>
            <div class="cancel" style="z-index: 10000" onclick="cancel2(this.className)">✕</div>
          </div>

          <div style="height: 30vh;background: url(img/girls.jpg) no-repeat center center; " class="center">
            <h2 id="pointsTeller">You currently have <?= $points ?> points</h2>
          </div>
          <div style="height: 50vh;"  class="center">
            <h2 style="font-size: 170%">10 points = 50Rps off your next meal 
              <br><br>
              Share and get 1 point for every friend that registers
              <br><br>
              <span style="font-style: italic; font-size: 70%">Also get 1 point every time you order with Oui Deliver</span>
            </h2> 
          </div>
          <div style="height: 10vh;background: #267DDD" class="center">
            <div style="overflow: auto" 
                        data-description="Hey there, register for Oui Deliver and get food delivered to your door step"
                        data-url="https://ouideliver.xyz/Foodie/index.php?refer=<?= $email ?>" class="sharethis-inline-share-buttons">
                    </div>Share
          </div>
        </div>

 
        <div id="Messages1" class="center">
            <span class="toggle" onclick="changeClass()" style="margin-left: 2%;font-size: 30px;float: left">☰</span>

            <p style="margin: 0" id="top">
                <?= $message ?>
            </p>
        </div>

        <div id="Usuals" class="center">
          <img src="img/truck.png" id="mainlogo">
        </div>    

        <div  id="Messages2" class="center">
          <!-- <p><strong id="top2">Click below to order</strong></p> -->
        </div>

        </div>

        <a class="typeform-share button" href="https://microtising.typeform.com/to/GQ2uIQ?number=<?= $number ?>&name=<?=$first_name?>&room=<?=$room?>" data-mode="popup" style="display:inline-block;text-decoration:none;background-color:#267DDD;color:white;cursor:pointer;font-family:Helvetica,Arial,sans-serif;font-size:22px;line-height:55px;text-align:center;margin:0;height:55px;padding:0px 36px;border-radius:27px;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:bold;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;" data-hide-headers=true data-hide-footer=true target="_blank">Order Here </a> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm_share", b="https://embed.typeform.com/"; if(!gi.call(d,id)){ js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>

    </div>
  </div>
 
<script type="text/javascript" src="js/true.js?v="></script>
</body>

<script type="text/javascript">
	document.getElementsByClassName("loader")[0].style.display ="none"; //to make sure loader disappears after page loads.
</script>





</html>

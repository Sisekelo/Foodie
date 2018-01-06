<?php 
ob_start();
/* Main page for auto-login*/
require 'db.php';
session_start();

//check if there is a referal code

if( isset($_GET["refer"]) AND !empty($_GET["refer"]) ): 
        $refer= $_GET["refer"];    
    else:
        $refer= "";
        endif
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="All your favourite meals delivered to your doorstep!">

  <meta property="og:title" content="Say no to hunger!">
  <meta property="og:type" content="website">
  <meta property="og:url" content="ouideliver.xyz">
  <meta property="og:site_name" content="Oui deliver">
  <meta property="og:image" content="img/food.jpg" />
  
<!--  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a2452f631a40500136712dd&product=sticky-share-buttons' async='async'></script>-->
 
  
  <meta property="og:description" content="All your favourite meals delivered to your doorstep!">

  <title>Oui Eat</title>
  <link rel="shortcut icon" type="image/png" href="img/truck.png"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="211441494247-3jn1rs6opted8v6c2e5sraunp0baftdv.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js?v2" async defer></script>
  <script src="js/modernizr-2.7.1.js?v2"></script>
 

  <?php include 'css/css.html'; ?>
</head>

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

<body>

  <header>
      <div class="container">
         <div class="row header-info">
          <div class="col-sm-10 col-sm-offset-1 text-center">
            <a href="index.html"><img src="img/truck.png" alt="Logo" style="height: 100px"></a>
            <h1 class="wow fadeIn">Welcome to Oui Deliver </h1>
            <br />
            <p class="lead wow fadeIn" data-wow-delay="0.5s">All your favourite meals delivered to your doorstep!</p>
           
            <br />
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                  <div class="form-group">
                    <form action="index.php" method="post" autocomplete="off" id="initialpage">
            <div class="field-wrap">
            <input id="email" type="email" style="display:none"  name="email" placeholder="ALU email please"  autocomplete="true" />

            <div id="others">
            <input type="text" name='firstname' placeholder="name1" id="name1" class="form-control" /> <br>
            <input type="text" name='surname1' placeholder="surname1" id="surname1" /> <br>
            <input type="text" name="referer" value="<?= $refer ?>" placeholder="referer" id="referer" /> <br>
            <input type="text" autocomplete="off" name='picNew' placeholder="picNew" class="form-control" id="picNew" /> 
            </div>
          </div>
          <button class="button button-block" name="login" id="clickMe" style="display: none" />Log In</button>
          </form>
          <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark">
                  </div>
              </div>
            </div><!-- <!End Form row -->
      
          </div>  
        </div>
      </div>

    </header>
   

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js?v2'></script>
  <script src="js/index.js?v2"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js?v2"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
  <script src="js/wow.min.js?v2"></script>
  <script src="js/bootstrap.min.js?v2"></script>
  <script src="js/main.js?v2"></script>

</body>
</html>
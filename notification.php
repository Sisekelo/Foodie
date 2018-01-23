<?php
/* Displays all  notifications */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  
    <script type="text/javascript">
        $(window).load(function() {
        $(".loader").fadeOut("slow");
        });
    </script>
    
    
  <title>Notifcation</title>
  <?php include 'css/css.html'; ?>
</head>

<!-- <div class="loader"><p></p>
   </div> -->

<body onload ="reset()" class="center">
    <div class="form">
        <h1>
        <?php 
            if( isset($_SESSION['emoji']) AND !empty($_SESSION['emoji']) ): 
                echo $_SESSION['emoji'];    
            endif;
        ?>
        </h1>
        <p id="message" style="font-size: 300%">
        <?php 
        if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
            echo $_SESSION['message'];    
        else:
            header( "location: index.php" );
        endif;
        ?>
        </p>    

        <a href="index.php"><button class="button button-block"/>Home</button></a>

        <form id="resetform" action="delete.php" style="display: none;">
            <br>
            <button id="resetbutton" style="margin: 0;width: 100%;font-size: 200%" type="submit">reset account</button>
            <br>
        </form> 
    </div>


    <script type="text/javascript">

        function reset(){
            var javaScriptVar = document.getElementById("message").innerHTML;
            console.log(javaScriptVar);

            if(javaScriptVar.includes("Please check your SMS's") == true){
                document.getElementById("resetform").style.display = "block"
            }
        }


    </script>
</body>
</html>

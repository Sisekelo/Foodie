<?php
    	$number = $_GET["number"];
    	$firstname = $_GET["name"];
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
    <title><?=$firstname?> | Past Orders</title>
    <?php include 'css/true.html'; ?>
</head>

<div class="loader"><p></p>
   </div>

   

<body> 

	<h1>Your past orders</h1>
   <div class="cancel" style="z-index: 10000"><a href="profile.php" style="text-decoration: none;color: black">✕</a></div>
   <br>
 <table cellpadding="1" cellspacing="1" id="resultTable">
				<thead>
					<tr>
						<th  style="border-left: 1px solid #C1DAD7"> Id </th>
						<th> Meal </th>
						<th> Flavour </th>
						<th> Comment </th>
						<th> Quantity </th>
						<th> Drink Choice </th>
						<th> Location </th>
						<th> Vendor</th>
						<th> Date </th>
						<th> Total </th>
					</tr>
				</thead>
				<tbody>
				<?php
					include('db.php');
					/*$result = mysql_query("SELECT * FROM reservation ORDER BY firstname ASC");*/
					$result = $mysqli ->query("SELECT * FROM  Orders2 WHERE Buyer_Number=$number") or die($mysqli->error());
					while($row = mysqli_fetch_array($result))
						{
							echo '<tr>';
							echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['Id'].'</td>';
							echo '<td>'.$row['Meal'].'</td>';
							echo '<td><div align="left">'.$row['Flavour'].'</div></td>';
							echo '<td><div align="left">'.$row['Comment'].'</div></td>';
							echo '<td><div align="left">'.$row['Quantity'].'</div></td>';
							echo '<td><div align="left">'.$row['Drink_Choice'].'</div></td>';
							echo '<td><div align="left">'.$row['Location'].'</div></td>';
							echo '<td><div align="left">'.$row['Vendor'].'</div></td>';
							echo '<td><div align="left">'.$row['Date'].'</div></td>';
							echo '<td><div align="left">'.$row['Total'].'</div></td>';

							echo '</tr>';
						}
					?> 
				</tbody>
			</table>
</body>

<script type="text/javascript">
	document.getElementsByClassName("loader")[0].style.display ="none"; //to make sure loader disappears after page loads.
</script>
</html>

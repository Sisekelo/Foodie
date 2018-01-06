<?php
require 'db.php';
session_start();
// Check if user with that ema already exists
$TotalSales = $mysqli->query("SELECT * FROM sales") or die($mysqli->error());
$TotalFood = $mysqli->query("SELECT Meal, count(*) as number FROM sales GROUP BY Meal") or die($mysqli->error());
$TotalDrink = $mysqli->query("SELECT Drink, count(*) as number FROM sales GROUP BY Drink") or die($mysqli->error());

?>

<!DOCTYPE html>

<html>
<head>
    
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a2452f631a40500136712dd&product=sticky-share-buttons"></script>
	<title></title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<style type="text/css">
		h1{
			margin: 0
		}
	</style>
</head>
<body style="margin: 0">
	<div id="top" style="background-color: red;height: 30vh">
		<h1>Averages for the week</h1>
		<p>Total number of sales: <?= $TotalSales->num_rows ?></p>
		<div data-network="sharethis" data-url="dancing.com" class="st-custom-button">Share on whatsapp</div>
	</div>

<div id="bottom" style="background:blue;height: 70vh">
<table class="columns">
      <tr>
        <td><div id="foodchart" style="border: 1px solid #ccc"></div></td>
        <td><div id="drinkchart" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
    </div>


	


<script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawFood);
           google.charts.setOnLoadCallback(drawDrink);  
          	
          	function drawFood()  
	           {  
	                var data = google.visualization.arrayToDataTable([  
	                          ['Meal', 'Number'],  
	                          <?php  
	                          while($row = mysqli_fetch_array($TotalFood))  
	                          {  
	                               echo "['".$row["Meal"]."', ".$row["number"]."],";  
	                          }   
	                          ?>  
	                     ]);  
	                var options = {  
	                      title: 'Meals and numbers',  
	                      //is3D:true,  
	                      pieHole: 0.4,
	                    
	                     };  
	                var chart = new google.visualization.BarChart(document.getElementById('foodchart'));  
	                chart.draw(data, options);  
	           }  

	           function drawDrink()  
	           {  
	                var data = google.visualization.arrayToDataTable([  
	                          ['Drink', 'Number'],  
	                          <?php  
	                          while($row = mysqli_fetch_array($TotalDrink))  
	                          {  
	                               echo "['".$row["Drink"]."', ".$row["number"]."],";  
	                          }   
	                          ?>  
	                     ]);  
	                var options = {  
	                      title: 'Drinks and numbers',  

	                     };  
	                var chart = new google.visualization.PieChart(document.getElementById('drinkchart'));  
	                chart.draw(data, options);  
	           } 
           </script>

</body>
</html>
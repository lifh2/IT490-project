#!/usr/bin/php
<?php

$db = mysqli_connect("127.0.0.1","testuser","12345","testdb");
$query = "SELECT * FROM stockDataLive WHERE stockname='Apple Inc.' ORDER BY timestamp ASC;";
$result= mysqli_query($db, $query);

echo "here i am \n";
?>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		['timestamp', 'price'],
		//document.getElementById("demo").innerHTML = "Hello";
		
<?php
if($result > 0)
{
	while($row = mysqli_fetch_array($result))
	{
		echo "['".$row['timestamp']."', ".$row['price']."],";
	
	}
}
?>
]);
        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

</head>
<h1>login page</h1>
<body>
<h1>chart test</h1>
<?php echo "Here i am!"; ?>
<div id = "demo"></div>
<div id="curve_chart" style="width: 900px; height: 500px"></div>
</body>
</html>


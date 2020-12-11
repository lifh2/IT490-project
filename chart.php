#!/usr/bin/php
<?php

require_once('/home/luke/git/rabbitmqphp_example/path.inc');
        require_once('/home/luke/git/rabbitmqphp_example/get_host_info.inc');
        require_once('/home/luke/git/rabbitmqphp_example/rabbitMQLib.inc');


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
        $client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","SQLDB");

        $request = array();
        $request['type'] = "dashboard";
        $request['message'] = "For the dashboard";
        $response = $client->send_request($request);
        $stockName = response['stockName'];
       // $response = $client->publish($request);

        // foreach($response as $timestamp => $price) {

          // echo"['".$response['timestamp']."',".$response['price']."],";

                //}
	// var_dump($response);
	$stockName = $response[0];
	//echo $stockName;
	$i = 2;
        while($i < count($response)-1){
                echo"['".$response[$i]."',".(float)$response[$i+1]."],";
		$i++;
		$i++;
        }


?>
]);
        var options = {
	  title: '<?php print $stockName;?>',
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


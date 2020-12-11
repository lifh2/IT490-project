#!/usr/bin/php
<?php

require_once('/home/luke/git/rabbitmqphp_example/path.inc');
        require_once('/home/luke/git/rabbitmqphp_example/get_host_info.inc');
        require_once('/home/luke/git/rabbitmqphp_example/rabbitMQLib.inc');



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
	 var_dump($response);
	//$i = 0;
	//while($i < count($response)-1){
	///	echo"['".$response[$i]."',".(float)$response[$i+1]."],";
	///	$i++;
	///	$i++;
	///}
?>


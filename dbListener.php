#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbWorks.php');






function requestProcessor($request)
{
	echo "inside request processor";
	var_dump($request);

        print_r($request['type']);
       	if(!isset($request['type']))
      	{
	       	return array('message'=> "ERROR: unsupported message type");
	}
	 
	//logger($request);


	switch($request['type'])
	{
		case "Data":
                          
                          echo "data is found \n";
			  print_r($request['name']);
			  echo "\n";
			  print_r($request['latestPrice']);
			  echo "\n";
			  return stockData($request['name'], $request['latestPrice']);
                          


		 case "login":
			 echo "Login validation \n"; 


			 if(doLogin($request['username'], $request['password']))
			 {
				echo "finish dologing now returning 4";
				return array("returnCode" => 4, 'message'=>"Server received request and processed");


			 }
			 else{
				 echo "finish dologing now returning 9";

	
				return array("returnCode" => 9, 'message'=>"Server received request and processed");

			 }
			 break;


		 case "signup":
			  echo "Sign up validation \n";
			  if (doSignup($request['username'], $request['password']))
			  {
				  echo "finished sign up returning code 5 \n";
				  return array("returnCode" => 5, 'message'=>"Server received request and processed");

			  }
			  else
			  {
				  echo "Can't do do sign up now returning 6 \n";
                                  return array("returnCode" => 6, 'message'=>"Server received request and processed");




			  }
		  case "validate_session<br>":
			  echo "Validate session";
		    	  return doValidate($request['sessionId']);
	}
	
	
	return array("returnCode" => 999, 'message'=>"unknown request type"); 
}


$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
//$response = $client->send_request($reqtrue);


echo "client received response: ";
print_r($response);
echo "\n\n";



exit();
?>


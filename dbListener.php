#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbWorks.php');
//do a function that uploal logs to a local file


function requestProcessor($request)
{
	echo "inside request processor";
	var_dump($request);

        print_r($request['type']);
       	if(!isset($request['type']))
      	{
	       	return array('message'=> "ERROR: unsupported message type");
	}
	 


	switch($request['type'])
	{
		case "Data":
                          var_dump($request);
                          echo "data is found \n";
			  print_r($request['name']);
			  echo "\n";
			  print_r($request['latestPrice']);
			  
                          break;


		 case "login":
			 echo "Login validation \n"; 
		         if(doLogin($request['username'], $request['password']))
			 {
		$client = new rabbitMQClient("testRabbitMQ.ini","SQLDBR");
				echo "new client is created \n";
	
              			$reqtrue = array();
				$reqtrue['type'] = "login";
				$reqtrue['username'] = $request['username'];
				$reqtrue['password'] = $request['password'];
				$reqtrue['message'] = "1";
				var_dump($reqtrue);
				$response = $client->send_request($reqtrue);
                                echo "new request has been sent";
                                print_r($response);

			 }
			 else{
	        $client = new rabbitMQClient("testRabbitMQ.ini","SQLDBR");

 				echo "new client is created \n";

                                $reqtrue = array();
                                $reqtrue['type'] = "login";
                                $reqtrue['username'] = $request['username']; 
                                $reqtrue['password'] =  $request['password'];
				$reqtrue['message'] = "0";
				var_dump($reqtrue);
                                $response = $client->send_request($reqtrue);
                                echo "new request has been sent";
                                print_r($response);

			 }
			 break;


		 case "Signup":
			  echo "Sign up validation \n";
			  return doSignup($request['username'], $request['password']); 
		  case "validate_session<br>":
			  echo "Validate session";
		    	  return doValidate($request['sessionId']);
	}
	
	
	return array("returnCode" => '0', 'message'=>"Server received request and processed"); 
}


$server = new rabbitMQServer("testRabbitMQ.ini","SQLDB");

$server->process_requests('requestProcessor');
//$response = $client->send_request($reqtrue);


echo "client received response: ";
print_r($response);
echo "\n\n";



exit();
?>


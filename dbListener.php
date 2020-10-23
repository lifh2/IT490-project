#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbWorks.php');




function requestProcessor($request)
{
	//echo "received request".PHP_EOL;
	var_dump($request);
	
       	if(!isset($request['type']))
      	{
	       	return array('message'=> "ERROR: unsupported message type");
	}
	
	logger($request);
	
	switch($request['type'])
	{
		 case "login":
			 echo "Login validation \n";
			 return doLogin($request['username'],$request['password']);
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
exit();
?>


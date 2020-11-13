#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbWorks.php');


//do a function that uploal logs to a local file
function errorlogger($msg)
{
          //path of the log file
        $log_file = '/var/log/rabbit_log/log_rabbit.log';
           //set error log to be active
        ini_set("logr_errors", TRUE);
          // setting the logging to be active
        ini_set('error_log', $log_file);
        // logging thhe error
        $ermsg = print_r($msg, true);

	error_log($ermsg);

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        echo "new client is created to sent error to broker\n";

        $request = array();
        $request['type'] = "logger";
        $request['error'] = $ermsg;

        var_dump($request);
        $response = $client->send_request($request);
        echo "error request has been sent to broker";
        print_r($response);

}






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


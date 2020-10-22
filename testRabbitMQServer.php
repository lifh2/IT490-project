#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//you are in Server
function doLogin($username,$password)
{
	echo "doLogin funtion has started";
	echo "\n";

	//making a client to send data
	//echo "new client to send is being created";
	//echo "\n";
	
	//$client = new rabbitMQClient("testRabbitMQ.ini", "SQLDB");
	
	//setting up vari for gotInfo --> SentInfo
	


	//$sentInfo = array($username,$password);
	

	//print_r($sentInfo);
	//echo "\n";


	//echo "Message:";
	//echo "\n";
	//$response = $client->publish($sentInfo);
	//echo "sending to SQLDB...";
	//echo "\n";

	//print_r($response);
	//echo"received response from SQLDB";
	//echo"\n";
		
	// check password

	//return true;
	return true;
    //return false if not valid
}

function doRegister($username, $password){
	echo "regi has started";
	echo "\n";
}



function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);

  echo "creating new client";
  echo "\n";
  $client = new rabbitMQClient("testRabbitMQ.ini", "SQLDB");

  $sentInfo = array($request);
  echo"what is is SentInfo:";
  echo"\n";

  print_r($sentInfo);

  echo"creating sender";
  echo"\n";
  $response = $client->send_request($request);

  echo "Response from SQLDB";
  echo "\n";
  print_r($response);

  echo"message type of sent message: ";
  print_r($request['type']);
  echo"\n";

  echo"sending from inside requestProcessor";
  echo"\n";

 // echo $request['backtalk'];
  
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }

  echo "valid type";
  echo"\n";
  switch ($request['type'])
  {
    case "login":
	    return doLogin($request['username'],$request['password']);
	    echo "login case has run";
    case "register":
	    return doRegister($request['username'], $request['password']);
	    echo "register case has run";

    case "validate_session":
      return doValidate($request['sessionId']);
  }


  return array("returnCode" => '4', 'message'=>"Server received request and processed. and complete.");


  echo "return array has sent";
  echo "\n";
}



echo "request processor function has ran";
echo "\n";

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo"new server instance has been made";
echo"\n";

$server->process_requests('requestProcessor');
echo "\n";
//echo "packaging recieved data to be shipped";
//echo "\n";


echo"running process_requests";
echo"\n";
exit();
?>


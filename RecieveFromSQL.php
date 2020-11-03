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
	
	//lookup username in database
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
  // echo $request['backtalk'];
  //making new client
  $sentInfo = array($request);
  echo "array is set, client being made";
  echo"\n";

  $client = new rabbitMQClient("testRabbitMQ.ini", "APA");

  echo"Sending:";
  echo"\n";
  $response = $client->send_request($request);

  echo"return:";
  print_r($response);
  //$response = $client->publish($request);


  
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
  
  return array("returnCode" => '0', 'message'=>"Server received request and processed. and complete.");
  echo "return array has sent";
  echo "\n";
}



echo "request processor function has ran";
echo "\n";

$server = new rabbitMQServer("testRabbitMQ.ini","SQLDBR");

echo"new server instance has been made for SQLDBR"; 
echo"\n";

$server->process_requests('requestProcessor');

echo"running process_requests";
echo"\n";
exit();
?>


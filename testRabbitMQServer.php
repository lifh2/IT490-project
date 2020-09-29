#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//you are in Server
function doLogin($username,$password)
{
    // lookup username in databas
    // check password
	return true;
	echo "login function";
	echo "\n";
    //return false if not valid
}




function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  
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
	    

    case "validate_session":
      return doValidate($request['sessionId']);
  }
  
  return array("returnCode" => '0', 'message'=>"Server received request and processed. and complete.");
  echo "return array has sent";
}


echo "request processor function has ran";
echo "\n";

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo"new server instance has been made";
echo"\n";

$server->process_requests('requestProcessor');

echo"running process_requests";
echo"\n";
exit();
?>


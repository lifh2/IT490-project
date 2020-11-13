#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('logger.php');
//you are in Server

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
 // echo $request['backtalk'];
  
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }

  echo "valid type";
  echo"\n";
  switch ($request['type'])
  {
    case "logger":
	    echo "logger case has run";
            errorLogger($request['error']);
	    return true;
	    
  }
   echo "return array has sent";
  echo "\n";

  return array("returnCode" => '1', 'message'=>"Server received request and processed. and complete.");
 
}

$server = new rabbitMQServer("testRabbitMQ.ini","APALogListener");

echo"new server instance has been made";
echo"\n";

$server->process_requests('requestProcessor');

echo"running process_requests";
echo"\n";
exit();
?>


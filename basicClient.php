#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

require_once('')

//you are in client
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
	$msg = "test message: Client to Server";
}

$request = array();
$request['type'] = "login";
$request['username'] = "test";
$request['password'] = "test";
$request['message'] = "basicClient is sending a message";

$request['backtalk']="going to Server now";
$request['FromServer'] = "";
$response = $client->send_request($request);

//$response = $client->publish($request);
//$response = $client ->publish($request['backtalk']);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n";

echo $argv[0]." END".PHP_EOL;


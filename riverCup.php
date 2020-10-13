#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

echo "Listener is starting up";
echo "\n";

function getInfo($request)
{
	echo "displaying request".PHP_EOL;
	var_dump($request);

	echo "Log:";
	echo $request;
}

$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");

echo "new sever instance made";
echo "\n";




?>

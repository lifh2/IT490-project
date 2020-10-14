#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

echo "Listener is starting up";
echo "\n";

function getInfo($request)
{
	//echo "displaying request".PHP_EOL;
	//var_dump($request);

	echo "Log:";
	print_r($request);
}

function dataStream($request)
{
	echo "dataStream function is running";
	
}



$server = new rabbitMQServer("testRabbitMQ.ini", "testServer");

echo "new sever instance made";
echo "\n";

$server->process_requests('getInfo');

echo "ran the process_requests function";
echo "\n";

$server->process_message($request);

echo "ran the process_message function";
echo "\n";


?>

#!/usr/bin/php
<?php
require_once __DIR__ . '/vender/autoload.php';
use PjpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->connection();

$channel->exchange_declare('logs', 'fanout', false, false, false);

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, 'logs');

echo " [*] waiting for logs...";

$callback = function($msg){
	echo ' [x] ', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_consuming()){
	$channel->wait();
}

$channel->close();
$connection->close();


echo "Consumer on SQL_DB has ran";
echo "\n";
?>

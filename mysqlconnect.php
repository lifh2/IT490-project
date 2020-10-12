#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//you are in Server

$mydb = new mysqli('127.0.0.1','testuser','12345','testdb');

if($mydb->errno != 0){
	echo "failed to connect to database".$mydb->error.PHP_EOL;
	exit(0);
}
echo "successful connected to database".PHP_EOL;

$query = "select * from Users;";

if($mydb->errno != 0){
	echo "failed to execute the query:".PHP_EOL;
	ECHO __FILE__.''.__LINE__.":error: ".$mydb->error.PHP_EOL;
//	exit(0);
}
if($response=$mydb->query($query)){

	printf("select query returned %d rows.\n", $response->num_rows);
		
}

?>


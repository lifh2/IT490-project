#!/usr/bin/php
<?php

//DB Connect function
function dbconnect(){

	$mydb = new mysqli('127.0.0.1','testuser','12345','testdb');

	if($mydb->errno !=0 ){
		echo "failed to connect to database: ".$mydb->error.PHP_EOL;
		exit();
	}
	echo "successful connect to database".PHP_EOL;

//	echo password_hash("outmarghadtahorriyt", PASSWORD_DEFAULT);
	return $mydb;
}

//dbconnect();

?>

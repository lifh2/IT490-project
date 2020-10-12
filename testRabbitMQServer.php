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
	$SQLServer = "10.192.234.195";//sifaw's IP
	$SQL_U = "testuser";
	$SQL_P = "12345";

	$SQL_conn  = new mysqli($SQLServer, $SQL_U, $SQL_P);

	if($SQL_conn->connect_error){
		die("conn failed: " . $SQL_conn->connect_error);
	}
	echo "Conn succ";
	echo "\n";
	
	$checkUser = "SELECT COUNT(1) FROM users WHERE username = '$username'";
	//$checkPass = "SELECT COUNT(1) FROM users WHERE password=test";

	$r=mysql_query($checkUser);
	$row = mysql_fetch_row($r);


	if($row[0] >= 1){
		return true;
		echo "checked the db and user exists";
		echo "\n";
	}
	else
	{
		echo "no record found";
		echo "\n";
		return false;
	}

	//return true;
	echo "login function";
	echo "\n";
    //return false if not valid
}

function doRegister($username, $password){
	echo "regi has started";
	echo "\n";

	//connect to db
	$SQLServer = "10.192.234.195\\testdb";//sifaw's IP
	$SQL_U = "testuser";
	$SQL_P = "12345";

	$SQL_conn  = new mysqli($SQLServer, $SQL_U, $SQL_P);

	if($SQL_conn->connect_error){
		die("conn failed: " . $SQL_conn->connect_error);
	}
	echo "Conn succ";
	echo "\n";
	$regi_user = "INSERT INTO Users (username, password) VALUES ('$username', '$password');";
	echo "regi_user queue has been created and sent to db";
	if($conn->query($regi_user) === TRUE){
		//checks if user has been added
		echo "new user has been added";
		echo "\n";
	}
	else
	{
		echo "ERROR!: " . $regi_user . "<br>" . $conn->error;
		echo "\n";
	}
}



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
    case "login":
	    return doLogin($request['username'],$request['password']);
	    echo "login case has run";
    case "register":
	    return doRegister($request['username'], $request['password']);
	    echo "register case has run";

    case "validate_session":
      return doValidate($request['sessionId']);
  }
  
  return array("returnCode" => '1', 'message'=>"Server received request and processed. and complete.");
  echo "return array has sent";
  echo "\n";
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


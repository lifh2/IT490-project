<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);



function sendRequest()
{

require_once('/home/luke/git/rabbitmqphp_example/path.inc');
require_once('/home/luke/git/rabbitmqphp_example/get_host_info.inc');
require_once('/home/luke/git/rabbitmqphp_example/rabbitMQLib.inc');
$username = $_GET ['username'] ;
echo "<br> username is: $username" ;

$password = $_GET ['password'] ;
echo "<br> passwrd is : $password" ;

$client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "login";
$request['username'] = "$username";
$request['password'] = "$password";
$request['message'] = "HI";
$response = $client->send_request($request);
echo "Client request sent!";
$response = $client->publish($request);

echo "client received response: ";//.PHP_EOL;
print_r($response);
echo "\n\n";
$server = new rabbitMQServer("testRabbitMQ.ini", "APA");

$server->processrequests('requestProcessor');
}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

sendRequest();
?>

<html>
<h1>Handling Login request....</h1>
<h1>STNK Login Page</h1>
<form action = "login.php">
        <input type = "text" name="username">USER<br><br>
        <input type = "text" name="password">PASS<br><br>
        <input type = submit>
</form>
</body>



</html>

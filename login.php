<?php
require_once('/home/luke/git/rabbitmqphp_example/path.inc');
require_once('/home/luke/git/rabbitmqphp_example/get_host_info.inc');
require_once('/home/luke/git/rabbitmqphp_example/rabbitMQLib.inc');


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);



function sendRequest()
{

$username = $_GET ['username'] ;
echo "<br> username is: $username" ;

$password = $_GET ['password'] ;
echo "<br> passwrd is : $password" ;


$choice = $_GET ['choice'] ;
echo "<br> choice is : $choice";

$client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","SQLDB");


$request = array();
$request['type'] = $choice;
$request['username'] = $username;
$request['password'] = $password;
$request['message'] = "HI";
$response = $client->send_request($request);
echo "Client request sent!";
var_dump($response);
print_r($response['message']);
echo "regway";
print_r($response['returnCode']);
$returnCode = $response["returnCode"];

$response = $client->publish($request);
echo "client received response: ";//.PHP_EOL;

echo "\n\n";
if($returnCode == 4)
{
	echo "Login successful";
	header('Location: dashboard.html');
}
elseif($returnCode == 9)
{
        echo "Failed login";
}

elseif($returnCode == 5)
{
        echo "Successful register";
}
elseif($returnCode == 6)
{
	echo "failed Register, user already exists";
}
}


sendRequest();
?>

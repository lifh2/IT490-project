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

<<<<<<< HEAD

$choice = $_GET ['choice'] ;
echo "<br> choice is : $choice";

$client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","SQLDB");


$request = array();
$request['type'] = $choice;
$request['username'] = $username;
$request['password'] = $password;
=======
$choice = $_GET ['choice'] ;
echo "<br> choice is : $choice" ;

$client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "$choice";
$request['username'] = "$username";
$request['password'] = "$password";
>>>>>>> 8d1b52c9437318573483916cad768e870c64250e
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
<<<<<<< HEAD
=======

<html>
<h1>Handling Login request....</h1>
<h1>STNK Login Page</h1>
<form action = "login.php">
        <input type = "text" name="username">USER<br><br>
	<input type = "text" name="password">PASS<br><br>

<select name="choice">
        <option value="0"> Choose </option>
        <option value="login"> Login </option>
        <option value="signup"> Register </option>
</select>


        <input type = submit>
</form>
</body>



</html>
>>>>>>> 8d1b52c9437318573483916cad768e870c64250e

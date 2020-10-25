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

}

sendRequest();
/*
function HandleLoginResponse(response)
{
	echo "inside handle login response...";
        var text = JSON.parse(response);
//      document.getElementById("textResponse").innerHTML = response+"<p>";
        document.getElementById("textResponse").innerHTML = "response: "+text+"<p>";
}

function SendLoginRequest(username,password)
{
	echo "sending login request";
        var request = new XMLHttpRequest();
        request.open("POST","login.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.onreadystatechange= function ()
        {
                
                if ((this.readyState == 4)&&(this.status == 200))
                {
                        HandleLoginResponse(this.responseText);
                }               
        }
        request.send("type=login&uname="+username+"&pword="+password);
}

//SendLoginRequest($username,$password);

//rabbitMQ code to pass/push into another server VM
//
//
//return logic weather authenticion verified or not
//print 

if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "unsupported request type, politely FUCK OFF";

//switch ($request["type"])
//{
//	case "login":
//		$response = "login, yeah we can do that";
//	break;
//}
//
echo json_encode($response);

print 
//exit(0);
 */
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

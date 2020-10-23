<?php
<<<<<<< HEAD

=======
$username = $_GET ['username'] ;
print "<br> username is: $username" ; 

$password = $_GET ['password'] ; 
print "<br> passwrd is : $password" ;

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
SendLoginRequest($username,$password);

//rabbitMQ code to pass/push into another server VM
//
//
//return logic weather authenticion verified or not
//print 
>>>>>>> b277e6e699fe94283b33da41e560100062345f58

if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "unsupported request type, politely FUCK OFF";
switch ($request["type"])
{
	case "login":
		$response = "login, yeah we can do that";
	break;
}
echo json_encode($response);
exit(0);

?>

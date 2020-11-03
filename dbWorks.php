#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('mysqlConnect.php');



////// Validate user logins //////

function doLogin($username, $password){
   $db = dbconnect();
   
   $query = "select * from users where username = '$username' and password='$password';";
   $response = $db->query($query);
   $numrows = mysqli_num_rows($response);
   echo "num of rows returned: ". $numrows . "\n";
   $resArray = $response -> fetch_assoc();
  // printf("print this array: \n", $resArray);
   
   if ($numrows > 0)
   {
      //if(password_verify($password, $resArray['password'])){
         echo "login is verified \n";
         return  true;
   }
   else
   {
         echo "Invalid inforamtion \n";
         return false;
   }
}



//////// User Sign up function///////

function doSignup($username, $password){
	//$hash = password_hash($password, PASSWORD_DEFAULT);
	//echo "$password". " :"."$hash". "\n";

        //$key = md5(time().$username);
        $db = dbconnect();
	$query = "INSERT INTO users (username, password) VALUES ('$username', '$password');";
        if (mysqli_query($db, $query))
        {
                echo "User has successfully registered \n";
        }
        else
        {
                echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
        $db->close();
}


///// Function to insert API data into DB///////
  
function stockData($stockname, $price){

	$db = dbconnect();
	$query = "INSERT INTO stockDataLive (stockname, price, timestamp) VALUES ('$stockname', '$price', now());";
        if (mysqli_query($db, $query))
        {
		echo "New stock data has been added to db \n";
		return true;
        }
        else
        {
		echo "Error: " . $query . "<br>" . mysqli_error($db);
		return false;
        }
        $db->close();


}




?>

#!/usr/bin/php

<?php

require_once('/home/james/git/RMQ/path.inc');
require_once('/home/james/git/RMQ/get_host_info.inc');
require_once('/home/james/git/RMQ/rabbitMQLib.inc');


$curl = curl_init();

curl_setopt_array($curl, [
CURLOPT_URL => "https://rapidapi.p.rapidapi.com/stock/intc/book",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
"x-rapidapi-host: investors-exchange-iex-trading.p.rapidapi.com",
"x-rapidapi-key: 636cd705b0msh003106b728cf3e3p101c47jsn97c7c0b4b786"
],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}




$client = new rabbitMQClient("testRabbitMQ.ini" , "SQLDB");

echo "client created";

$request = array();


$request['name'] = 'companyName';
print_r($request);

$response = $client->send_request($request);
print_r($response);
echo "request sent";
?>

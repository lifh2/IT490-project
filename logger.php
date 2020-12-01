#!/usr/bin/php
<?php
require_once('/home/luke/git/rabbitmqphp_example/path.inc');
require_once('/home/luke/git/rabbitmqphp_example/get_host_info.inc');
require_once('/home/luke/git/rabbitmqphp_example/rabbitMQLib.inc');



//do a function that uploal logs to a local file
function errorlogger($msg)
{
          //path of the log file
        $log_file = '/var/log/rabbit_log/log_rabbit.log';
           //set error log to be active
        ini_set("logr_errors", TRUE);
          // setting the logging to be active
        ini_set('error_log', $log_file);
        // logging thhe error
        $ermsg = print_r($msg, true);

	error_log($ermsg);


}


function sendErrorLog($ermsg)
{
        $client = new rabbitMQClient("/home/luke/git/rabbitmqphp_example/testRabbitMQ.ini","APALog");
        echo "new client is created to sent error to all other machines log listeners";

        $request = array();
        $request['type'] = "logger";
        $request['error'] = $ermsg;

        var_dump($request);
        $response = $client->send_request($request);
        echo "error request has been sent to broker";
        print_r($response);


	
}

?>


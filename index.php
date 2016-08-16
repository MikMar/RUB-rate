<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 8/15/16
 * Time: 1:05 PM
 */

$html = file_get_contents("http://www.inecobank.am");
$html = preg_replace('/\s+/', '', $html);
// we need to find 7th "RUR" word in DOM
for ( $i=0; $i<7; $i++ ){
    $html = substr( $html, strpos($html, 'RUR') + 3,  strlen($html) );
}

$html = substr( $html, 48, 4 );
$rate = floatval($html);
echo $rate;

// Required if your envrionment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

if (date('h') == 11 || $rate <= 7){

// Your Account SID and Auth Token from twilio.com/console
    $sid = 'AC57fec98ff371e587e2c2e78bdc6ad55c';
    $token = 'bdab0c8657d72d71370ead4dd023d16d';
    $client = new Client($sid, $token);


// Use the client to do fun stuff like send text messages!
    $client->messages->create(
// the number you'd like to send the message to
        '4545454545',
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '131313131313',
            // the body of the text message you'd like to send
            'body' => $rate
        )
    );
}

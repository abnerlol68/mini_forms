<?php

require_once ROOT . 'vendor/twilio/sdk/src/Twilio/autoload.php';

use Twilio\Rest\Client;

$mess = $_SESSION['userMessage'];

$sid = "ACe09fe34aa0d7094abb76aa449205a397";
$token = "5766c9c2cdf8d07259ee5d5c1463e7f1";
$twilio = new Client($sid, $token);

$message = $twilio->messages
    ->create("whatsapp:+5217721446962", // to
        array(
            "from" => "whatsapp:+14155238886",
            "body" => $mess
        )
    );

echo $message->sid;
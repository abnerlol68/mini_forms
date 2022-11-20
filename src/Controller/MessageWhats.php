<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once ROOT . 'vendor/twilio/sdk/src/Twilio/autoload.php';

use Twilio\Rest\Client;

$mess = $_SESSION['userMessage'];

$sid    = "ACe09fe34aa0d7094abb76aa449205a397";
$token  = "db324d8de3340e21ed885f613dedfd15";
$twilio = new Client($sid, $token);

$message = $twilio->messages
    ->create("whatsapp:+5217732334551", // to
        array(
            "from" => "whatsapp:+15135069189",
            "body" => $mess
        )
    );

echo $message->sid;
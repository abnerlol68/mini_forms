<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once ROOT . 'vendor/twilio/sdk/src/Twilio/autoload.php';

use Twilio\Rest\Client;

$mess = $_SESSION['userMessage'];

$sid    = "ACe09fe34aa0d7094abb76aa449205a397";
$token  = "3556a903e2d4ce80cc8ef1175d5ceffc";
$twilio = new Client($sid, $token);

$message = $twilio->messages
    ->create("whatsapp:+5217721446962", // to
        array(
            "from" => "whatsapp:+14155238886",
            "body" => $mess
        )
    );

echo $message->sid;
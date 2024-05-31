// Send an SMS using Twilio's REST API and PHP
<?php
// Required if your environment does not handle autoloading
require 'twilio-php-main/src/Twilio/autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "AC4480a4a72a730d8468baa2d944e0164c";
$token = "1fb3ab7eb1d828cd20b358034b6e5d47";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+460720412325',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+18777804236',
        // The body of the text message you'd like to send
        'body' => "Tack för ditt köp!"
    ]
);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Payment Success</title>
    <link rel="stylesheet" href="checkout.css" />
</head>
<body>
    <h1>Payment Success</h1>
    <p>Your payment was successful. Thank you for your purchase!</p>
    <a href="index.php">Back to Products</a>
</body>
</html>

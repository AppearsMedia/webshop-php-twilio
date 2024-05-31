<?php
require_once 'stripe-php/init.php';

$stripe = new \Stripe\StripeClient('sk_test_51PJEZvRvdqCDotXI1Rg03VuACv9e9TtWSMReK4pGxCla8SEwVQ0m2uFJgkCZvZBou1cPyk3gE0NOkW1IucccvvFS00tNrPVJ1F');

function calculateOrderAmount($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item->price;  // Assuming each item object has a price property
    }
    return $total * 100;  // Amount in cents
}

header('Content-Type: application/json');

try {
    // retrieve JSON from POST body
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    // Debugging: log items to a file
    file_put_contents('test.txt', print_r($jsonObj->items, true));

    // Create a PaymentIntent with amount and currency
    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => calculateOrderAmount($jsonObj->items),
        'currency' => 'sek',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

    echo json_encode($output);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>



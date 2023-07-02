<?php
include_once '../acquisti/carrello.php';
require_once 'stripe-php-9.6.0/init.php';
include_once '../config/mysql-config.php';

session_start();

// dati amministratore
$rrr = $conn->query("SELECT * FROM amministratore");
$admin = $rrr->fetch_assoc();

// This is your test secret API key.
\Stripe\Stripe::setApiKey($admin['stripe_private_key']);

function calculateOrderAmount(): int {
    
    return $_SESSION['carrello']->getTotale()*100;

}

header('Content-Type: application/json');

try {
    // Create a PaymentIntent with amount and currency
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => calculateOrderAmount(),
        'currency' => 'eur',
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
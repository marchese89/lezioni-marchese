<?php
include_once '../acquisti/carrello.php';
require_once 'stripe-php-9.6.0/init.php';

session_start();

// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LkNn9H3pdyIax9sV9wedmHBJPMfcfTdeXDXbMhnBTlN3dzYa7kTVrSl3CJPYHNgRklQiJJI5rrjOMjoOM4RbALu00n77YaBXr');

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
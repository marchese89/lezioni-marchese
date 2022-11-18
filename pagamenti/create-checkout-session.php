<?php

include_once '../acquisti/carrello.php';
require_once 'stripe-php-9.6.0/init.php';

session_start();

// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LkNn9H3pdyIax9sV9wedmHBJPMfcfTdeXDXbMhnBTlN3dzYa7kTVrSl3CJPYHNgRklQiJJI5rrjOMjoOM4RbALu00n77YaBXr');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242/public';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1LuzpBH3pdyIax9synkaI9Fk',
      'quantity' => $_SESSION['carrello']->getTotale(),
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
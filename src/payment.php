<?php 
require_once('../vendor/autoload.php');
// Include configuration file  
require_once 'config.php'; 

if($_POST['chechout']){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = 1;

    $stripe = new \Stripe\StripeClient(SECRET_KEY);
    
    $checkout = $stripe->checkout->sessions->create([
        'success_url' => URL_SUCCESS,
        'cancel_url' => URL_CANCEL,
        'payment_method_types' => ['card'],
        'mode' => 'payment',
        'line_items' => [
            [
                'name' => $name,
                'amount' => $price,
                'currency' => 'USD',
                'quantity' => $quantity,
            ]
        ],
      ]);
    
    print_r($checkout->id);
}
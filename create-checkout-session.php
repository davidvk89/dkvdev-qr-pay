<?php
session_start();
ob_start();
require('data/config.php');

require 'vendor/autoload.php';

if(isset($_POST['submit_payment'])){        //form handler
  $payment_amount = $_POST['payment_amount'];
  $extra_data = $_POST['extra'];

  if(!$payment_amount){
    $payment_amount = $config['minimal_payment_amount'];
  
  }elseif($payment_amount < $config['minimal_payment_amount']){
    $payment_amount = $config['minimal_payment_amount'];
  }    

  if(!$extra_data){$extra_data = "Geen extra vermeldingen";}  //default message if no additonal data was entered.

  //payment_amount manipulation for UX.
    $needle = ".";
    $needle2 = ",";
    if(str_contains($payment_amount, $needle)){
     $payment_amount = str_replace($needle, "", $payment_amount);
    }
    elseif(str_contains($payment_amount, $needle2)){
      $payment_amount = str_replace($needle2, "", $payment_amount);
    }
    else{
      $payment_amount = $payment_amount * 100;
    }

  $payment_tracker = session_id();
  $payment_status = "Gestart";
  date_default_timezone_set('Europe/Amsterdam');
  $time = date("Y-m-d H:i:s");
  $query = "INSERT INTO $company_payments (payment_amount, payment_data, payment_status, payment_time, stripe_id) VALUES(?, ?, ?, ?, ?)";
  $stmt = $conn -> prepare($query);
  $stmt -> bind_param("sssss", $payment_amount, $extra_data, $payment_status, $time, $payment_tracker);
  $stmt -> execute();
  $stmt -> close();

  $_SESSION['payment_tracker'] = $payment_tracker;
  $_SESSION['payment_amount'] = $payment_amount;
  $_SESSION['payment_extra_data'] = $extra_data;
  $_SESSION['payment_status'] = $payment_status;

  
}

//stripe API key
\Stripe\Stripe::setApiKey($stripe_api);

header('Content-Type: application/json');

$YOUR_DOMAIN = $domain; //domain used for redirects.
//logic for price calculations.

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card', 'ideal', 'bancontact'],    //payment methods
  'line_items' => [[
      
      'price_data' => [
      'currency' => 'eur',    //defines the currency ysed
      'unit_amount' => $_SESSION['payment_amount'],  //defines the price charged
      
      'product_data' => [
        'name' => 'Betaling aan ' . $company,  //display name on checkout screen
//        'images' => [""],  //image displayed on checkout screen, currently bugs and shows a broken link. 
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',    //redirect on success
  'cancel_url' => $YOUR_DOMAIN . '/index.php?status=cancelled',                      //redirect on cancel
]);
$stripe_id = $checkout_session -> id;
$payment_status = "In behandeling";


$query = "UPDATE $company_payments SET stripe_id = ?, payment_status = ? WHERE stripe_id = ? ";
$upd_stmt = $conn -> prepare($query);
$upd_stmt -> bind_param("sss", $stripe_id, $payment_status, $_SESSION['payment_tracker']);
$upd_stmt -> execute();
$upd_stmt -> close();

$_SESSION['payment_tracker'] = $stripe_id;


header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

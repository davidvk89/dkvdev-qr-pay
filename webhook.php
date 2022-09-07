<?php
require 'vendor/autoload.php';
require 'data/config.php';

// This is your test secret API key.
\Stripe\Stripe::setApiKey($stripe_api);
// Replace this endpoint secret with your endpoint's unique secret
// If you are testing with the CLI, find the secret by running 'stripe listen'
// If you are using an endpoint defined with the API or dashboard, look in your webhook settings
// at https://dashboard.stripe.com/webhooks
$endpoint_secret = $webhook_secret;

$payload = @file_get_contents('php://input');
$event = null;

try {
  $event = \Stripe\Event::constructFrom(
    json_decode($payload, true)
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  echo '⚠️  Webhook error while parsing basic request.';
  http_response_code(400);
  exit();
}
if ($endpoint_secret) {
  // Only verify the event if there is an endpoint secret defined
  // Otherwise use the basic decoded event
  $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
  try {
    $event = \Stripe\Webhook::constructEvent(
      $payload, $sig_header, $endpoint_secret
    );
  } catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    echo '⚠️  Webhook error while validating signature.';
    http_response_code(400);
    exit();
  }
}

// Handle the event
switch ($event->type) {
  case 'checkout.session.async_payment_failed':
    $session = $event->data->object->id;
    $status = 'Mislukt';
    $query = "UPDATE $company_payments SET payment_status = ? WHERE stripe_id = ? ";
    $insert_stmt = $conn ->prepare($query);
    $insert_stmt -> bind_param('ss',$status, $session);
    $insert_stmt -> execute();
    $insert_stmt -> close();
  break;

  case 'checkout.session.completed':
    $session = $event->data->object->id;
    $status = 'Geslaagd';
    $query = "UPDATE $company_payments SET payment_status = ? WHERE stripe_id = ? ";
    $insert_stmt = $conn ->prepare($query);
    $insert_stmt -> bind_param('ss',$status, $session);
    $insert_stmt -> execute();
    $insert_stmt -> close();
    break;

  case 'checkout.session.expired':
    $session = $event->data->object->id;
    $status = 'FAILED';
    $query = "UPDATE $company_payments SET payment_status = ? WHERE stripe_id = ? ";
    $insert_stmt = $conn ->prepare($query);
    $insert_stmt -> bind_param('ss',$status, $session);
    $insert_stmt -> execute();
    $insert_stmt -> close();
    break;

  // ... handle other event types
  default:
    echo 'Received unknown event type ' . $event->type;
}


http_response_code(200);
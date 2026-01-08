<?php
require_once('./config.php');
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

function sendCancellationSMS($details) {
    // Load credentials from environment variables or from constants in config.php
    $account_sid = getenv('TWILIO_ACCOUNT_SID') ?: (defined('TWILIO_ACCOUNT_SID') ? TWILIO_ACCOUNT_SID : null);
    $auth_token  = getenv('TWILIO_AUTH_TOKEN') ?: (defined('TWILIO_AUTH_TOKEN') ? TWILIO_AUTH_TOKEN : null);
    $twilio_number = getenv('TWILIO_FROM') ?: (defined('TWILIO_FROM') ? TWILIO_FROM : null);

    if (!$account_sid || !$auth_token || !$twilio_number) {
        echo json_encode(["status" => "error", "message" => "Twilio credentials not configured."]);
        return;
    }

    $client = new Client($account_sid, $auth_token);

    $message = "Booking Cancellation:\n" .
               "Ref Code: {$details['ref_code']}\n" .
               "Pickup Zone: {$details['pickup_zone']}\n" .
               "Drop-off Zone: {$details['drop_zone']}\n" .
               "Driver Contact: {$details['driver_contact']}\n" .
               "Client: {$details['client']}\n" .
               "Client Contact: {$details['contact']}\n" .
               "Fee: LKR {$details['fee']}";

    try {
        $response = $client->messages->create(
            "+94779488546",
            [
                'from' => $twilio_number,
                'body' => $message
            ]
        );
        echo json_encode(["status" => "success", "message" => "SMS sent successfully."]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $details = json_decode($_POST['details'], true);
    sendCancellationSMS($details);
}

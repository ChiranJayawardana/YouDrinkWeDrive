<?php
/**
 * Geocoding Proxy - Server-side proxy to avoid CORS issues
 * This file acts as a proxy between the frontend and Nominatim API
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo json_encode(['error' => 'Query parameter is required']);
    exit;
}

$query = urlencode($_GET['q']);
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
$country = isset($_GET['country']) ? $_GET['country'] : 'lk';

// Build the Nominatim API URL
$url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}&limit={$limit}&countrycodes={$country}";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'CabBookingApp/1.0 (Contact: admin@cabbooking.com)');
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode(['error' => 'Request failed: ' . $error]);
    exit;
}

if ($httpCode !== 200) {
    echo json_encode(['error' => 'API returned status code: ' . $httpCode]);
    exit;
}

// Return the response
echo $response;
?>

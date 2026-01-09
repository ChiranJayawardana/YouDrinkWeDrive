<?php
/**
 * Geocoding API Proxy
 * Handles location autocomplete requests to avoid CORS issues
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

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Query parameter is required']);
    exit;
}

$query = trim($_GET['q']);
if (strlen($query) < 2) {
    http_response_code(400);
    echo json_encode(['error' => 'Query must be at least 2 characters']);
    exit;
}

$query = urlencode($query);
// Add country code to improve results for Sri Lanka
$url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}&limit=5&addressdetails=1&countrycodes=lk&dedupe=1";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'CabBookingSystem/1.0 (https://example.com/contact)');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Accept-Language: en-US,en;q=0.9'
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Request failed: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

if ($httpCode !== 200) {
    http_response_code($httpCode);
    if ($httpCode === 429) {
        echo json_encode(['error' => 'Rate limit exceeded. Please wait a moment before searching again.']);
    } else {
        echo json_encode(['error' => 'API returned status code: ' . $httpCode]);
    }
    exit;
}

// Validate JSON response
$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['error' => 'Invalid JSON response from API']);
    exit;
}

// Return the response
echo $response;
?>

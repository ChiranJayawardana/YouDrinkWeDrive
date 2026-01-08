<?php
// Created By Chiran - Updated to use Gemini API

if (isset($_POST['text'])) {
    $userMessage = $_POST['text'];
    //$apiKey = 'AIzaSyCPJCGkWxY7TvavyO-lD0SpsMsEy3msL0Q'; // Replace with your actual Gemini API Key
    $apiKey = 'AIzaSyAZDeFWY8WbqfR-x1p0SnzDww3DC60iPxA'; // Replace with your actual Gemini API Key
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;

    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $userMessage]
                ]
            ]
        ]
    ];

    $jsonData = json_encode($data);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    // Disable SSL verification for local development (if needed, otherwise remove this line in production)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        $decodedResponse = json_decode($response, true);
        
        // Check if candidates exist and have content
        if (isset($decodedResponse['candidates'][0]['content']['parts'][0]['text'])) {
            $botReply = $decodedResponse['candidates'][0]['content']['parts'][0]['text'];
            echo $botReply;
        } else {
            // Fallback if the API structure changes or returns an error payload
             if (isset($decodedResponse['error']['message'])) {
                 echo "API Error: " . $decodedResponse['error']['message'];
             } else {
                 echo "Sorry, I couldn't process your request at the moment.";
             }
        }
    }

    curl_close($ch);
} else {
    echo "No message received.";
}
?>
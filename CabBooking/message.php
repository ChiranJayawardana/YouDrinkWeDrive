<?php
// Created By Chiran - Updated to use Gemini API with system-specific responses only

if (isset($_POST['text'])) {
    $userMessage = trim($_POST['text']);
    
    // Check if message is empty
    if (empty($userMessage)) {
        echo "Please enter a message.";
        exit;
    }
    
    $apiKey = 'AIzaSyDrUTMmTVAZmE2jfqZhh8kvAqvzoCT2H2g'; // Replace with your actual Gemini API Key
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;

    // System prompt to restrict responses to cab booking system only
    $systemPrompt = "You are a helpful assistant for a Cab Booking System called 'You Drink We Drive'. 
    
IMPORTANT RULES:
1. ONLY answer questions related to the cab booking system, booking process, driver availability, account management, booking status, payment, cancellation, or system features.
2. If the user asks about topics NOT related to the cab booking system (such as general knowledge, other services, personal questions, weather, news, etc.), politely decline and redirect them to ask system-related questions.
3. Provide helpful, accurate information about:
   - How to book a driver/cab
   - How to view booking history
   - How to manage account details
   - Driver availability
   - Booking status (Pending, Confirmed, Pickup, Completed, Cancelled)
   - Payment and fees
   - Cancellation process
   - Registration and login
   - Contact information
   - System features and functionality

4. Keep responses concise and friendly.
5. If unsure if a question is system-related, ask the user to clarify or rephrase their question about the cab booking system.

User's question: " . $userMessage;

    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $systemPrompt]
                ]
            ]
        ],
        "generationConfig" => [
            "temperature" => 0.7,
            "topK" => 40,
            "topP" => 0.95,
            "maxOutputTokens" => 500
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
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        echo "Sorry, I'm having trouble connecting right now. Please try again later.";
    } else {
        $decodedResponse = json_decode($response, true);
        
        // Check if candidates exist and have content
        if (isset($decodedResponse['candidates'][0]['content']['parts'][0]['text'])) {
            $botReply = trim($decodedResponse['candidates'][0]['content']['parts'][0]['text']);
            
            // Additional check: If response seems unrelated, provide a default message
            $unrelatedKeywords = ['weather', 'news', 'sports', 'politics', 'recipe', 'joke', 'story', 'poem', 'song'];
            $messageLower = strtolower($userMessage);
            $replyLower = strtolower($botReply);
            
            // Check if user message contains unrelated keywords and response doesn't redirect
            $isUnrelated = false;
            foreach ($unrelatedKeywords as $keyword) {
                if (strpos($messageLower, $keyword) !== false && 
                    strpos($replyLower, 'cab booking') === false && 
                    strpos($replyLower, 'system') === false &&
                    strpos($replyLower, 'booking') === false) {
                    $isUnrelated = true;
                    break;
                }
            }
            
            if ($isUnrelated) {
                echo "I'm here to help you with questions about our Cab Booking System. Please ask me about booking a driver, checking your bookings, managing your account, or any other system-related questions. How can I assist you with the cab booking system?";
            } else {
                echo $botReply;
            }
        } else {
            // Fallback if the API structure changes or returns an error payload
            if (isset($decodedResponse['error']['message'])) {
                echo "I apologize, but I'm only able to answer questions about our Cab Booking System. Please ask me about booking drivers, managing your account, or other system-related topics.";
            } else {
                echo "I'm here to help you with questions about our Cab Booking System. Please ask me about booking a driver, checking your bookings, managing your account, or any other system-related questions.";
            }
        }
    }

    curl_close($ch);
} else {
    echo "No message received. Please ask me a question about our Cab Booking System.";
}
?>
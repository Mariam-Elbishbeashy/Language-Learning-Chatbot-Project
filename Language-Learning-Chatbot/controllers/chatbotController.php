<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *'); // Allow all origins

    $userInput = $_POST['message'] ?? '';

    if (empty($userInput)) {
        echo json_encode(['error' => 'Message is required']);
        exit;
    }

    //place of the key

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful language learning assistant. Respond to queries in a way that helps users practice and improve their chosen language.'],
            ['role' => 'user', 'content' => $userInput]
        ]
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Request error: ' . curl_error($ch)]);
    } elseif ($httpCode !== 200) {
        echo json_encode(['error' => 'API returned an error: ' . $response]);
    } else {
        $result = json_decode($response, true);
        echo json_encode([
            'reply' => $result['choices'][0]['message']['content'] ?? 'No response from ChatGPT'
        ]);
    }

    curl_close($ch);
}
?>

<?php
require_once '../config/dbh.inc.php';

class ChatbotController {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *'); // Allow all origins

            $userInput = $_POST['message'] ?? '';

            if (empty($userInput)) {
                echo json_encode(['error' => 'Message is required']);
                exit;
            }

            $response = $this->sendToApi($userInput);

            if (isset($response['error'])) {
                echo json_encode(['error' => $response['error']]);
            } else {
                echo json_encode([
                    'reply' => $response['reply'] ?? 'No response from ChatGPT'
                ]);
            }
        } else {
            echo json_encode(['error' => 'Invalid request method']);
        }
    }

    private function sendToApi($userInput) {
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
            'Authorization: Bearer ' . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return ['error' => 'Request error: ' . curl_error($ch)];
        } elseif ($httpCode !== 200) {
            return ['error' => 'API returned an error: ' . $response];
        } else {
            $result = json_decode($response, true);
            return [
                'reply' => $result['choices'][0]['message']['content'] ?? null
            ];
        }

        curl_close($ch);
    }
}

// Create an instance and handle the request
//key place hereeee 
$chatbotController = new ChatbotController($apiKey);
$chatbotController->handleRequest();

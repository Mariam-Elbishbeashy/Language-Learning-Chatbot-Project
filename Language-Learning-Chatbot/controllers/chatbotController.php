<?php
require_once '../config/dbh.inc.php';
session_start();

class ChatbotController {
    private $apiKey;
    private $conn;

    public function __construct($apiKey, $conn) {
        $this->apiKey = $apiKey;
        $this->conn = $conn; 
    }

    public function handleRequest() {
        if (!isset($_SESSION['userId'])) {
            echo json_encode(['error' => 'User not authenticated']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');

            $userInput = $_POST['message'] ?? '';

            if (empty($userInput)) {
                echo json_encode(['error' => 'Message is required']);
                exit;
            }

            $chatId = $this->findOrCreateChatSession($userInput);
            $response = $this->sendToApi($userInput);

            if (isset($response['error'])) {
                echo json_encode(['error' => $response['error']]);
            } else {
                echo json_encode([
                    'reply' => $response['reply'] ?? 'No response from ChatGPT'
                ]);
            }

            // Log the conversation in database
            $this->saveToDatabase($chatId, $userInput, $response['reply'] ?? 'No response from ChatGPT');
        } else {
            echo json_encode(['error' => 'Invalid request method']);
        }
    }

    /**
     * Handle finding or creating the first session and generating the chat title using ChatGPT.
     */
    private function findOrCreateChatSession($userInput) {
        $userId = $_SESSION['userId'];

        // Check if there is an active session for this user
        $sql = "SELECT id FROM Chats WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $chat = $result->fetch_assoc();
            $stmt->close();
            return $chat['id'];
        }

        // No session found, call the API to generate a chat title
        $stmt->close();
        $chatTitle = $this->generateDynamicChatTitle($userInput);

        // Save new session with chatbot-generated title
        $sql = "INSERT INTO Chats (user_id, title) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $chatTitle);
        $stmt->execute();

        return $this->conn->insert_id;
    }

    /**
     * Call the chatbot API with the first user input to generate a title.
     */
    private function generateDynamicChatTitle($userInput) {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant that can generate concise titles based on user context or input. Create a relevant, short, and contextually appropriate title for this chat session.'],
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
            error_log("ChatGPT API Request error: " . curl_error($ch));
            return 'New Chat Session';
        }

        if ($httpCode !== 200) {
            error_log("Error with ChatGPT API response: $response");
            return 'New Chat Session';
        }

        $result = json_decode($response, true);

        return trim($result['choices'][0]['message']['content'] ?? 'New Chat Session');
    }

    public function sendToApi($userInput) {
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
        if ($response) {
            $result = json_decode($response, true);
            return [
                'reply' => $result['choices'][0]['message']['content'] ?? null
            ];
        }

        return ['error' => 'No response'];
    }

    public function saveToDatabase($chatId, $userInput, $chatbotResponse) {
        $userId = $_SESSION['userId'];

        $sql = "INSERT INTO ChatMessages (chat_id, user_id, message, response) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iiss", $chatId, $userId, $userInput, $chatbotResponse);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Create an instance and handle the request
$apiKey = getenv('OPENAI_API_KEY');
$chatbotController = new ChatbotController($apiKey, $conn);
$chatbotController->handleRequest();

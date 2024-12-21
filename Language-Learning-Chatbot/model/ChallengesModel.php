<?php
require_once __DIR__ . '/../model/Model.php'; 


class ChallengesModel extends Model {
    private $apiKey;
    protected $conn;

    public function __construct($apiKey, $conn) {
        $this->apiKey = $apiKey;
        $this->conn = $conn; 
    }
    //retrieve question from database to display it 
    public function getQuestionForUser($userId,  $category) {
        // Query to fetch question based on user's attributes
        $query = "
            SELECT cq.question_id, cq.question_text 
            FROM challenge_question cq
            JOIN users u 
            ON cq.language_category = u.language 
            AND cq.difficulty_level = u.difficulty_level
            WHERE u.ID = ?
            AND cq.challenge_category = ?
            ORDER BY RAND() 
            LIMIT 1;
        ";
        
        $stmt = $this->conn->prepare($query); // Use $this->conn from Model
        $stmt->bind_param('is', $userId, $category); // Bind the user ID and category
        $stmt->execute();
        
        $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        // Fetch the result if available
        $row = $result->fetch_assoc();
        return $row;
    } else {
        // No data found
        error_log("No question found for userId: $userId and category: $category");
        return null;
    }
    }

    public function saveUserInput($userId, $questionId, $userInput) {
        $query = "INSERT INTO challenge_data 
                  (user_id, question_id, user_input, ai_feedback, challenge_score, created_at) 
                  VALUES (?, ?, ?, '', '', NOW())";
        
        $stmt = $this->conn->prepare($query); // Use the connection from Model
        $stmt->bind_param(
            'iis', 
            $userId, 
            $questionId, 
            $userInput
        );
        
        if ($stmt->execute()) {
            return true; // Return true if insertion is successful
        } else {
            return false; // Return false if there’s an error
        }
    }

    
    
    public function handleRequest() {
        if (!isset($_SESSION['userId'])) {
            echo json_encode(['error' => 'User not authenticated']);
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return; // Ignore the error for non-POST requests
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
    
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
    
            // Log the conversation in database
            //$this->saveToDatabase($chatId, $userInput, $response['reply'] ?? 'No response from ChatGPT');
        } else {
            echo json_encode(['error' => 'Invalid request method']);
        }
    }
    
    
    public function sendToApi($userInput) {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a grammar checking assistant. Analyze the text for grammar mistakes and provide suggestions without altering the original meaning.'],
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
    
    public function savoToDatabase($userId, $questionId, $userInput) {
        $query = "INSERT INTO challenge_data 
                  (user_id, question_id, user_input, ai_feedback, challenge_score, created_at) 
                  VALUES (?, ?, ?, '', '', NOW())";
    
        $stmt = $this->conn->prepare($query); // Use the connection from Model
        $stmt->bind_param(
            'iis', 
            $userId, 
            $questionId, 
            $userInput
        );
    
        if ($stmt->execute()) {
            return true; // Return true if insertion is successful
        } else {
            return false; // Return false if there’s an error
        }
    }    

}
$apiKey = getenv('OPENAI_API_KEY');
$ChallengesModel = new ChallengesModel($apiKey, $conn);
$ChallengesModel->handleRequest();


<?php
require_once __DIR__ . '/../model/Model.php'; 


class ChallengesModel extends Model {
    private $apiKey;
    protected $conn;

    public function __construct( $conn) {
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

    public function checkGrammarAndSave($userInput, $chatId) {
        // Step 1: Send user input to the API to get grammar feedback
        $feedbackAI = $this->getGrammarFeedback($userInput);
    
        // Step 2: Save the user input and the grammar feedback to the database
        $this->saveToDatabase($chatId, $userInput, $feedbackAI);
    
        // Return the feedback for display
        return $feedbackAI;
    }
    
    private function getGrammarFeedback($userInput) {
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
            return $result['choices'][0]['message']['content'] ?? 'No feedback available.';
        }
    
        return 'Error: Unable to process your request.';
    }
    
    private function saveToDatabase($chatId, $userInput, $feedbackAI) {
        $userId = $_SESSION['userId'];
    
        $sql = "INSERT INTO ChatMessages (chat_id, user_id, message, response) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("iiss", $chatId, $userId, $userInput, $feedbackAI);
            $stmt->execute();
            $stmt->close();
        }
    }
    


}


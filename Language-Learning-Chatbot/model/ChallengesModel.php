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
            SELECT cq.question_text
            FROM challenge_question cq
            JOIN users u 
            ON cq.language_category = u.language 
            AND cq.difficulty_level = u.difficulty_level
            WHERE u.ID = ?
            AND cq.challenge_category = ?
            LIMIT 1;
        ";
        
        $stmt = $this->conn->prepare($query); // Use $this->conn from Model
        $stmt->bind_param('is', $userId, $category); // Bind the user ID and category
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            // Debugging: Log the issue
            error_log("No question found for user_id: $userId");
            error_log("Query: SELECT cq.question_text FROM challenge_question cq JOIN users u ON cq.language_category = u.language AND cq.difficulty_level = u.difficulty_level WHERE u.user_id = $userId LIMIT 1");
        }
    
        // Return the question_text or null if not found
        return $row ? $row['question_text'] : null;
    }

    public function saveUserInput($userId, $questionId, $userInput) {
        $query = "INSERT INTO challenge_data 
                  (user_id, question_id, user_input, ai_feedback, challenge_score, created_at) 
                  VALUES (?, ?, ?, NULL, NULL, NOW())";
        
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


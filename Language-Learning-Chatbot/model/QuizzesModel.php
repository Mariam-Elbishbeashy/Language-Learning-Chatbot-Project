<?php
require_once __DIR__ . '/../model/Model.php'; 

class QuizModel extends Model {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    public function getQuestionsByType($difficulty, $language, $type) {
        $query = "SELECT * FROM quiz_questions WHERE difficulty_level = ? AND language_category = ? AND question_type = ?";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters explicitly
        $stmt->bind_param('sss', $difficulty, $language, $type);
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    

    public function saveQuizAnswers($answers) {
        foreach ($answers as $question_id => $answer) {
            $query = "INSERT INTO user_quiz_answers (user_id, question_id, answer) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$_SESSION['userId'], $question_id, $answer]);
        }
    }

    public function getCorrectAnswers($questionIds) {
        $placeholders = implode(',', array_fill(0, count($questionIds), '?'));
        $query = "SELECT question_id, correct_answer FROM quiz_questions WHERE question_id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bind_param(str_repeat('i', count($questionIds)), ...$questionIds);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $correctAnswers = [];
        while ($row = $result->fetch_assoc()) {
            $correctAnswers[$row['question_id']] = $row['correct_answer'];
        }
        return $correctAnswers;
    }
    
}
?>

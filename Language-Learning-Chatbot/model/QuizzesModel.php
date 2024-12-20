<?php
require_once __DIR__ . '/../model/Model.php'; 
require_once  __DIR__ .'/../db/dbh.inc.php';
class QuizModel extends Model {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    public function getQuestionsForUser($userId,  $questionType) {
        $query = "
            SELECT 
                qq.question_id,
                qq.question_text,
                qq.option_a,
                qq.option_b,
                qq.option_c,
                qq.option_d,
                correct_answer,
                question_type
            FROM 
                quiz_questions qq
            INNER JOIN 
                users u 
            ON 
                qq.language_category = u.language
                AND qq.difficulty_level = u.difficulty_level
            WHERE 
                u.Id = ?
                AND qq.question_type = ?              
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $userId, $questionType);
        $stmt->execute();
        $result = $stmt->get_result();


        // Return the question_text or null if not found
        return $result->fetch_all(MYSQLI_ASSOC); // Return all rows
    }


    public function getConnection() {
        return $this->conn;
    }

    public function saveScore($userId, $score) {
        $query = "UPDATE users SET score = score + ? WHERE Id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ii", $score, $userId);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Database error: Unable to prepare statement.");
        }
    }

    public function getCurrentScore($userId) {
        $query = "SELECT score FROM users WHERE Id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $userId); // Assuming user_id is a string, adjust if it's an integer
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['score'] ?? 0;  // Default to 0 if no score is found
    }

}
?>

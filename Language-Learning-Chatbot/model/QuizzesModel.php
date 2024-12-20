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
                qq.option_d
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
    

}
?>

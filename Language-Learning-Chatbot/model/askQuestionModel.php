<?php
require_once __DIR__ . '/../model/Model2.php';

class askQuestionModel extends Model2 {

    // Method to save a question
    public function saveQuestion($userId, $title, $content, $category) {
        $this->conn->begin_transaction(); // Start transaction
        try {
            // Insert the question into forum_posts table
            $sql = "INSERT INTO forum_posts (user_id, title, content, category) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isss", $userId, $title, $content, $category);
            $stmt->execute();
    
            // Increment the postsCount in users table
            $updateSql = "UPDATE users SET postsCount = postsCount + 1 WHERE Id = ?";
            $updateStmt = $this->conn->prepare($updateSql);
            $updateStmt->bind_param("i", $userId);
            $updateStmt->execute();
    
            $this->conn->commit(); // Commit transaction
            return true;
        } catch (Exception $e) {
            $this->conn->rollback(); // Rollback transaction in case of error
            error_log("Error saving question or updating postsCount: " . $e->getMessage());
            return false;
        }
    }
    
    

}
    

?>

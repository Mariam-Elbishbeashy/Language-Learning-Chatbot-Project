<?php
require_once __DIR__ . '/../model/Model2.php';

class askQuestionModel extends Model2 {

    // Method to save a question
    public function saveQuestion($userId, $title, $content, $category) {
        echo "Inside saveQuestion method: <br>";
        var_dump($userId, $title, $content, $category);

        // SQL query to insert the question into the database
        $sql = "INSERT INTO forum_posts (user_id, title, content, category) VALUES (?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("isss", $userId, $title, $content, $category);

            // Debugging: Check if the query was executed successfully
            if ($stmt->execute()) {
                echo "Question saved to database successfully.<br>";
                return true;
            } else {
                echo "Error executing query: " . $stmt->error . "<br>";
                return false;
            }
        } else {
            echo "Error preparing query: " . $this->conn->error . "<br>";
            return false;
        }
    }
}
?>

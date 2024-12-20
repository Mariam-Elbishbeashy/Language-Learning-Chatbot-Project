<?php
require_once __DIR__ . '/../db/dbh.inc.php';  // Database connection

class CommentModel {
    public function saveComment($userId, $postId, $commentText) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO forum_comments (user_id, post_id, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $postId, $commentText);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error executing query: " . $stmt->error);
            return false;
        }
    }
}
?>

?>

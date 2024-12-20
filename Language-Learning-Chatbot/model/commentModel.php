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

    public function getCommentsByPostId($postId) {
        global $conn;
        $stmt = $conn->prepare("
            SELECT 
                fc.comment_text, 
                fc.created_at, 
                u.username, 
                u.profileImage 
            FROM 
                forum_comments fc
            JOIN 
                users u 
            ON 
                fc.user_id = u.Id
            WHERE 
                fc.post_id = ?
            ORDER BY 
                fc.created_at DESC
        ");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    
        return $comments;
    }
    
}
?>


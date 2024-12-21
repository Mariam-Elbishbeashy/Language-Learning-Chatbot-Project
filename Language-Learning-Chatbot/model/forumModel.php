<?php
require_once __DIR__ . '/../model/Model2.php';

class forumModel extends Model2 {

    public function getQuestions() {
        $sql = "SELECT forum_posts.post_id, forum_posts.title, forum_posts.content, forum_posts.category, forum_posts.created_at, users.username, users.profileImage
                FROM forum_posts
                INNER JOIN users ON forum_posts.user_id = users.Id
                ORDER BY forum_posts.created_at DESC";
    
        $result = $this->conn->query($sql);
        $questions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Decode both title and content before returning
                $row['title'] = html_entity_decode($row['title'], ENT_QUOTES, 'UTF-8');
                $row['content'] = html_entity_decode($row['content'], ENT_QUOTES, 'UTF-8');
                $questions[] = $row;
            }
        }
    
        return $questions;
    }    

    public function getTopUsers() {
        $sql = "SELECT username, profileImage, postsCount FROM users ORDER BY postsCount DESC LIMIT 5";
        $result = $this->conn->query($sql);

        $topUsers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topUsers[] = $row;
            }
        }
        return $topUsers;
    }
    
}
?>

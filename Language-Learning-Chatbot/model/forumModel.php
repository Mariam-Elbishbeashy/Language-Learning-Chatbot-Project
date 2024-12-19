<?php
require_once __DIR__ . '/../model/Model2.php';

class forumModel extends Model2 {

    public function getQuestions() {
        $sql = "SELECT forum_posts.post_id, forum_posts.title, forum_posts.content, forum_posts.category, forum_posts.created_at, users.username, users.profileImage
                FROM forum_posts
                INNER JOIN users ON forum_posts.user_id = users.Id
                ORDER BY forum_posts.created_at DESC";
    
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }    
    
}
?>

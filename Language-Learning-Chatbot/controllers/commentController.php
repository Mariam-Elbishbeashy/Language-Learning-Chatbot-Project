<?php
require_once __DIR__ . '/../model/commentModel.php';

class CommentController {
    public function submitComment($userId, $postId, $commentText) {
        $commentModel = new CommentModel();
        $isSaved = $commentModel->saveComment($userId, $postId, $commentText);

        if ($isSaved) {
            // Redirect back to the forum page with the post ID as a hash
            header("Location: ../../public/forum.php#$postId");
            exit();
        } else {
            header("Location: ../../public/error.php");
            exit();
        }
    }
}
?>

?>

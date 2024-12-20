<?php
session_start();

if (!isset($_SESSION['userId'])) {
    // Handle the case where user ID is not set in the session
    header("Location: ../../public/error.php");
    exit();
}

// Require necessary files
require_once __DIR__ . '/../model/commentModel.php';
require_once __DIR__ . '/../controllers/commentController.php';

// Handle the comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment_text']) && !empty($_POST['comment_text']) && isset($_POST['post_id']) && !empty($_POST['post_id'])) {
        $commentText = $_POST['comment_text'];
        $postId = $_POST['post_id'];
        $userId = $_SESSION['userId']; // Get the user ID from session

        // Call the Comment Controller to handle saving the comment
        $commentController = new CommentController();
        $commentController->submitComment($userId, $postId, $commentText);
    } else {
        // Handle the case where required fields are missing
        header("Location: ../../public/error.php");
        exit();
    }
}
?>

?>

<?php
session_start();
require_once __DIR__ . '/../model/askQuestionModel.php';

// Debugging: Log the incoming request
error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
error_log("POST Data: " . json_encode($_POST));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['publishQuestion'])) {
    // Debugging: Check if the form is processed
    echo "Form is being processed.<br>";

    // Debug session and input values
    echo "Session userId: " . (isset($_SESSION['userId']) ? $_SESSION['userId'] : 'No User ID in session') . "<br>";  // Shows the session variable
    var_dump($_POST['title'], $_POST['content'], $_POST['category']);  // Shows the values from the form

    if (isset($_SESSION['userId']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])) {
        $userId = $_SESSION['userId'];
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $category = htmlspecialchars(trim($_POST['category']));

        // Debugging: Check before calling the model
        echo "Before calling the model.<br>";

        // Create an instance of the askQuestionModel
        $askQuestionModel = new askQuestionModel();

        // Debugging: Check if model method is being called
        echo "Calling saveQuestion method.<br>";
        $isSaved = $askQuestionModel->saveQuestion($userId, $title, $content, $category);

        // Debugging: Check if the save was successful
        if ($isSaved) {
            echo "Question saved successfully.<br>";
            header("Location: ../../public/forum.php");
            exit();
        } else {
            echo "Database error occurred while saving the question.<br>";
            exit();
        }
    } else {
        echo "Validation failed: Required fields are empty.<br>"; 
        exit();
    }
}
?>

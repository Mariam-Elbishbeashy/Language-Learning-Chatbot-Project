<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/ChallengesModel.php';

class ChallengesController extends Controller {
    
    public function getQuestionForUser($userId, $category) {
        // Fetch the question text using the model
        $questionText = $this->model->getQuestionForUser($userId, $category);

        if ($questionText) {
            echo $questionText; // Directly output the question_text
        } else {
            echo 'Error: No suitable question found'; // Handle case where no question matches
        }
    }

    public function saveChallengeData() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['userId'];
            $questionId = intval($_POST['question_id']);
            $userInput = trim($_POST['user_input']);
    
            if (!$questionId || empty($userInput)) {
                echo json_encode(['success' => false, 'message' => 'Invalid question or empty input.']);
                return;
            }
    
            $isSaved = $this->model->saveUserInput($userId, $questionId, $userInput);
    
            if ($isSaved) {
                echo json_encode(['success' => true, 'message' => 'Challenge data saved successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save challenge data.']);
            }
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
    
}

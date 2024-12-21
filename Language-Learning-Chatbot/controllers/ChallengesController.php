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
}

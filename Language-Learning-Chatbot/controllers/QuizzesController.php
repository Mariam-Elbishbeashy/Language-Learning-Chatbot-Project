<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/QuizzesModel.php';

class QuizzesController extends Controller {
    
    public function getQuizQuestions($userId, $questionType) {
        $quizQuestions = $this->model->getQuestionsForUser($userId, $questionType);
        return $quizQuestions;
    }

    public function handleQuizSubmission($quizQuestions, $userAnswers, $userId) {
        $feedback = [];
        $score = 0;

        foreach ($quizQuestions as $question) {
            if ($question && isset($userAnswers[$question['question_id']])) {
                $correctAnswer = $question['correct_answer'];

                if ($userAnswers[$question['question_id']] == $correctAnswer) {
                    $feedback[$question['question_id']] = [
                        'is_correct' => true,
                        'correct_answer' => $correctAnswer
                    ];
                    $score+=5;
                } else {
                    $feedback[$question['question_id']] = [
                        'is_correct' => false,
                        'correct_answer' => $correctAnswer
                    ];
                }
            }
        }

        // Save the score using the model
        $this->model->saveScore($userId, $score);

        return [
            'feedback' => $feedback,
            'score' => $score
        ];
    }

    public function addScoreToDatabase($userId, $newScore) {
        // Get the current score from the database
        $currentScore = $this->model->getCurrentScore($userId);

        // Add the new score to the current score
        $totalScore = $currentScore + $newScore;

        // Update the total score in the database
        $this->model->saveScore($userId, $totalScore);
    }

    public function CurrentScore($userId){
        $currentScore = $this->model->getCurrentScore($userId);
        return $currentScore;
    }
    
}
?>

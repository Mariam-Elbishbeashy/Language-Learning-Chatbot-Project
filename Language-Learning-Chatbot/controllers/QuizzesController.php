<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/QuizzesModel.php';

class QuizzesController extends Controller {
    private $quizModel;

    public function __construct($conn) {
        $this->quizModel = new QuizModel($conn);
    }

    public function getQuizQuestions($difficulty, $language) {
        return [
            'mcq1' => $this->quizModel->getQuestionsByType($difficulty, $language, 'mcq')[0] ?? null,
            'fillInTheBlank' => $this->quizModel->getQuestionsByType($difficulty, $language, 'fill-in-the-blank')[0] ?? null,
            'trueFalse' => $this->quizModel->getQuestionsByType($difficulty, $language, 'true/false')[0] ?? null,
            'mcq2' => $this->quizModel->getQuestionsByType($difficulty, $language, 'mcq')[1] ?? null,
            'mcq3' => $this->quizModel->getQuestionsByType($difficulty, $language, 'mcq')[2] ?? null,
        ];
    }    

    public function submitQuiz($data) {
        $this->quizModel->saveQuizAnswers($data);
    }

    
}
?>
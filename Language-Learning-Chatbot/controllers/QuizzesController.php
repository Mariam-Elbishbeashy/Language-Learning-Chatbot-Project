<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/QuizzesModel.php';

class QuizzesController extends Controller {
    
    public function getQuizQuestions($userId, $questionType) {
        $quizQuestions = $this->model->getQuestionsForUser($userId, $questionType);
        return $quizQuestions;
    }
}
?>

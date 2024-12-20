<?php
session_start();
require_once __DIR__ . '/../model/forumModel.php';

class forumController {
    private $forumModel;

    public function __construct() {
        $this->forumModel = new forumModel();
    }

    public function loadQuestions() {
        return $this->forumModel->getQuestions();
    }
}
?>

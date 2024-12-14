<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/ChatbotModel.php';
class ChatbotController extends Controller{
    
    public function handle() {
		$this->model->handleRequest();
	}
}
?>
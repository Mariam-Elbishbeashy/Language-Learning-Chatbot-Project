<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/UserModel.php';
class UserController extends Controller{
    
    public function edit() {
		$this->model->handleProfileUpdate();
	}
}
?>

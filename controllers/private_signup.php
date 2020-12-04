<?php

class Private_Signup extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	public function index() {
		$this->view->render('private_signup/inc/header');
		$this->view->render('private_signup/index');
		$this->view->render('private_signup/inc/footer');
	}
	
	public function signPrivate(){
		$this->model->signPrivate();
	}

}
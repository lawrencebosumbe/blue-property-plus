<?php

class Signup extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	public function index() {
		//$this->view->render('agent_signup/inc/header');
		$this->view->render('signup/index');
		//$this->view->render('agent_signup/inc/footer');
	}
	
	//Add agent
	public function addAgent(){									
		$this->model->addAgent();	
		header('location: ' . URL . 'signup');
	}

}
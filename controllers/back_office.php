<?php

class Back_Office extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();	
	}
	
	public function index() {	
		$this->view->render('back_office/index');
	}
	
	public function logout(){
		Session::destroy();
		header('location: ' . URL . 'login');
	}
	
	public function getAgentPosts(){
		$this->view->getAgentPosts = $this->model->getAgentPosts();
		$this->view->render('back_office/index');
	}
	
	public function payment(){
		//$this->view->getPayment = $this->model->getPayment();
		$this->view->render('back_office/payment');
	}
	
}
<?php

class Payment extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();	
	}
	
	public function index() {	
		$this->view->render('payment/index');
	}
	
	public function logout(){
		Session::destroy();
		header('location: ' . URL . 'login');
	}
	
	public function payment(){
		//$this->view->getPayment = $this->model->getPayment();
		$this->view->render('payment/payment');
	}
	
	public function confirm_payment(){
		//$this->view->getPayment = $this->model->getPayment();
		$this->view->render( 'payment/confirm_payment');
	}
	
	public function pay(){
		//$this->view->getPayment = $this->model->getPayment();
		$this->view->render( 'payment/pay');
	}
	
}
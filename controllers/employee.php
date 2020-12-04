<?php

class Employee_Signup extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->render('employee_signup/index');
	}	

}
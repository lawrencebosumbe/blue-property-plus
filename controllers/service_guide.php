<?php

class Service_Guide extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->render('service_guide/index');
	}	
	
	public function room_display() {	
		$this->view->render('service_guide/room_display');
	}
	
	public function inner_city() {	
		$this->view->render('service_guide/inner_city');
	}
	
	public function neighborhood() {	
		$this->view->render('service_guide/neighborhood');
	}

}
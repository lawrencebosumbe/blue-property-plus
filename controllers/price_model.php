<?php

class Price_Model extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->render('price_model/index');
	}	

}
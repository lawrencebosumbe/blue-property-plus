<?php
	class Property_Listing extends Controller{

		public function __construct(){
			parent::__construct();
		}			

		public function index(){
			$this->view->addProperty = $this->model->addProperty();
			$this->view->render('property_listing/index');
		}
		
		public function addProperty(){
			$this->model->addProperty();
			header('location:' . URL . 'property_listing/');
		}
	}



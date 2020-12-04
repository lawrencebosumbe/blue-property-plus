<?php
	class Property_Listing_Status extends Controller{

		public function __construct(){
			parent::__construct();
		}			

		public function index(){
			$this->view->addProperty = $this->model->addProperty();
			$this->view->render('property_listing_status/index');
		}
		
		public function addProperty(){
			$this->model->addProperty();
			header('location:' . URL . 'property_listing_status');
		}
	}



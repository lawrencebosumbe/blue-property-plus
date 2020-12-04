<?php
	class Commercial extends Controller{
		private $city_name;
		public function __construct(){
			parent::__construct();
			$this->city_name = '';
		}
		
		public function index(){								
			$this->view->render('gauteng/commercial/index');
		}		
		
		//Get single suburb
		public function suburb_forsale($suburb_id){	
		$this->view->commercial = $this->model->getSuburb($suburb_id);
		if (empty($this->view->commercial)) {
			die('This is an invalid city!');
		}
											
		$this->view->render('commercial/suburb_forsale');
		}
		
		//Get single city
		public function city_forsale($city_id){	
		$this->view->commercial = $this->model->getCity($city_id);;
		if (empty($this->view->commercial)) {
			die('This is an invalid city!');
		}
											
		$this->view->render('commercial/city_forsale');
		}	
		
	}
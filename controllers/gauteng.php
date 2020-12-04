<?php
	class Gauteng extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){	
			//$this->view->render('gauteng/inc/header');							
			$this->view->render('gauteng/index');
			//$this->view->render('gauteng/inc/footer');	
		}		
		
		//municipalities
		public function johannesburg(){	
			$this->view->render('gauteng/johannesburg/index');	
		}
		
		public function pretoria(){	
			$this->view->render('gauteng/pretoria/index');				
		}
		
		public function ekurhuleni(){	
			$this->view->render('gauteng/ekurhuleni/index');				
		}
		
		public function emfuleni(){	
			$this->view->render('gauteng/emfuleni/index');				
		}	
		
		public function lesedi(){	
			$this->view->render('gauteng/lesedi/index');				
		}	
		
		public function merafong(){	
			$this->view->render('gauteng/merafong/index');				
		}
		
		public function midvaal(){	
			$this->view->render('gauteng/midvaal/index');				
		}
		
		public function mogale(){	
			$this->view->render('gauteng/mogale/index');				
		}
		
		public function rand_west(){	
			$this->view->render('gauteng/rand_west/index');				
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->gauteng = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->gauteng)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('gauteng/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->gauteng = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->gauteng)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('gauteng/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->gauteng = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->gauteng)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('gauteng/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->gauteng = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->gauteng)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('gauteng/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->gauteng = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->gauteng)) {
					die('This is an invalid city!');
				}
			$this->view->render('gauteng/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->gauteng = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->gauteng)) {
					die('This is an invalid city!');
				}
			$this->view->render('gauteng/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->gauteng = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->gauteng)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('gauteng/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->gauteng = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->gauteng)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('gauteng/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->gauteng = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->gauteng)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('gauteng/to_rent_gallery/index');
		}

	}
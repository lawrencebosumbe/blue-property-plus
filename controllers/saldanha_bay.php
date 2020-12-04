<?php
	class Saldanha_Bay extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('western_cape/saldanha_bay/index');	
		}		
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->saldanha_bay = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->saldanha_bay)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('saldanha_bay/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->sub = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->sub)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('saldanha_bay/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->saldanha_bay = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->saldanha_bay)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('saldanha_bay/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->saldanha_bay = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->saldanha_bay)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('saldanha_bay/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->saldanha_bay = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->saldanha_bay)) {
					die('This is an invalid city!');
				}
			$this->view->render('saldanha_bay/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->saldanha_bay = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->saldanha_bay)) {
					die('This is an invalid city!');
				}
			$this->view->render('saldanha_bay/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->saldanha_bay = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->saldanha_bay)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('saldanha_bay/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->saldanha_bay = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->saldanha_bay)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('saldanha_bay/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->saldanha_bay = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->saldanha_bay)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('saldanha_bay/to_rent_gallery/index');
		}
	}
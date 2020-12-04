<?php
	class Tswelopele extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('free_state/tswelopele/index');	
		}		
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->suburb = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->suburb)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('tswelopele/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->suburb_on_show = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->suburb_on_show)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('tswelopele/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->suburb_to_rent = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->suburb_to_rent)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('tswelopele/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->municipal_city = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->municipal_city)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('tswelopele/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->city_on_show = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->city_on_show)) {
					die('This is an invalid city!');
				}
			$this->view->render('tswelopele/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->city_to_rent = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->city_to_rent)) {
					die('This is an invalid city!');
				}
			$this->view->render('tswelopele/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->gallery = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->gallery)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('tswelopele/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->gallery_on_show = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->gallery_on_show)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('tswelopele/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->gallery_to_rent = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->gallery_to_rent)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('tswelopele/to_rent_gallery/index');
		}
	}
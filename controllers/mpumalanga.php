<?php
	class Mpumalanga extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('mpumalanga/index');
		}		
		
		//municipalities
		public function bushbuckridge(){	
			$this->view->render('mpumalanga/bushbuckridge/index');	
		}
		
		public function mbombela(){	
			$this->view->render('mpumalanga/mbombela/index');				
		}
		
		public function nkomazi(){	
			$this->view->render('mpumalanga/nkomazi/index');				
		}
		
		public function thaba_chewu(){	
			$this->view->render('mpumalanga/thaba_chewu/index');				
		}	
		
		public function chief_albert_luthuli(){	
			$this->view->render('mpumalanga/chief_albert_luthuli/index');				
		}	
		
		public function dipaleseng(){	
			$this->view->render('mpumalanga/dipaleseng/index');				
		}
		
		public function pixley_ka_isaka_seme(){	
			$this->view->render('mpumalanga/pixley_ka_isaka_seme/index');				
		}
		
		public function govan_mbeki(){	
			$this->view->render('mpumalanga/govan_mbeki/index');				
		}
		
		public function lekwa(){	
			$this->view->render('mpumalanga/lekwa/index');				
		}
		
		public function mkhondo(){	
			$this->view->render('mpumalanga/mkhondo/index');				
		}
		
		public function msukaligwa(){	
			$this->view->render('mpumalanga/msukaligwa/index');				
		}
		
		public function js_moroka(){	
			$this->view->render('mpumalanga/js_moroka/index');				
		}
		
		public function emalaleni(){	
			$this->view->render('mpumalanga/emalaleni/index');				
		}
		
		public function emakhazeni(){	
			$this->view->render('mpumalanga/emakhazeni/index');				
		}
		
		public function steve_tshwete(){	
			$this->view->render('mpumalanga/steve_tshwete/index');				
		}
		
		public function thembisile_hani(){	
			$this->view->render('mpumalanga/thembisile_hani/index');				
		}
		
		public function victor_khanye(){	
			$this->view->render('mpumalanga/victor_khanye/index');				
		}
		
				
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->mpumalanga = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->mpumalanga)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('mpumalanga/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->mpumalanga = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->mpumalanga)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('mpumalanga/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->mpumalanga = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->mpumalanga)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('mpumalanga/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->mpumalanga = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->mpumalanga)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('mpumalanga/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->mpumalanga = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->mpumalanga)) {
					die('This is an invalid city!');
				}
			$this->view->render('mpumalanga/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->mpumalanga = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->mpumalanga)) {
					die('This is an invalid city!');
				}
			$this->view->render('mpumalanga/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->mpumalanga = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->mpumalanga)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('mpumalanga/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->mpumalanga = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->mpumalanga)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('mpumalanga/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->mpumalanga = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->mpumalanga)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('mpumalanga/to_rent_gallery/index');
		}

	}
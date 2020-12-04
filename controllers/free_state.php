<?php
	class Free_State extends Controller{
		public function __construct(){
			parent::__construct();
		}	
		
		public function index(){
			$this->view->render('free_state/index');
		}
		
		public function dihlabeng(){
			$this->view->render('free_state/dihlabeng/index');
		}	
		public function kopanong(){
			$this->view->render('free_state/kopanong/index');
		}
		public function letsemeng(){
			$this->view->render('free_state/letsemeng/index');
		}
		public function mafube(){
			$this->view->render('free_state/mafube/index');
		}
		public function maluti_a_phofung(){
			$this->view->render('free_state/maluti_a_phofung/index');
		}
		public function mangaung_metropolitan(){
			$this->view->render('free_state/mangaung_metropolitan/index');
		}
		public function mantsopa(){
			$this->view->render('free_state/mantsopa/index');
		}
		public function masilonyana(){
			$this->view->render('free_state/masilonyana/index');
		}
		public function matjhabeng(){
			$this->view->render('free_state/matjhabeng/index');
		}
		public function metsimaholo(){
			$this->view->render('free_state/metsimaholo/index');
		}
		public function mohokare(){
			$this->view->render('free_state/mohokare/index');
		}
		public function moqhaka(){
			$this->view->render('free_state/moqhaka/index');
		}
		public function nala(){
			$this->view->render('free_state/nala/index');
		}
		public function ngwathe(){
			$this->view->render('free_state/ngwathe/index');
		}
		public function nketoana(){
			$this->view->render('free_state/nketoana/index');
		}
		public function phumelela(){
			$this->view->render('free_state/phumelela/index');
		}
		public function setseto(){
			$this->view->render('free_state/setseto/index');
		}
		public function tokologo(){
			$this->view->render('free_state/tokologo/index');
		}
		public function tswelopele(){
			$this->view->render('free_state/tswelopele/index');
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->free_state = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->free_state )) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('free_state/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->free_state = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->free_state)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('free_state/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->free_state = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->free_state)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('free_state/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->free_state = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->free_state)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('free_state/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->free_state = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->free_state)) {
					die('This is an invalid city!');
				}
			$this->view->render('free_state/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->free_state = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->free_state)) {
					die('This is an invalid city!');
				}
			$this->view->render('free_state/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->free_state = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->free_state)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('free_state/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->free_state = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->free_state)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('free_state/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->free_state = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->free_state)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('free_state/to_rent_gallery/index');
		}
	}

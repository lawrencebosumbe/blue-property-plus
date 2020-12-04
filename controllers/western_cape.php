<?php
	class Western_Cape extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){							
			$this->view->render('western_cape/index');	
		}		
		
		public function cape_town(){	
			$this->view->render('western_cape/cape_town/index');	
		}
		
		public function breede_valley(){	
			$this->view->render('western_cape/breede_valley/index');	
		}
		
		public function drakenstein(){	
			$this->view->render('western_cape/drakenstein/index');	
		}
		
		public function stellenbosch(){	
			$this->view->render('western_cape/stellenbosch/index');	
		}
		
		public function witzenberg(){	
			$this->view->render('western_cape/witzenberg/index');	
		}
		
		public function langeberg(){	
			$this->view->render('western_cape/langeberg/index');	
		}
		
		public function george(){	
			$this->view->render('western_cape/george/index');	
		}
		
		public function cape_agulhas(){	
			$this->view->render('western_cape/cape_agulhas/index');	
		}
		
		public function bergrivier(){	
			$this->view->render('western_cape/bergrivier/index');	
		}
		
		public function swartland(){	
			$this->view->render('western_cape/swartland/index');	
		}
		
		public function beaufort_west(){	
			$this->view->render('western_cape/beaufort_west/index');	
		}
		
		public function laingsburg(){	
			$this->view->render('western_cape/laingsburg/index');	
		}
		
		public function hessequa(){	
			$this->view->render('western_cape/hessequa/index');	
		}
		
		public function overstrand(){	
			$this->view->render('western_cape/overstrand/index');	
		}
		
		public function cederberg(){	
			$this->view->render('western_cape/cederberg/index');	
		}
		
		public function oudtshoorn(){	
			$this->view->render('western_cape/oudtshoorn/index');	
		}
		
		public function prince_albert(){	
			$this->view->render('western_cape/prince_albert/index');	
		}
		
		public function kannaland(){	
			$this->view->render('western_cape/kannaland/index');	
		}
		
		public function swellendam(){	
			$this->view->render('western_cape/swellendam/index');	
		}
		
		public function matzikama(){	
			$this->view->render('western_cape/matzikama/index');	
		}
		
		public function mossel_bay(){	
			$this->view->render('western_cape/mossel_bay/index');	
		}
		
		public function bitou(){	
			$this->view->render('western_cape/bitou/index');	
		}
		
		public function knysna(){	
			$this->view->render('western_cape/knysna/index');	
		}
		
		public function theewaterskloof(){	
			$this->view->render('western_cape/theewaterskloof/index');	
		}
		
		public function saldanha_bay(){	
			$this->view->render('western_cape/saldanha_bay/index');	
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->western_cape = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->western_cape)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('western_cape/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->western_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->western_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('western_cape/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->western_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->western_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('western_cape/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->western_cape = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->western_cape)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('western_cape/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->western_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->western_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('western_cape/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->western_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->western_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('western_cape/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->western_cape = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->western_cape)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('western_cape/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->western_cape = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->western_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('western_cape/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->western_cape = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->western_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('western_cape/to_rent_gallery/index');
		}
		
	}
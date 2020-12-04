<?php
	class North_West extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){							
			$this->view->render('north_west/index');	
		}		
		
		//municipalities
		public function kgetlengrivier(){	
			$this->view->render('north_west/kgetlengrivier/index');	
		}
		
		public function madibeng(){	
			$this->view->render('north_west/madibeng/index');				
		}
		
		public function moretele(){	
			$this->view->render('north_west/moretele/index');				
		}
		
		public function moses_kotane(){	
			$this->view->render('north_west/moses_kotane/index');				
		}	
		
		public function rustenburg(){	
			$this->view->render('north_west/rustenburg/index');				
		}	
		
		public function matlosana(){	
			$this->view->render('north_west/matlosana/index');				
		}
		
		public function jb_marks(){	
			$this->view->render('north_west/jb_marks/index');				
		}
		
		public function maquassi_hills(){	
			$this->view->render('north_west/maquassi_hills/index');				
		}
		
		public function greater_taung(){	
			$this->view->render('north_west/greater_taung/index');				
		}
		
		public function kagisano_molopo(){	
			$this->view->render('north_west/kagisano_molopo/index');				
		}
		
		public function lekwa_teemane(){	
			$this->view->render('north_west/lekwa_teemane/index');				
		}
		
		public function mamusa(){	
			$this->view->render('north_west/mamusa/index');				
		}
		
		public function naledi(){	
			$this->view->render('north_west/naledi/index');				
		}
		
		public function ditsobotla(){	
			$this->view->render('north_west/ditsobotla/index');				
		}
		
		public function mafikeng(){	
			$this->view->render('north_west/mafikeng/index');				
		}
		
		public function ramotshere_moiloa(){	
			$this->view->render('north_west/ramotshere_moiloa/index');				
		}
		
		public function ratlou(){	
			$this->view->render('north_west/ratlou/index');				
		}
		
		public function tswaing(){	
			$this->view->render('north_west/tswaing/index');				
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->north_west = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->north_west)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('north_west/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->north_west = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->north_west)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('north_west/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->north_west = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->north_west)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('north_west/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->north_west = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->north_west)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('north_west/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->north_west = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->north_west)) {
					die('This is an invalid city!');
				}
			$this->view->render('north_west/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->north_west = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->north_west)) {
					die('This is an invalid city!');
				}
			$this->view->render('north_west/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->north_west = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->north_west)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('north_west/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->north_west = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->north_west)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('north_west/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->north_west = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->north_west)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('north_west/to_rent_gallery/index');
		}

	}
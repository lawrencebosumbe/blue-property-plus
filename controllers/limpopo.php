<?php
	class Limpopo extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('limpopo/index');	
		}		
		
		//municipalities
		public function blouberg(){	
			$this->view->render('limpopo/blouberg/index');	
		}
		
		public function phalaborwa(){	
			$this->view->render('limpopo/phalaborwa/index');	
		}
		
		public function maruleng(){	
			$this->view->render('limpopo/maruleng/index');	
		}
		
		public function makhuduthamaga(){	
			$this->view->render('limpopo/makhuduthamaga/index');	
		}
		
		public function thulamela(){	
			$this->view->render('limpopo/thulamela/index');	
		}
		
		public function mogalakwena(){	
			$this->view->render('limpopo/mogalakwena/index');	
		}
		
		public function lepelle_nkumpi(){	
			$this->view->render('limpopo/lepelle_nkumpi/index');	
		}
		
		public function giyani(){	
			$this->view->render('limpopo/giyani/index');	
		}
		
		public function elias_motsoaledi(){	
			$this->view->render('limpopo/elias_motsoaledi/index');	
		}
		
		public function collins_chabane(){	
			$this->view->render('limpopo/collins_chabane/index');	
		}
		
		public function bela_bela(){	
			$this->view->render('limpopo/bela_bela/index');	
		}
		
		public function thabazimbi(){	
			$this->view->render('limpopo/thabazimbi/index');	
		}
		
		public function molemole(){	
			$this->view->render('limpopo/molemole/index');	
		}
		
		public function letaba(){	
			$this->view->render('limpopo/letaba/index');	
		}
		
		public function ephraim_mogale(){	
			$this->view->render('limpopo/ephraim_mogale/index');	
		}
		
		public function makhado(){	
			$this->view->render('limpopo/makhado/index');	
		}
		
		public function lephalale(){	
			$this->view->render('limpopo/lephalale/index');	
		}
		
		public function polokwane(){	
			$this->view->render('limpopo/polokwane/index');	
		}
		
		public function tzaneen(){	
			$this->view->render('limpopo/tzaneen/index');	
		}
		
		public function fetakgomo(){	
			$this->view->render('limpopo/fetakgomo/index');	
		}
		
		public function musina(){	
			$this->view->render('limpopo/musina/index');	
		}
		
		public function modimolle(){	
			$this->view->render('limpopo/modimolle/index');	
		}
		
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->limpopo = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->limpopo)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('limpopo/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->limpopo = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->limpopo)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('limpopo/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->limpopo = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->limpopo)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('limpopo/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->limpopo = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->limpopo)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('limpopo/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->limpopo = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->limpopo)) {
					die('This is an invalid city!');
				}
			$this->view->render('limpopo/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->limpopo = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->limpopo)) {
					die('This is an invalid city!');
				}
			$this->view->render('limpopo/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->limpopo = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->limpopo)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('limpopo/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->limpopo = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->limpopo)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('limpopo/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->limpopo = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->limpopo)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('limpopo/to_rent_gallery/index');
		}

	}
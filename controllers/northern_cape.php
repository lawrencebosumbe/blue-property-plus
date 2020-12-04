<?php
	class Northern_Cape extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){							
			$this->view->render('northern_cape/index');	
		}		
		
		//municipalities
		public function dikgatlong(){	
			$this->view->render('northern_cape/dikgatlong/index');	
		}
		
		public function magareng(){	
			$this->view->render('northern_cape/magareng/index');				
		}
		
		public function phokwane(){	
			$this->view->render('northern_cape/phokwane/index');				
		}
		
		public function sol_plaatje(){	
			$this->view->render('northern_cape/sol_plaatje/index');				
		}	
		
		public function segonyana(){	
			$this->view->render('northern_cape/segonyana/index');				
		}	
		
		public function gamagara(){	
			$this->view->render('northern_cape/gamagara/index');				
		}
		
		public function joe_morolong(){	
			$this->view->render('northern_cape/joe_morolong/index');				
		}
		
		public function hantam(){	
			$this->view->render('northern_cape/hantam/index');				
		}
		
		public function kamiesberg(){	
			$this->view->render('northern_cape/kamiesberg/index');				
		}
		
		public function karoo_hoogland(){	
			$this->view->render('northern_cape/karoo_hoogland/index');				
		}
		
		public function khai_ma(){	
			$this->view->render('northern_cape/khai_ma/index');				
		}
		
		public function nama_khoi(){	
			$this->view->render('northern_cape/nama_khoi/index');				
		}
		
		public function richtersveld(){	
			$this->view->render('northern_cape/richtersveld/index');				
		}
		
		public function emthanjeni(){	
			$this->view->render('northern_cape/emthanjeni/index');				
		}
		
		public function kareeberg(){	
			$this->view->render('northern_cape/kareeberg/index');				
		}
		
		public function renosterberg(){	
			$this->view->render('northern_cape/renosterberg/index');				
		}
		
		public function siyancuma(){	
			$this->view->render('northern_cape/siyancuma/index');				
		}
		
		public function siyathemba(){	
			$this->view->render('northern_cape/siyathemba/index');				
		}
		
		public function thembelihle(){	
			$this->view->render('northern_cape/thembelihle/index');				
		}
		
		public function ubuntu(){	
			$this->view->render('northern_cape/ubuntu/index');				
		}
		
		public function umsobomvu(){	
			$this->view->render('northern_cape/umsobomvu/index');				
		}
		
		public function tsantsabane(){	
			$this->view->render('northern_cape/tsantsabane/index');				
		}
		
		public function kheis(){	
			$this->view->render('northern_cape/kheis/index');				
		}
		
		public function dawid_kruiper(){	
			$this->view->render('northern_cape/dawid_kruiper/index');				
		}
		
		public function kai_garib(){	
			$this->view->render('northern_cape/kai_garib/index');				
		}
		
		public function kgatelopele(){	
			$this->view->render('northern_cape/kgatelopele/index');				
		}
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->northern_cape = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->northern_cape)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('northern_cape/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->northern_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->northern_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('northern_cape/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->northern_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->northern_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('northern_cape/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->northern_cape = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->northern_cape)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('northern_cape/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->northern_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->northern_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('northern_cape/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->northern_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->northern_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('northern_cape/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->northern_cape = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->northern_cape)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('northern_cape/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->northern_cape = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->northern_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('northern_cape/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->northern_cape = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->northern_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('northern_cape/to_rent_gallery/index');
		}

	}
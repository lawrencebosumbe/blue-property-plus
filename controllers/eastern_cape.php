<?php
	class Eastern_Cape extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('eastern_cape/index');
		}		
		
		public function amahlathi(){	
			$this->view->render('eastern_cape/amahlathi/index');			
		}
		
		public function baviaans(){	
			$this->view->render('eastern_cape/baviaans/index');				
		}
		
		public function blue_crane_route(){	
			$this->view->render('eastern_cape/blue_crane_route/index');				
		}
		
		public function buffalo_city(){	
			$this->view->render('eastern_cape/buffalo_city/index');				
		}	
		
		public function beyers_naude(){	
			$this->view->render('eastern_cape/beyers_naude/index');				
		}	
		
		public function elundini(){	
			$this->view->render('eastern_cape/elundini/index');				
		}
		
		public function emalahleni(){	
			$this->view->render('eastern_cape/emalahleni/index');				
		}
		
		public function engcobo(){	
			$this->view->render('eastern_cape/engcobo/index');				
		}
		
		public function enoch_mgijima(){	
			$this->view->render('eastern_cape/enoch_mgijima/index');				
		}
		
		public function great_kei(){	
			$this->view->render('eastern_cape/great_kei/index');				
		}
		
		public function ingquza_hill(){	
			$this->view->render('eastern_cape/ingquza_hill/index');				
		}
		
		public function intsika_yethu(){	
			$this->view->render('eastern_cape/intsika_yethu/index');				
		}
		
		public function ixhuba_yethemba(){	
			$this->view->render('eastern_cape/ixhuba_yethemba/index');				
		}
		
		public function king_sabata(){	
			$this->view->render('eastern_cape/king_sabata/index');				
		}
		
		public function kouga(){	
			$this->view->render('eastern_cape/kouga/index');				
		}
		
		public function koukamma(){	
			$this->view->render('eastern_cape/koukamma/index');				
		}
		
		public function makana(){	
			$this->view->render('eastern_cape/makana/index');				
		}
		
		public function matatiele(){	
			$this->view->render('eastern_cape/matatiele/index');				
		}
		
		public function mbhashe(){	
			$this->view->render('eastern_cape/mbhashe/index');				
		}
		
		public function mbizana(){	
			$this->view->render('eastern_cape/mbizana/index');				
		}
		
		public function mhlontlo(){	
			$this->view->render('eastern_cape/mhlontlo/index');				
		}
		
		public function mnquma(){	
			$this->view->render('eastern_cape/mnquma/index');				
		}
		
		public function ndlambe(){	
			$this->view->render('eastern_cape/ndlambe/index');				
		}
		
		public function nelson_mandela_bay(){	
			$this->view->render('eastern_cape/nelson_mandela_bay/index');				
		}
		
		public function ngqushwa(){	
			$this->view->render('eastern_cape/ngqushwa/index');				
		}
		
		public function nkonkobe(){	
			$this->view->render('eastern_cape/nkonkobe/index');				
		}
		
		public function ntabankulu(){	
			$this->view->render('eastern_cape/ntabankulu/index');				
		}
		
		public function nyandeni(){	
			$this->view->render('eastern_cape/nyandeni/index');				
		}
		
		public function port_st_johns(){	
			$this->view->render('eastern_cape/port_st_johns/index');				
		}
		
		public function raymond_mhlaba(){	
			$this->view->render('eastern_cape/raymond_mhlaba/index');				
		}
		
		public function sakhisizwe(){	
			$this->view->render('eastern_cape/sakhisizwe/index');				
		}
		
		public function senqu(){	
			$this->view->render('eastern_cape/senqu/index');				
		}
		
		public function sunday_river_valley(){	
			$this->view->render('eastern_cape/sunday_river_valley/index');				
		}
		
		public function umzimvubu(){	
			$this->view->render('eastern_cape/umzimvubu/index');				
		}
		
		public function walter_sisulu(){	
			$this->view->render('eastern_cape/walter_sisulu/index');				
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->eastern_cape = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->eastern_cape)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('eastern_cape/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->eastern_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->eastern_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('eastern_cape/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->eastern_cape = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->eastern_cape)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('eastern_cape/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->eastern_cape = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->eastern_cape)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('eastern_cape/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->eastern_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->eastern_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('eastern_cape/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->eastern_cape = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->eastern_cape)) {
					die('This is an invalid city!');
				}
			$this->view->render('eastern_cape/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->eastern_cape = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->eastern_cape)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('eastern_cape/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->eastern_cape = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->eastern_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('eastern_cape/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->eastern_cape = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->eastern_cape)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('eastern_cape/to_rent_gallery/index');
		}
	}
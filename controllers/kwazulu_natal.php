<?php
	class Kwazulu_Natal extends Controller{
		public function __construct(){
			parent::__construct();
		}	
		
		public function index(){
			$this->view->render('kwazulu_natal/index');
		}
		
		public function abaqulusi(){
			$this->view->render('kwazulu_natal/abaqulusi/index');
		}		
				
		public function alfred_duma(){
			$this->view->render('kwazulu_natal/alfred_duma/index');
		}
		
		public function big_5_hlabisa(){
			$this->view->render('kwazulu_natal/big_5_hlabisa/index');
		}
		
		public function dannhause(){
			$this->view->render('kwazulu_natal/dannhause/index');
		}
		
		public function edumbe(){
			$this->view->render('kwazulu_natal/edumbe/index');
		}
		
		public function emadlangeni(){
			$this->view->render('kwazulu_natal/emadlangeni/index');
		}
		
		public function endumeni(){
			$this->view->render('kwazulu_natal/endumeni/index');
		}
		
		public function ethekwini(){
			$this->view->render('kwazulu_natal/ethekwini/index');
		}
		
		public function greater_kokstad(){
			$this->view->render('kwazulu_natal/greater_kokstad/index');
		}
		
		public function impendle(){
			$this->view->render('kwazulu_natal/impendle/index');
		}
		
		public function jozini(){
			$this->view->render('kwazulu_natal/jozini/index');
		}
		
		public function kwadukuza(){
			$this->view->render('kwazulu_natal/kwadukuza/index');
		}
		
		public function mandeni(){
			$this->view->render('kwazulu_natal/mandeni/index');
		}
		
		public function maphumulo(){
			$this->view->render('kwazulu_natal/maphumulo/index');
		}
		
		public function mkhambathini(){
			$this->view->render('kwazulu_natal/mkhambathini/index');
		}
		
		public function mpofana(){
			$this->view->render('kwazulu_natal/mpofana/index');
		}
		
		public function msinga(){
			$this->view->render('kwazulu_natal/msinga/index');
		}
		
		public function msunduzi(){
			$this->view->render('kwazulu_natal/msunduzi/index');
		}
		
		public function mthonjaneni(){
			$this->view->render('kwazulu_natal/mthonjaneni/index');
		}
		
		public function mtubatuba(){
			$this->view->render('kwazulu_natal/mtubatuba/index');
		}
		
		public function ndwedwe(){
			$this->view->render('kwazulu_natal/ndwedwe/index');
		}
		
		public function newcastle(){
			$this->view->render('kwazulu_natal/newcastle/index');
		}
		
		public function nkandla(){
			$this->view->render('kwazulu_natal/nkandla/index');
		}
		
		public function nkosazana_dlamini_zuma(){
			$this->view->render('kwazulu_natal/nkosazana_dlamini_zuma/index');
		}
		
		public function nkosi_langalibalele(){
			$this->view->render('kwazulu_natal/nkosi_langalibalele/index');
		}
		
		public function nongoma(){
			$this->view->render('kwazulu_natal/nongoma/index');
		}
		
		public function nquthu(){
			$this->view->render('kwazulu_natal/nquthu/index');
		}
		
		public function okhahlamba(){
			$this->view->render('kwazulu_natal/okhahlamba/index');
		}
		
		public function ray_nkonenyi(){
			$this->view->render('kwazulu_natal/ray_nkonenyi/index');
		}
		
		public function richmond(){
			$this->view->render('kwazulu_natal/richmond/index');
		}
		
		public function ubuhlebezwe(){
			$this->view->render('kwazulu_natal/ubuhlebezwe/index');
		}
		
		public function ulundi(){
			$this->view->render('kwazulu_natal/ulundi/index');
		}
		
		public function umdoni(){
			$this->view->render('kwazulu_natal/umdoni/index');
		}
		
		public function umfolozi(){
			$this->view->render('kwazulu_natal/umfolozi/index');
		}
		
		public function umhlabuyalingana(){
			$this->view->render('kwazulu_natal/umhlabuyalingana/index');
		}
		
		public function umhlathuze(){
			$this->view->render('kwazulu_natal/umhlathuze/index');
		}
		
		public function umlalazi(){
			$this->view->render('kwazulu_natal/umlalazi/index');
		}
		
		public function umngeni(){
			$this->view->render('kwazulu_natal/umngeni/index');
		}
		
		public function umshwathi(){
			$this->view->render('kwazulu_natal/umshwathi/index');
		}
		
		public function umvoti(){
			$this->view->render('kwazulu_natal/umvoti/index');
		}
		
		public function umzimkhulu(){
			$this->view->render('kwazulu_natal/umzimkhulu/index');
		}		
				
		public function umziwabantu(){
			$this->view->render('kwazulu_natal/umziwabantu/index');
		}
		
		public function umzumbe(){
			$this->view->render('kwazulu_natal/umzumbe/index');
		}
		
		public function uphongolo(){
			$this->view->render('kwazulu_natal/uphongolo/index');
		}
		
		/*
		---------------------------------------------------
			SINGLE CITY & SUBURB
		---------------------------------------------------
		*/
		
		//Get single suburb
		public function suburb($suburb_id){
			$suburb = $this->model->getSuburb($suburb_id);
			$this->view->kwazulu_natal = $suburb;
			$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
			if (empty($this->view->kwazulu_natal)) {
				die('This is an invalid suburb!');
			}
										
			$this->view->render('kwazulu_natal/suburb');
		}
		
		public function on_show_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->kwazulu_natal = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->kwazulu_natal)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('kwazulu_natal/on_show_suburb/index');	
		}
	
		public function to_rent_suburb($suburb_id){	
			$suburb = $this->model->getSuburb($suburb_id);
				$this->view->kwazulu_natal = $suburb;
				$this->view->getSuburbImage = $this->model->getSuburbImage($suburb_id);
				if (empty($this->view->kwazulu_natal)) {
					die('This is an invalid suburb!');
				}
			$this->view->render('kwazulu_natal/to_rent_suburb/index');	
		}
		
		//Get single city
		public function city($city_id){
			$this->view->kwazulu_natal = $this->model->getCity($city_id);
			$this->view->getSuburbs = $this->model->getSuburbs();
			if (empty($this->view->kwazulu_natal)) {
			die('This is an invalid city!');
			}
											
			$this->view->render('kwazulu_natal/city');
		}
		
		public function on_show_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->kwazulu_natal = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->kwazulu_natal)) {
					die('This is an invalid city!');
				}
			$this->view->render('kwazulu_natal/on_show_city/index');	
		}
		
		public function to_rent_city($city_id){	
			$city = $this->model->getCity($city_id);
				$this->view->kwazulu_natal = $city;
				$this->view->getSuburbImage = $this->model->getSuburbImage($city_id);
				if (empty($this->view->kwazulu_natal)) {
					die('This is an invalid city!');
				}
			$this->view->render('kwazulu_natal/to_rent_city/index');	
		}
		
		//Get single image
		public function gallery($property_id){
			$this->view->kwazulu_natal = $this->model->getAgentPropertyImagesForSale($property_id);
			$this->view->getPropertySuburb = $this->model->getPropertySuburbForSale($property_id);
			$this->view->getPropertyAgent = $this->model->getPropertyAgentForSale($property_id);
			if (empty($this->view->kwazulu_natal)) {
				die('This is an invalid gallery!');
			}
											
			$this->view->render('kwazulu_natal/gallery');
		}
		
		public function on_show_gallery($property_id){
		$this->view->kwazulu_natal = $this->model->getAgentPropertyImagesOnShow($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbOnShow($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentOnShow($property_id);
			if (empty($this->view->kwazulu_natal)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('kwazulu_natal/on_show_gallery/index');
		}
		
		public function to_rent_gallery($property_id){
		$this->view->kwazulu_natal = $this->model->getAgentPropertyImagesToRent($property_id);
		$this->view->getPropertySuburb = $this->model->getPropertySuburbToRent($property_id);
		$this->view->getPropertyAgent = $this->model->getPropertyAgentToRent($property_id);
			if (empty($this->view->kwazulu_natal)) {
				die('This is an invalid gallery!');
			}
												
			$this->view->render('kwazulu_natal/to_rent_gallery/index');
		}
			
	}

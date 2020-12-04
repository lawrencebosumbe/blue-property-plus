<?php
class Property_City extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->getCities = $this->model->getCities();
		$this->view->render('property_city/index');
	}

	//Get all cities
	public function city_list() {	
		$this->view->getCities = $this->model->getCities();
		$this->view->countAll = $this->model->countAll();
		$this->view->render('property_city/city_list');
	}
		
	//Get single city
	public function city_single($city_id){	
		$this->view->property_city = $this->model->getCity($city_id);
		if (empty($this->view->property_city)) {
			die('This is an invalid city!');
		}
											
		$this->view->render('property_city/city_single');
	}
	
	//Get single city to edit
	public function city_edit($city_id){	
		$this->view->property_city = $this->model->getCity($city_id);
		if (empty($this->view->property_city)) {
			die('This is an invalid city!');
		}
											
		$this->view->render('property_city/city_edit');
	}
	
	//Add City
	public function addCity(){									
		$this->model->addCity();	
		header('location: ' . URL . 'property_city');
	}
		
	//TODO: Implement update city
	public function updateCity($city_id){					
		$this->model->updateCity($city_id);
		header('location: ' . URL . 'property_city/city_list');
	}
		
		
	//Delete city 
	public function deleteCity($city_id) {
		$this->model->deleteCity($city_id);
		header('location: ' . URL . 'property_city');
	}
	
	
	//Get city records for pagination
	public function getRecords($from_record_num, $records_per_page){
		$this->view->getRecords = $this->model->getRecords($from_record_num, $records_per_page);
	}
}
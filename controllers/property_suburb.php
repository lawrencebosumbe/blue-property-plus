<?php
class Property_Suburb extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->getSuburbs = $this->model->getSuburbs();
		$this->view->render('property_suburb/index');
	}

	//Get all suburbs
	public function suburb_list() {	
		$this->view->getSuburbs = $this->model->getSuburbs();
		$this->view->countAll = $this->model->countAll();
		$this->view->render('property_suburb/suburb_list');
	}
		
	//Get single suburb
	public function suburb_single($suburb_id){	
		$this->view->property_suburb = $this->model->getSuburb($suburb_id);
		if (empty($this->view->property_suburb)) {
			die('This is an invalid suburb!');
		}
											
		$this->view->render('property_suburb/suburb_single');
	}
	
	//Get single suburb to edit
	public function suburb_edit($suburb_id){	
		$this->view->property_suburb = $this->model->getSuburb($suburb_id);
		if (empty($this->view->property_suburb)) {
			die('This is an invalid suburb!');
		}
											
		$this->view->render('property_suburb/suburb_edit');
	}
	
	//Add Suburb
	public function addSuburb(){									
		$this->model->addSuburb();	
		header('location: ' . URL . 'property_suburb');
	}
		
	//Update suburb 
	public function updateSuburb($suburb_id){					
		$this->model->updateSuburb($suburb_id);
		header('location: ' . URL . 'property_suburb/suburb_list');
	}
		
		
	//Delete suburb 
	public function deleteSuburb($suburb_id) {
		$this->model->deleteSuburb($suburb_id);
		header('location: ' . URL . 'property_suburb');
	}
	
	
	//Get suburb records for pagination
	/*
	public function getRecords($from_record_num, $records_per_page){
		$this->view->getRecords = $this->model->getRecords($from_record_num, $records_per_page);
	}
	*/
}
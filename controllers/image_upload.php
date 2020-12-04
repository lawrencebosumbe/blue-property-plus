<?php
	class Image_Upload extends Controller{

		public function __construct(){
			parent::__construct();
		}			

		public function index(){
			$this->view->uploadImage = $this->model->uploadImage();
			$this->view->render('image_upload/index');
		}
		
		//Get single suburb
		public function getProperty($property_id){	
			$this->view->image_upload = $this->model->getProperty($property_id);
			if (empty($this->view->image_upload)) {
				die('This is an invalid property ID!');
			}
												
			//$this->view->render('image_upload/property_single');
		}
	
		public function uploadImage(){
			$imgUpload = $this->model->uploadImage();
			
			if($imgUpload){
				Session::init();
				Session::set('pptImgUpStatus', $imgUpload);
				
			}
			header('location:' . URL . 'image_upload/');
			exit();
		}
		
		
	}



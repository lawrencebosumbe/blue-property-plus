<?php
	class Why_List_With_Us extends Controller{
		public function __construct(){
			parent::__construct();
		}	
		
		public function index(){
			$this->view->render('why_list_with_us/index');
		}
				
	}

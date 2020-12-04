<?php
	class Agencies extends Controller{
		public function __construct(){
			parent::__construct();
		}	
		
		public function index(){
			$this->view->render('agencies/index');
		}
		
		public function agents(){
			$this->view->render('agencies/agents');
		}
		public function agent(){
			$this->view->render('agencies/agent');
		}		
	}

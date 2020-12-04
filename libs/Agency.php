<?php
	class Agency{
		private $agency_id;
		private $agency_name;
		private $logo;
		
		public function __construct(){
			$this->agency_id = 0;
			$this->agency_name = "";
			$this->logo = "";
		}
		
		//SETTERS - MUTATORS
	
		/*
		set Agency ID
		@param value
		@return void
		*/
		
		public function setAgencyID($value){
			$this->agency_id = $value;
		}
		
		/*
		set Agency Name
		@param value
		@return void
		*/
		
		public function setAgencyName($value){
			$this->agency_name = $value;
		}
		
		/*
		set Agency Logo
		@param value
		@return void
		*/
		
		public function setLogo($value){
			$this->logo = $value;
		}
				
		//GETTERS - ACCESSORS
		
		/*
		get Agency ID
		@param void
		@return Agency ID
		*/
		
		public function getAgencyID(){
			return $this->agency_id;
		}
		
		/*
		get Agency Name
		@param void
		@return Agency Name
		*/
		
		public function getAgencyName(){
			return $this->agency_name;
		}
		
		/*
		get Logo
		@param void
		@return Logo
		*/
		
		public function getLogo(){
			return $this->logo;
		}
		
	}
?>
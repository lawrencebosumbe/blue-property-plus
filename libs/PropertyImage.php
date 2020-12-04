<?php
	class PropertyImage{
		private $img_id;
		private $property;
		private $img_location;
		private $img_date;
		
		public function __construct(){
			$this->img_id = 0;
			$this->property = null;
			$this->img_location = "";
			$this->img_date = "";
		}
		
		//SETTERS - MUTATORS
			
		public function setImageID($value){
			$this->img_id = $value;
		}
		
		public function setProperty($value){
			$this->property = $value;
		}
		
		public function setImageLocation($value){
			$this->img_location = $value;
		}
		
		public function setImageDate($value){
			$this->img_date = $value;
		}
		
		//GETTERS - ACCESSORS
		
		public function getImageID(){
			return $this->img_id;
		}
		
		public function getProperty(){
			return $this->property;
		}
		
		public function getImageLocation(){
			return $this->img_location;
		}
		
		public function getImageDate(){
			return $this->img_date;
		}
	}
?>
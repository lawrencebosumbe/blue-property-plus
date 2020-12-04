<?php
	class FreeStateProperty{
		private $property_id;
		private $employee;
		private $type;
		private $agent;
		private $suburb;
		private $city;
		private $property_range;
		private $street_no;
		private $street_name;
		private $desc;
		private $status;
		private $num_bathroom;
		private $num_bed;
		private $num_garage;
		private $num_lounge;
		private $aircon;
		private $pool;
		private $cottage;
		private $price;
		private $img_id;
		private $img_location;
		private $logo;
		
		public function __construct(){
			$this->property_id = 0;
			$this->employee = null;
			$this->type = null;
			$this->agent = null;
			$this->suburb = null;
			$this->city = null;
			$this->property_range = null;
			$this->street_no = "";
			$this->street_name = "";
			$this->desc = "";
			$this->status = "";
			$this->num_bathroom = "";
			$this->num_bed = "";
			$this->num_garage = "";
			$this->num_lounge = "";
			$this->aircon = "";
			$this->pool = "";
			$this->cottage = "";
			$this->price = "";
			$this->image_url = "";
			$this->municipality_id = 0;
			$this->municipality_name = "";
			$this->suburb_id = 0;
			$this->city_id = 0;
		}
		
		//SETTERS - MUTATORS
	
		/*
		set Property ID
		@param value
		@return void
		*/
		
		public function setPropertyID($value){
			$this->property_id = $value;
		}
		
		/*
		set Employee
		@param value
		@return void
		*/
		
		public function setEmployee($value){
			$this->employee = $value;
		}
		
		/*
		set Property Type
		@param value
		@return void
		*/
		
		public function setPropertyType($value){
			$this->type = $value;
		}
		
		/*
		set Agent
		@param value
		@return void
		*/
		
		public function setAgent($value){
			$this->agent = $value;
		}
		
		/*
		set Logo
		@param value
		@return void
		*/
		
		public function setLogo($value){
			$this->logo = $value;
		}
		
		/*
		set Suburb
		@param value
		@return void
		*/
		
		public function setSuburb($value){
			$this->suburb = $value;
		}
		
		/*
		set City
		@param value
		@return void
		*/
		
		public function setCity($value){
			$this->city = $value;
		}
		
		/*
		set Property Range
		@param value
		@return void
		*/
		
		public function setPropertyRange($value){
			$this->property_range = $value;
		}
		
		/*
		set Street No
		@param value
		@return void
		*/
		
		public function setStreetNo($value){
			$this->street_no = $value;
		}
		
		/*
		set Street Name
		@param value
		@return void
		*/
		
		public function setStreetName($value){
			$this->street_name = $value;
		}
		
		/*
		set Description
		@param value
		@return void
		*/
		
		public function setPropertyDescription($value){
			$this->desc = $value;
		}
		
		/*
		set Status
		@param value
		@return void
		*/
		
		public function setPropertyStatus($value){
			$this->status = $value;
		}
		
		/*
		set No Bathroom
		@param value
		@return void
		*/
		
		public function setNumBathRoom($value){
			$this->num_bathroom = $value;
		}
		
		/*
		set Num Bed
		@param value
		@return void
		*/
		
		public function setNumBed($value){
			$this->num_bed = $value;
		}
		
		/*
		set Num Garage
		@param value
		@return void
		*/
		
		public function setNumGarage($value){
			$this->num_garage = $value;
		}
		
		/*
		set Num Lounge
		@param value
		@return void
		*/
		
		public function setNumLounge($value){
			$this->num_lounge = $value;
		}
		
		/*
		set Aircon
		@param value
		@return void
		*/
		
		public function setAirCon($value){
			$this->aircon = $value;
		}
		
		/*
		set Pool
		@param value
		@return void
		*/
		
		public function setPool($value){
			$this->pool = $value;
		}
		
		/*
		set Cottage
		@param value
		@return void
		*/
		
		public function setCottage($value){
			$this->cottage = $value;
		}
		
		/*
		set Price
		@param value
		@return void
		*/
		
		public function setPrice($value){
			$this->price = $value;
		}
		
		public function setImageID($value){
			$this->img_id = $value;
		}
		
		public function setImageLocation($value){
			$this->img_location = $value;
		}
		
		//GETTERS - ACCESSORS
	
		/*
		get Employee
		@param void
		@return Employee
		*/
		
		public function getEmployee(){
			return $this->employee;
		}
		
		/*
		get Property ID
		@param void
		@return Property ID
		*/
		
		public function getPropertyID(){
			return $this->property_id;
		}
		
		/*
		get Property Type
		@param void
		@return Property Type
		*/
		
		public function getPropertyType(){
			return $this->type;
		}
		
		/*
		get Agent
		@param void
		@return Agent
		*/
		
		public function getAgent(){
			return $this->agent;
		}
		
		/*
		get Logo
		@param void
		@return Logo
		*/
		
		public function getLogo(){
			return $this->logo;
		}
		
		/*
		get Suburb
		@param void
		@return Suburb
		*/
		
		public function getSuburb(){
			return $this->suburb;
		}
		
		/*
		get City
		@param void
		@return City
		*/
		
		public function getCity(){
			return $this->city;
		}
			
		/*
		get Street No
		@param void
		@return Street No
		*/
		
		public function getStreetNo(){
			return $this->street_no;
		}
		
		/*
		get Street Name
		@param void
		@return Street Name
		*/
		
		public function getStreetName(){
			return $this->street_name;
		}
		
		/*
		get Description
		@param void
		@return Description
		*/
		
		public function getPropertyDescription(){
			return $this->desc;
		}
		
		/*
		get Status
		@param void
		@return Status
		*/
		
		public function getPropertyStatus(){
			return $this->status;
		}
		
		/*
		get Num Bathroom
		@param void
		@return Num Bathroom
		*/
		
		public function getNumBathRoom(){
			return $this->num_bathroom;
		}
		
		/*
		get Num Beds
		@param void
		@return Num Beds
		*/
		
		public function getNumBed(){
			return $this->num_bed;
		}
		
		/*
		get Num Garage
		@param void
		@return Num Garage
		*/
		
		public function getNumGarage(){
			return $this->num_garage;
		}
		
		/*
		get Num Lounge
		@param void
		@return Num Lounge
		*/
		
		public function getNumLounge(){
			return $this->num_lounge;
		}
		
		/*
		get Aircon
		@param void
		@return Aircon
		*/
		
		public function getAirCon(){
			return $this->aircon;
		}
		
		/*
		get Pool
		@param void
		@return Pool
		*/
		
		public function getPool(){
			return $this->pool;
		}
		
		/*
		get Cottage
		@param void
		@return Cottage
		*/
		
		public function getCottage(){
			return $this->cottage;
		}
		
		/*
		get Price
		@param void
		@return Price
		*/
		
		public function getPrice(){
			return $this->price;
		}

		/*
		get Property Image Alternative Text
		@param void
		@return Property Image Alternative Text
		*/
		
		public function getImageAltText(){
			$image_alt_text = $this->getPropertyDescription();
			return $image_alt_text;
		}
		
		public function getImageID(){
			return $this->img_id;
		}
		
		public function getImageLocation(){
			return $this->img_location;
		}
		
		/*
		set Municipality Name
		@param value
		@return void
		*/
		
		public function setMunicipalityName($value){
			$this->municipality_name = $value;
		}
		
		/*
		get Municipality Name
		@param void
		@return Municipality Name
		*/
		
		public function getMunicipalityName(){
			return $this->municipality_name;
		}
		
		
		/*
		set Municipality ID
		@param value
		@return void
		*/
		
		public function setMunicipalityID($value){
			$this->municipality_id = $value;
		}
		
		/*
		get Municipality ID
		@param void
		@return Municipality ID
		*/
		
		public function getMunicipalityID(){
			return $this->municipality_id;
		}
		
		
		/*
		set Suburb ID
		@param value
		@return void
		*/
		
		public function setSuburbID($value){
			$this->suburb_id = $value;
		}
		
		
		/*
		get Suburb ID
		@param void
		@return Suburb ID
		*/
		
		public function getSuburbID(){
			return $this->suburb_id;
		}
		
		/*
		Set City ID 
		@param value
		@return void
		*/
		
		public function setCityID($value){
			$this->city_id = $value;	
		}
		
		
		/*
		get City ID 
		@param void
		@return City ID
		*/
		
		public function getCityID(){
			return $this->city_id;	
		}
	}
?>
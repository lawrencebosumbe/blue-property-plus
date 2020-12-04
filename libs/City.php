<?php
class City{
    private $city_id;
	private $municipality;
    private $code;
    private $name;
	private $no_property_forsale;
	private $no_property_torent;
	private $no_property_onshow;
	private $latitude;
	private $longitude;
   	
	public function __construct(){
		$this->city_id = 0;
		$this->municipality = null;
		$this->code = "";
		$this->name = "";
		$this->no_property_forsale = 0;
		$this->no_property_torent = 0;
		$this->no_property_onshow = 0;
		$this->latitude = "";
		$this->longitude = "";
	}
	
	//SETTERS - MUTATORS
	
	/*
	Set City ID 
	@param value
	@return void
	*/
	
	public function setCityID($value){
		$this->city_id = $value;	
	}
	
	/*
	Set Municipality 
	@param value
	@return void
	*/
	
	public function setMunicipality($value){
		$this->municipality = $value;	
	}
	
	/*
	Set City Code 
	@param value
	@return void
	*/
	
	public function setCityCode($value){
		$this->code = $value;	
	}
	
	/*
	Set City Name 
	@param value
	@return void
	*/
	
	public function setCityName($value){
		$this->name = $value;	
	}
	
	/*
	set Number of Properties for sale
	@param value
	@return void
	*/
	
	public function setTotalPropertyForSale($value){
		$this->no_property_forsale = $value;
	}
	
	/*
	set Number of Properties to rent
	@param value
	@return void
	*/
	
	public function setTotalPropertyToRent($value){
		$this->no_property_torent = $value;
	}
	
	/*
	set Number of Properties on show
	@param value
	@return void
	*/
	
	public function setTotalPropertyOnShow($value){
		$this->no_property_onshow = $value;
	}
	
	/*
	set Latitude
	@param value
	@return void
	*/
	
	public function setLatitude($value){
		$this->latitude = $value;
	}
	
	/*
	set Longitude
	@param value
	@return void
	*/
	
	public function setLongitude($value){
		$this->longitude = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get City ID 
	@param void
	@return City ID
	*/
	
	public function getCityID(){
		return $this->city_id;	
	}
	
	/*
	get City Municipality  
	@param void
	@return Municipality 
	*/
	
	public function getMunicipality(){
		return $this->municipality;	
	}
	
	/*
	get City Code 
	@param void
	@return City Code
	*/
	
	public function getCityCode(){
		return $this->code;	
	}
	
	/*
	get City Name 
	@param void
	@return City Name
	*/
	
	public function getCityName(){
		return $this->name;	
	}
	
	/*
	get No Properties for sale
	@param void
	@return No Properties
	*/
		
	public function getTotalPropertyForSale(){
		return $this->no_property_forsale;
	}
	
	/*
	get No Properties to rent
	@param void
	@return No Properties
	*/
		
	public function getTotalPropertyToRent(){
		return $this->no_property_torent;
	}
	
	/*
	get No Properties on show
	@param void
	@return No Properties
	*/
		
	public function getTotalPropertyOnShow(){
		return $this->no_property_onshow;
	}
	
	/*
	get Latitude
	@param void
	@return Latitude
	*/
		
	public function getLatitude(){
		return $this->latitude;
	}
	
	/*
	get Longitude
	@param void
	@return Longitude
	*/
		
	public function getLongitude(){
		return $this->longitude;
	}
}
?>
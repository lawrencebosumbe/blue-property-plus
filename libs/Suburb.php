<?php
class Suburb{
    private $suburb_id;
    private $city;
	private $municipality;
    private $code;
    private $name;
	private $no_property_forsale;
	private $no_property_torent;
	private $no_property_onshow;
	private $desc;
	private $num_rooms;
	private $num_beds;
	private $num_garages;
	private $image;
	private $price;
	private $property_id;
	private $type;
	private $agent;
	private $street_no;
	private $street_name;
	
	public function __construct(){
		$this->suburb_id = 0;
		$this->city = null;
		$this->municipality = null;
		$this->code = "";
		$this->name = "";
		$this->no_property_forsale = 0;
		$this->no_property_torent = 0;
		$this->no_property_onshow = 0;
		$this->property_id = 0;
		$this->agent = null;
	}
	
	//SETTERS - MUTATORS
	
	/*
	set Suburb ID
	@param value
	@return void
	*/
	
	public function setSuburbID($value){
		$this->suburb_id = $value;
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
	set Municipality
	@param value
	@return void
	*/
	
	public function setMunicipality($value){
		$this->municipality = $value;
	}
	
	/*
	set Suburb Code
	@param value
	@return void
	*/
	
	public function setSuburbCode($value){
		$this->code = $value;
	}
	
	/*
	set Suburb Name
	@param value
	@return void
	*/
	
	public function setSuburbName($value){
		$this->name = $value;
	}
		
	/*
	set Property Description
	@param value
	@return void
	*/
	
	public function setPropertyDescription($value){
		$this->desc = $value;
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
	set Number of rooms
	@param value
	@return void
	*/
	
	public function setNumBathRoom($value){
		$this->num_rooms = $value;
	}
	
	/*
	set Number of bed rooms
	@param value
	@return void
	*/
	
	public function setNumBed($value){
		$this->num_beds = $value;
	}

	/*
	set Number of garages
	@param value
	@return void
	*/
	
	public function setNumGarage($value){
		$this->num_garages = $value;
	}

	/*
	set Price
	@param value
	@return void
	*/
	
	public function setPrice($value){
		$this->price = $value;
	}
	
	/*
	set Property Image
	@param value
	@return void
	*/
	
	public function setImageLocation($value){
		$this->image = $value;
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
	set Property ID
	@param value
	@return void
	*/
	
	public function setPropertyID($value){
		$this->property_id = $value;
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
	set Agent
	@param value
	@return void
	*/
	
	public function setAgent($value){
		$this->agent = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get Suburb ID
	@param void
	@return Suburb ID
	*/
	
	public function getSuburbID(){
		return $this->suburb_id;
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
	get Municipality
	@param void
	@return Municipality
	*/
	
	public function getMunicipality(){
		return $this->municipality;
	}
	
	/*
	get Suburb Code
	@param void
	@return Suburb Code
	*/
	
	public function getSuburbCode(){
		return $this->code;
	}
	
	/*
	get Suburb Name
	@param void
	@return Suburb Name
	*/
	
	public function getSuburbName(){
		return $this->name;
	}
	
	/*
	get Property Description
	@param void
	@return Property Description
	*/
	
	public function getPropertyDescription(){
		return $this->desc;
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
	get Number of rooms
	@param void
	@return Number of rooms
	*/
	
	public function getNumBathRoom(){
		return $this->num_rooms;
	}
	
	/*
	get Number of bed rooms
	@param void
	@return Number of bed rooms
	*/
	
	public function getNumBed(){
		return $this->num_beds;
	}

	/*
	get Number of garages
	@param void
	@return Number of garages
	*/
	
	public function getNumGarage(){
		return $this->num_garages;
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
	get Property Image
	@param void
	@return Property Image
	*/
	
	public function getImageLocation(){
		return $this->image;
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
	get Property ID
	@param void
	@return Property ID
	*/
	
	public function getPropertyID(){
		return $this->property_id;
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
}
?>
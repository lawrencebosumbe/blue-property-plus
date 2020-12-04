<?php
class Municipality{
    private $municipality_id;
    private $province;
    private $code;
    private $name;
	private $total_forsale;
	private $total_torent;
	private $total_onshow;
	
	public function __construct(){
		$this->municipality_id = 0;
		$this->province = null;
		$this->code = "";
		$this->name = "";
		$this->total_forsale = 0;
		$this->total_torent = 0;
		$this->total_onshow = 0;
	}
	
	//SETTERS - MUTATORS
	
	/*
	set Municipality ID
	@param value
	@return void
	*/
	
	public function setMunicipalityID($value){
		$this->municipality_id = $value;
	}
	
	/*
	set Province
	@param value
	@return void
	*/
	
	public function setProvince($value){
		$this->province = $value;
	}
	
	/*
	set Municipality Code
	@param value
	@return void
	*/
	
	public function setMunicipalityCode($value){
		$this->code = $value;
	}
	
	/*
	set Municipality Name
	@param value
	@return void
	*/
	
	public function setMunicipalityName($value){
		$this->name = $value;
	}
	
	/*
	set Total property for sale
	@param value
	@return void
	*/
	
	public function setTotalPropertyForSale($value){
		$this->total_forsale = $value;
	}
	
	/*
	set Total property to rent
	@param value
	@return void
	*/
	
	public function setTotalPropertyToRent($value){
		$this->total_torent = $value;
	}
	
	/*
	set Total property on show
	@param value
	@return void
	*/
	
	public function setTotalPropertyOnShow($value){
		$this->total_onshow = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get Municipality ID
	@param void
	@return Municipality ID
	*/
	
	public function getMunicipalityID(){
		return $this->municipality_id;
	}
	
	/*
	get Province
	@param void
	@return Province
	*/
	
	public function getProvince(){
		return $this->province;
	}
	
	/*
	get Municipality Code
	@param void
	@return Municipality Code
	*/
	
	public function getMunicipalityCode(){
		return $this->code;
	}
	
	/*
	get Municipality Name
	@param void
	@return Municipality Name
	*/
	
	public function getMunicipalityName(){
		return $this->name;
	}
	
	/*
	get Total property for sale
	@param void
	@return Total property to rent
	*/
	
	public function getTotalPropertyForSale(){
		return $this->total_forsale;
	}
	
	/*
	get Total property to rent
	@param void
	@return Total property to rent
	*/
	
	public function getTotalPropertyToRent(){
		return $this->total_torent;
	}
	
	/*
	get Total property on show
	@param void
	@return Total property on show
	*/
	
	public function getTotalPropertyOnShow(){
		return $this->total_onshow;
	}
}
?>
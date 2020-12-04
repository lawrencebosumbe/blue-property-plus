<?php
class Province{
    private $province_id;
    private $code;
    private $name;
	
	public function __construct(){
		$this->province_id = 0;
		$this->code = "";
		$this->name = "";
	}
	
	//SETTERS - MUTATORS
	
	/*
	set Province ID 
	@param value
	@return void
	*/
	
	public function setProvinceID($value){
		$this->province_id = $value;
	}
	
	/*
	set Province Code 
	@param value
	@return void
	*/
	
	public function setProvinceCode ($value){
		$this->code = $value;
	}

	/*
	set Province Name 
	@param value
	@return void
	*/
	
	public function setProvinceName ($value){
		$this->name = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get Province ID
	@param void
	@return Province ID
	*/
	
	public function getProvinceID(){
		return $this->province_id;
	}

	
	/*
	get Province Code
	@param void
	@return Province Code
	*/
	
	public function getProvinceCode(){
		return $this->code;
	}
	
	/*
	get Province Name
	@param void
	@return Province Name
	*/
	
	public function getProvinceName(){
		return $this->name;
	}
}
?>
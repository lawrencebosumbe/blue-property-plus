<?php
	class Agent{
		private $agent_id;
		private $agent_type;
		private $agency;
		private $suburb;		
		private $firstname;
		private $lastname;
		private $email;
		private $password;
		private $phone;
		private $gender;
		private $registration_date;
		private $image;
		
		public function __construct(){
			$this->agent_type = "";
			$this->agency = null;
			$this->suburb = null;
			$this->firstname = "";
			$this->lastname = "";
			$this->email = "";
			$this->password = "";
			$this->phone = "";
			$this->gender = "";
			$this->registration_date = "";
			$this->image = "";
		}
		
		//SETTERS - MUTATORS
	
		/*
		set Agent ID
		@param value
		@return void
		*/
		
		public function setAgentID($value){
			$this->agent_id = $value;
		}
		
		/*
		set Agency
		@param value
		@return void
		*/
		
		public function setAgency($value){
			$this->agency = $value;
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
		set Firstname
		@param value
		@return void
		*/
		
		public function setFirstname($value){
			$this->firstname = $value;
		}
		
		/*
		set Lastname
		@param value
		@return void
		*/
		
		public function setLastname($value){
			$this->lastname = $value;
		}
		
		/*
		set Email
		@param value
		@return void
		*/
		
		public function setEmail($value){
			$this->email = $value;
		}
		
		/*
		set Password
		@param value
		@return void
		*/
		
		public function setPassword($value){
			$this->password = $value;
		}
		
		/*
		set Phone
		@param value
		@return void
		*/
		
		public function setPhone($value){
			$this->phone = $value;
		}
		
		/*
		set Gender
		@param value
		@return void
		*/
		
		public function setGender($value){
			$this->gender = $value;
		}
		
		/*
		set Registration Date
		@param value
		@return void
		*/
		
		public function setRegistrationDate($value){
			$this->registration_date = $value;
		}
		
		/*
		set Image
		@param value
		@return void
		*/
		
		public function setImage($value){
			$this->image = $value;
		}
		
		//GETTERS - ACCESSORS
		
		/*
		get Agent ID
		@param void
		@return Employee ID
		*/
		
		public function getAgentID(){
			return $this->agent_id;
		}
		
		/*
		get Agent Type
		@param void
		@return Agent Type
		*/
		
		public function getAgentType(){
			return $this->agent_type;
		}
		
		/*
		get Agency
		@param void
		@return Agency
		*/
		
		public function getAgency(){
			return $this->agency;
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
		get Firstname
		@param void
		@return Firstname
		*/
		
		public function getFirstname(){
			return $this->firstname;
		}
		
		/*
		get Lastname
		@param void
		@return Lastname
		*/
		
		public function getLastname(){
			return $this->lastname;
		}
		
		/*
		get Email
		@param void
		@return Email
		*/
		
		public function getEmail(){
			return $this->email;
		}
		
		/*
		get Password
		@param void
		@return Password
		*/
		
		public function getPassword(){
			return $this->password;
		}
		
		/*
		get Phone
		@param void
		@return Phone
		*/
		
		public function getPhone(){
			return $this->phone;
		}
		
		/*
		get Gender
		@param void
		@return Gender
		*/
		
		public function getGender(){
			return $this->gender;
		}
		
		/*
		get Registration Date
		@param void
		@return Registration Date
		*/
		
		public function getRegistrationDate(){
			return $this->registration_date;
		}
		
		/*
		get Image
		@param void
		@return Image
		*/
		
		public function getImage(){
			return $this->image;
		}
	}
?>
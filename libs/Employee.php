<?php
	class Employee{
		private $emp_id;
		private $firstname;
		private $lastname;
		private $email;
		private $password;
		private $phone;
		private $gender;
		private $role;
		private $registration_date;
		private $image;
		
		public function __construct(){
			$this->firstname = "";
			$this->lastname = "";
			$this->email = "";
			$this->password = "";
			$this->phone = "";
			$this->gender = "";
			$this->role = "";
			$this->registration_date = "";
			$this->image = "";
		}
		
		//SETTERS - MUTATORS
	
		/*
		set Employee ID
		@param value
		@return void
		*/
		
		public function setEmployeeID($value){
			$this->emp_id = $value;
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
		set Employee Role
		@param value
		@return void
		*/
		
		public function setEmployeeRole($value){
			$this->role = $value;
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
		get Employee ID
		@param void
		@return Employee ID
		*/
		
		public function getEmployeeID(){
			return $this->emp_id;
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
		get Employee Role
		@param void
		@return Employee Role
		*/
		
		public function getEmployeeRole(){
			return $this->role;
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
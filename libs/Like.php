<?php
	class Like{
		private $like_id;
		private $post;
		private $employee;
		private $agent;
		private $like_date;
		
		public function __construct(){
			$this->like_id = 0;
			$this->post = null;
			$this->employee = null;
			$this->agent = null;
			$this->like_date = '';
		}
		
		//SETTERS - MUTATORS
		
		/*
		Set Like ID
		@param value
		@return void
		*/
		
		public function setLikeID($value){
			$this->like_id = $value;
		}
		
		/*
		Set Post ID
		@param value
		@return void
		*/
		
		public function setPost($value){
			$this->post = $value;
		}
		
		
		/*
		Set Employee
		@param value
		@return void
		*/
		
		public function setEmployee($value){
			$this->employee = $value;
		}
		
		/*
		Set Agent
		@param value
		@return void
		*/
		
		public function setAgent($value){
			$this->agent = $value;
		}
		
		/*
		Set Like Date
		@param value
		@return void
		*/
		
		public function setLikeDate($value){
			$this->like_date = $value;
		}
		
		//GETTERS - ACCESSORS
		
		/*
		Get Like ID
		@param void
		@return Post ID
		*/
		
		public function getLikeID(){
			return $this->like_id;
		}
		
		/*
		Get Post ID
		@param void
		@return Post ID
		*/
		
		public function getPost(){
			return $this->post;
		}
		
		
		/*
		Get Employee
		@param void
		@return Employee
		*/
		
		public function getEmployee(){
			return $this->employee;
		}
		
		/*
		Get Agent
		@param void
		@return Agent
		*/
		
		public function getAgent(){
			return $this->agent;
		}
		
		/*
		Get Like Date
		@param void
		@return Like Date
		*/
		
		public function getLikeDate(){
			return $this->like_date;
		}
	}
?>
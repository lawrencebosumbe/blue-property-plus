<?php
	class Comment{
		private $comment_id;
		private $post;
		private $employee;
		private $agent;
		private $comment;
		private $comment_date;
		
		public function __construct(){
			$this->comment_id = 0;
			$this->post = null;
			$this->employee = null;
			$this->agent = null;
			$this->comment = '';
			$this->comment_date = '';
		}
		
		//SETTERS - MUTATORS
		
		/*
		Set Comment ID
		@param value
		@return void
		*/
		
		public function setCommentID($value){
			$this->comment_id = $value;
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
		SetComment
		@param value
		@return void
		*/
		
		public function setComment($value){
			$this->comment = $value;
		}
		
		/*
		Set Comment Date
		@param value
		@return void
		*/
		
		public function setCommentDate($value){
			$this->comment_date = $value;
		}
		
		//GETTERS - ACCESSORS
		
		/*
		Get Comment ID
		@param void
		@return Comment ID
		*/
		
		public function getCommentID(){
			return $this->comment_id;
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
		Get Comment
		@param void
		@return Comment
		*/
		
		public function getComment(){
			return $this->comment;
		}
		
		/*
		Get Comment Date
		@param void
		@return Comment
		*/
		
		public function getCommentDate(){
			return $this->comment_date;
		}
	}
?>
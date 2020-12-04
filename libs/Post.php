<?php
	class Post{
		private $post_id;
		private $employee;
		private $agent;
		private $content;
		private $subject;
		private $total_like;
		private $total_comment;
		private $like_id;
		private $post_date;
				
		public function __construct(){
			$this->post_id = 0;
			$this->employee = null;
			$this->agent = null;
			$this->content = '';
			$this->subject = '';
			$this->total_like = 0;
			$this->total_comment = 0;
			$this->like_id = 0;
			$this->post_date = '';		
		}
		
		//SETTERS - MUTATORS
		
		/*
		Set Post ID
		@param value
		@return void
		*/
		
		public function setPostID($value){
			$this->post_id = $value;
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
		Set Content
		@param value
		@return void
		*/
		
		public function setPostContent($value){
			$this->content = $value;
		}
		
		/*
		Set Post Subject
		@param value
		@return void
		*/
		
		public function setPostSubject($value){
			$this->subject = $value;
		}
		
		/*
		Set Total Like
		@param value
		@return void
		*/
		
		public function setTotalLike($value){
			$this->total_like = $value;
		}
		
		/*
		Set Total Comment
		@param value
		@return void
		*/
		
		public function setTotalComment($value){
			$this->total_comment = $value;
		}
		
		/*
		Set Like ID
		@param value
		@return void
		*/
		
		public function setLikeID($value){
			$this->like_id = $value;
		}
		
		/*
		Set Post Date
		@param value
		@return void
		*/
		
		public function setPostDate($value){
			$this->date_created = $value;
		}
		
		//GETTERS - ACCESSORS
		
		/*
		Get Post ID
		@param void
		@return Post ID
		*/
		
		public function getPostID(){
			return $this->post_id;
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
		Get Post Content
		@param void
		@return Content
		*/
		
		public function getPostContent(){
			return $this->content;
		}
		
		/*
		Get Post Subject
		@param void
		@return Post Subject
		*/
		
		public function getPostSubject(){
			return $this->subject;
		}
		
		/*
		Get Total Like
		@param void
		@return Total Like
		*/
		
		public function getTotalLike(){
			return $this->total_like;
		}
		
		/*
		Get Total Comment
		@param void
		@return Total Comment
		*/
		
		public function getTotalComment(){
			return $this->total_comment;
		}
		/*
		Get Like ID
		@param void
		@return Like ID
		*/
		
		public function getLikeID(){
			return $this->like_id;
		}
		
		/*
		Get Post Date
		@param void
		@return Date
		*/
		
		public function getPostDate(){
			return $this->post_date;
		}
	}
?>
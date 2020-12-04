<?php
	class Queries_Model{
		private $conn;		

		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}	
		
		
	}

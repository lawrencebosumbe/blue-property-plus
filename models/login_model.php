<?php
	class Login_Model{
		private $conn;		

		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}	
		
		//Emplyee Login
		public function login(){
			try{
				$email = isset($_POST["email"] ) ? $_POST["email"]: '';
				$password = isset($_POST["password"]) ? $_POST["password"]: '';
		
				$query = "SELECT * FROM agents WHERE email = '$email' AND password = (PASSWORD('$password'))";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);			
			
				$counter = $result->rowCount();
				
				if($counter > 0){
						Session::init();
						Session::set('loggedIn', true);
						Session::set('agent_id', $row['agent_id']);
						Session::set('firstname', $row['firstname']);
						Session::set('lastname', $row['lastname']);
						Session::set('email', $row['email']);
						Session::set('image', $row['image']);
						Session::set('date', $row['date']);
						header("location: " . URL . 'back_office');				
				}else{
					header("location: " . URL . "login");
					exit();
				}
								
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

<?php
	class Signup_Model {
		private $conn;
		
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Add Employee
		public function addAgent(){
			try{
			 $agency = isset($_POST["agency"] ) ? $_POST["agency"]: '';
			 $suburb = isset($_POST["suburb"] ) ? $_POST["suburb"]: '';
			 $firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: '';
			 $lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: '';
			 $email = isset($_POST["email"] ) ? $_POST["email"]: '';
			 $password = isset($_POST["password"]) ? $_POST["password"]: '';
			 $phone = isset($_POST["phone"]) ? $_POST["phone"]: ''; 
			 $gender = isset($_POST["gender"]) ? $_POST["gender"]: ''; 
			 $type = isset($_POST["type"]) ? $_POST["type"]: ''; 
			 $date = date("Y-m-d H:i:s", time()); 
			 $image = isset($_POST["image"]) ? $_POST["image"]: ''; 
             if ($gender == 'Male'){
                $image = "public/images/users/male.jpg";
             }else{
                $image = "public/images/users/female.jpg";
             }
			 $agent = new Agent();
			 $agent->setAgency($agency);
			 $agent->setSuburb($suburb);
			 $agent->setFirstname($firstname); 
			 $agent->setLastname($lastname);
			 $agent->setEmail($email);
			 $agent->setPassword($password);
			 $agent->setPhone($phone);
			 $agent->setGender($gender);
			 $agent->setRegistrationDate($date);
			 $agent->setImage($image);
			 $agent->setAgency($agency);
			 
			// $agent = new Agent();
			 $agent->getAgency();
			 $agent->getSuburb();
			 $agent->getFirstname(); 
			 $agent->getLastname();
			 $agent->getEmail();
			 $agent->getPassword();
			 $agent->getPhone();
			 $agent->getGender();
			 $agent->getRegistrationDate();
			 $agent->getImage();
			 $agent->getAgency();
			  
			  $query = "INSERT INTO agents (agency_id, suburb_id, agent_type, firstname, lastname, email, password, 
			  			phone, gender, date, image)
			  			VALUES('$agency', '$suburb', '$type', '$firstname', '$lastname', '$email', (PASSWORD('$password')), '$phone', 
						'$gender', '$date', '$image')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
	}

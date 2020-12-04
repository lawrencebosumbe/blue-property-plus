<?php
	class AgentDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get All Agents
		public function getAgents(){
			try{
				$query = "SELECT a.*, g.agency_name, s.suburb_name FROM agents a
						  LEFT JOIN agencies g
						  ON a.agency_id = g.agency_id
						  LEFT JOIN suburbs s
						  ON a.suburb_id = s.suburb_id 
					  	  ORDER BY agent_id";
				$result = $this->conn->query($query);
				
				$agents = array();
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID();
					$agency->setAgencyName();
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setAgentType($row['agent_type']);
					$agent->setAgency($row['agency_id']);					
					$agent->setSuburb($row['suburb_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPassword($row['password']);
					$agent->setPhone($row['phone']);
					$agent->setGender($row['gender']);
					$agent->setRegistrationDate($row['date']);
					$agent->setImage($row['image']);
					$agents[] = $agent;
				}				
				return $agents;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Agent By ID
		public function getAgent($agent_id){
			try{
				$query = "SELECT * FROM agents
						  WHERE agent_id = '$agent_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$agent = new Agent();
				$agent->setAgentID($row['agent_id']);
				//$agent->setAgentType($row['agent_type_id']);
				$agent->setAgency($row['agency_id']);					
				$agent->setSuburb($row['suburb_id']);
				$agent->setFirstname($row['firstname']);
				$agent->setLastname($row['lastname']);
				$agent->setEmail($row['email']);
				$agent->setPassword($row['password']);
				$agent->setPhone($row['phone']);
				$agent->setGender($row['gender']);
				$agent->setRegistrationDate($row['date']);
				$agent->setImage($row['image']);

				return $agent;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add Agent
		public function addAgent(){
			try{
			 $agent_id = isset($_POST["agent_id"] ) ? $_POST["agent_id"]: '';
			 $agent_type = isset($_POST["agent_type"] ) ? $_POST["agent_type"]: '';
			 $agency = isset($_POST["agency"] ) ? $_POST["agency"]: '';
			 $suburb = isset($_POST["suburb"] ) ? $_POST["suburb"]: '';
			 $firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: '';
			 $lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: '';
			 $email = isset($_POST["email"] ) ? $_POST["email"]: '';
			 $password = isset($_POST["password"]) ? $_POST["password"]: '';
			 $phone = isset($_POST["phone"]) ? $_POST["phone"]: ''; 
			 $gender = isset($_POST["gender"]) ? $_POST["gender"]: ''; 
			 $date = date("Y-m-d H:i:s", time()); 
			 $image = isset($_POST["image"]) ? $_POST["image"]: ''; 
             if ($gender == 'Male'){
                $image = "../back_office/img/male.jpg";
             }else{
                $image = "../back_office/img/female.jpg";
             }
			 
			 $agent = new Agent();
			 $agent->setAgentID($row['agent_id']);
			 $agent->setAgentType($row['agent_type_id']);
			 $agent->setAgency($row['agency_id']);					
			 $agent->setSuburb($row['suburb_id']);
			 $agent->setFirstname($row['firstname']);
			 $agent->setLastname($row['lastname']);
			 $agent->setEmail($row['email']);
			 $agent->setPassword($row['password']);
			 $agent->setPhone($row['phone']);
			 $agent->setGender($row['gender']);
			 $agent->setRegistrationDate($row['date']);
			 $agent->setImage($row['image']);
			 
			 $agent->getAgentID();
			 $agent->getAgentType();
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
			  
			  $query = "INSERT INTO employees (agent_type_id, agency_id, suburb, firstname, lastname, email, password, 
			  			phone, gender, date, image)
			  			VALUES('$agent_type_id', '$agency_id', '$suburb', '$firstname', '$lastname', '$email', 
								md5('$password'), '$phone', '$gender', '$date', '$image')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Agent 
		public function deleteAgent(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM agents
							  WHERE agent_id = '$agent_id'";	
					$row_count = $this->conn->exec($query);
					header("location: employees.php");
					
					return $row_count;
				}else{
					$agent_id = isset($_GET["agent_id"] ) ? $_GET["agent_id"]: ''; 
					$query = "SELECT firstname, lastname FROM agents
							  WHERE agent_id = '$agent_id'";	
					$result = $this->conn->query($query);
					$row = $result->fetch(PDO::FETCH_ASSOC);
					extract($row);
					
					//Main content
					echo'
                	<section class="content delete-employee">
						<div class="row">
							<div class="col-md-12">
								<div class="box box-primary">
									<div class="box-header">
										<strong><h3 class="box-title">Deleting Agent</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $firstname . '  ' . $lastname . '\'s ' . '</strong> account?<br>
										  There is no way to retrieve your account once you confirm!<br>										
										</p>
								     </div>
									 <div class="box-footer clearfix">
									 	<form action="" method="post">
										  <input type="button" value="No" onClick="history.go(-1);" 
										  	class="btn btn-primary btn-md">
										  <input type="submit" name="submit" value="Yes" class="btn btn-danger btn-md"> &nbsp; 
											
										</form>
									 </div>            
                        	     </div>
                    	    </div> 
                	</section>  						
					';
					}
				}else{
					echo"<h1 style='text-align:center; margin-top: 75px'>You don't have administrative privilege to perform this task!</h2>";
				}
				
			}catch(PDOException $e){
			$e->getMessage();
			}
		}
			
		//Update Agent
		public function updateAgent(){
			try{					
				$agent = new Agent();
				$agent_id = isset($_POST["agent_id"] ) ? $_POST["agent_id"]: '';
				$agent_type = isset($_POST["agent_type"] ) ? $_POST["agent_type"]: '';
				$agency = isset($_POST["agency"] ) ? $_POST["agency"]: '';
				$suburb = isset($_POST["suburb "] ) ? $_POST["suburb "]: '';
				$firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: '';
				$lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: '';
				$email = isset($_POST["email"] ) ? $_POST["email"]: '';
				$password = isset($_POST["password"]) ? $_POST["password"]: '';
				$phone = isset($_POST["phone"]) ? $_POST["phone"]: ''; 
				$gender = isset($_POST["gender"]) ? $_POST["gender"]: ''; 
				$type = isset($_POST["type"]) ? $_POST["type"]: ''; 

				$date = date("Y-m-d H:i:s", time()); 
				$image = isset($_POST["image"]) ? $_POST["image"]: ''; 
				 
			 	$agent->setAgentID($row['agent_id']);
			 	$agent->setAgentType($row['agent_type_id']);
			 	$agent->setAgency($row['agency_id']);					
			 	$agent->setSuburb($row['suburb_id']);
			 	$agent->setFirstname($row['firstname']);
			 	$agent->setLastname($row['lastname']);
			 	$agent->setEmail($row['email']);
			 	$agent->setPassword($row['password']);
			 	$agent->setPhone($row['phone']);
			 	$agent->setGender($row['gender']);
			 	$agent->setRegistrationDate($row['date']);
			 	$agent->setImage($row['image']);
			 
			 	$agent->getAgentID();
			 	$agent->getAgentType();
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
				
				$query = "UPDATE agents
						  SET agent_type_id = :agent_type,
						  	  agency_id = :agency,
							  suburb_id = :suburb,
						  	  firstname	= :firstname,
							  lastname	= :lastname,
							  email	= :email,
							  password = :password,
							  phone	= :phone,
							  gender = :gender,
							  date = :date,
							  image	= :image
						  WHERE agent_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":agent_type", $agent_type);
				$statement->bindParam(":agency", $agency);
				$statement->bindParam(":suburb", $suburb);
				$statement->bindParam(":firstname", $firstname);
				$statement->bindParam(":lastname", $lastname);
				$statement->bindParam(":email", $email);
				$statement->bindParam(":password", $password);
				$statement->bindParam(":phone", $phone);
				$statement->bindParam(":gender", $gender);
				$statement->bindParam(":date", $date);
				$statement->bindParam(":image", $image);
				$statement->bindParam(":id", $agent_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Agent Login
		public function login($email, $password){
			try{
				$query = "SELECT * FROM agents WHERE email = '$email' AND password = md5('$password')";
				$result = $this->conn->query($query) or die($conn->error);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($result->rowCount() == 1){
					if($row['password']== md5($password)){
						$_SESSION['employee'] = $row['emp_id'];
						return true;
					}else{
						header("location: login.php?error");
						exit();
					}
				}else{
					header("location: login.php?error");
					exit();
				}
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Login Session Setting
		public function is_logged_in(){
			if(isset($_SESSION['agent'])){
				return true;
			}
		}
		
		//Logout Session Setting
		public function is_logged_out(){
			session_destroy();
			$_SESSION['agent'] = false;
		}
		
		//Redirect employee to correct url
		public function redirect($url){
			header("location: $url");
		}
		
		//Check if email exists
		public function checkMail($email){
			$error_message = "";
			try{
				$query = "SELECT email FROM agents
						  WHERE email = '$email'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$agent = new Agent();
				$agent->setEmail($row['email']);
				
				if(!is_null($agent->getEmail())){
					$error_message = "This email exists, please use different email.";				
				}
				return $agent;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Read one Agent at a time
		public function readOneAgent($agent_id){
			try{
				$query = "SELECT * FROM agents
					  	  WHERE agent_id = ?
            		      LIMIT 0,1";
				$stmt = $this->conn->prepare( $query );
				$stmt->bindParam(1, $emp_id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$agent = new Agent();
				$agent->setAgentID($row['agent_id']);
			 	$agent->setAgentType($row['agent_type_id']);
			 	$agent->setAgency($row['agency_id']);					
			 	$agent->setSuburb($row['suburb_id']);
			 	$agent->setFirstname($row['firstname']);
			 	$agent->setLastname($row['lastname']);
			 	$agent->setEmail($row['email']);
			 	$agent->setPassword($row['password']);
			 	$agent->setPhone($row['phone']);
			 	$agent->setGender($row['gender']);
			 	$agent->setRegistrationDate($row['date']);
			 	$agent->setImage($row['image']);
					
				return $agent;
				
			}catch(PDOException $e){
			echo $e->getMessage();			
			}
		}
		
		//Read all Agent per row per page
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM agents
						  ORDER BY firstname ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Agent Record for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM agents
						  ORDER BY emp_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$agents  = array();
			 	foreach($result as $row){
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setAgentType($row['agent_type_id']);
					$agent->setAgency($row['agency_id']);					
					$agent->setSuburb($row['suburb_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPassword($row['password']);
					$agent->setPhone($row['phone']);
					$agent->setGender($row['gender']);
					$agent->setRegistrationDate($row['date']);
					$agent->setImage($row['image']);
					$agents[] = $agent;
				}
				return $agents;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Agent By ID
		// used for paging records
		public function countAll(){
			try{
				$query = "SELECT agent_id FROM agents";
	 
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Agent By Search
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM agents a
						  WHERE a.firstname LIKE ?";
			 
				// prepare query statement
				$statement = $this->conn->prepare( $query );
			 
				// bind variable values
				$search_term = "%{$search_term}%";
				$statement ->bindParam(1, $search_term);
			 
				$statement ->execute();
				$row = $statement->fetch(PDO::FETCH_ASSOC);
			 
				return $row['total_rows'];
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get the last inserted Agent ID
		public function getLastInsertedID(){
			try{
				$result = $this->conn->lastInsertId();
				return $result;
				
			}catch(PDOException $e){
			$e->getMessage();
			}
		}
		
		//Send Email
		function send_mail($email,$message,$subject){						
			require_once('mailer/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP(); 
			$mail->SMTPDebug  = 0;                     
			$mail->SMTPAuth   = true;                  
			$mail->SMTPSecure = "ssl";                 
			$mail->Host       = "smtp.ipage.com";      
			$mail->Port       = 587;             
			$mail->AddAddress($email);
			$mail->Username="lawrencebosumbe16258";  
			$mail->Password="@Bosumbe1234";            
			$mail->SetFrom('admin@bluepropertyplus.com','Blue Property Plus');
			$mail->AddReplyTo("admin@bluepropertyplus.com","Blue Property Plus");
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->Send();
		}
	}
?>
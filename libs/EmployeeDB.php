<?php
	class EmployeeDB{
		private $conn;
		
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get All Employees
		public function getEmployees(){
			try{
				$query = "SELECT * FROM employees
					  	  ORDER BY emp_id";
				$result = $this->conn->query($query);
				
				$employees = array();
				foreach($result as $row){
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					$employee->setFirstname($row['firstname']);
					$employee->setLastname($row['lastname']);
					$employee->setEmail($row['email']);
					$employee->setPassword($row['password']);
					$employee->setPhone($row['phone']);
					$employee->setGender($row['gender']);
					$employee->setEmployeeType($row['type']);
					$employee->setRegistrationDate($row['date']);
					$employee->setImage($row['image']);
					$employees[] = $employee;
				}				
				return $employees;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Employee By ID
		public function getEmployee($emp_id){
			try{
				$query = "SELECT * FROM employees
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$employee = new Employee();
				$employee->setEmployeeID($row['emp_id']);
				$employee->setFirstname($row['firstname']);
				$employee->setLastname($row['lastmame']);
				$employee->setEmail($row['email']);
				$employee->setPassword($row['password']);
				$employee->setPhone($row['phone']);
				$employee->setGender($row['gender']);
				$employee->setEmployeeType($row['type']);
				$employee->setRegistrationDate($row['date']);
				$employee->setImage($row['image']);
			
				return $employee;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add Employee
		public function addEmployee(){
			try{
			 $emp_id = isset($_POST["emp_id"] ) ? $_POST["emp_id"]: '';
			 $firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: '';
			 $lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: '';
			 $email = isset($_POST["email"] ) ? $_POST["email"]: '';
			 $password = isset($_POST["password"]) ? $_POST["password"]: '';
			 $phone = isset($_POST["phone"]) ? $_POST["phone"]: ''; 
			 $gender = isset($_POST["gender"]) ? $_POST["gender"]: ''; 
			 $type = 'user'; 
			 $date = date("Y-m-d H:i:s", time()); 
			 $image = isset($_POST["image"]) ? $_POST["image"]: ''; 
             if ($gender == 'Male'){
                $image = "public/images/users/male.jpg";
             }else{
                $image = "public/images/users/female.jpg";
             }
			 $employee = new Employee();
			 $employee->setEmployeeID($emp_id );
			 $employee->setFirstname($firstname); 
			 $employee->setLastname($lastname);
			 $employee->setEmail($email);
			 $employee->setPassword($password);
			 $employee->setPhone($phone);
			 $employee->setGender($gender);
			 $employee->setEmployeeType($type);
			 $employee->setRegistrationDate($date);
			 $employee->setImage($image);
			 
			 $employee->getEmployeeID();
			 $employee->getFirstname(); 
			 $employee->getLastname();
			 $employee->getEmail();
			 $employee->getPassword();
			 $employee->getPhone();
			 $employee->getGender();
			 $employee->getEmployeeType();
			 $employee->getRegistrationDate();
			 $employee->getImage();
			  
			  $query = "INSERT INTO employees (firstname, lastname, email, password, phone, gender, type, date, image)
			  			VALUES('$firstname', '$lastname', '$email', (PASSWORD('$password')), '$phone', '$gender', 
						'$type', '$date', '$image')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Employee with delete page
		public function deleteEmployee(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM employees
							  WHERE emp_id = '$emp_id'";	
					$row_count = $this->conn->exec($query);
					header("location: employees.php");
					
					return $row_count;
				}else{
					$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
					$query = "SELECT firstname, lastname FROM employees
							  WHERE emp_id = '$emp_id'";	
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
										<strong><h3 class="box-title">Deleting Employee</h3></strong>
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
		
		//Delete Employee with Bootstrap Modal
		//1. Get Employee By ID
		public function getEmployeeByID(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
					$query = "SELECT firstname, lastname FROM employees
							  WHERE emp_id = '$emp_id'";	
					$result = $conn->query($query);
					$row = $result->fetch(PDO::FETCH_ASSOC);
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					$employee->setEmployeeID($row['firstname']);
					$employee->setEmployeeID($row['lastname']);
					
					return $employee;
		}
		//2. Delete Employee
		public function delete(){
			try{
				if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
					$query = "DELETE FROM employees
							  WHERE emp_id = '$emp_id'";	
					$row_count = $this->conn->exec($query);
					header("location: employees.php");
					
					return $row_count;
				}else{
					
					echo'
						<p>
						  Are you sure you want to delete '. $firstname . '  ' . $lastname . '\'s ' . ' account?<br>
						  There is no way to retrieve your account once you confirm!<br>
						  <form action="" method="post">
							<input type="submit" name="submit" value="Yes"> &nbsp; 
							<input type="button" value=" No " onClick="history.go(-1);">
						  </form>
						</p>
					';
				}
			}catch(PDOException $e){
			$e->getMessage();
			}
		}
			
		//Update Employee
		public function updateEmployee(){
			try{					
				$employee = new Employee();
				$emp_id = isset($_POST["emp_id"] ) ? $_POST["emp_id"]: '';
				$firstname = isset($_POST["firstname"]) ? $_POST["firstname"]: '';
				$lastname = isset($_POST["lastname"]) ? $_POST["lastname"]: '';
				$email = isset($_POST["email"] ) ? $_POST["email"]: '';
				$password = isset($_POST["password"]) ? $_POST["password"]: '';
				$phone = isset($_POST["phone"]) ? $_POST["phone"]: ''; 
				$gender = isset($_POST["gender"]) ? $_POST["gender"]: ''; 
				$type = isset($_POST["type"]) ? $_POST["type"]: ''; 
				$date = date("Y-m-d H:i:s", time()); 
				$image = isset($_POST["image"]) ? $_POST["image"]: ''; 
				 
				$employee->setEmployeeID($emp_id );
				$employee->setFirstname($firstname); 
				$employee->setLastname($lastname);
				$employee->setEmail($email);
				$employee->setPassword($password);
				$employee->setPhone($phone);
				$employee->setGender($gender);
				$employee->setEmployeeType($type);
				$employee->setRegistrationDate($date);
				$employee->setImage($image);
				 
				$employee->getEmployeeID();
				$employee->getFirstname(); 
				$employee->getLastname();
				$employee->getEmail();
				$employee->getPassword();
				$employee->getPhone();
				$employee->getGender();
				$employee->getEmployeeType();
				$employee->getRegistrationDate();
				$employee->getImage();
				
				$query = "UPDATE employees
						  SET firstname	= :firstname,
							  lastname	= :lastname,
							  email	= :email,
							  password = :password,
							  phone	= :phone,
							  gender = :gender,
							  type = :type,
							  date = :date,
							  image	= :image
						  WHERE emp_id	= :id";	
				$statement = $this->conn->prepare($query);
				 
				$statement->bindParam(":firstname", $firstname);
				$statement->bindParam(":lastname", $lastname);
				$statement->bindParam(":email", $email);
				$statement->bindParam(":password", $password);
				$statement->bindParam(":phone", $phone);
				$statement->bindParam(":type", $type);
				$statement->bindParam(":gender", $gender);
				$statement->bindParam(":date", $date);
				$statement->bindParam(":image", $image);
				$statement->bindParam(":id", $emp_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Emplyee Login
		public function login($email, $password){
			try{
				$query = "SELECT * FROM employees WHERE email = '$email' AND password = (PASSWORD('$password'))";
				$result = $this->conn->query($query) or die($conn->error);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($result->rowCount() == 1){
					if($row['password']== (PASSWORD($password))){
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
		public static function is_logged_in(){
			if(isset($_SESSION['employee'])){
				return true;
			}
		}
		
		//Logout Session Setting
		public function is_logged_out(){
			session_destroy();
			$_SESSION['employee'] = false;
		}
		
		//Redirect employee to correct url
		public function redirect($url){
			header("location: $url");
		}
		
		//Check if email exists
		public function checkMail($email){
			$error_message = "";
			try{
				$query = "SELECT email FROM employees
						  WHERE email = '$email'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$employee = new Employee();
				$employee->setEmail($row['email']);
				
				if(!is_null($employee->getEmail())){
					$error_message = "This email exists, please use different email.";				
				}
				return $employee;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Read one Employee at a time
		public function readOneEmployee($emp_id){
			try{
				$query = "SELECT * FROM employees
					  	  WHERE emp_id = ?
            		      LIMIT 0,1";
				$stmt = $this->conn->prepare( $query );
				$stmt->bindParam(1, $emp_id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$employee = new Employee();
				$employee->setEmployeeID($row['emp_id']);
				$employee->setFirstname($row['firstname']);
				$employee->setLastname($row['lastname']);
				$employee->setEmail($row['email']);
				$employee->setPassword($row['password']);
				$employee->setPhone($row['phone']);
				$employee->setGender($row['gender']);
				$employee->setEmployeeType($row['type']);
				$employee->setRegistrationDate($row['date']);
				$employee->setImage($row['image']);
					
				return $employee;
				
			}catch(PDOException $e){
			echo $e->getMessage();			
			}
		}
		
		//Read all employees per row per page
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM employees
						  ORDER BY firstname ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Employee Record for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM employees
						  ORDER BY emp_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$employees  = array();
			 	foreach($result as $row){
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id'] );
					$employee->setFirstname($row['firstname']); 
					$employee->setLastname($row['lastname']);
					$employee->setEmail($row['email']);
					$employee->setPassword($row['password']);
					$employee->setPhone($row['phone']);
					$employee->setEmployeeType($row['type']);
					$employee->setRegistrationDate($row['date']);
					$employee->setImage($row['image']);
					$employees[] = $employee;
				}
				return $employees;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Employees By ID
		// used for paging records
		public function countAll(){
			try{
				$query = "SELECT emp_id FROM employees";
	 
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Employees By Search
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM employees e
						  WHERE e.firstname LIKE ?";
			 
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
		
		//Get the last inserted Employee ID
		public function getLastInsertedID(){
			try{
				$result = $this->conn->lastInsertId();
				return $result;
				
			}catch(PDOException $e){
			$e->getMessage();
			}
		}
		
		//Send Email
		public function send_mail($email,$message,$subject){						
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
<?php
	class Employee_Signup_Model extends Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function checkMail($count){
			$email = isset($_POST['email'])	? $_POST['email']: "";
			$st = $this->db->prepare("SELECT emp_email FROM employees WHERE emp_email = :email");
			$st->execute(array(
				':email' => $email
			));

			$count = $st->rowCount();
			
			return $count;
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
		
	}

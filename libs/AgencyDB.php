<?php
	class AgencyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get All Agencies
		public function getAgencies(){
			try{
				$query = "SELECT * FROM agencies
					  	  ORDER BY agency_id";
				$result = $this->conn->query($query);
				
				$agencies = array();
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					$agencies[] = $agency;
				}	
							
				return $agencies;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Agency By ID
		public function getAgency($agency_id){
			try{
				$query = "SELECT * FROM agencies
						  WHERE agency_id = '$agency_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$agency = new Agency();
				$agency->setAgencyID($row['agency_id']);
				$agency->setAgencyName($row['agency_name']);
				$agency->setLogo($row['logo']);
				
				return $agency;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add Agency
		public function addAgency(){
			try{
			 $agency_id = isset($_POST["agency_id"] ) ? $_POST["agency_id"]: '';
			 $agency_name = isset($_POST["agency_name"]) ? $_POST["agency_name"]: '';
			 $logo = isset($_POST["logo"]) ? $_POST["logo"]: '';
			 
			 $agency = new Agency();
			 $agency->setAgencyID($row['agency_id']);
			 $agency->setAgencyName($row['agency_name']);
			 $agency->setLogo($row['logo']);
			 
			 $agency->getAgencyID();
			 $agency->getAgencyName();
			 $agency->getLogo();
			  
			  $query = "INSERT INTO agencies (agency_name, logo)
			  			VALUES('$agency_name', '$logo')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Agency
		public function deleteAgency(){
			$agency_id = isset($_GET["agency_id"] ) ? $_GET["agency_id"]: ''; 
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM agencies 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM agencies
							  WHERE agency_id = '$agency_id'";	
					$row_count = $this->conn->exec($query);
					header("location: agencies.php");
					
					return $row_count;
				}else{
					$query = "SELECT agency_name FROM agencies
							  WHERE agency_id = '$agency_id'";	
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
										<strong><h3 class="box-title">Deleting Agency</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $agency_name .  '\'s ' . '</strong> account?<br>
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
			
		//Update Employee
		public function updateAgency(){
			try{					
				$agency_id = isset($_POST["agency_id"] ) ? $_POST["agency_id"]: '';
			 	$agency_name = isset($_POST["agency_name"]) ? $_POST["agency_name"]: '';
			 	$logo = isset($_POST["logo"]) ? $_POST["logo"]: '';
			 
			 	$agency = new Agency();
			 	$agency->setAgencyID($row['agency_id']);
			 	$agency->setAgencyName($row['agency_name']);
			 	$agency->setLogo($row['logo']);
			 
			 	$agency->getAgencyID();
			 	$agency->getAgencyName();
			 	$agency->getLogo();				 
							
				$query = "UPDATE agencies
						  SET agency_name	= :agency_name,
							  logo	= :logo,
						  WHERE agency_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":agency_name", $agency_name);
				$statement->bindParam(":logo", $logo);
				$statement->bindParam(":id", $agency_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read one Agency at a time
		public function readOneAgency($agency_id){
			try{
				$query = "SELECT * FROM agencies
					  	  WHERE agency_id = ?
            		      LIMIT 0,1";
				$stmt = $this->conn->prepare( $query );
				$stmt->bindParam(1, $agency_id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$agency = new Agency();
			 	$agency->setAgencyID($row['agency_id']);
			 	$agency->setAgencyName($row['agency_name']);
			 	$agency->setLogo($row['logo']);
					
				return $agency;
				
			}catch(PDOException $e){
			echo $e->getMessage();			
			}
		}
		
		//Read all agencies per row per page
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM agencies
						  ORDER BY agency_name ASC
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
				$query = "SELECT * FROM agencies
						  ORDER BY agency_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$agencies = array();
			 	foreach($result as $row){
					$agency = new Agency();
			 		$agency->setAgencyID($row['agency_id']);
			 		$agency->setAgencyName($row['agency_name']);
			 		$agency->setLogo($row['logo']);
					$agencies[] = $agency;
				}
				
				return $agencies;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all gencies By ID
		// used for paging records
		public function countAll(){
			try{
				$query = "SELECT emp_id FROM agencies";
	 
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all agencies By Search
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM gencies a
						  WHERE a.gency_name LIKE ?";
			 
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

	}
?>
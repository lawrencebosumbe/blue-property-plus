<?php
	class Property_Suburb_Model {
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
					
		//Get a single suburb 
		public function getSuburb($suburb_id){
			try{
				$query = "SELECT * FROM suburbs
						  WHERE suburb_id = '$suburb_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
								
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbCode($row['suburb_code']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setTotalPropertyForSale($row['total_property_forsale']);
				$suburb->setTotalPropertyToRent($row['total_property_torent']);
				$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
				return $suburb;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get all suburbs 
		public function getSuburbs(){
			try{
				$query = "SELECT * FROM suburbs ORDER BY suburb_id";
				$result = $this->conn->query($query);
				$suburbs = array();
				
					foreach($result as $row){											
						//create Suburb object						
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$suburbs[] = $suburb;
					}
					
					return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add suburb
		public function addSuburb(){
			try{
			 	$city = isset($_POST["city"]) ? $_POST["city"]: '';
			 	$municipality = isset($_POST["municipality"]) ? $_POST["municipality"]: '';
			 	$suburb_code = isset($_POST["code"]) ? $_POST["code"]: '';
			 	$suburb_name = isset($_POST["name"]) ? $_POST["name"]: '';
			 	$tot_property_forsale = isset($_POST["tot_property_forsale"]) ? $_POST["tot_property_forsale"]: '';
				$tot_property_torent = isset($_POST["tot_property_torent"]) ? $_POST["tot_property_torent"]: '';
				$tot_property_onshow = isset($_POST["tot_property_onshow"]) ? $_POST["tot_property_onshow"]: '';
			 
			 	$suburb = new Suburb();
			 
				$suburb->setCity($city);
				$suburb->setMunicipality($municipality);
				$suburb->setSuburbCode($suburb_code);
				$suburb->setSuburbName($suburb_name);
				$suburb->setTotalPropertyForSale($row['total_property_forsale']);
				$suburb->setTotalPropertyToRent($row['total_property_torent']);
				$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
				  
				$suburb->getCity();
				$suburb->getMunicipality();
				$suburb->getSuburbCode();
				$suburb->getSuburbName();
				$suburb->getTotalPropertyForSale();
				$suburb->getTotalPropertyToRent();
				$suburb->getTotalPropertyOnShow();
				  
				$query = "INSERT INTO suburbs (city_id, municipality_id, suburb_code, suburb_name, total_property_forsale, 
						  total_property_torent, total_property_onshow)
				          VALUES('$city', '$municipality', '$suburb_code', '$suburb_name', '$tot_property_forsale',
						  '$tot_property_torent', '$tot_property_onshow')";
				$row_count = $this->conn->exec($query);
			  
			    return $row_count;
			  				
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Update suburb
		public function updateSuburb($suburb_id){
			try{
				$suburb_id = isset($_POST["suburb_id"]) ? $_POST["suburb_id"]: '';
			 	$code = isset($_POST["code"]) ? $_POST["code"]: '';
			 	$name = isset($_POST["name"]) ? $_POST["name"]: '';
			 
			 	$suburb = new Suburb();
			 
			 	$suburb->setSuburbID($suburb_id);
				$suburb->setSuburbCode($code);
				$suburb->setSuburbName($name);
				  
				$suburb->getSuburbCode();
				$suburb->getSuburbName();
				$suburb->getSuburbID();
				
				$query = "UPDATE suburbs
						  SET suburb_code = :code,
						  	  suburb_name = :name
						  WHERE suburb_id = :id";
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":code", $code);
				$statement->bindParam(":name", $name);
				$statement->bindParam(":id", $suburb_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
				
		//Delete suburb
		public function deleteSuburb($suburb_id){
			try{
				$query = "DELETE FROM suburbs WHERE suburb_id = '$suburb_id'";
				$row_count = $this->conn->exec($query);
					
				return $row_count;
				
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Read all suburbs per row per page
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM suburbs
						  ORDER BY suburb_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get suburb records for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM suburbs
						  ORDER BY suburb_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$suburbs  = array();
			 	foreach($result as $row){
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id'] );
					$suburb->setSuburbCode($row['suburb_code']); 
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setTotalPropertyForSale($row['total_property_forsale']);
					$suburb->setTotalPropertyToRent($row['total_property_torent']);
					$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
				
					$suburbs[] = $suburb;
				}
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		 Count all suburb IDs
		 used for paging records
		*/
		public function countAll(){
			try{
				$query = "SELECT suburb_id FROM suburbs";
	 
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}



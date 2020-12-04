<?php
	class Property_City_Model {
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
					
		//Get a single city 
		public function getCity($city_id){
			try{
				$query = "SELECT * FROM cities
						  WHERE city_id = '$city_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
								
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityCode($row['city_code']);
				$city->setCityName($row['city_name']);
				$city->setTotalPropertyForSale($row['total_property_forsale']);
				$city->setTotalPropertyToRent($row['total_property_torent']);
				$city->setTotalPropertyForSale($row['total_property_onshow']);
				$city->setLatitude($row['latitude']);
				$city->setLongitude($row['longitude']);
				
				return $city;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get all cities 
		public function getCities(){
			try{
				$query = "SELECT * FROM cities ORDER BY city_id";
				$result = $this->conn->query($query);
				$cities = array();
				
					foreach($result as $row){											
						//create city object						
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						$city->setLatitude($row['latitude']);
						$city->setLongitude($row['longitude']);
						$cities[] = $city;
					}
					
					return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add city
		public function addCity(){
			try{
			 	$municipality = isset($_POST["municipality"]) ? $_POST["municipality"]: '';
			 	$city_code = isset($_POST["code"]) ? $_POST["code"]: '';
			 	$city_name = isset($_POST["name"]) ? $_POST["name"]: '';
				$tot_property_forsale = isset($_POST["tot_property_forsale"]) ? $_POST["tot_property_forsale"]: '';
				$tot_property_torent = isset($_POST["tot_property_torent"]) ? $_POST["tot_property_torent"]: '';
				$tot_property_onshow = isset($_POST["tot_property_onshow"]) ? $_POST["tot_property_onshow"]: '';
				$latitude = isset($_POST['latitude']) ? $_POST['latitude']: '';
				$longitude = isset($_POST['longitude']) ? $_POST['longitude']: '';
					 
			 	$city = new City();
			 
				$city->setMunicipality($municipality);
				$city->setCityCode($city_code);
				$city->setCityName($city_name);
				$city->setTotalPropertyForSale($row['total_property_forsale']);
				$city->setTotalPropertyToRent($row['total_property_torent']);
				$city->setTotalPropertyOnShow($row['total_property_onshow']);
				$city->setLatitude($row['latitude']);
				$city->setLongitude($row['longitude']);
					  
				$city->getMunicipality();
				$city->getCityCode();
				$city->getCityName();
				$city->getTotalPropertyForSale();
				$city->getTotalPropertyToRent();
				$city->getTotalPropertyOnShow();
				$city->getLatitude();
				$city->getLongitude();
				
				$query = "INSERT INTO cities (municipality_id, city_code, city_name, total_property_forsale, total_property_torent,
						  total_property_onshow, latitude, longitude)
				          VALUES('$municipality', '$city_code', '$city_name', '$tot_property_forsale', '$tot_property_torent',
						  '$tot_property_onshow', '$latitude', '$longitude')";
				$row_count = $this->conn->exec($query);
			  
			    return $row_count;
			  				
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Update city
		public function updateCity($city_id){
			try{
				$city_id = isset($_POST["city_id"]) ? $_POST["city_id"]: '';
			 	$code = isset($_POST["code"]) ? $_POST["code"]: '';
			 	$name = isset($_POST["name"]) ? $_POST["name"]: '';
				$latitude = isset($_POST['latitude']) ? $_POST['latitude']: '';
				$longitude = isset($_POST['longitude']) ? $_POST['longitude']: '';
				
			 	$city = new City();
			 
			 	$city->setCityID($city_id);
				$city->setCityCode($code);
				$city->setCityName($name);
				$city->setLatitude($latitude);
				$city->setLongitude($longitude);
				 
				$city->getCityID();
				$city->getCityCode();
				$city->getCityName();
				$city->getLatitude();
				$city->getLongitude();
				
				$query = "UPDATE cities
						  SET city_code = :code,
						  	  city_name = :name,
							  latitude = :latitude,
							  longitude = :longitude
						  WHERE city_id = :id";
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":code", $code);
				$statement->bindParam(":name", $name);
				$statement->bindParam(":latitude", $latitude);
				$statement->bindParam(":longitude", $longitude);
				$statement->bindParam(":id", $city_id);
				
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
				
		//Delete city
		public function deleteCity($city_id){
			try{
				$query = "DELETE FROM cities WHERE city_id = '$city_id'";
				$row_count = $this->conn->exec($query);
					
				return $row_count;
				
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Read all cities per row per page
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM cities
						  ORDER BY city_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get city records for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM cities
						  ORDER BY city_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$cities  = array();
			 	foreach($result as $row){
					$city = new City();
					$city->setCityID($row['city_id'] );
					$city->setCityCode($row['city_code']); 
					$city->setCityName($row['city_name']);
					$city->setTotalPropertyForSale($row['total_property_forsale']);
					$city->setTotalPropertyToRent($row['total_property_torent']);
					$city->setTotalPropertyOnShow($row['total_property_onshow']);
					$city->setLatitude($row['latitude']);
					$city->setLongitude($row['longitude']);
				
					$cities[] = $city;
				}
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		 Count all city IDs
		 used for paging records
		*/
		public function countAll(){
			try{
				$query = "SELECT city_id FROM cities";
	 
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}



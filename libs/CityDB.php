<?php
	class CityDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get City By ID
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
				$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
				return $city;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get all Cities
		public function get_cities(){
			try{
				$query = "SELECT * FROM cities 
						  ORDER BY city_id";
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
						
						array_push($cities, $city); // $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Cities By Municipality ID
		public function getCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}		
		
		//Get City with total properties
		public function getTotalPropetiesByCity(){
			try{
				$query ="SELECT SELECT * FROM cities";
				$result = $this->conn->query($query);
				
				$cities = array();
				
				foreach($result as $row){
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityCode($row['city_code']);
					$city->setCityName($row['city_name']);
					$city->setTotalPropertyForSale($row['total_property_forsale']);
					$city->setTotalPropertyToRent($row['total_property_torent']);
					$city->setTotalPropertyOnShow($row['total_property_onshow']);	
									
					array_push($cities, $city);					
				}
				
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Cities By Province ID
		public function getCitiesByProvince($province_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get cities By Municipality ID
		public function getMunicipalityCities($municipality_id, $conditions=array()){
			try{
				$selectSQL = ' c.*, m.municipality_name, m.municipality_code, m.municipality_id';
				$limitSQL = '';
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$selectSQL = 'COUNT(*) as rowNum';
				}
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = ' LIMIT '.$conditions['limit'];
				}
				
				$query = "SELECT ".$selectSQL." FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  ORDER BY c.city_name 
						  ".$limitSQL;
				$result = $this->conn->query($query);
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}
				
				$cities = array();
					foreach($result as $row){
												
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setMunicipality($municipality);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //$cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image for sale By City ID		
		public function getPropertyByCityForSale($city_id, $conditions=array()){
			$selectSQL = 'properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, agents.firstname, agents.lastname, image, 
						  agencies.agency_id, logo';
			$limitSQL = '';
			if(!empty($conditions) && array_key_exists('count', $conditions)){
				$selectSQL = 'COUNT(*) as rowNum FROM (SELECT properties.*';
				$limitSQL = ') groups';
			}else{
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = 'LIMIT '.$conditions['limit'];
				}
			}
			
			try{
				$query = "SELECT ".$selectSQL."
						  FROM properties 
						  LEFT JOIN property_images	
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces
						  ON municipalities.province_id = provinces.province_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE cities.city_id = '$city_id'
						  AND property_status = 'For Sale'
						  GROUP BY properties.property_id ORDER BY properties.property_id DESC
						  ".$limitSQL;
				$result = $this->conn->query($query);
				
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}

			    $suburbs = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setLogo($row['logo']);
											
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setImage($row['image']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					$munucipality->setProvince($province);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setPropertyID($row['property_id']);
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);				
					$suburb->setNumBathRoom($row['num_bathrooms']);
					$suburb->setNumBed($row['num_beds']);
					$suburb->setNumGarage($row['num_garages']);		
					$suburb->setPropertyDescription($row['property_desc']);	
					$suburb->setPropertyType($row['property_type']);		
					$suburb->setPrice($row['price']);		
					$suburb->setImageLocation($row['image_location']);	
					$suburb->setStreetNo($row['street_no']);
					$suburb->setStreetName($row['street_name']);				
					$suburb->setAgent($agent);	
								
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image on show By City ID		
		public function getPropertyByCityOnShow($city_id, $conditions=array()){
			$selectSQL = 'properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, agents.firstname, agents.lastname, image,
						  agencies.agency_id, logo';
			$limitSQL = '';
			if(!empty($conditions) && array_key_exists('count', $conditions)){
				$selectSQL = 'COUNT(*) as rowNum FROM (SELECT properties.*';
				$limitSQL = ') groups';
			}else{
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = 'LIMIT '.$conditions['limit'];
				}
			}
			
			try{
				$query = "SELECT ".$selectSQL."
						  FROM properties 
						  LEFT JOIN property_images	
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces
						  ON municipalities.province_id = provinces.province_id
						  LEFT JOIN agents
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  ON properties.agent_id = agents.agent_id
						  WHERE cities.city_id = '$city_id'
						  AND property_status = 'On Show'
						  GROUP BY properties.property_id ORDER BY properties.property_id DESC
						  ".$limitSQL;
				$result = $this->conn->query($query);
				
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}

			    $suburbs = array();
				
				foreach($result as $row){	
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setImage($row['image']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					$munucipality->setProvince($province);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setPropertyID($row['property_id']);
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);				
					$suburb->setNumBathRoom($row['num_bathrooms']);
					$suburb->setNumBed($row['num_beds']);
					$suburb->setNumGarage($row['num_garages']);		
					$suburb->setPropertyDescription($row['property_desc']);			
					$suburb->setPrice($row['price']);		
					$suburb->setImageLocation($row['image_location']);
					$suburb->setStreetNo($row['street_no']);
					$suburb->setStreetName($row['street_name']);					
					$suburb->setAgent($agent);	
								
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image on show By City ID		
		public function getPropertyByCityToRent($city_id, $conditions=array()){
			$selectSQL = 'properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, agents.firstname, agents.lastname, image,
						  agencies.agency_id, logo';
			$limitSQL = '';
			if(!empty($conditions) && array_key_exists('count', $conditions)){
				$selectSQL = 'COUNT(*) as rowNum FROM (SELECT properties.*';
				$limitSQL = ') groups';
			}else{
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = 'LIMIT '.$conditions['limit'];
				}
			}
			
			try{
				$query = "SELECT ".$selectSQL."
						  FROM properties 
						  LEFT JOIN property_images	
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces
						  ON municipalities.province_id = provinces.province_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id						  
						  WHERE cities.city_id = '$city_id'
						  AND property_status = 'To Rent'
						  GROUP BY properties.property_id ORDER BY properties.property_id DESC
						  ".$limitSQL;
				$result = $this->conn->query($query);
				
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}

			    $suburbs = array();
				
				foreach($result as $row){	
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setImage($row['image']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					$munucipality->setProvince($province);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setPropertyID($row['property_id']);
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);				
					$suburb->setNumBathRoom($row['num_bathrooms']);
					$suburb->setNumBed($row['num_beds']);
					$suburb->setNumGarage($row['num_garages']);		
					$suburb->setPropertyDescription($row['property_desc']);			
					$suburb->setPrice($row['price']);		
					$suburb->setImageLocation($row['image_location']);
					$suburb->setStreetNo($row['street_no']);
					$suburb->setStreetName($row['street_name']);					
					$suburb->setAgent($agent);	
								
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read One City at a time
		public function ReadOneCity(){
			try{
				$query = "SELECT city_code, city_name, total_properties
						  FROM cities
						  WHERE city_id = ?
						  LIMIT 0, 1";
				$statement = $this->conn->prepare($query);
				$statement->bindParam(1, $city_id);
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				
				$city = new City();
				$city->setCityCode($row['city_code']);
				$city->setCityName($row['city_name']);
				
				return $city;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get City Records
		public function getCityRecords(){
			try{
				$query = "SELECT * FROM cities
						  ORDER BY city_id ASC";
				$result = $this->conn->query($query);
				
				$cities = array();
				
				foreach($result as $row){
					$city = new City();
					$city->setCityCode($row['city_code']);
					$city->setCityName($row['city_name']);
					$city->setTotalPropertyForSale($row['total_property_forsale']);
					$city->setTotalPropertyToRent($row['total_property_torent']);
					$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
					array_push($cities, $city);
				}
								
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN GAUTENG
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Gauteng
		public function getGautengCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '1'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Johannesburg Cities
		public function getJohannesburgCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '2'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Ekurhuleni Cities
		public function getEkurhuleniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '1'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Pretoria Cities
		public function getPretoriaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '3'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Emfuleni Cities
		public function getEmfuleniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '4'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Midvaal Cities
		public function getMidvaalCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '5'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Rand West Cities
		public function getRandWestCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '9'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Lesedi Cities
		public function getLesediCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '6'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Mogale Cities
		public function getMogaleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '7'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Merafong Cities
		public function getMerafongCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '8'";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
						
						$cities[] = $city; // or array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN EASTERN CAPE
		------------------------------------------------------------------------------------------
		*/

		public function getEasternCapeCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '2'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get City in Western Cape
		public function getWesternCapeCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '3'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All Cities in Kwa-Zulu Natal
		public function getKwaZuluNatalCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '4'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All Cities in Limpopo
		public function getLimpopoCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '5'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All Cities in Mpumalanga
		public function getMpumalangaCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '6'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get City in Free State
		public function getFreeStateCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '7'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get City in North West
		public function getNorthWestCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '8'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get City in Northern Cape
		public function getNorthernCapeCities(){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '9'
						  ORDER BY city_name ASC";
				$result = $this->conn->query($query);
				$cities = array();
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setProvince($province);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setMunicipality($municipality);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						$city->setTotalPropertyForSale($row['total_property_forsale']);
						$city->setTotalPropertyToRent($row['total_property_torent']);
						$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($cities, $city); //or $cities[] = $city;
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add City
		public function addCity(){
			try{
			 $current_city = isset($_POST["city_id"] ) ? $_POST["city_id"]: '';
			 $municipality = isset($_POST["municipality"]) ? $_POST["municipality"]: '';
			 $city_code = isset($_POST["city_code"]) ? $_POST["city_code"]: '';
			 $city_name = isset($_POST["city_name"]) ? $_POST["city_name"]: '';
			 $tot_property_forsale = isset($_POST["total_property_forsale"]) ? $_POST["total_property_forsale"]: '';
			 $tot_property_torent = isset($_POST["total_property_torent"]) ? $_POST["total_property_torent"]: '';
			 $tot_property_onshow = isset($_POST["total_property_onshow"]) ? $_POST["total_property_onshow"]: '';
			 
			 $city = new City();
			 $city->setCityID($current_city);
			 $city->setMunicipality($municipality);
			 $city->setCityCode($city_code);
			 $city->setCityName($city_name);
			 $city->setTotalPropertyForSale($row['total_property_forsale']);
			 $city->setTotalPropertyToRent($row['total_property_torent']);
			 $city->setTotalPropertyOnShow($row['total_property_onshow']);
			 
			 $city->getCityID();
			 $city->getMunicipality();
			 $city->getCityCode();
			 $city->getCityName();
			 $city->setTotalPropertyForSale();
			 $city->setTotalPropertyToRent();
			 $city->setTotalPropertyOnShow();
			  
			  $query = "INSERT INTO cities (municipality_id, city_code, city_name, total_property_forsale, total_property_torent, 
			  			total_property_onshow)
			  			VALUES('$municipality', '$city_code', '$city_name', '$tot_property_forsale', '$tot_property_torent', 
						'$tot_property_onshow')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				echo 'Error' . $e->__toString();
			}
		}
		
		//Delete City
		public function deleteCity(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM cities
							  WHERE city_id = '$city_id'";	
					$row_count = $this->conn->exec($query);
					header("location: cities.php");
					
					return $row_count;
				}else{
					$city_id = isset($_GET["city_id"] ) ? $_GET["city_id"]: ''; 
					$query = "SELECT city_name FROM cities
							  WHERE city_id = '$city_id'";	
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
										<strong><h3 class="box-title">Deleting City</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $city_name . '</strong>?<br>
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
			
		//Update City
		public function updateCity(){
			try{					
				$city_id = isset($_POST["city_id"] ) ? $_POST["city_id"]: '';
				$municipality_id = isset($_POST["municipality_id"]) ? $_POST["municipality_id"]: '';
				$city_code = isset($_POST["city_code"]) ? $_POST["city_code"]: '';
				$city_name = isset($_POST["city_name"]) ? $_POST["city_name"]: '';
	
				$municipality = new Municipality();
				$municipality->getMunicipality($municipality_id);
				 
				$city = new City();
				$city->setMunicipalityID($city_id);
			 	$city->setMunicipality($municipality);
			 	$city->setCityCode($municipality_code);
			 	$city->setCityName($municipality_name);
				 
				$city->getCityID();
				$city->getMunicipality();
				$city->getCityCode();
				$city->getCityName();
				
				$query = "UPDATE cities
						  SET municipality_id	= :municipality_id,
							  city_code	= :city_code,
							  city_name	= :city_name,
						  WHERE city_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":municipality_id", $municipality_id);
				$statement->bindParam(":city_code", $city_code);
				$statement->bindParam(":city_name", $city_name);
				$statement->bindParam(":id", $city_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read all Cities per record 
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT city_id, city_code, city_name FROM cities
						  ORDER BY city_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all City Ids
		public function countAll(){
			try{
				$query = "SELECT city_id FROM cities";
	 
				$statement =$this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		//Count all cities' rows by search term
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE c.city_name LIKE ?";
			 
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
				
		//Get City Records for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM cities
						  ORDER BY city_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$cities  = array();
				
			 	foreach($result as $row){
				
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityCode($row['city_code']);
				$city->setCityName($row['city_name']);
				$city->setTotalPropertyForSale($row['total_property_forsale']);
				$city->setTotalPropertyToRent($row['total_property_torent']);
				$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
				$cities[] = $city;
				}
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		
		// Read City by search term
		public function search($search_term, $from_record_num, $records_per_page){
			try{
				// select query
				$query = "SELECT m.municipality_name as municipality, c.city_id, c.city_name, m.municipality_id
						  FROM cities c LEFT JOIN municipalities m
								ON c.municipality_id = m.municipality_id
					WHERE
						c.city_name LIKE ? OR m.municipality_name LIKE ?
					ORDER BY
						c.city_name ASC
					LIMIT
						?, ?";
		 
				// prepare query statement
				$stmt = $this->conn->prepare( $query );
			 
				// bind variable values
				$search_term = "%{$search_term}%";
				$stmt->bindParam(1, $search_term);
				$stmt->bindParam(2, $search_term);
				$stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
				$stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
			 
				// execute query
				$stmt->execute();
			 
				// return values from database
				return $stmt;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
?>
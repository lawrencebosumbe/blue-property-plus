<?php
	class SuburbDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get Suburb By ID
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
		
		//Get Suburbs 
		public function get_suburbs(){
			try{
				$query = "SELECT * FROM suburbs
						  ORDER BY suburb_id";
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
		
		//Get Suburbs By City ID
		public function getSuburbs($city_id){
			try{
				$query = "SELECT s.*, c.city_name, c.city_code, c.city_id FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE c.city_id = '$city_id'
						  ORDER BY s.suburb_name ASC";
				$result = $this->conn->query($query);
				$suburbs = array();
				
					foreach($result as $row){
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						
						//create Suburb object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setCity($city);
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
		
		//Get Suburbs By Municipality ID
		public function getMunicipalitySuburbs($municipality_id, $conditions=array()){
			try{
				$selectSQL = ' s.*, m.municipality_name, m.municipality_code, m.municipality_id, c.city_name, c.city_code, c.city_id';
				$limitSQL = '';
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$selectSQL = 'COUNT(*) as rowNum';
				}
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = ' LIMIT '.$conditions['limit'];
				}
				
				$query = "SELECT ".$selectSQL." FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE m.municipality_id = '$municipality_id'
						  ORDER BY s.suburb_name 
						  ".$limitSQL;
				$result = $this->conn->query($query);
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}
				
				$suburbs = array();
					foreach($result as $row){
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setCity($city);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($suburbs, $suburb); //$cities[] = $city;
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Suburbs By City ID
		public function getCitySuburbs($city_id, $conditions=array()){
			try{
				$selectSQL = ' s.*, m.municipality_name, m.municipality_code, m.municipality_id, c.city_name, c.city_code, c.city_id';
				$limitSQL = '';
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$selectSQL = 'COUNT(*) as rowNum';
				}
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = ' LIMIT '.$conditions['limit'];
				}
				
				$query = "SELECT ".$selectSQL." FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE c.city_id = '$city_id'
						  ORDER BY s.suburb_name 
						  ".$limitSQL;
				$result = $this->conn->query($query);
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}
				
				$suburbs = array();
					foreach($result as $row){
						//create city object
						$city = new City();
						$city->setCityID($row['city_id']);
						$city->setCityCode($row['city_code']);
						$city->setCityName($row['city_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setCity($city);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($suburbs, $suburb); //$cities[] = $city;
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get Property Image By Municipality ID		
		public function getPropertyByMunicipality($municipality_id){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, suburbs.total_properties
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
						  WHERE municipalities.municipality_id = '$municipality_id'
						  GROUP BY properties.property_id
						  ";
				$result = $this->conn->query($query);

			    $suburbs = array();
				
				foreach($result as $row){	

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
				
		//Get Property for sale image by Suburb ID		
		public function getPropertyBySuburbForSale($suburb_id, $conditions=array()){
			try{
				$selectSQL = 'properties.property_id, property_status, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, image, agencies.agency_id,
						  logo';
				$limitSQL = '';
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$selectSQL = 'COUNT(*) as rowNum FROM (SELECT properties.*';
					$limitSQL = ') groups';
				}else{
					if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
						$limitSQL = 'LIMIT '.$conditions['limit'];
					}
				}
				
				
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
						  WHERE suburbs.suburb_id = '$suburb_id'
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
					$suburb->setPrice($row['price']);		
					$suburb->setImageLocation($row['image_location']);					
					$suburb->setAgent($agent);	
					$suburb->setStreetNo($row['street_no']);
					$suburb->setStreetName($row['street_name']);		
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property for sale image by Suburb ID		
		public function getPropertyBySuburbToRent($suburb_id, $conditions=array()){
			try{
				$selectSQL = 'properties.property_id, property_status, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, image,
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
						  WHERE suburbs.suburb_id = '$suburb_id'
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
		
		//Get Property for sale image by Suburb ID		
		public function getPropertyBySuburbOnShow($suburb_id, $conditions=array()){
			try{
				$selectSQL = 'properties.property_id, property_status, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, image,
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
						  WHERE suburbs.suburb_id = '$suburb_id'
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
					$suburb->setAgent($agent);	
					$suburb->setStreetNo($row['street_no']);
					$suburb->setStreetName($row['street_name']);
							
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get Property Image to rent By City ID		
		public function getPropertyByCityToRent($city_id, $conditions=array()){
			$selectSQL = 'properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, agents.firstname, agents.lastname, image';
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
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setImage($row['image']);
					
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
					$suburb->setAgent($agent);	
								
					$suburbs[] = $suburb;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Suburb Property Image By Property ID		
		public function getPropertySuburbs($property_id){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
						  provinces.province_id, province_name
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
						  WHERE properties.property_id = '$property_id'
						  GROUP BY properties.property_id
						  ";
				$result = $this->conn->query($query);

			    $suburbs = array();
				
				foreach($result as $row){	

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
					
					$sub = new Suburb();
					$sub->setPropertyID($row['property_id']);
					$sub->setSuburbID($row['suburb_id']);
					$sub->setSuburbName($row['suburb_name']);
					$sub->setCity($city);				
					$sub->setNumBathRoom($row['num_bathrooms']);
					$sub->setNumBed($row['num_beds']);
					$sub->setNumGarage($row['num_garages']);		
					$sub->setPropertyDescription($row['property_desc']);			
					$sub->setPrice($row['price']);		
					$sub->setImageLocation($row['image_location']);					
								
					$suburbs[] = $sub;
	
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Total Suburbs By City ID
		public function getTotalPropertyBySuburbs($city_id){
			try{
				$query = "SELECT s.*, c.city_id, city_name
						  FROM suburbs s LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE c.city_id = '$city_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
					//create city object
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
						
					//create Suburb object
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setTotalPropertyForSale($row['total_property_forsale']);
					$suburb->setTotalPropertyToRent($row['total_property_torent']);
					$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
					$suburb->setCity($city);
					
				return $suburb;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Total Suburbs By Municipality ID
		public function getTotalMunicipalitySuburbs($municipality_id){
			try{
				$query = "SELECT COUNT(*) AS num_rows, c.city_id, c.city_name, m.municipality_id, m.municipality_name
						  FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
					//Create Municipality Object
					$municipality = new Municipality();
					$municipality->setMunicipalityID($row['municipality_id']);
					$municipality->setMunicipalityName($row['municipality_name']);
					
					//create city object
					$city = new City();
					$city->setMunicipality($municipality);
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
						
					//create Suburb object
					$suburb = new Suburb();
					$suburb->setSuburbID($row['num_rows']);
					$suburb->setCity($city);
					
				return $suburb;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			
		}
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN MUNICIPALITY
		------------------------------------------------------------------------------------------
		*/
		
		//Get Suburbs in Ekurhuleni
		public function getEkurhuleniSuburbs(){
			try{
				$query = "SELECT s.*, c.city_id, c.city_name, c.city_code, m.municipality_name, 
						  m.municipality_code, m.municipality_id
						  FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '1'
						  ORDER BY suburb_name ASC";
				$result = $this->conn->query($query);
				$suburbs = array();
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
						
						$suburb = new Suburb();
						$suburb->setCity($city);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						
						array_push($suburbs, $suburb); 
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Suburbs in Ekurhuleni
		public function getJohannesburgSuburbs($municipality_id){
			try{
				$query = "SELECT s.*, c.city_id, c.city_name, c.city_code, m.municipality_name, 
						  m.municipality_code, m.municipality_id
						  FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '2'
						  ORDER BY suburb_name ASC";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						$suburb = new Suburb();
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb); 
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Johannesburg Suburbs
		public function getJohannesburgSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '2'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Ekurhuleni Suburbs
		public function getEkurhuleniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '1'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Emfuleni Suburbs
		public function getEmfuleniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '4'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Midvaal Suburbs
		public function getMidvaalSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '5'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Rand West Suburbs
		public function getRandWestSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '9'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Suburbs in Pretoria
		public function getPretoriaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '3'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Lesidi Suburbs
		public function getLesediSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '6'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Mogale Suburbs
		public function getMogaleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '7'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Merafong Suburbs
		public function getMerafongSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '8'";
				$result = $this->conn->query($query);
				$suburbs = array();
					foreach($result as $row){
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setMunicipality($municipality);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add Suburb
		public function addSuburb(){
			try{
			 $suburb_id = isset($_POST["suburb_id"] ) ? $_POST["suburb_id"]: '';
			 $city_id = isset($_POST["city_id"]) ? $_POST["city_id"]: '';
			 $suburb_code = isset($_POST["suburb_code"]) ? $_POST["suburb_code"]: '';
			 $suburb_name = isset($_POST["suburb_name"]) ? $_POST["suburb_name"]: '';

			 $city = new City();
			 $city->getCity($city_id);
			 
			 $suburb = new Suburb();
			 $suburb->setSuburbID($suburb_id);
			 $suburb->setMunicipality($city);
			 $suburb->setSuburbCode($suburb_code);
			 $suburb->setSuburbName($suburb_name);
			 
			 $suburb->getSuburbID();
			 $suburb->getCity();
			 $suburb->getSuburbCode();
			 $suburb->getSuburbName();
			
			  
			  $query = "INSERT INTO suburbs (city_id, suburb_code, suburb_name)
			  			VALUES('$city_id', '$suburb_code', '$suburb_name')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Suburb
		public function deleteSuburb(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM suburbs
							  WHERE suburb_id = '$suburb_id'";	
					$row_count = $this->conn->exec($query);
					header("location: cities.php");
					
					return $row_count;
				}else{
					$suburb_id = isset($_GET["suburb_id"] ) ? $_GET["suburb_id"]: ''; 
					$query = "SELECT suburb_name FROM suburbs
							  WHERE suburb_id = '$suburb_id'";	
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
										<strong><h3 class="box-title">Deleting Suburb</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $suburb_name . '</strong>?<br>
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
			
		//Update Suburb
		public function updateSuburb(){
			try{					
				$suburb_id = isset($_POST["suburb_id"] ) ? $_POST["suburb_id"]: '';
				$city_id = isset($_POST["city_id"]) ? $_POST["city_id"]: '';
				$suburb_code = isset($_POST["suburb_code"]) ? $_POST["suburb_code"]: '';
				$suburb_name = isset($_POST["suburb_name"]) ? $_POST["suburb_name"]: '';
	
				$city = new City();
				$city->getCity($city_id);
				 
				$suburb = new Suburb();
				$suburb->setSuburbID($suburb_id);
			 	$suburb->setMunicipality($city);
			 	$suburb->setSuburbCode($suburb_code);
			 	$suburb->setSuburbName($suburb_name);
				 
				$suburb->getSuburbID();
				$suburb->getCity();
				$suburb->getSuburbCode();
				$suburb->getSuburbName();
				
				$query = "UPDATE suburbs
						  SET city_id	= :city_id,
							  suburb_code	= :suburb_code,
							  suburb_name	= :suburb_name,
						  WHERE suburb_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":city_id", $city_id);
				$statement->bindParam(":suburb_code", $suburb_code);
				$statement->bindParam(":suburb_name", $suburb_name);
				$statement->bindParam(":id", $suburb_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read all Suburbs per record 
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT suburb_id, suburb_code, suburb_name FROM suburbs
						  ORDER BY suburb_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Suburb Ids
		public function countAll(){
			try{
				$query = "SELECT suburb_id FROM suburbs";
	 
				$statement =$this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		//Count all Suburbs' rows by search term
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE s.suburb_name LIKE ?";
			 
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
				
		//Get Suburb Records for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM suburbs
						  ORDER BY suburb_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$suburbs  = array();
				
			 	foreach($result as $row){
				
				//Cosntruct suburb object				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbCode($row['suburb_code']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburbs[] = $suburb;
				}
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		//Get Suburb Records for pagination by municipality ID
		public function getSuburbMunicipalityRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT s.*, m.municipality_id, m.municipality_name
						  FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  ORDER BY suburb_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$suburbs  = array();
				
			 	foreach($result as $row){
				
				//Cosntruct suburb object	
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityName($row['municipality_name']);
							
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbCode($row['suburb_code']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setMunicipality($municipality);
				$suburbs[] = $suburb;
				}
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		// Read Suburb by search term
		public function search($search_term, $from_record_num, $records_per_page){
			try{
				// select query
				$query = "SELECT c.city_name as city, s.suburb_id, s.suburb_name, c.city_id
						  FROM suburbs s LEFT JOIN cities c
								ON s.city_id = c.city_id
					WHERE
						s.suburb_name LIKE ? OR c.city_name LIKE ?
					ORDER BY
						s.suburb_name ASC
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
		
		//Get Property Listings By Municipality
		public function getPropertyListByMunicipality($municipality_id){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, num_beds, num_garages, 
						  property_image_id, image_location, suburbs.suburb_id, suburb_name, cities.city_id, city_name, 
						  municipalities.municipality_id, municipality_name, provinces.province_id, province_name 
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
						  WHERE municipalities.municipality_id = '$municipality_id'

						  GROUP BY suburbs.suburb_id 						  
						  DESC LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $suburbs = array();
				
				foreach($result as $row){					
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
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
					$suburb->setPropertyDescription($row['property_desc']);
					$suburb->setNumBathRoom($row['num_bathrooms']);
					$suburb->setNumBed($row['num_beds']);
					$suburb->setNumGarage($row['num_garages']);
					$suburb->setPrice($row['price']);	
					$suburb->setImageLocation($row['image_location']);
																								
					$suburbs[] = $suburb;
				}
				
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}	
	}
?>
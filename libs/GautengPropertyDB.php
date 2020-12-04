<?php
	class GautengPropertyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		/*
		------------------------------------------------------------------------------------------
			PROPERTY IMAGES IN GAUTENG
			url/gauteng/index.php
		------------------------------------------------------------------------------------------
		*/
		
		public function getGautengPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_status, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, email, 
						  phone, agencies.agency_id, agency_name, logo
						  FROM property_images 
						  LEFT JOIN properties
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
						  WHERE property_status = 'For Sale'
						  AND provinces.province_id = '1'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
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
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getGautengPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_status, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, email, 
						  phone, agencies.agency_id, agency_name, logo
						  FROM property_images 
						  LEFT JOIN properties
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
						  WHERE property_status = 'On Show'
						  AND provinces.province_id = '1'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
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
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getGautengPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_status, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name, 
						  provinces.province_id, province_name, agents.agent_id, firstname, lastname, email, 
						  phone, agencies.agency_id, agency_name, logo
						  FROM property_images 
						  LEFT JOIN properties
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
						  WHERE property_status = 'To Rent'
						  AND provinces.province_id = '1'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
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
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getGautengSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  provinces.province_id, provinces.province_name, provinces.province_code,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE provinces.province_id = 1
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					$province->setProvinceCode($row['province_code']);
					
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getGautengSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  provinces.province_id, provinces.province_name, provinces.province_code,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE provinces.province_id = 1
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					$province->setProvinceCode($row['province_code']);
					
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getGautengSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  provinces.province_id, provinces.province_name, provinces.province_code,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE provinces.province_id = 1
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceName($row['province_name']);
					$province->setProvinceCode($row['province_code']);
					
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			MUNICIPALITIES IN GAUTENG BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Free State
		public function getGautengMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '1'
						  ORDER BY municipality_name ASC";
				$result = $this->conn->query($query);
				
				$municipalities = array();
				
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
						
						$municipalities[] = $municipality; 
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CTIES IN GAUTENG BY MUNICIPALITY ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Free State
		public function getGautengCity($municipality_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '1'
						  ORDER BY municipality_name ASC";
				$result = $this->conn->query($query);
				
				$municipalities = array();
				
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
						
						$municipalities[] = $municipality; 
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN GAUTENG BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Free State
		public function getGautengCities($province_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '1'
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
				
						array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN GAUTENG
		------------------------------------------------------------------------------------------
		*/
		
		public function getGautengSubs(){
			try{
				$query = "SELECT s.*, c.city_id, c.city_name, c.city_code,
						  m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '1'
						  ORDER BY suburb_name ASC";
				$result = $this->conn->query($query);
				
				$suburbs = array();
				
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
				
						//create city object
						$suburb = new Suburb();
						$suburb->setSuburbID($row['suburb_id']);
						$suburb->setSuburbName($row['suburb_name']);
						$suburb->setSuburbCode($row['suburb_code']);
						$suburb->setCity($city);
						$suburb->setTotalPropertyForSale($row['total_property_forsale']);
						$suburb->setTotalPropertyToRent($row['total_property_torent']);
						$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
						
						//save suburb object inside suburbs array
						array_push($suburbs, $suburb);
					}
					
				return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		// End Gauteng
		
		/*
		GET PROPERTY IMAGE FOR EKURHULENI
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/ekurhuleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEkurhuleniPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '1'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEkurhuleniPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '1'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEkurhuleniPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '1'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEkurhuleniSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 1
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getEkurhuleniSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 1
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getEkurhuleniSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 1
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN EKURHULENI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN EKURHULENI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		//End Ekurhuleni
		
		/*
		GET PROPERTY IMAGE FOR JOHANNESBURG
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/johannesburg/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getJohannesburgPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '2'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getJohannesburgPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '2'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getJohannesburgPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '2'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getJohannesburgSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 2
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getJohannesburgSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 2
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getJohannesburgSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 2
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN JOHANNESBURG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN JOHANNESBURG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Johannesburg
		
		/*
		GET PROPERTY IMAGE FOR PRETORIA
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/pretoria/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getPretoriaPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '3'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getPretoriaPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '3'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getPretoriaPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '3'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getPretoriaSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 3
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getPretoriaSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 3
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getPretoriaSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 3
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN PRETORIA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN PRETORIA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Pretoria
		
		/*
		GET PROPERTY IMAGE FOR EMFULENI
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/emfuleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEmfuleniPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '4'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEmfuleniPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '4'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEmfuleniPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '4'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getEmfuleniSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 4
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getEmfuleniSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 4
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getEmfuleniSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 4
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN EMFULENI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN EMFULENI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Emfuleni
		
		/*
		GET PROPERTY IMAGE FOR MIDVAAL
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/midvaal/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMidvaalPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '5'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMidvaalPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '5'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMidvaalPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '5'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMidvaalSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 5
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getMidvaalSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 5
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getMidvaalSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 5
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN MIDVAAL
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN MIDVAAL
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Midvaal
		
		/*
		GET PROPERTY IMAGE FOR LESEDI
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/lesedi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLesediPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '6'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getLesediPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '6'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getLesediPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '6'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getLesediSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 6
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getLesediSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 7
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getLesediSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 6
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN LESEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN LESEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Lesedi
		
		/*
		GET PROPERTY IMAGE FOR MOGALE
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/mogale/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMogalePropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '7'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMogalePropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '7'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMogalePropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '7'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMogaleSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 7
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getMogaleSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 7
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN MOGALE
		------------------------------------------------------------------------------------------
		*/

		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN MOGALE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Mogale
		
		/*
		GET PROPERTY IMAGE FOR MERAFONG
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/merafong/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMerafongPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '8'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMerafongPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '8'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMerafongPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '8'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getMerafongSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 8
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getMerafongSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 8
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getMerafongSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 8
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN MERAFONG
		------------------------------------------------------------------------------------------
		*/


		//Get  Cities by municipality ID
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
			SUBURBS IN MERAFONG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Merafong
		
		/*
		GET PROPERTY IMAGE FOR RAND WEST
		-------------------------------------------------------------------------------------------------------------
		url/gauteng/rand_west/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getRandWestPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '9'
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getRandWestPropertyListImagesToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '9'
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getRandWestPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = '9'
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getRandWestSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_status, property_type, property_desc, price, num_bathrooms, 
						  street_no, street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 9
						  AND properties.property_status = 'For Sale'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getRandWestSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 9
						  AND properties.property_status = 'On Show'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function getRandWestSimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN agents
						  ON properties.agent_id = agents.agent_id
						  LEFT JOIN agencies
						  ON agents.agency_id = agencies.agency_id
						  WHERE municipalities.municipality_id = 9
						  AND properties.property_status = 'To Rent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN RAND WEST
		------------------------------------------------------------------------------------------
		*/


		//Get  Cities by municipality ID
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
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN RAND WEST
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
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
		
		// End Rand West
		
	}
?>
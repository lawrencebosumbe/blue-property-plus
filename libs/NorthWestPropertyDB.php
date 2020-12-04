<?php
	class NorthWestPropertyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		/*
		------------------------------------------------------------------------------------------
			PROPERTY IMAGES IN NORTHERN CAPE
			url/northern_cape/index.php
		------------------------------------------------------------------------------------------
		*/
		
		public function getNorthWestPropertyListImagesForSale(){
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
						  AND provinces.province_id = '8'
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
		
		public function getNorthWestPropertyListImagesOnShow(){
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
						  AND provinces.province_id = '8'
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
		
		public function getNorthWestPropertyListImagesToRent(){
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
						  AND provinces.province_id = '8'
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
		
		public function getNorthWestSimilarPropertyForSale(){
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
						  WHERE provinces.province_id = 8
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
		
		public function getNorthWestSimilarPropertyOnShow(){
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
						  WHERE provinces.province_id = 8
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
		
		public function getNorthWestSimilarPropertyToRent(){
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
						  WHERE provinces.province_id = 8
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
			MUNICIPALITIES IN NORTH WEST BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		public function getNorthWestMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '8'
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
			CTIES IN NORTH WEST BY MUNICIPALITY ID
		------------------------------------------------------------------------------------------
		*/
		
		public function getNorthWestCity($municipality_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '8'
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
			CITIES IN NORTH WEST 
		------------------------------------------------------------------------------------------
		*/
		
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
				
						array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN NORTH WEST
		------------------------------------------------------------------------------------------
		*/
		
		public function getNorthWestSubs(){
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
						  WHERE p.province_id = '8'
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
		
		// End North West
				
		/*
		GET PROPERTY IMAGE FOR KGETLENGRIVIER
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/kgetlengrivier/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getKgetlengrivierPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '186'
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
		
		public function getKgetlengrivierPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '186'
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
		
		public function getKgetlengrivierPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '186'
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
		
		public function getKgetlengrivierSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 186
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

		
		public function getKgetlengrivierSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 186
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
		
		public function getKgetlengrivierSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 186
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
			CITIES IN KGETLENGRIVIER
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getKgetlengrivierCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '186'";
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
			SUBURBS IN KGETLENGRIVIER
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getKgetlengrivierSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '186'";
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
		
		//End Kgetlengrivier
		
		/*
		GET PROPERTY IMAGE FOR MADIBENG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/madibeng/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMadibengPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '187'
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
		
		public function getMadibengPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '187'
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
		
		public function getMadibengPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '187'
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
		
		public function getMadibengSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 187
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

		
		public function getMadibengSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 187
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
		
		public function getMadibengSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 187
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
			CITIES IN MADIBENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMadibengCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '187'";
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
			SUBURBS IN MADIBENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMadibengSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '187'";
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
		
		//End Madibeng
		
		/*
		GET PROPERTY IMAGE FOR MORETELE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/moretele/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMoretelePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '188'
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
		
		public function getMoretelePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '188'
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
		
		public function getMoretelePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '188'
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
		
		public function getMoreteleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 188
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

		
		public function getMoreteleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 188
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
		
		public function getMoreteleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 188
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
			CITIES IN MADIBENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMoreteleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '188'";
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
			SUBURBS IN MORETELE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMoreteleSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '188'";
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
		
		//End Moretele
		
		/*
		GET PROPERTY IMAGE FOR MOSES KOTANE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/moses_kotane/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMosesKotanePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '189'
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
		
		public function getMosesKotanePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '189'
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
		
		public function getMosesKotanePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '189'
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
		
		public function getMosesKotaneSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 189
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

		
		public function getMosesKotaneSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 189
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
		
		public function getMosesKotaneSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 189
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
			CITIES IN MOSES KOTANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMosesKotaneCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '189'";
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
			SUBURBS IN MOSES KOTANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMosesKotaneSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '189'";
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
		
		//End Moses Kotane
		
		/*
		GET PROPERTY IMAGE FOR RUSTENBURG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/rustenburg/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getRustenburgPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '190'
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
		
		public function getRustenburgPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '190'
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
		
		public function getRustenburgPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '190'
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
		
		public function getRustenburgSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 190
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

		
		public function getRustenburgSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 190
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
		
		public function getRustenburgSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 190
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
			MUNICIPALITIES IN RUSTENBURG
		------------------------------------------------------------------------------------------
		*/
		
		//Get Municipalities
		//Get all Municipalities
		public function get_municipalities(){
			try{
				$query = "SELECT * FROM municipalities 
						  ORDER BY municipality_id";
				$result = $this->conn->query($query);
				
				$municipalities = array();
				
					foreach($result as $row){						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
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
			CITIES IN RUSTENBURG
		------------------------------------------------------------------------------------------
		*/
		
		//Get  Cities by municipality ID
		public function getRustenburgCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '190'";
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
			SUBURBS IN RUSTENBURG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getRustenburgSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '190'";
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
		
		//End Rustenburg
		
		/*
		GET PROPERTY IMAGE FOR MATLOSANA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/matlosana/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMatlosanaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '191'
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
		
		public function getMatlosanaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '191'
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
		
		public function getMatlosanaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '191'
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
		
		public function getMatlosanaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 191
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

		
		public function getMatlosanaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 191
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
		
		public function getMatlosanaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 191
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
			CITIES IN MATLOSANA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMatlosanaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '191'";
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
			SUBURBS IN MATLOSANA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMatlosanaSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '190'";
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
		
		//End Matlosana
		
		/*
		GET PROPERTY IMAGE FOR JB MARKS
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/jb_marks/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getJBMarksPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '192'
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
		
		public function getJBMarksPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '192'
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
		
		public function getJBMarksPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '192'
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
		
		public function getJBMarksSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 192
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

		
		public function getJBMarksSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 192
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
		
		public function getJBMarksSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 192
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
			CITIES IN JB MARKS
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getJBMarksCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '192'";
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
			SUBURBS IN JB MARKS
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getJBMarksSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '192'";
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
		
		//End JB Marks
		
		/*
		GET PROPERTY IMAGE FOR MAQUASSI HILLS
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/maquassi_hills/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMaquassiHillsPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '193'
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
		
		public function getMaquassiHillsPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '193'
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
		
		public function getMaquassiHillsPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '193'
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
		
		public function getMaquassiHillsSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 193
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

		
		public function getMaquassiHillsSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 193
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
		
		public function getMaquassiHillsSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 193
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
			CITIES IN MAQUASSI HILLS
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMaquassiHillsCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '193'";
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
			SUBURBS IN MAQUASSI HILLS
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMaquassiHillsSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '193'";
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
		
		//End Maquassi Hills
		
		/*
		GET PROPERTY IMAGE FOR GREATER TAUNG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/greater_taung/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getGreaterTaungPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '194'
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
		
		public function getGreaterTaungPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '194'
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
		
		public function getGreaterTaungPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '194'
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
		
		public function getGreaterTaungSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 194
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

		
		public function getGreaterTaungSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 194
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
		
		public function getGreaterTaungSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 194
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
			CITIES IN GREATER TAUNG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getGreaterTaungCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '194'";
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
			SUBURBS IN GREATER TAUNG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getGreaterTaungSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '194'";
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
		
		//End Greater Taung
		
		/*
		GET PROPERTY IMAGE FOR KAGISANO MOLOPO
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/kagisano_molopo/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getKagisanoMolopoPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '195'
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
		
		public function getKagisanoMolopoPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '195'
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
		
		public function getKagisanoMolopoPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '195'
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
		
		public function getKagisanoMolopoSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 195
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

		
		public function getKagisanoMolopoSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 195
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
		
		public function getKagisanoMolopoSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 195
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
			CITIES IN KAGISANO MOLOPO
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getKagisanoMolopoCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '195'";
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
			SUBURBS IN KAGISANO MOLOPO
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getKagisanoMolopoSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '195'";
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
		
		//End KagisanoMolopo
		
		/*
		GET PROPERTY IMAGE FOR LEKWA TEEMANE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/lekwa_teemane/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLekwaTeemanePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '196'
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
		
		public function getLekwaTeemanePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '196'
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
		
		public function getLekwaTeemanePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '196'
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
		
		public function getLekwaTeemaneSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 196
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

		
		public function getLekwaTeemaneSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 196
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
		
		public function getLekwaTeemaneSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 196
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
			CITIES IN LEKWA TEEMANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getLekwaTeemaneCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '196'";
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
			SUBURBS IN LEKWA TEEMANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getLekwaTeemaneSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '196'";
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
		
		//End Lekwa Teemane
		
		/*
		GET PROPERTY IMAGE FOR LEKWA MAMUSA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/mamusa/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMamusaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '197'
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
		
		public function getMamusaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '197'
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
		
		public function getMamusaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '197'
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
		
		public function getMamusaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 197
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

		
		public function getMamusaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 197
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
		
		public function getMamusaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 197
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
			CITIES IN MAMUSA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMamusaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '197'";
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
			SUBURBS IN MAMUSA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMamusaSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '197'";
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
		
		//End Mamusa
		
		/*
		GET PROPERTY IMAGE FOR NALEDI
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/naledi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNalediPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '198'
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
		
		public function getNalediPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '198'
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
		
		public function getNalediPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '198'
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
		
		public function getNalediSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 198
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

		
		public function getNalediSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 198
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
		
		public function getNalediSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 198
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
			CITIES IN MALEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getNalediCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '198'";
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
			SUBURBS IN NALEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getNalediSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '198'";
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
		
		//End Naledi
		
		/*
		GET PROPERTY IMAGE FOR DITSOBOTLA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/ditsobotla/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getDitsobotlaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '199'
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
		
		public function getDitsobotlaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '199'
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
		
		public function getDitsobotlaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '199'
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
		
		public function getDitsobotlaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 199
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

		
		public function getDitsobotlaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 199
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
		
		public function getDitsobotlaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 199
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
			CITIES IN DITSOBOTLA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getDitsobotlaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '199'";
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
			SUBURBS IN DITSOBOTLA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getDitsobotlaSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '199'";
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
		
		//End Ditsobotla
		
		/*
		GET PROPERTY IMAGE FOR MAFIKENG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/mafikeng/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMafikengPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '200'
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
		
		public function getMafikengPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '200'
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
		
		public function getMafikengPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '200'
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
		
		public function getMafikengSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 200
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

		
		public function getMafikengSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 200
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
		
		public function getMafikengSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 200
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
			CITIES IN MAFIKENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMafikengCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '200'";
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
			SUBURBS IN MAFIKENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMafikengSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '200'";
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
		
		//End Mafikeng
		
		/*
		GET PROPERTY IMAGE FOR RAMOTSHERE MOILOA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/ramotshere_moiloa/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getRamotshereMoiloaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '201'
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
		
		public function getRamotshereMoiloaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '201'
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
		
		public function getRamotshereMoiloaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '201'
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
		
		public function getRamotshereMoiloaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 201
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

		
		public function getRamotshereMoiloaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 201
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
		
		public function getRamotshereMoiloaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 201
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
			MUNICIPALITIES IN RAMOTSHERE MOILOA
		------------------------------------------------------------------------------------------
		*/
		
		//Get Municipalities
		//Get all Municipalities
		public function getRamotshereMoiloaMunicipalities(){
			try{
				$query = "SELECT * FROM municipalities 
						  ORDER BY municipality_id";
				$result = $this->conn->query($query);
				
				$municipalities = array();
				
					foreach($result as $row){						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
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
			CITIES IN RAMOTSHERE MOILOA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getRamotshereMoiloaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '201'";
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
			SUBURBS IN RAMOTSHERE MOILOA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getRamotshereMoiloaSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '201'";
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
		
		//End Ramotshere Moiloa
		
		/*
		GET PROPERTY IMAGE FOR RATLOU
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/ratlou/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getRatlouPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '202'
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
		
		public function getRatlouPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '202'
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
		
		public function getRatlouPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '202'
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
		
		public function getRatlouSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 202
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

		
		public function getRatlouSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 202
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
		
		public function getRatlouSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 202
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
			CITIES IN RATLOU
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getRatlouCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '202'";
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
			SUBURBS IN RATLOU
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getRatlouSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '202'";
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
		
		//End Ratlou
		
		/*
		GET PROPERTY IMAGE FOR TSWAING
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/tswaing/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getTswaingPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '203'
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
		
		public function getTswaingPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '203'
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
		
		public function getTswaingPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '203'
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
		
		public function getTswaingSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 203
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

		
		public function getTswaingSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 203
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
		
		public function getTswaingSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 203
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
			CITIES IN TSWAING
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getTswaingCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '203'";
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
			SUBURBS IN TSWAING
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getTswaingSubs($municipality_id){
			try{ 
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '203'";
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
		
		//End Tswaing
	}
?>
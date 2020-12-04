<?php
	class LimpopoPropertyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		/*
		------------------------------------------------------------------------------------------
			PROPERTY IMAGES IN LIMPOPO
			url/limpopo/index.php
		------------------------------------------------------------------------------------------
		*/
		
		public function getLimpopoPropertyListImagesForSale(){
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
						  AND provinces.province_id = '5'
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
		
		public function getLimpopoPropertyListImagesOnShow(){
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
						  AND provinces.province_id = '5'
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
		
		public function getLimpopoPropertyListImagesToRent(){
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
						  AND provinces.province_id = '5'
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
		
		public function getLimpopoSimilarPropertyForSale(){
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
						  WHERE provinces.province_id = 5
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
		
		public function getLimpopoSimilarPropertyOnShow(){
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
						  WHERE provinces.province_id = 5
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
		
		public function getLimpopoSimilarPropertyToRent(){
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
						  WHERE provinces.province_id = 5
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
			MUNICIPALITIES IN LIMPOPO BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Limpopo
		public function getLimpopoMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '5'
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
			CTIES IN LIMPOPO BY MUNICIPALITY ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Limpopo
		public function getLimpopoCity($municipality_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '5'
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
			CITIES IN LIMPOPO BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		//Get City in Limpopo
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
				
						array_push($cities, $city);
					}
					
				return $cities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		------------------------------------------------------------------------------------------
			SUBURBS IN LIMPOPO
		------------------------------------------------------------------------------------------
		*/
		
		public function getLimpopoSubs(){
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
						  WHERE p.province_id = '5'
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
		
		// End Limpopo
		
		/*
		GET PROPERTY IMAGE FOR BLOUBERG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/blouberg/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getBloubergPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '121'
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
		
		public function getBloubergPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '121'
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
		
		public function getBloubergPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '121'
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
		
		//Blouberg Similar properties at the bottom of Light Gallery
		public function getBloubergSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 121
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

		
		//Blouberg Similar properties at the bottom of Light Gallery
		public function getBloubergSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 121
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
		
		//Blouberg Similar properties at the bottom of Light Gallery
		public function getBloubergSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 121
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
			CITIES IN  BLOUBERG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getBloubergCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '121'";
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
			SUBURBS IN  BLOUBERG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getBloubergSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '121'";
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
		
		//End Blouberg
		
		/*
		GET PROPERTY IMAGE FOR LEPELLE NKUMPI
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/lepelle_nkumpi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLepelleNkumpiPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '122'
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
		
		public function getLepelleNkumpiPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '122'
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
		
		public function getLepelleNkumpiPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '122'
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
		
		public function getLepelleNkumpiSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 122
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

		
		public function getLepelleNkumpiSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 122
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
		
		public function getLepelleNkumpiSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 122
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
			CITIES IN  LEPELLE NKUMPI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getLepelleNkumpiCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '122'";
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
			SUBURBS IN  LEPELLE NKUMPI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getLepelleNkumpiSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '122'";
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
		
		//End Lepelle Nkumpi
		
		/*
		GET PROPERTY IMAGE FOR MOLEMOLE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/Molemole/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMolemolePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '123'
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
		
		public function getMolemolePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '123'
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
		
		public function getMolemolePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '123'
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
		
		public function getMolemoleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 123
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

		
		public function getMolemoleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 123
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
		
		public function getMolemoleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 123
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
			CITIES IN  MOLEMOLE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMolemoleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '123'";
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
			SUBURBS IN  MOLEMOLE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMolemoleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '123'";
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
		
		//End Molemole
		
		/*
		GET PROPERTY IMAGE FOR POLOKWANE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/Polokwane/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getPolokwanePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '124'
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
		
		public function getPolokwanePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '124'
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
		
		public function getPolokwanePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '124'
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
		
		public function getPolokwaneSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 124
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

		
		public function getPolokwaneSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 124
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
		
		public function getPolokwaneSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 124
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
			CITIES IN  POLOLKWANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getPolokwaneCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '124'";
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
			SUBURBS IN POLOKWANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getPolokwaneSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '124'";
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
		
		//End Polokwane
		
		/*
		GET PROPERTY IMAGE FOR PHALABORWA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/phalaborwa/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getPhalaborwaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '125'
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
		
		public function getPhalaborwaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '125'
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
		
		public function getPhalaborwaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '125'
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
		
		public function getPhalaborwaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 125
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

		
		public function getPhalaborwaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 125
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
		
		public function getPhalaborwaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 125
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
			CITIES IN  PHALABORWA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getPhalaborwaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '125'";
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
			SUBURBS IN PHALABORWA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getPhalaborwaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '125'";
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
		
		//End Phalaborwa
		
		/*
		GET PROPERTY IMAGE FOR GIYANI
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/giyani/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getGiyaniPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '126'
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
		
		public function getGiyaniPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '126'
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
		
		public function getGiyaniPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '126'
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
		
		public function getGiyaniSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 126
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

		
		public function getGiyaniSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 126
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
		
		public function getGiyaniSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 126
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
			CITIES IN GIYANI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getGiyaniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '126'";
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
			SUBURBS IN GIYANI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getGiyaniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '126'";
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
		
		//End Giyani
		
		/*
		GET PROPERTY IMAGE FOR LETABA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/letaba/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLetabaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '127'
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
		
		public function getLetabaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '127'
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
		
		public function getLetabaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '127'
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
		
		public function getLetabaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 127
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

		
		public function getLetabaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 127
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
		
		public function getLetabaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 127
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
			CITIES IN LETABA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getLetabaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '127'";
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
			SUBURBS IN LETABA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getLetabaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '127'";
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
		
		//End Letaba
		
		/*
		GET PROPERTY IMAGE FOR TZANEEN
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/tzaneen/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getTzaneenPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '128'
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
		
		public function getTzaneenPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '128'
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
		
		public function getTzaneenPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '128'
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
		
		public function getTzaneenSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 128
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

		
		public function getTzaneenSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 128
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
		
		public function getTzaneenSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 128
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
			CITIES IN TZANEEN
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getTzaneenCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '128'";
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
			SUBURBS IN TZANEEN
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getTzaneenSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '128'";
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
		
		//End Tzaneen
		
		/*
		GET PROPERTY IMAGE FOR MARULENG
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/maruleng/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMarulengPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '129'
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
		
		public function getMarulengPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '129'
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
		
		public function getMarulengPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '129'
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
		
		public function getMarulengSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 129
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

		
		public function getMarulengSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 129
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
		
		public function getMarulengSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 129
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
			CITIES IN MARULENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMarulengCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '129'";
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
			SUBURBS IN MARULENG
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMarulengSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '129'";
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
		
		//End Maruleng
		
		/*
		GET PROPERTY IMAGE FOR ELIAS MOTSOALEDI
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/elias_motsoaledi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEliasMotsoalediPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '130'
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
		
		public function getEliasMotsoalediPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '130'
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
		
		public function getEliasMotsoalediPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '130'
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
		
		public function getEliasMotsoalediSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 130
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

		
		public function getEliasMotsoalediSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 130
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
		
		public function getEliasMotsoalediSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 130
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
			CITIES IN ELIAS MOTSOALEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getEliasMotsoalediCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '130'";
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
			SUBURBS IN ELIAS MOTSOALEDI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getEliasMotsoalediSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '130'";
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
		
		//End Elias Motsoaledi
		
		/*
		GET PROPERTY IMAGE FOR EPHRAIM MOGALE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/ephraim_mogale/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEphraimMogalePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '131'
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
		
		public function getEphraimMogalePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '131'
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
		
		public function getEphraimMogalePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '131'
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
		
		public function getEphraimMogaleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 131
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

		
		public function getEphraimMogaleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 131
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
		
		public function getEphraimMogaleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 131
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
			CITIES IN EPHRAIM MOGALE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getEphraimMogaleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '131'";
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
			SUBURBS IN EPHRAIM MOGALE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getEphraimMogaleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '131'";
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
		
		//End Ephraim Mogale
		
		/*
		GET PROPERTY IMAGE FOR FETAKGOMO
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/fetakgomo/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getFetakgomoPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '132'
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
		
		public function getFetakgomoPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '132'
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
		
		public function getFetakgomoPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '132'
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
		
		public function getFetakgomoSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 132
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

		
		public function getFetakgomoSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 132
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
		
		/*
		------------------------------------------------------------------------------------------
			CITIES IN FETAKGOMO
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getFetakgomoCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '132'";
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
			SUBURBS IN FETAKGOMO
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getFetakgomoSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '132'";
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
		
		//End Fetakgomo
		
		/*
		GET PROPERTY IMAGE FOR MAKHUDUTHAMAGA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/makhuduthamaga/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMakhuduthamagaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '133'
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
		
		public function getMakhuduthamagaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '133'
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
		
		public function getMakhuduthamagaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '133'
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
		
		public function getMakhuduthamagaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 133
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

		
		public function getMakhuduthamagaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 133
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
		
		public function getMakhuduthamagaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 133
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
			CITIES IN MAKHUDUTHAMAGA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMakhuduthamagaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '133'";
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
			SUBURBS IN MAKHUDUTHAMAGA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMakhuduthamagaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '133'";
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
		
		//End Makhuduthamaga
		
		/*
		GET PROPERTY IMAGE FOR COLLINS CHABANE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/collins_chabane/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getCollinsChabanePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '134'
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
		
		public function getCollinsChabanePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '134'
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
		
		public function getCollinsChabanePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '134'
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
		
		public function getCollinsChabaneSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 134
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

		
		public function getCollinsChabaneSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 134
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
		
		public function getCollinsChabaneSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 134
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
			CITIES IN COLLINS CHABANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getCollinsChabaneCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '134'";
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
			SUBURBS IN COLLINS CHABANE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getCollinsChabaneSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '134'";
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
		
		//End Collins Chabane
		
		/*
		GET PROPERTY IMAGE FOR MAKHADO
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/makhado/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMakhadoPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '135'
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
		
		public function getMakhadoPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '135'
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
		
		public function getMakhadoPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '135'
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
		
		public function getMakhadoSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 135
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

		
		public function getMakhadoSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 135
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
		
		public function getMakhadoSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 135
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
			CITIES IN MAKHADO
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMakhadoCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '135'";
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
			SUBURBS IN COLLINS MAKHADO
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMakhadoSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '135'";
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
		
		//End Makhado
		
		/*
		GET PROPERTY IMAGE FOR MUSINA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/musina/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMusinaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '136'
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
		
		public function getMusinaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '136'
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
		
		public function getMusinaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '136'
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
		
		public function getMusinaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 136
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

		
		public function getMusinaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 136
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
		
		public function getMusinaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 136
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
			CITIES IN MUSINA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMusinaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '136'";
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
			SUBURBS IN COLLINS MUSINA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMusinaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '136'";
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
		
		//End Musina
		
		/*
		GET PROPERTY IMAGE FOR THUMELA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/thulamela/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getThulamelaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '137'
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
		
		public function getThulamelaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '137'
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
		
		public function getThulamelaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '137'
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
		
		public function getThulamelaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 137
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

		
		public function getThulamelaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 137
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
		
		public function getThulamelaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 137
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
			CITIES IN THUMELA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getThulamelaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '137'";
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
			SUBURBS IN COLLINS THUMELA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getThulamelaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '137'";
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
		
		//End Thulamela
		
		/*
		GET PROPERTY IMAGE FOR BELA BELA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/bela_bela/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getBelaBelaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '138'
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
		
		public function getBelaBelaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '138'
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
		
		public function getBelaBelaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '138'
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
		
		public function getBelaBelaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 138
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

		
		public function getBelaBelaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 138
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
		
		public function getBelaBelaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 138
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
			CITIES IN BELA BELA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getBelaBelaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '138'";
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
			SUBURBS IN BELA BELA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getBelaBelaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '138'";
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
		
		//End Bela Bela
		
		/*
		GET PROPERTY IMAGE FOR LEPHALALE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/lephalale/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLephalalePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '139'
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
		
		public function getLephalalePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '139'
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
		
		public function getLephalalePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '139'
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
		
		public function getLephalaleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 139
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

		
		public function getLephalaleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 139
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
		
		public function getLephalaleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 139
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
			CITIES IN LEPHALALE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getLephalaleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '139'";
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
			SUBURBS IN LEPHALALE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getLephalaleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '139'";
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
		
		//End Lephalale
		
		/*
		GET PROPERTY IMAGE FOR MODIMOLLE
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/modimolle/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getModimollePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '140'
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
		
		public function getModimollePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '140'
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
		
		public function getModimollePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '140'
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
		
		public function getModimolleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 140
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

		
		public function getModimolleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 140
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
		
		public function getModimolleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 140
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
			CITIES IN MODIMOLLE
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getModimolleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '140'";
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
			SUBURBS IN MODIMOLLE
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getModimolleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '140'";
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
		
		//End Modimolle
		
		/*
		GET PROPERTY IMAGE FOR MOGALAKWENA
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/mogalakwena/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMogalakwenaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '141'
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
		
		public function getMogalakwenaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '141'
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
		
		public function getMogalakwenaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '141'
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
		
		public function getMogalakwenaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 141
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

		
		public function getMogalakwenaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 141
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
		
		public function getMogalakwenaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 141
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
			CITIES IN MOGALAKWENA
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getMogalakwenaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '141'";
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
			SUBURBS IN MOGALAKWENA
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getMogalakwenaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '141'";
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
		
		//End Mogalakwena
		
		/*
		GET PROPERTY IMAGE FOR THABAZIMBI
		-------------------------------------------------------------------------------------------------------------
		url/limpopo/thabazimbi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getThabazimbiPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '142'
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
		
		public function getThabazimbiPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '142'
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
		
		public function getThabazimbiPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '142'
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
		
		public function getThabazimbiSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 142
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

		
		public function getThabazimbiSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 142
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
		
		public function getThabazimbiSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 142
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
			CITIES IN THABAZIMBI
		------------------------------------------------------------------------------------------
		*/
		//Get  Cities by municipality ID
		public function getThabazimbiCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '142'";
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
			SUBURBS IN THABAZIMBI
		------------------------------------------------------------------------------------------
		*/
		//Get  Suburbs by municipality ID
		public function getThabazimbiSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '142'";
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
		
		//End Thabazimbi
				
	}
?>
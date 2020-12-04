<?php
	class EasternCapePropertyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		/*
		------------------------------------------------------------------------------------------
			PROPERTY IMAGES IN EASTERN CAPE
		------------------------------------------------------------------------------------------
		*/
		
		public function getEasternCapePropertyListImagesForSale(){
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
						  AND provinces.province_id = '2'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		public function getEasternCapePropertyListImagesOnShow(){
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
						  AND provinces.province_id = '2'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		public function getEasternCapePropertyListImagesToRent(){
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
						  AND provinces.province_id = '2'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		public function getEasternCapeSimilarPropertyForSale(){
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
						  WHERE provinces.province_id = 2
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
		
		public function getEasternCapeSimilarPropertyOnShow(){
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
						  WHERE provinces.province_id = 2
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
		
		public function getEasternCapeSimilarPropertyToRent(){
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
						  WHERE provinces.province_id = 2
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
			MUNICIPALITIES IN EASTERN CAPE BY PROVINCE ID
		------------------------------------------------------------------------------------------
		*/
		
		public function getEasternCapeMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '2'
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
			CITIES IN EASTERN CAPE BY MUNICIPALITY ID
		------------------------------------------------------------------------------------------
		*/
		
		public function getEasternCapeCities($province_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id,
						  p.province_id, p.province_name 
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '2'
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
		Get Property images for Amahlathi
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		10. url/eastern_cape/amahlathi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getAmahlathiPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '10'
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
		
		public function getAmahlathiPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '10'
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
		
		public function getAmahlathiPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '10'
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
		
		//Amahlathi Similar properties at the bottom of Light Gallery
		public function getAmahlathiSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 10
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

		
		//Amahlathi Similar properties at the bottom of Light Gallery
		public function getAmahlathiSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 10
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
		
		//Amahlathi Similar properties at the bottom of Light Gallery
		public function getAmahlathiSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 10
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
			CITIES IN AMAHLATHI
		------------------------------------------------------------------------------------------
		*/
		//Get Amahlathi Cities
		public function getAmahlathiCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '10'";
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
			SUBURBS IN AMAHLATHI
		------------------------------------------------------------------------------------------
		*/
		//Get Amahlathi Suburbs
		public function getAmahlathiSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '10'";
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
		
		/*
		Get Property images for Blue Crane Route
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		11. url/eastern_cape/blue_crane_route/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getBlueCraneRoutePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '11'
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
		
		public function getBlueCraneRoutePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '11'
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
		
		public function getBlueCraneRoutePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '11'
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
		
		//Baviaans Similar properties at the bottom of Light Gallery
		public function getBlueCraneRouteSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 11
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

		
		//Blue Crane Route Similar properties at the bottom of Light Gallery
		public function getBlueCraneRouteSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 11
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
		
		//Blue Crane Route Similar properties at the bottom of Light Gallery
		public function getBlueCraneRouteSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 11
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
			CITIES IN BLUE CRANE ROUTE
		------------------------------------------------------------------------------------------
		*/
		//Get Blue Crane Route Cities
		public function getBlueCraneRouteCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '11'";
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
			SUBURBS IN BLUE CRANE ROUTE
		------------------------------------------------------------------------------------------
		*/
		//Get Blue Crane Route Suburbs
		public function getBlueCraneRouteSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '11'";
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
		
		/*
		Get Property images for buffalo City
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		12. url/eastern_cape/buffalo_city/index.php
		-------------------------------------------------------------------------------------------------------------
		*/	
		
		public function getBuffaloCityPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '12'
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
		
		public function getBuffaloCityPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '12'
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
		
		public function getBuffaloCityPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '12'
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
		
		//Buffalo City Similar properties at the bottom of Light Gallery
		public function getBuffaloCitySimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 12
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

		
		//Buffalo City Similar properties at the bottom of Light Gallery
		public function getBuffaloCitySimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 12
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
		
		//Buffalo City Similar properties at the bottom of Light Gallery
		public function getBuffaloCitySimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 12
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
			SUBURBS IN BUFFALO CITY
		------------------------------------------------------------------------------------------
		*/
		//Get Buffalo City Cities
		public function getBuffaloCityCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '12'";
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
			SUBURBS IN BUFFALO CITY
		------------------------------------------------------------------------------------------
		*/
		//Get Buffalo City Suburbs
		public function getBuffaloCitySubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '12'";
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
		
		/*
		Get Property images for Beyers Naude
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		10. url/eastern_cape/beyers_naude/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getBeyersNaudePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '13'
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
		
		public function getBeyersNaudePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '13'
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
		
		public function getBeyersNaudePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '13'
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
		
		//Beyers Naude Similar properties at the bottom of Light Gallery
		public function getBeyersNaudeSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 13
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

		
		//Beyers Naude Similar properties at the bottom of Light Gallery
		public function getBeyersNaudeSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 13
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
		
		//Beyers Naude Similar properties at the bottom of Light Gallery
		public function getBeyersNaudeSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 13
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
			CITIES IN Beyers Naude
		------------------------------------------------------------------------------------------
		*/
		//Get Beyers Naude Cities
		public function getBeyersNaudeCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '13'";
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
			SUBURBS IN Beyers Naude
		------------------------------------------------------------------------------------------
		*/
		//Get Beyers Naude Suburbs
		public function getBeyersNaudeSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '13'";
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
		
		/*
		Get Property images for Elundini
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		14. url/eastern_cape/elundini/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getElundiniPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '14'
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
		
		public function getElundiniPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '14'
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
		
		public function getElundiniPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '14'
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
		
		//Elundini Similar properties at the bottom of Light Gallery
		public function getElundiniSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 14
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

		
		//Elundini Similar properties at the bottom of Light Gallery
		public function getElundiniSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 14
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
		
		//Elundini Similar properties at the bottom of Light Gallery
		public function getElundiniSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 14
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
			CITIES IN Elundini
		------------------------------------------------------------------------------------------
		*/
		//Get Elundini Cities
		public function getElundiniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '14'";
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
			SUBURBS IN Elundini
		------------------------------------------------------------------------------------------
		*/
		//Get Elundini Suburbs
		public function getElundiniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '14'";
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
		
		/*
		Get Property images for Emalahleni
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		15. url/eastern_cape/emalahleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEmalahleniPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '15'
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
		
		public function getEmalahleniPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '15'
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
		
		public function getEmalahleniPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '15'
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
		
		//Emalahleni Similar properties at the bottom of Light Gallery
		public function getEmalahleniSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 15
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

		
		//Amahlathi Similar properties at the bottom of Light Gallery
		public function getEmalahleniSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 15
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
		
		//Emalahleni Similar properties at the bottom of Light Gallery
		public function getEmalahleniSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 15
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
			CITIES IN Emalahleni
		------------------------------------------------------------------------------------------
		*/
		//Get Emalahleni Cities
		public function getEmalahleniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '15'";
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
			SUBURBS IN Emalahleni
		------------------------------------------------------------------------------------------
		*/
		//Get Emalahleni Suburbs
		public function getEmalahleniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '15'";
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
		
		/*
		Get Property images for Engcobo
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		16. url/eastern_cape/engcobo/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEngcoboPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '16'
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
		
		public function getEngcoboPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '16'
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
		
		public function getEngcoboPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '16'
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
		
		//Engcobo Similar properties at the bottom of Light Gallery
		public function getEngcoboSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 16
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

		
		//Engcobo Similar properties at the bottom of Light Gallery
		public function getEngcoboSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 16
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
		
		//Engcobo Similar properties at the bottom of Light Gallery
		public function getEngcoboSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 16
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
			CITIES IN Engcobo
		------------------------------------------------------------------------------------------
		*/
		//Get Engcobo Cities
		public function getEngcoboCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '16'";
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
			SUBURBS IN Engcobo
		------------------------------------------------------------------------------------------
		*/
		//Get Engcobo Suburbs
		public function getEngcoboSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '16'";
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
		
		/*
		Get Property images for Enoch Mgijima
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		17. url/eastern_cape/enoch_mgijima/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEnochMgijimaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '17'
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
		
		public function getEnochMgijimaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '17'
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
		
		public function getEnochMgijimaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '17'
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
		
		//Enoch Mgijima Similar properties at the bottom of Light Gallery
		public function getEnochMgijimaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 17
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

		
		//Enoch Mgijima Similar properties at the bottom of Light Gallery
		public function getEnochMgijimaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 17
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
		
		//Enoch Mgijima Similar properties at the bottom of Light Gallery
		public function getEnochMgijimaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 17
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
			CITIES IN Enoch Mgijima
		------------------------------------------------------------------------------------------
		*/
		//Get Enoch Mgijima Cities
		public function getEnochMgijimaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '17'";
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
			SUBURBS IN Enoch Mgijima
		------------------------------------------------------------------------------------------
		*/
		//Get Enoch Mgijima Suburbs
		public function getEnochMgijimaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '17'";
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
		
		/*
		Get Property images for GREAT KEI
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		10. url/eastern_cape/great_kei/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getGreatKeiPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '18'
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
		
		public function getGreatKeiPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '18'
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
		
		public function getGreatKeiPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '18'
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
		
		//Enoch Mgijima Similar properties at the bottom of Light Gallery
		public function getGreatKeiSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 18
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

		
		//Enoch Mgijima Similar properties at the bottom of Light Gallery
		public function getGreatKeiSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 18
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
		
		//Great Kei Similar properties at the bottom of Light Gallery
		public function getGreatKeiSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 18
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
			CITIES IN Great Kei
		------------------------------------------------------------------------------------------
		*/
		//Get Great Kei Cities
		public function getGreatKeiCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '18'";
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
			SUBURBS IN Great Kei
		------------------------------------------------------------------------------------------
		*/
		//Get Great Kei Suburbs
		public function getGreatKeiSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '18'";
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
		
		/*
		Get Property images for INGQUZA HILL
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		19. url/eastern_cape/ingquza_hill/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getIngquzaHillPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '19'
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
		
		public function getIngquzaHillPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '19'
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
		
		public function getIngquzaHillPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '19'
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
		
		//Ingquza Hill Similar properties at the bottom of Light Gallery
		public function getIngquzaHillSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 19
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

		
		//Ingquza Hill Similar properties at the bottom of Light Gallery
		public function getIngquzaHillSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 19
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
		
		//Ingquza Hill Similar properties at the bottom of Light Gallery
		public function getIngquzaHillSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 19
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
			CITIES IN Ingquza Hill
		------------------------------------------------------------------------------------------
		*/
		//Get Ingquza Hill Cities
		public function getIngquzaHillCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '19'";
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
			SUBURBS IN Ingquza Hill
		------------------------------------------------------------------------------------------
		*/
		//Get Ingquza Hill Suburbs
		public function getIngquzaHillSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '19'";
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
		
		/*
		Get Property images for INSIKA YETHU
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		20. url/eastern_cape/intsika_yethu/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getIntsikaYethuPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '20'
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
		
		public function getIntsikaYethuPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '20'
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
		
		public function getIntsikaYethuPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '20'
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
		
		//Intsika Yethu Similar properties at the bottom of Light Gallery
		public function getIntsikaYethuSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 20
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

		
		//Intsika Yethu Similar properties at the bottom of Light Gallery
		public function getIntsikaYethuSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 20
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
		
		//Intsika Yethu Similar properties at the bottom of Light Gallery
		public function getIntsikaYethuSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 20
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
			CITIES IN IntsikaYethu
		------------------------------------------------------------------------------------------
		*/
		//Get Intsika Yethu Hill Cities
		public function getIntsikaYethuCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '20'";
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
			SUBURBS IN Intsika Yethu
		------------------------------------------------------------------------------------------
		*/
		//Get Intsika Yethu Suburbs
		public function getIntsikaYethuSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '20'";
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
		
		/*
		Get Property images for IXUBA YETHEMBA
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		21. url/eastern_cape/ixhuba_yethemba/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getIxhubaYethembaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '21'
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
		
		public function getIxhubaYethembaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '21'
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
		
		public function getIxhubaYethembaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '21'
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
		
		//Inxhuba Yathemba Similar properties at the bottom of Light Gallery
		public function getIxhubaYethembaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 21
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

		
		//Ixhuba Yethemba Similar properties at the bottom of Light Gallery
		public function getIxhubaYethembaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 21
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
		
		//Ixhuba Yethemba Similar properties at the bottom of Light Gallery
		public function getIxhubaYethembaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 21
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
			CITIES IN Ixhuba Yethemba
		------------------------------------------------------------------------------------------
		*/
		//Get Ixhuba Yethemba Hill Cities
		public function getIxhubaYethembaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '21'";
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
			SUBURBS IN Ixhuba Yethemba
		------------------------------------------------------------------------------------------
		*/
		//Get Ixhuba Yethemba Suburbs
		public function getIxhubaYethembaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '21'";
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
		
		/*
		Get Property images for KING SABATA
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		22. url/eastern_cape/king_sabata/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getKingSabataPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '22'
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
		
		public function getKingSabataPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '22'
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
		
		public function getKingSabataPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '22'
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
		
		//King Sabata Similar properties at the bottom of Light Gallery
		public function getKingSabataSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 22
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

		
		//King Sabata Similar properties at the bottom of Light Gallery
		public function getKingSabataSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 22
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
		
		//King Sabata Similar properties at the bottom of Light Gallery
		public function getKingSabataSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 22
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
			CITIES IN King Sabata
		------------------------------------------------------------------------------------------
		*/
		//Get King Sabata Hill Cities
		public function getKingSabataCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '22'";
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
			SUBURBS IN King Sabata
		------------------------------------------------------------------------------------------
		*/
		//Get King Sabata Suburbs
		public function getKingSabataSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '22'";
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
		
		/*
		Get Property images for KOUGA
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		23. url/eastern_cape/kouga/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getKougaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '23'
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
		
		public function getKougaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '23'
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
		
		public function getKougaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '23'
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
		
		//Kouga Similar properties at the bottom of Light Gallery
		public function getKougaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 23
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

		
		//Kouga Similar properties at the bottom of Light Gallery
		public function getKougaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 23
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
		
		//Kouga Similar properties at the bottom of Light Gallery
		public function getKougaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 23
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
			CITIES IN Kouga
		------------------------------------------------------------------------------------------
		*/
		//Get Kouga Hill Cities
		public function getKougaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '23'";
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
			SUBURBS IN Kouga
		------------------------------------------------------------------------------------------
		*/
		//Get Kouga Suburbs
		public function getKougaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '23'";
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
		
		/*
		Get Property images for KOUKAMMA
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		24. url/eastern_cape/koukamma/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getKoukammaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '24'
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
		
		public function getKoukammaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '24'
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
		
		public function getKoukammaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '24'
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
		
		//Koukamma Similar properties at the bottom of Light Gallery
		public function getKoukammaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 24
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

		
		//Koukamma Similar properties at the bottom of Light Gallery
		public function getKoukammaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 24
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
		
		//Koukamma Similar properties at the bottom of Light Gallery
		public function getKoukammaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 24
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
			CITIES IN Koukamma
		------------------------------------------------------------------------------------------
		*/
		//Get Koukamma Hill Cities
		public function getKoukammaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '24'";
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
			SUBURBS IN Koukamma
		------------------------------------------------------------------------------------------
		*/
		//Get Koukamma Suburbs
		public function getKoukammaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '24'";
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
		
		/*
		Get Property images for MAKANA
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/makana/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMakanaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '25'
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
		
		public function getMakanaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '25'
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
		
		public function getMakanaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '25'
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
		
		//Makana Similar properties at the bottom of Light Gallery
		public function getMakanaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 25
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

		
		//Makana Similar properties at the bottom of Light Gallery
		public function getMakanaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 25
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
		
		//Makana Similar properties at the bottom of Light Gallery
		public function getMakanaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 25
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
			CITIES IN Makana
		------------------------------------------------------------------------------------------
		*/
		//Get Makana Hill Cities
		public function getMakanaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '25'";
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
			SUBURBS IN Makana
		------------------------------------------------------------------------------------------
		*/
		//Get Makana Suburbs
		public function getMakanaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '25'";
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
		
		/*
		Get Property images for MATATIELE
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/matatiele/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMatatielePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '26'
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
		
		public function getMatatielePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '26'
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
		
		public function getMatatielePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '26'
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
		
		//Matatiele Similar properties at the bottom of Light Gallery
		public function getMatatieleSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 26
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

		
		//Matatiele Similar properties at the bottom of Light Gallery
		public function getMatatieleSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 26
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
		
		//Matatiele Similar properties at the bottom of Light Gallery
		public function getMatatieleSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 26
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
			CITIES IN Matatiele
		------------------------------------------------------------------------------------------
		*/
		//Get Matatiele Hill Cities
		public function getMatatieleCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '26'";
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
			SUBURBS IN Matatiele
		------------------------------------------------------------------------------------------
		*/
		//Get Matatiele Suburbs
		public function getMatatieleSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '26'";
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
		
		/*
		Get Property images for MBHASHE
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/mbhashe/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMbhashePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '27'
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
		
		public function getMbhashePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '27'
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
		
		public function getMbhashePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '27'
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
		
		//Mbhashe Similar properties at the bottom of Light Gallery
		public function getMbhasheSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 27
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

		
		//Mbhashe Similar properties at the bottom of Light Gallery
		public function getMbhasheSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 27
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
		
		//Mbhashe Similar properties at the bottom of Light Gallery
		public function getMbhasheSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 27
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
			CITIES IN Mbhashe
		------------------------------------------------------------------------------------------
		*/
		//Get Mbhashe Hill Cities
		public function getMbhasheCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '27'";
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
			SUBURBS IN Mbhashe
		------------------------------------------------------------------------------------------
		*/
		//Get Mbhashe Suburbs
		public function getMbhasheSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '27'";
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
		
		/*
		Get Property images for Mbizana
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/mbizana/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMbizanaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '28'
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
		
		public function getMbizanaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '28'
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
		
		public function getMbizanaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '28'
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
		
		//Mbizana Similar properties at the bottom of Light Gallery
		public function getMbizanaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 28
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

		
		//Mbizana Similar properties at the bottom of Light Gallery
		public function getMbizanaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 28
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
		
		//Mbizana Similar properties at the bottom of Light Gallery
		public function getMbizanaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 28
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
			CITIES IN Mbizana
		------------------------------------------------------------------------------------------
		*/
		//Get Mbizana Hill Cities
		public function getMbizanaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '28'";
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
			SUBURBS IN Mbizana
		------------------------------------------------------------------------------------------
		*/
		//Get Mbizana Suburbs
		public function getMbizanaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '28'";
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
		
		/*
		Get Property images for Mhlontlo
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/mhlontlo/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMhlontloPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '29'
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
		
		public function getMhlontloPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '29'
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
		
		public function getMhlontloPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '29'
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
		
		//Mbizana Similar properties at the bottom of Light Gallery
		public function getMhlontloSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 29
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

		
		//Mhlontlo Similar properties at the bottom of Light Gallery
		public function getMhlontloSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 29
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
		
		//Mhlontlo Similar properties at the bottom of Light Gallery
		public function getMhlontloSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 29
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
			CITIES IN Mhlontlo
		------------------------------------------------------------------------------------------
		*/
		//Get Mhlontlo Cities
		public function getMhlontloCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '29'";
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
			SUBURBS IN Mhlontlo
		------------------------------------------------------------------------------------------
		*/
		//Get Mhlontlo Suburbs
		public function getMhlontloSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '29'";
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
		
		/*
		Get Property images for Mnquma
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/mnquma/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getMnqumaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '30'
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
		
		public function getMnqumaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '30'
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
		
		public function getMnqumaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '30'
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
		
		//Mnquma Similar properties at the bottom of Light Gallery
		public function getMnqumaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 30
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

		
		//Mnquma Similar properties at the bottom of Light Gallery
		public function getMnqumaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 30
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
		
		//Mnquma Similar properties at the bottom of Light Gallery
		public function getMnqumaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 30
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
			CITIES IN Mnquma
		------------------------------------------------------------------------------------------
		*/
		//Get Mnquma Cities
		public function getMnqumaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '30'";
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
			SUBURBS IN Mnquma
		------------------------------------------------------------------------------------------
		*/
		//Get Mnquma Suburbs
		public function getMnqumaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '30'";
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
		
		/*
		Get Property images for Ndlambe
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/ndlambe/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNdlambePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '32'
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
		
		public function getNdlambePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '32'
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
		
		public function getNdlambePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '32'
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
		
		//Ndlambe Similar properties at the bottom of Light Gallery
		public function getNdlambeSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 32
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

		
		//Ndlambe Similar properties at the bottom of Light Gallery
		public function getNdlambeSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 32
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
		
		//Ndlambe Similar properties at the bottom of Light Gallery
		public function getNdlambeSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 32
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
			CITIES IN Ndlambe
		------------------------------------------------------------------------------------------
		*/
		//Get Ndlambe Cities
		public function getNdlambeCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '32'";
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
			SUBURBS IN Ndlambe
		------------------------------------------------------------------------------------------
		*/
		//Get Ndlambe Suburbs
		public function getNdlambeSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '32'";
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
		
		/*
		Get Property images for Nelson Mandela Bay
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		25. url/eastern_cape/nelson_mandela_bay/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNelsonMandelaBayPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '33'
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
		
		public function getNelsonMandelaBayPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '33'
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
		
		public function getNelsonMandelaBayPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '33'
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
		
		//Nelson Mandela Bay Similar properties at the bottom of Light Gallery
		public function getNelsonMandelaBaySimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 33
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

		
		//Nelson Mandela Bay Similar properties at the bottom of Light Gallery
		public function getNelsonMandelaBaySimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 33
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
		
		//Nelson Mandela Bay Similar properties at the bottom of Light Gallery
		public function getNelsonMandelaBaySimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 33
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
			CITIES IN Nelson Mandela Bay
		------------------------------------------------------------------------------------------
		*/
		//Get Nelson Mandela Bay Cities
		public function getNelsonMandelaBayCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '33'";
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
			SUBURBS IN Nelson Mandela Bay
		------------------------------------------------------------------------------------------
		*/
		//Get Nelson Mandela Bay Suburbs
		public function getNelsonMandelaBaySubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '33'";
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
		
		/*
		Get Property images for Ngqushwa
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/ngqushwa/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNgqushwaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '34'
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
		
		public function getNgqushwaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '34'
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
		
		public function getNgqushwaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '34'
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
		
		//Ngqushwa Similar properties at the bottom of Light Gallery
		public function getNgqushwaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 34
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

		
		//Ngqushwa Similar properties at the bottom of Light Gallery
		public function getNgqushwaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 34
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
		
		//Ngqushwa Similar properties at the bottom of Light Gallery
		public function getNgqushwaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 34
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
			CITIES IN Ngqushwa
		------------------------------------------------------------------------------------------
		*/
		//Get Ngqushwa Cities
		public function getNgqushwaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '34'";
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
			SUBURBS IN Ngqushwa
		------------------------------------------------------------------------------------------
		*/
		//Get Ngqushwa Suburbs
		public function getNgqushwaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '34'";
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
		
		/*
		Get Property images for Ntabankulu
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		35. url/eastern_cape/ntabankulu/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNtabankuluPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '35'
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
		
		public function getNtabankuluPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '35'
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
		
		public function getNtabankuluPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '35'
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
		
		//Ntabankulu Similar properties at the bottom of Light Gallery
		public function getNtabankuluSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 35
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

		
		//Ngqushwa Similar properties at the bottom of Light Gallery
		public function getNtabankuluSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 35
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
		
		//Ntabankulu Similar properties at the bottom of Light Gallery
		public function getNtabankuluSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 35
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
			CITIES IN Ntabankulu
		------------------------------------------------------------------------------------------
		*/
		//Get Ntabankulu Cities
		public function getNtabankuluCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '35'";
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
			SUBURBS IN Ntabankulu
		------------------------------------------------------------------------------------------
		*/
		//Get Ntabankulu Suburbs
		public function getNtabankuluSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '35'";
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
		
		/*
		Get Property images for Nyandeni
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/nyandeni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getNyandeniPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '36'
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
		
		public function getNyandeniPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '36'
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
		
		public function getNyandeniPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '36'
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
		
		//Nyandeni Similar properties at the bottom of Light Gallery
		public function getNyandeniSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 36
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

		
		//Nyandeni Similar properties at the bottom of Light Gallery
		public function getNyandeniSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 36
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
		
		//Nyandeni Similar properties at the bottom of Light Gallery
		public function getNyandeniSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 36
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
			CITIES IN Nyandeni
		------------------------------------------------------------------------------------------
		*/
		//Get Nyandeni Cities
		public function getNyandeniCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '36'";
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
			SUBURBS IN Nyandeni
		------------------------------------------------------------------------------------------
		*/
		//Get Nyandeni Suburbs
		public function getNyandeniSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '36'";
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
		
		/*
		Get Property images for Port St Johns
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/port_st_john/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getPortStJohnsPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '37'
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
		
		public function getPortStJohnsPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '37'
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
		
		public function getPortStJohnsPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '37'
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
		
		//Port St Johns Similar properties at the bottom of Light Gallery
		public function getPortStJohnsSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 37
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

		
		//Port St Johns Similar properties at the bottom of Light Gallery
		public function getPortStJohnsSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 37
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
		
		//PortStJohns Similar properties at the bottom of Light Gallery
		public function getPortStJohnsSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 37
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
			CITIES IN PortStJohns
		------------------------------------------------------------------------------------------
		*/
		//Get PortStJohns Cities
		public function getPortStJohnsCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '37'";
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
			SUBURBS IN PortStJohns
		------------------------------------------------------------------------------------------
		*/
		//Get PortStJohns Suburbs
		public function getPortStJohnsSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '37'";
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
		
		/*
		Get Property images for Raymond Mhlaba
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/raymond_mhlaba/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getRaymondMhlabaPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '38'
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
		
		public function getRaymondMhlabaPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '38'
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
		
		public function getRaymondMhlabaPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '38'
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
		
		//Raymond Mhlaba Similar properties at the bottom of Light Gallery
		public function getRaymondMhlabaSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 38
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

		
		//Raymond Mhlaba Similar properties at the bottom of Light Gallery
		public function getRaymondMhlabaSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 38
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
		
		//Raymond Mhlaba Similar properties at the bottom of Light Gallery
		public function getRaymondMhlabaSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 38
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
			CITIES IN Raymond Mhlaba
		------------------------------------------------------------------------------------------
		*/
		//Get Raymond Mhlaba Cities
		public function getRaymondMhlabaCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '38'";
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
			SUBURBS IN Raymond Mhlaba
		------------------------------------------------------------------------------------------
		*/
		//Get Raymond Mhlaba Suburbs
		public function getRaymondMhlabaSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '38'";
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
		
		/*
		Get Property images for Sakhisizwe
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/sakhisizwe/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getSakhisizwePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '39'
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
		
		public function getSakhisizwePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '39'
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
		
		public function getSakhisizwePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '39'
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
		
		//Sakhisizwe Similar properties at the bottom of Light Gallery
		public function getSakhisizweSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 39
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

		
		//Sakhisizwe Similar properties at the bottom of Light Gallery
		public function getSakhisizweSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 39
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
		
		//Sakhisizwe Similar properties at the bottom of Light Gallery
		public function getSakhisizweSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 39
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
			CITIES IN Sakhisizwe
		------------------------------------------------------------------------------------------
		*/
		//Get Sakhisizwe Cities
		public function getSakhisizweCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '39'";
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
			SUBURBS IN Sakhisizwe
		------------------------------------------------------------------------------------------
		*/
		//Get Sakhisizwe Suburbs
		public function getSakhisizweSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '39'";
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
		
		/*
		Get Property images for Senqu
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/senqu/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getSenquPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '40'
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
		
		public function getSenquPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '40'
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
		
		public function getSenquPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '40'
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
		
		//Senqu Similar properties at the bottom of Light Gallery
		public function getSenquSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 40
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

		
		//Senqu Similar properties at the bottom of Light Gallery
		public function getSenquSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 40
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
		
		//Senqu Similar properties at the bottom of Light Gallery
		public function getSenquSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 40
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
			CITIES IN Senqu
		------------------------------------------------------------------------------------------
		*/
		//Get Senqu Cities
		public function getSenquCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '40'";
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
			SUBURBS IN Senqu
		------------------------------------------------------------------------------------------
		*/
		//Get Sakhisizwe Suburbs
		public function getSenquSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '40'";
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
		
		/*
		Get Property images for Sunday River Valley
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/sunday_river_valley/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getSundayRiverValleyPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '41'
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
		
		public function getSundayRiverValleyPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '41'
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
		
		public function getSundayRiverValleyPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '41'
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
		
		//Sunday River Valley Similar properties at the bottom of Light Gallery
		public function getSundayRiverValleySimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 41
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

		
		//Sunday River Valley Similar properties at the bottom of Light Gallery
		public function getSundayRiverValleySimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 41
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
		
		//Sunday River Valley Similar properties at the bottom of Light Gallery
		public function getSundayRiverValleySimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 41
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
			CITIES IN Sunday River Valley
		------------------------------------------------------------------------------------------
		*/
		//Get Sunday River Valley Cities
		public function getSundayRiverValleyCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '41'";
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
			SUBURBS IN Sunday River Valley
		------------------------------------------------------------------------------------------
		*/
		//Get Sunday River Valley Suburbs
		public function getSundayRiverValleySubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '41'";
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
		
		/*
		Get Property images for Umzimvubu
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/umzimvubu/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getUmzimvubuPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '42'
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
		
		public function getUmzimvubuPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '42'
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
		
		public function getUmzimvubuPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '42'
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
		
		//Umzimvubu Similar properties at the bottom of Light Gallery
		public function getUmzimvubuSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 42
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

		
		//Umzimvubu Similar properties at the bottom of Light Gallery
		public function getUmzimvubuSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 42
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
		
		//Umzimvubu properties at the bottom of Light Gallery
		public function getUmzimvubuSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 42
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
			CITIES IN Umzimvubu
		------------------------------------------------------------------------------------------
		*/
		//Get Umzimvubu Cities
		public function getUmzimvubuCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '42'";
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
			SUBURBS IN Umzimvubu
		------------------------------------------------------------------------------------------
		*/
		//Get Umzimvubu Suburbs
		public function getUmzimvubuSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '42'";
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
		
		/*
		Get Property images for Walter Sisilu
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		34. url/eastern_cape/walter_sisilu/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getWalterSisuluPropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '43'
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
		
		public function getWalterSisuluPropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '43'
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
		
		public function getWalterSisuluPropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '43'
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
		
		//Walter Sisilu Similar properties at the bottom of Light Gallery
		public function getWalterSisuluSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = 43
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

		
		//Walter Sisilu Similar properties at the bottom of Light Gallery
		public function getWalterSisuluSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = 43
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
		
		//Walter Sisilu properties at the bottom of Light Gallery
		public function getWalterSisuluSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = 43
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
			CITIES IN Walter Sisilu
		------------------------------------------------------------------------------------------
		*/
		//Get Walter Sisilu Cities
		public function getWalterSisuluCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '43'";
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
			SUBURBS IN Walter Sisilu
		------------------------------------------------------------------------------------------
		*/
		//Get Walter Sisilu Suburbs
		public function getWalterSisuluSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '43'";
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
		
		/*
		Get Property images for Nkonkobe
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		12. url/eastern_cape/nkonkobe/index.php
		-------------------------------------------------------------------------------------------------------------
		*/	
		
		public function getNkonkobePropertyListImagesForSale(){
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
						  WHERE municipalities.municipality_id = '31'
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
		
		public function getNkonkobePropertyListImagesToRent(){
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
						  WHERE municipalities.municipality_id = '31'
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
		
		public function getNkonkobePropertyListImagesOnShow(){
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
						  WHERE municipalities.municipality_id = '31'
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
		
		//Nkonkobe Similar properties at the bottom of Light Gallery
		public function getNkonkobeSimilarPropertyForSale(){
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
						  WHERE municipalities.municipality_id = '31'
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

		
		//Nkonkobe Similar properties at the bottom of Light Gallery
		public function getNkonkobeSimilarPropertyOnShow(){
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
						  WHERE municipalities.municipality_id = '31'
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
		
		//Nkonkobe Similar properties at the bottom of Light Gallery
		public function getNkonkobeSimilarPropertyToRent(){
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
						  WHERE municipalities.municipality_id = '31'
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
			SUBURBS IN NKONKOBE CITY
		------------------------------------------------------------------------------------------
		*/
		//Get Nkonkobe Cities
		public function getNkonkobeCities($municipality_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '31'";
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
			SUBURBS IN NKONKOBE 
		------------------------------------------------------------------------------------------
		*/
		//Get Buffalo City Suburbs
		public function getNkonkobeSubs($municipality_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, 
						  m.municipality_id FROM suburbs s
						  LEFT JOIN municipalities m
						  ON s.municipality_id = m.municipality_id
						  WHERE m.municipality_id = '$municipality_id'
						  AND m.municipality_id = '31'";
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
		
	}
?>
<?php
	class Matatiele_Model{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get Suburb By ID
		public function getSuburb($suburb_id){
			try{
				$query = "SELECT s.*, m.municipality_name, m.municipality_code, m.municipality_id, 
						  c.city_name, c.city_code, c.city_id 
						  FROM suburbs s
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id						  
						  WHERE suburb_id = '$suburb_id' 
						  ";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
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
																
				$suburb = new Suburb();
				$suburb->setCity($city);
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setTotalPropertyForSale($row['total_property_forsale']);
				$suburb->setTotalPropertyToRent($row['total_property_torent']);
				$suburb->setTotalPropertyOnShow($row['total_property_onshow']);
																														
				return $suburb;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image By Suburb ID
		public function getSuburbImage($suburb_id){
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
						  WHERE suburbs.suburb_id = '$suburb_id'
						  ORDER BY properties.property_id 
						  ";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
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
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setSuburb($suburb);
				$property->setNumBathRoom($row['num_bathrooms']);
				$property->setNumBed($row['num_beds']);
				$property->setNumGarage($row['num_garages']);
				$property->setPrice($row['price']);
																										
				$image = new PropertyImage();
				$image->setImageID($row['property_image_id']);
				$image->setProperty($property);
				$image->setImageLocation($row['image_location']);	
							
				return $suburb;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		//Get City By ID
		public function getCity($city_id){
			try{
				$query = "SELECT c.*, m.municipality_name, m.municipality_code, m.municipality_id
						  FROM cities c
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE city_id = '$city_id'
						  ";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				//create municipality object
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityCode($row['municipality_code']);
				$municipality->setMunicipalityName($row['municipality_name']);
				
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityCode($row['city_code']);
				$city->setCityName($row['city_name']);
				$city->setMunicipality($municipality);
				$city->setTotalPropertyForSale($row['total_property_forsale']);
				$city->setTotalPropertyToRent($row['total_property_torent']);
				$city->setTotalPropertyOnShow($row['total_property_onshow']);
				
				return $city;
				
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
						$suburbs[] = $suburb;
					}
					
					return $suburbs;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image per ID
		public function getPropertyImage($image_id){
			try{
				$query = "SELECT * FROM property_images 					  
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$row = $result->fetch(pdo::FETCH_ASSOC);
			
				$property_image = new PropertyImage();
				$property_image->setImageID($row['property_image_id']);
				$property_image->setImageLocation($row['image_location']);				
				
				return $property_image;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		/*
		--------------------------------------------------
			LIGHT GALLERY IMAGES
		--------------------------------------------------
		*/
		
		//Get property images by property ID (Light Gallery)
		public function getPropertyImages($property_id){
			try{
				$queryPr = "SELECT properties.* FROM properties WHERE property_id = $property_id";
				$resultPr = $this->conn->query($queryPr);
				$rowPr = $resultPr->fetch(pdo::FETCH_ASSOC);
				
				
				$query = "SELECT * FROM property_images WHERE property_id = $property_id					  
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$i=0;
				foreach($result as $row){
					$data[$i] = $row;
					$data[$i]['property'] = $rowPr;
					$i++;
				}
				return $data;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get property images for sale, and agent by property ID (Light Gallery)
		public function getAgentPropertyImagesForSale($property_id){
			try{
				$queryPr = "SELECT properties.*, agents.agent_id, agents.firstname, agents.lastname, 
							agents.image, agents.phone 
							FROM properties LEFT JOIN agents
							ON properties.agent_id = agents.agent_id
							WHERE property_id = $property_id
							AND property_status = 'For Sale'";
				$resultPr = $this->conn->query($queryPr);
				$rowPr = $resultPr->fetch(pdo::FETCH_ASSOC);
				
				
				$query = "SELECT * FROM property_images WHERE property_id = $property_id					  
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$i=0;
				foreach($result as $row){
					$data[$i] = $row;
					$data[$i]['property'] = $rowPr;
					$i++;
				}
				return $data;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get property images to rent, and agent by property ID (Light Gallery)
		public function getAgentPropertyImagesToRent($property_id){
			try{
				$queryPr = "SELECT properties.*, agents.agent_id, agents.firstname, agents.lastname, 
							agents.image, agents.phone 
							FROM properties LEFT JOIN agents
							ON properties.agent_id = agents.agent_id
							WHERE property_id = $property_id
							AND property_status = 'To Rent'";
				$resultPr = $this->conn->query($queryPr);
				$rowPr = $resultPr->fetch(pdo::FETCH_ASSOC);
				
				
				$query = "SELECT * FROM property_images WHERE property_id = $property_id					  
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$i=0;
				foreach($result as $row){
					$data[$i] = $row;
					$data[$i]['property'] = $rowPr;
					$i++;
				}
				return $data;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get property images on show, and agent by property ID (Light Gallery)
		public function getAgentPropertyImagesOnShow($property_id){
			try{
				$queryPr = "SELECT properties.*, agents.agent_id, agents.firstname, agents.lastname, 
							agents.image, agents.phone 
							FROM properties LEFT JOIN agents
							ON properties.agent_id = agents.agent_id
							WHERE property_id = $property_id
							AND property_status = 'On Show'";
				$resultPr = $this->conn->query($queryPr);
				$rowPr = $resultPr->fetch(pdo::FETCH_ASSOC);
				
				
				$query = "SELECT * FROM property_images WHERE property_id = $property_id					  
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$i=0;
				foreach($result as $row){
					$data[$i] = $row;
					$data[$i]['property'] = $rowPr;
					$i++;
				}
				return $data;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get suburb for sale by property ID (Light Gallery)
		public function getPropertySuburbForSale($property_id){
			try{
				$query = "SELECT s.*, p.property_id, p.price, p.property_desc,
						  c.city_id, c.city_name
					  FROM suburbs s
					  LEFT JOIN properties p
					  ON s.suburb_id = p.suburb_id
					  LEFT JOIN cities c
					  ON s.city_id = c.city_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'For Sale'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
			
				return $suburb;
			
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get suburb for sale by property ID (Light Gallery)
		public function getPropertySuburbOnShow($property_id){
			try{
				$query = "SELECT s.*, p.property_id, p.price, p.property_desc,
						  c.city_id, c.city_name
					  FROM suburbs s
					  LEFT JOIN properties p
					  ON s.suburb_id = p.suburb_id
					  LEFT JOIN cities c
					  ON s.city_id = c.city_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'On Show'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
			
				return $suburb;
			
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}	
		
		//Get suburb for sale by property ID (Light Gallery)
		public function getPropertySuburbToRent($property_id){
			try{
				$query = "SELECT s.*, p.property_id, p.price, p.property_desc,
						  c.city_id, c.city_name
					  FROM suburbs s
					  LEFT JOIN properties p
					  ON s.suburb_id = p.suburb_id
					  LEFT JOIN cities c
					  ON s.city_id = c.city_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'To Rent'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
			
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
			
				return $suburb;
			
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get agent for sale by property ID (Light Gallery)
		public function getPropertyAgentForSale($property_id){
			try{
			$query = "SELECT a.*, c.agency_id, c.logo, c.agency_name, property_id, price, property_desc
					  FROM agents a
					  LEFT JOIN properties p
					  ON a.agent_id = p.agent_id
					  LEFT JOIN agencies c
					  ON a.agency_id = c.agency_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'For Sale'";
			$result = $this->conn->query($query);
			$row = $result->fetch(PDO::FETCH_ASSOC);
			
			$agency = new Agency();
			$agency->setAgencyID($row['agency_id']);
			$agency->setAgencyName($row['agency_name']);
			$agency->setLogo($row['logo']);
			
			$agent = new Agent();
			$agent->setAgentID($row['agent_id']);
			$agent->setFirstname($row['firstname']);
			$agent->setLastname($row['lastname']);
			$agent->setPhone($row['phone']);
			$agent->setImage($row['image']);
			$agent->setAgency($agency);
			
			return $agent;
			
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get agent to rent by property ID (Light Gallery)
		public function getPropertyAgentToRent($property_id){
			$query = "SELECT a.*, c.agency_id, c.logo, c.agency_name, property_id, price, property_desc
					  FROM agents a
					  LEFT JOIN properties p
					  ON a.agent_id = p.agent_id
					  LEFT JOIN agencies c
					  ON a.agency_id = c.agency_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'To Rent'";
			$result = $this->conn->query($query);
			$row = $result->fetch(PDO::FETCH_ASSOC);
			
			$agency = new Agency();
			$agency->setAgencyID($row['agency_id']);
			$agency->setAgencyName($row['agency_name']);
			$agency->setLogo($row['logo']);
			
			$agent = new Agent();
			$agent->setAgentID($row['agent_id']);
			$agent->setFirstname($row['firstname']);
			$agent->setLastname($row['lastname']);
			$agent->setPhone($row['phone']);
			$agent->setImage($row['image']);
			$agent->setAgency($agency);
			
			return $agent;
		}
		
		//Get agent on show by property ID (Light Gallery)
		public function getPropertyAgentOnShow($property_id){
			$query = "SELECT a.*, c.agency_id, c.logo, c.agency_name, property_id, price, property_desc
					  FROM agents a
					  LEFT JOIN properties p
					  ON a.agent_id = p.agent_id
					  LEFT JOIN agencies c
					  ON a.agency_id = c.agency_id
					  WHERE property_id = '$property_id'
					  AND property_status = 'On Show'";
			$result = $this->conn->query($query);
			$row = $result->fetch(PDO::FETCH_ASSOC);
			
			$agency = new Agency();
			$agency->setAgencyID($row['agency_id']);
			$agency->setAgencyName($row['agency_name']);
			$agency->setLogo($row['logo']);
			
			$agent = new Agent();
			$agent->setAgentID($row['agent_id']);
			$agent->setFirstname($row['firstname']);
			$agent->setLastname($row['lastname']);
			$agent->setPhone($row['phone']);
			$agent->setImage($row['image']);
			$agent->setAgency($agency);
			
			return $agent;
		}
		
		//Get Property By ID 
		public function getProperty($property_id){
			try{
				$query = "SELECT p.*,  i.property_image_id, i.image_location, s.suburb_id, s.suburb_name,
						  c.city_id, c.city_name, c.city_code
						  FROM properties p
						  LEFT JOIN property_images i
						  ON i.property_id = p.property_id
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  WHERE p.property_id = '$property_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);		
				
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityCode($row['city_code']);
				$city->setCityName($row['city_name']);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setStreetNo($row['street_no']);
				$property->setStreetName($row['street_name']);
				$property->setPropertyDescription($row['propoerty_desc']);
				$property->setPropertyStatus($row['propoerty_status']);
				$property->setNumBathRoom($row['num_bathrooms']);
				$property->setNumBed($row['num_beds']);
				$property->setNumGarage($row['num_garages']);
				$property->setNumLounge($row['num_lounges']);
				$property->setAirCon($row['air_con']);
				$property->setPool($row['pool']);
				$property->setCottage($row['cottage']);
				$property->setPrice($row['price']);
				
				return $property;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		
		} 
	}
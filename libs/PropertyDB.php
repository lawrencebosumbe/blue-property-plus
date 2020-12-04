<?php
	class PropertyDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get all Propety IDs
		public function getPropertyIDs(){
			try{
				$query = "SELECT property_id FROM properties
						  ORDER BY property_id
						  DESC LIMIT 1";
	 
				$result = $this->conn->query( $query );
			 	$properties = array();
				
				foreach($result as $row){
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$properties[] = $property;
				}				
							 
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get all Propety Total IDs By Employee ID
		public function getTotalPropertyIDs(){
			$emp_id = 0;
			try{
				$query = "SELECT property_id, employees.emp_id
						  FROM properties
						  JOIN employees					  
						  WHERE properties.emp_id = '$emp_id'
						  ORDER BY employees.emp_id
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					
					$property = new Property();					
					$property->setPropertyID($row['property_id']);					
										
					$properties[] = $property;

				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		//Get Suburbs By Municipality ID
		public function getTotalMunicipalitySuburbs($municipality_id){
			try{
				$query = "SELECT COUNT(*) AS num_rows, p.*, s.suburb_id, c.city_id, m.municipality_id
						  FROM properties p 
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id
						  LEFT JOIN cities c
						  ON s.city_id = c.city_id
						  LEFT JOIN municipalities m
						  ON c.municipality_id = m.municipality_id
						  WHERE s.municipality_id = '$municipality_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
					
					//Create City Object
					
					//Create Municipality Object
					$municipality = new Municipality();
					$municipality->setMunicipalityName($row['municipality_id']);
					
					$city = new City();
					$city->setMunicipality($municipality);
					$city->setCityName($row['city_id']);
					
					//create Suburb object
					$suburb = new Suburb();
					$suburb->setCity($city);
					$suburb->setSuburbID($row['num_rows']);
						
					//create Property Object
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$property->setSuburb($suburb);
					
				return $property;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All Properties
		public function get_properties(){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, suburbs.suburb_id, suburb_name, cities.city_id, city_name, 
						  municipalities.municipality_id, municipality_name, provinces.province_id, province_name
						  FROM properties 
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces
						  ON municipalities.province_id = provinces.province_id
						  GROUP BY properties.property_id
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);		
					$property->setSuburb($suburb);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);			
					$property->setPrice($row['price']);				
										
					$properties[] = $property;
				}
				
				return $properties;
			
			}catch(PDOException $e){
				echo($e->getMessage());
			}
		}
		
		//Get All Properties
		public function getProperties(){
			try{
				$query = "SELECT * FROM properties
						  INNER JOIN property_types
						  ON properties.property_type_id = property_types.property_type_id
						  INNER JOIN agents
						  ON properties.agent_id = agents.agent_id
						  INNER JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id
						  INNER JOIN property_ranges
						  ON properties.property_range_id = property_ranges.property_range_id
						  INNER JOIN employees
						  ON properties.emp_id = employees.emp_id";
				$result = $this->conn->query($query);
				$properties = array();
				
				foreach($result as $row){
					//Create Employee Object
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					$employee->setFirstname($row['firstname']);
					$employee->setLastname($row['lastname']);
					$employee->setEmail($row['email']);
					$employee->setPassword($row['password']);
					$employee->setPhone($row['phone']);
					$employee->setGender($row['gender']);
					$employee->setEmployeeType($row['type']);
					$employee->setRegistrationDate($row['date']);
					$employee->setImage($row['image']);
					
					//Create Property Type Object
					$property_type = new PropertyType();
					$property_type->setPropertyTypeID($row['property_type_id']);
					$property_type->setPropertyType($row['property_type_desc']);
					
					//Create Agent Object								
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPassword($row['password']);
					$agent->setPhone($row['phone']);
					$agent->setGender($row['gender']);
					$agent->setDate($row['date']);
					$agent->setImage($row['image']);
					
					//Create Suburb Object
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbCode($row['suburb_code']);
					$suburb->setSuburbName($row['suburb_name']);
					
					//Create Property Range Object
					$property_range = new PropertyRange();
					$property_range->setPropertyRangeID($row['property_range_id']);
					$property_range->setPropertyRangeAmount($row['amount']);
					$property_range->setPropertyRangeMin($row['min_range']);
					$property_range->setPropertyRangeMax($row['max_range']);
					
					//Create Property Object
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$property->setPropertyType($property_type);
					$property->setAgent($agent);
					$property->setSuburb($suburb);
					$property->setPropertyRange($property_range);
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
					
					$properties[] = $property;
				}

				return $properties;
			
			}catch(PDOException $e){
				echo($e->getMessage());
			}
		}
		
		//Get All properties By Property Type, Agent, Suburb, and Property Range IDs
		public function getPropertiesByID($property_type_id, $agent_id, $suburb_id, $property_range_id, $emp_id){
			try{
				$query = "SELECT p.*, t.property_type_id, t.property_type_desc, a.agent_id, a.firstname, a.lastname,
						  a.email, a.phone, a.image, s.suburb_id, s.suburb_name, r.property_range_id, r.amount,
						  r.min_range, r.max_range, e.firstname, e.lastname, e.email, e.phone FROM properties p
						  LEFT JOIN property_types t
						  ON p.property_type_id = t.property_type_id
						  LEFT JOIN agents a
						  ON p.agent_id = a.agent_id
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id
						  LEFT JOIN property_range r
						  ON p.property_range_id = r.property_range_id
						  LEFT JOIN employees e
						  ON p.emp_id = e.emp_id
						  WHERE t.property_type_id = '$property_type_id'
						  AND a.agent_id = '$agent_id'
						  AND s.suburb_id = '$suburb_id'
						  AND r.property_range_id = '$property_range_id'
						  AND e.emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				
				$properties = array();
				
				foreach($result as $row){
					//Create Employee Object
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					$employee->setFirstname($row['firstname']);
					$employee->setLastname($row['lastname']);
					$employee->setEmail($row['email']);
					$employee->setPassword($row['password']);
					$employee->setPhone($row['phone']);
					$employee->setGender($row['gender']);
					$employee->setEmployeeType($row['type']);
					$employee->setRegistrationDate($row['date']);
					$employee->setImage($row['image']);
					
					//Create Property Type Object
					$property_type = new PropertyType();
					$property_type->setPropertyTypeID($row['property_type_id']);
					$property_type->setPropertyType($row['property_type_desc']);
					
					//Create Agent Object								
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPassword($row['password']);
					$agent->setPhone($row['phone']);
					$agent->setGender($row['gender']);
					$agent->setDate($row['date']);
					$agent->setImage($row['image']);
					
					//Create Suburb Object
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbCode($row['suburb_code']);
					$suburb->setSuburbName($row['suburb_name']);
					
					//Create Property Range Object
					$property_range = new PropertyRange();
					$property_range->setPropertyRangeID($row['property_range_id']);
					$property_range->setPropertyRangeAmount($row['amount']);
					$property_range->setPropertyRangeMin($row['min_range']);
					$property_range->setPropertyRangeMax($row['max_range']);
					
					//Create Property Object
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$property->setPropertyType($property_type);
					$property->setAgent($agent);
					$property->setSuburb($suburb);
					$property->setPropertyRange($property_range);
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
					
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo($e->getMessage());
			}		
		}
		 
		//Get Property By ID 
		public function getProperty($property_id){
			try{
				$query = "SELECT * FROM properties
						  WHERE property_id = '$property_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);		
				
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
				
		//Get Property Listings For Home Page
		/*
		This function is used by 
		1. index.php
		2. for-sale/gauteng/gauteng.php
		3. for-sale/gauteng/johannesburg/johannesburg.php
		*/
		public function getPropertyListImages(){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name, 
						  provinces.province_id, province_name
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
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);			
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Listings Image For Sale
		public function getPropertyListImagesForSale(){
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
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
				
		/*
		---------------------------------------------------------
			SIMILAR PROPERTIES
		---------------------------------------------------------
		*/
		
		//Ekurhuleni Similar properties at the bottom of Light Gallery
		public function getEkurhuleniSimilarPropertyForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Ekurhuleni Similar properties at the bottom of Light Gallery
		public function getEkurhuleniSimilarPropertyOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_status, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		//Johannesburg Similar properties at the bottom of Light Gallery
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
		
		//Lesedi Similar properties at the bottom of Light Gallery
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
		
		//Lesedi Similar properties at the bottom of Light Gallery
		public function getLesediSimilarPropertyToRent(){
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
		
		//Lesedi Similar properties at the bottom of Light Gallery
		public function getLesediSimilarPropertyOnShow(){
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
		
		//Pretoria Similar properties for sale at the bottom of Light Gallery
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
		
		//Pretoria Similar properties on show at the bottom of Light Gallery
		public function getPretoriaSimilarPropertyOnShow(){
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
		
		//Pretoria Similar properties to rent at the bottom of Light Gallery
		public function getPretoriaSimilarPropertyToRent(){
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
						  AND properties.property_status = 'ToRent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
					$property->setMunicipalityName($row['municipality_name']);
					$property->setCityID($row['city_id']);
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Mogale Similar properties at the bottom of Light Gallery
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
		
		//Mogale Similar properties at the bottom of Light Gallery
		public function getMogaleSimilarPropertyToRent(){
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
		
		//Mogale Similar properties at the bottom of Light Gallery
		public function getMogaleSimilarPropertyOnShow(){
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
		
		//Midvaal Similar properties at the bottom of Light Gallery
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
		
		//Midvaal Similar properties at the bottom of Light Gallery
		public function getMidvaalSimilarPropertyToRent(){
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
		
		//Midvaal Similar properties at the bottom of Light Gallery
		public function getMidvaalSimilarPropertyOnShow(){
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
		
		
		//Merafong Similar properties at the bottom of Light Gallery
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
		
		//Merafong Similar properties at the bottom of Light Gallery
		public function getMerafongSimilarPropertyToRent(){
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
		
		//Merafong Similar properties at the bottom of Light Gallery
		public function getMerafongSimilarPropertyOnShow(){
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
		
		
		//Rand West Similar properties at the bottom of Light Gallery
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
		
		//Rand West Similar properties at the bottom of Light Gallery
		public function getRandWestSimilarPropertyToRent(){
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
		
		//Rand West Similar properties at the bottom of Light Gallery
		public function getRandWestSimilarPropertyOnShow(){
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
		
		//Johannesburg Similar properties at the bottom of Light Gallery
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
		
		//Johannesburg Similar properties at the bottom of Light Gallery
		public function SimilarPropertyToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		//Emfuleni Similar properties at the bottom of Light Gallery
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
		
		//Get Property Listings Image To Rent
		public function getPropertyListImagesToRent(){
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
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		//Get Property Listings Image To Rent
		public function getEkurhuleniPropertyListImagesToRent(){
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
						  AND municipalities.municipality_id = '1'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		//Get Property Listings Image On Show
		public function getPropertyListImagesOnShow(){
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
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
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
		
		/*
		Get Property images for Johannesburg On Show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/on_show/johannesburg/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getJhbPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		/*
		Get Property images for sale in Johannesburg
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/johannesburg/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getJhbPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		/*
		Get Property images for Ekurhuleni for sale
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/ekurhuleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEkurhuleniPropertyListImagesForSale(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
					      street_name, num_beds, num_garages, property_status, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		/*
		Get Property images for Ekurhuleni on show
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getEkurhuleniPropertyListImagesOnShow(){
			try{
				$query = "SELECT properties.property_id, property_type, property_status, property_desc, price, num_bathrooms, 
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
				
		/*
		Get Property images for Pretoria
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/pretoria/index.php
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
		
		/*
		Get Property images for Pretoria on show
		-------------------------------------------------------------------------------------------------------------
		*/
		
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
		
		/*
		Get Property images for Pretoria to rent
		-------------------------------------------------------------------------------------------------------------
		*/
		
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
		
		
		/*
		Get Property images for Emfuleni
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/emfuleni/index.php
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
		
		/*
		Get Property images for Emfuleni On Show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/on_show/emfuleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Emfuleni To Rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/on_show/emfuleni/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Midvaal for sale
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/midvaal/index.php
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
		
		/*
		Get Property images for Midvaal to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/midvaal/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Midvaal on show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/midvaal/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Rand West
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/rand_west/index.php
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
		
		/*
		Get Property images for Rand West to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/rand_west/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Rand West on show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/rand_west/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Lesedi for sale
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/lesedi/index.php
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
		
		/*
		Get Property images for Lesedi to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/lesedi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
		public function getLesediPropertyListImageToRent(){
			try{
				$query = "SELECT properties.property_id, property_type, property_desc, price, num_bathrooms, street_no, 
				          street_name, num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipalities.municipality_name,
						  agents.agent_id, firstname, lastname, email, phone, agencies.agency_id, agency_name, logo 
						  FROM property_images 
						  LEFT JOIN properties
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN suburbs
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
		
		/*
		Get Property images for Lesedi on show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/lesedi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Lesedi to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/lesedi/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Mogale for sale
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/mogale/index.php
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
		
		/*
		Get Property images for Mogale to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/to_tent/mogale/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
						  AND properties.property_status = 'ToRent'
						  GROUP BY properties.property_id
						  DESC
						  LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){
					$agency = new Agency();
					$agency->setAgencyID($row['agency_id']);
					$agency->setAgencyName($row['agency_name']);
					$agency->setLogo($row['logo']);
					
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPhone($row['phone']);
					$agent->setAgency($agency);
					
					$munucipality = new Municipality();
					$munucipality->setMunicipalityID($row['municipality_id']);
					$munucipality->setMunicipalityName($row['municipality_name']);
					
					$city = new City();
					$city->setCityID($row['city_id']);
					$city->setCityName($row['city_name']);
					$city->setMunicipality($munucipality);
					
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					$suburb->setCity($city);
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setAgent($agent);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);	
					$property->setStreetNo($row['street_no']);	
					$property->setStreetName($row['street_name']);	
					$property->setPropertyDescription($row['property_desc']);	
					$property->setPropertyType($row['property_type']);		
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);
					$property->setSuburbID($row['suburb_id']);
					$property->setMunicipalityID($row['municipality_id']);
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
		Get Property images for Mogale on show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/on_show/mogale/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Merafong for sale
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/merafong/index.php
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
		
		/*
		Get Property images for Merafong to rent
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/merafong/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		/*
		Get Property images for Merafong on show
		-------------------------------------------------------------------------------------------------------------
		This function is used by 
		1. url/gauteng/merafong/index.php
		-------------------------------------------------------------------------------------------------------------
		*/
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
		
		//Get Property Listings By Province
		/*
		This function is used by :
		1. for-sale/gauteng/gauteng.php
		*/
		public function getPropertyListByProvince($province_id){
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
						  WHERE provinces.province_id = '$province_id'

						  GROUP BY properties.property_id 						  
						  DESC LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);		
					$property->setPropertyDescription($row['property_desc']);			
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);					
										
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
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

						  GROUP BY properties.property_id 						  
						  DESC LIMIT 3
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
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
														
					$property = new Property();		
					$property->setPropertyID($row['property_id']);			
					$property->setSuburb($suburb);	
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);		
					$property->setPropertyDescription($row['property_desc']);			
					$property->setPrice($row['price']);	
					$property->setImageLocation($row['image_location']);					
										
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get Property Listings By Agent
		public function getPropertyListByEmployee($emp_id){
			try{
				$employees = new EmployeeDB();
				$employee = new Employee();
				$employee = $employees->getEmployee($emp_id);
				
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, num_beds, property_image_id, 
						  image_location, employees.emp_id, firstname, lastname, num_garages, image, email, phone,
						  suburbs.suburb_id, suburb_name, cities.city_id, city_name, municipalities.municipality_id,
						  municipality_name, provinces.province_id, province_name 
						  FROM properties 
						  LEFT JOIN property_images	
						  ON property_images.property_id = properties.property_id
						  LEFT JOIN employees 
						  ON properties.emp_id = employees.emp_id
						  LEFT JOIN suburbs
						  ON properties.suburb_id = suburbs.suburb_id					   
						  LEFT JOIN cities
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces
						  ON municipalities.province_id = provinces.province_id
						  WHERE employees.emp_id = '$emp_id'

						  GROUP BY properties.emp_id						  
						  ";
				$result = $this->conn->query($query);

			    $properties = array();
				
				foreach($result as $row){					
					$property = new Property();	
					$property->setPropertyID($row['property_id']);	
					$property->setEmployee($employee);			
					$property->setPropertyDescription($row['property_desc']);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);					
					$property->setPrice($row['price']);	
					$property->setEmployee($employee);	
					$property->setImageLocation($row['image_location']);					
										
					$properties[] = $property;
				}
				
				return $properties;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read One Property at a time
		public function GetOneProperty($property_id){
			try{
				$query = "SELECT * FROM properties
						  WHERE property_id = ?
						  LIMIT 0, 1";
				$statement = $this->conn->prepare($query);
				$statement->bindParam(1, $property_id);
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				
				$employee = new Employee();
				$employee->getEmployee($row['emp_id']);
				
				$property_type = new PropertyType();
				$property_type->getPropertyType($row['property_type_id']);
				
				$agent = new Agent();
				$agent->getAgent($row['agent_id']);
				
				$suburb = new Suburb();
				$suburb->getSuburb($row['suburb_id']);
				
				$property_range = new PropertyRange();
				$property_range->getPropertyRange($row['property_range_id']);
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setPropertyType($property_type);
				$property->setAgent($agent);
				$property->setSuburb($suburb);
				$property->setPropertyRange($property_range);
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
		
		//Read all Properties per row per page
		public function getAllProperties($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM properties
						  ORDER BY property_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Records for pagination
		public function getPropertyRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM properties
						  ORDER BY property_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				
				$propertes  = array();
				
			 	foreach($result as $row){
					//Create Employee Object
					$employee = new Employee();
					$employee->setEmployeeID($row['emp_id']);
					$employee->setFirstname($row['firstname']);
					$employee->setLastname($row['lastname']);
					$employee->setEmail($row['email']);
					$employee->setPassword($row['password']);
					$employee->setPhone($row['phone']);
					$employee->setGender($row['gender']);
					$employee->setEmployeeType($row['type']);
					$employee->setRegistrationDate($row['date']);
					$employee->setImage($row['image']);
					
					//Create Property Type Object
					$property_type = new PropertyType();
					$property_type->setPropertyTypeID($row['property_type_id']);
					$property_type->setPropertyType($row['property_type_desc']);
					
					//Create Agent Object								
					$agent = new Agent();
					$agent->setAgentID($row['agent_id']);
					$agent->setFirstname($row['firstname']);
					$agent->setLastname($row['lastname']);
					$agent->setEmail($row['email']);
					$agent->setPassword($row['password']);
					$agent->setPhone($row['phone']);
					$agent->setGender($row['gender']);
					$agent->setDate($row['date']);
					$agent->setImage($row['image']);
					
					//Create Suburb Object
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbCode($row['suburb_code']);
					$suburb->setSuburbName($row['suburb_name']);
					
					//Create Property Range Object
					$property_range = new PropertyRange();
					$property_range->setPropertyRangeID($row['property_range_id']);
					$property_range->setPropertyRangeAmount($row['amount']);
					$property_range->setPropertyRangeMin($row['min_range']);
					$property_range->setPropertyRangeMax($row['max_range']);
					
					//Create Property Object
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$property->setPropertyType($property_type);
					$property->setAgent($agent);
					$property->setSuburb($suburb);
					$property->setPropertyRange($property_range);
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
					$propertes[] = $property;
				}
				
				return $propertes ;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All Properties By Search Term
		public function getPropertyBySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM properties p
						  WHERE p.property_name LIKE ?";
			 
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
				
		//Add Property 
		public function addProperty(){
			try{
				 //Assign Property Values
				 $property_id = isset($_POST["property_id"] ) ? $_POST["property_id"]: '';
				 $employee = isset($_SESSION['emp_id'] ) ? $_SESSION['emp_id']: '';
				 $property_type = isset($_POST["property_type"] ) ? $_POST["property_type"]: '';
				 $agent = isset($_SESSION["agent"] ) ? $_SESSION["agent"]: '';
				 $suburb = isset($_POST["suburb"] ) ? $_POST["suburb"]: '';
				 $property_range = isset($_POST["property_range"] ) ? $_POST["property_range"]: '';
				 $street_no = isset($_POST["street_no"] ) ? $_POST["street_no"]: '';
				 $street_name = isset($_POST["street_name"] ) ? $_POST["street_name"]: '';
				 $desc = isset($_POST["desc"] ) ? $_POST["desc"]: '';			 
				 $property_status = isset($_POST["property_status"] ) ? $_POST["property_status"]: '';
				 $num_bathrooms = isset($_POST["num_bathrooms"] ) ? $_POST["num_bathrooms"]: '';
				 $num_beds = isset($_POST["num_beds"] ) ? $_POST["num_beds"]: '';
				 $num_garages = isset($_POST["num_garages"] ) ? $_POST["num_garages"]: '';
				 $num_lounges = isset($_POST["num_lounges"] ) ? $_POST["num_lounges"]: '';
				 $air_con = isset($_POST["air_con"] ) ? $_POST["air_con"]: '';
				 $pool = isset($_POST["pool"] ) ? $_POST["pool"]: '';
				 $cottage = isset($_POST["cottage"] ) ? $_POST["cottage"]: '';
				 $price = isset($_POST["price"] ) ? $_POST["price"]: '';
				 
				 //Instantiate Property Object				 
				 $property = new Property();
				 
				 //Set Property Object
				 $property->setPropertyID($property_id);
				 $property->setEmployee($employee);
				 $property->setPropertyType($property_type);
				 $property->setAgent($agent);
				 $property->setSuburb($suburb);
				 $property->setPropertyRange($property_range);
				 $property->setStreetNo($street_no);
				 $property->setStreetName($street_name);
				 $property->setPropertyDescription($desc);
				 $property->setPropertyStatus($property_status);
				 $property->setNumBathRoom($num_bathrooms);
				 $property->setNumBed($num_beds);
				 $property->setNumGarage($num_garages);
				 $property->setNumLounge($num_lounges);
				 $property->setAirCon($air_con);
				 $property->setPool($pool);
				 $property->setCottage($cottage);
				 $property->setPrice($price);
	
				 //Get Property Object
				 $property->getPropertyID();
				 $property->getEmployee();
				 $property->getPropertyType();
				 $property->getAgent();
				 $property->getSuburb();
				 $property->getPropertyRange();
				 $property->getStreetNo();
				 $property->getStreetName();
				 $property->getPropertyDescription();
				 $property->getPropertyStatus();
				 $property->getNumBathRoom();
				 $property->getNumBed();
				 $property->getNumGarage();
				 $property->getNumLounge();
				 $property->getAirCon();
				 $property->getPool();
				 $property->getCottage();
				 $property->getPrice();
			  
			  //Insert Properties into Database
			 $query = "INSERT INTO properties (emp_id, property_type_id, agent_id, suburb_id, property_range_id, 
			 		   street_no, street_name, property_desc, property_status, num_bathrooms, num_beds,
					   num_garages, num_lounges, air_con, pool, cottage, price)
			  			VALUES('$employee', '$property_type', '$agent', '$suburb', '$property_range', '$street_no', 
						        '$street_name', '$desc', '$property_status', '$num_bathrooms', '$num_beds',
								'$num_garages', '$num_lounges', '$air_con', '$pool', '$cottage', '$price')";
			  $row_count = $this->conn->exec($query);
			  if($row_count){
					$query = "UPDATE suburbs SET total_property = total_property + 1
							  WHERE suburb_id = '$suburb'";
					$row_count = $this->conn->exec($query);
				}
			  //Retrieve the last inserted Property ID
			  $last_insert_property_id = $this->conn->lastInsertId(); 
			  
			  //If property_id exists, we want to make it equal to property	object		  
			  if($last_insert_property_id){
				$property = $last_insert_property_id;
				$file_name = isset($_POST["image"]) ? $_POST["image"]: '';
				
				$img_date = date("Y-m-d H:i:s", time());			
				
				//Instantiate Property Image Object				
				$property_image = new PropertyImage();
				
				//Set Property Image Object
				
				$property_image->setProperty($property);
				$property_image->setImageLocation($file_name);
				$property_image->setImageDate($img_date);
				
				//Get Property Image Object	
				$property_image->getImageID();
				$property_image->getProperty();
				$property_image->getImageLocation();
				$property_image->getImageDate();
					
					if(isset($_FILES['image'])){
						$errors= array();
						foreach($_FILES['image']['tmp_name'] as $key => $tmp_name ){
							$file_name = $key.$_FILES['image']['name'][$key];
							$file_size =$_FILES['image']['size'][$key];
							$file_tmp =$_FILES['image']['tmp_name'][$key];
							
							move_uploaded_file($file_tmp, "uploads/".$file_name);
										
							$location = "back_office/admin/properties/uploads/" . $file_name;
							
							if($file_size > 2097152){
								$errors[]='File size must be less than 2 MB';
							}		
							$query = "INSERT INTO property_images (property_id, image_location, upload_date) 
								      VALUES('$property', '$location', '$img_date'); ";
							$row_count = $this->conn->exec($query);	
						}
						if(empty($error)){
							echo "Success";
						}
					}			
			  }
				
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
	
		//Delete Property
		public function deletePropertyRange(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			$property_range_id = isset($_GET["property_id"] ) ? $_GET["property_id"]: '';
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM properties
							  WHERE property_id = '$property_id'";	
					$row_count = $this->conn->exec($query);
					header("location: properties.php");
					
					return $row_count;
				}else{
				$query = "SELECT p.street_no, p.street_name, p.price, s.suburb_id, s.suburb_name FROM properties p
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id
						  WHERE property_id = '$property_id'";	
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
										<strong><h3 class="box-title">Deleting Property Range Status</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete property located on <strong>'
										  . $street_no . '  ' . $street_name . '  ' . $suburb_name . '
										   worth ' . $price . '</strong>?<br>
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
			
		//Update Property Range
		public function updateProperty(){
			try{					
				 $property_id = isset($_POST["property_id"] ) ? $_POST["property_id"]: '';
				 $employee = isset($_POST["employee"] ) ? $_POST["employee"]: '';
				 $property_type = isset($_POST["property_type"] ) ? $_POST["property_type"]: '';
				 $agent = isset($_POST["agent"] ) ? $_POST["agent"]: '';
				 $suburb = isset($_POST["suburb"] ) ? $_POST["suburb"]: '';
				 $property_range = isset($_POST["property_range"] ) ? $_POST["property_range"]: '';
				 $street_no = isset($_POST["street_no"] ) ? $_POST["street_no"]: '';
				 $street_name = isset($_POST["street_name"] ) ? $_POST["street_name"]: '';
				 $desc = isset($_POST["desc"] ) ? $_POST["desc"]: '';			 
				 $property_status = isset($_POST["range_status"] ) ? $_POST["range_status"]: '';
				 $num_bathrooms = isset($_POST["num_bathrooms"] ) ? $_POST["num_bathrooms"]: '';
				 $num_beds = isset($_POST["num_beds"] ) ? $_POST["num_beds"]: '';
				 $num_garages = isset($_POST["num_garages"] ) ? $_POST["num_garages"]: '';
				 $num_lounges = isset($_POST["num_lounges"] ) ? $_POST["num_lounges"]: '';
				 $air_con = isset($_POST["air_con"] ) ? $_POST["air_con"]: '';
				 $pool = isset($_POST["pool"] ) ? $_POST["pool"]: '';
				 $cottage = isset($_POST["cottage"] ) ? $_POST["cottage"]: '';
				 $price = isset($_POST["price"] ) ? $_POST["price"]: '';
				 
				 $property = new Property();
				 $property->setPropertyID($property_id);
				 $property->setEmployee($employee);
				 $property->setPropertyType($property_type);
				 $property->setAgent($agent);
				 $property->setSuburb($suburb);
				 $property->setPropertyRange($property_range);
				 $property->setStreetNo($street_no);
				 $property->setStreetName($street_name);
				 $property->setPropertyDescription($desc);
				 $property->setPropertyStatus($property_status);
				 $property->setNumBathRoom($num_bathrooms);
				 $property->setNumBed($num_beds);
				 $property->setNumGarage($num_garages);
				 $property->setNumLounge($num_lounges);
				 $property->setAirCon($air_con);
				 $property->setPool($pool);
				 $property->setCottage($cottage);
				 $property->setPrice($price);
	
				 $property->getPropertyID();
				 $property->getEmployee();
				 $property->getPropertyType();
				 $property->getAgent();
				 $property->getSuburb();
				 $property->getPropertyRange();
				 $property->getStreetNo();
				 $property->getStreetName();
				 $property->getPropertyDescription();
				 $property->getPropertyStatus();
				 $property->getNumBathRoom();
				 $property->getNumBed();
				 $property->getNumGarage();
				 $property->getNumLounge();
				 $property->getAirCon();
				 $property->getPool();
				 $property->getCottage();
				 $property->getPrice();
					
				$query = "UPDATE properties
						  SET emp_id = :employee,
						  property_type_id = :property_type_id,
						  agent_id = :agent_id,
						  suburb_id = :suburb_id,
						  property_range_id = :property_range_id,
						  street_no = :street_no,
						  street_name = :street_name,
						  property_desc = :property_desc,
						  property_status = :property_status,
						  num_rooms = :num_rooms,
						  num_beds = :num_beds,
						  num_garages = :num_garages,
						  num_lounges = :num_lounges,
						  air_con = :air_con,
						  pool = :pool,
						  cottage = :cottage,	
						  price = :price					  
						  WHERE property_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":employee", $employee);
				$statement->bindParam(":property_type_id", $property_type);
				$statement->bindParam(":agent_id", $agent);
				$statement->bindParam(":suburb_id", $suburb);
				$statement->bindParam(":property_range_id", $property_range);
				$statement->bindParam(":street_no", $street_no);
				$statement->bindParam(":street_name", $street_name);
				$statement->bindParam(":property_desc", $desc);
				$statement->bindParam(":property_status", $property_status);
				$statement->bindParam(":num_rooms", $num_rooms);
				$statement->bindParam(":num_beds", $num_beds);
				$statement->bindParam(":num_garages", $num_garages);
				$statement->bindParam(":num_lounges", $num_lounges);
				$statement->bindParam(":air_con", $air_con);
				$statement->bindParam(":pool", $pool);
				$statement->bindParam(":cottage", $cottage);
				$statement->bindParam(":price", $price);
				$statement->bindParam(":id", $property_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}
?>
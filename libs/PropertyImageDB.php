<?php
	class PropertyImageDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db; 
		}

		//Get Property Image by Property ID
		/*
		public function getPropertyImage($property_id){
			try{
				$query = "SELECT i.*, p.property_id, s.suburb_id 
						  FROM property_images i
						  LEFT JOIN properties p
						  ON i.property_id = p.property_id
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id   					  
						  WHERE p.property_id = '$property_id'
						  ORDER BY p.property_id";
				$result = $this->conn->query($query);
				$row = $result->fetch(pdo::FETCH_ASSOC);
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				
				$property_image = new PropertyImage();
				$property_image->setImageID($row['property_image_id']);
				$property_image->setProperty($property);
				$property_image->setImageLocation($row['image_location']);				
				
				return $property_image;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		*/
		
		//Get Property Image by Property ID
		
		public function getPropertyImage($image_id){
			try{
				$query = "SELECT i.*, p.property_id, s.suburb_id 
						  FROM property_images i
						  LEFT JOIN properties p
						  ON i.property_id = p.property_id
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id   					  
						  WHERE property_image_id = '$image_id'
						  ORDER BY property_image_id";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);				
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					
					$property = new Property();
					$property->setSuburb($suburb);
					$property->setPropertyID($row['property_id']);
					
					$image = new PropertyImage();
					$image->setImageID($row['property_image_id']);
					$image->setProperty($property);
					$image->setImageLocation($row['image_location']);	
				
				return $image;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		
		//Get Property Image by Property ID and Suburb ID
		public function getPropertyImagesBySuburb($suburb_id){
			try{
				$query = "SELECT i.*, p.property_id, s.suburb_id, s.suburb_name,
						  p.property_desc, p.price, p.num_bathrooms, p.num_beds, p.num_garages
						  FROM property_images i
						  LEFT JOIN properties p
						  ON i.property_id = p.property_id
						  LEFT JOIN suburbs s
						  ON p.suburb_id = s.suburb_id   					  
						  WHERE p.suburb_id = '$suburb_id'
						  ORDER BY p.property_id";
				$result = $this->conn->query($query);
				
				$images = array();
				
				foreach($result as $row){
					$suburb = new Suburb();
					$suburb->setSuburbID($row['suburb_id']);
					$suburb->setSuburbName($row['suburb_name']);
					
					$property = new Property();
					$property->setPropertyID($row['property_id']);
					$property->setPropertyDescription($row['property_desc']);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);					
					$property->setPrice($row['price']);
					$property->setSuburb($suburb);
					
					$image = new PropertyImage();
					$image->setImageID($row['property_image_id']);
					$image->setProperty($property);
					$image->setImageLocation($row['image_location']);
					$images[] = $image;
				}		
				
				return $images;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
				
		//Get Property Images
		public function getPropertyByImageID($image_id){
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
		
		//Get 3 Property Listings For Home Page
		public function getPropertyListForHome(){
			try{
				$query = "SELECT property_image_id, properties.property_id, image_location, property_desc, price,
						  num_bathrooms, num_beds, num_garages
						  FROM property_images 	LEFT JOIN properties
						  ON property_images.property_id = properties.property_id 					  
						  ORDER BY property_image_id
						  DESC";
				$result = $this->conn->query($query);
				$property_images = array();
				
				foreach($result as $row){	
					$property = new Property();
					$property->setPropertyDescription($row['property_desc']);
					$property->setNumBathRoom($row['num_bathrooms']);
					$property->setNumBed($row['num_beds']);
					$property->setNumGarage($row['num_garages']);					
					$property->setPrice($row['price']);
			
					$property_image = new PropertyImage();
					$property_image->setImageID($row['property_image_id']);
					$property_image->setProperty($property);
					$property_image->setImageLocation($row['image_location']);

					$property_images[] = $property_image;					
				}
				
				return $property_images;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		
		public function getPropertyListImages(){
			try{
				$query = "SELECT properties.property_id, property_desc, price, num_bathrooms, street_no, street_name,
						  num_beds, num_garages, property_image_id, image_location, suburbs.suburb_id, 
						  suburb_name, cities.city_id, city_name, municipalities.municipality_id, municipality_name, 
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
				
				$images = array();
				
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
					
					$image = new PropertyImage();
					$image->setImageID($row['property_image_id']);	
					$image->setImageLocation($property);
					$image->setImageLocation($row['image_location']);
					
					$images[] = $image;

				}
				
				return $images;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Property Image By Suburb ID
		public function getSuburbImages($suburb_id){
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
						  	
						  GROUP BY suburbs.suburb_id DESC 
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
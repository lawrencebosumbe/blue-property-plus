<?php
	class MunicipalityDB{
		private $conn;
	
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
				
		//Get Municipality By ID
		public function getMunicipality($municipality_id){
			try{
				$query = "SELECT * FROM municipalities
						  WHERE municipality_id = '$municipality_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityCode($row['municipality_code']);
				$municipality->setMunicipalityName($row['municipality_name']);
				
				return $municipality;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
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
		
		//Get Municipality By Province ID
		public function getMunicipalities($province_id){
			try{
				$query = "SELECT m.*, p.province_name, p.province_code, p.province_id FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'";
				$result = $this->conn->query($query);
				
				$municipalities = array();
				
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceCode($row['province_code']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setProvince($province);
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
		
		//Get Municipality By Province ID
		public function getMunicipalitiesByProvince($province_id){
			try{
				$query = "SELECT m.*, p.province_name, p.province_code, p.province_id FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'";
				$result = $this->conn->query($query);
				
				$municiplalities = array();
				
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceCode($row['province_code']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setProvince($province);
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						$municiplalities[] = $municipality;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get Municipalities By Province ID
		public function getProvinceMunicipalities($province_id, $conditions=array()){
			try{
				$selectSQL = ' m.*, p.province_name, p.province_code, p.province_id';
				$limitSQL = '';
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$selectSQL = 'COUNT(*) as rowNum';
				}
				if(!empty($conditions) && array_key_exists('limit', $conditions) && empty($conditions['count'])){
					$limitSQL = ' LIMIT '.$conditions['limit'];
				}
				
				$query = "SELECT ".$selectSQL." FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  ORDER BY m.municipality_name 
						  ".$limitSQL;
				$result = $this->conn->query($query);
				if(!empty($conditions) && array_key_exists('count', $conditions)){
					$resultNum = $result->fetch(PDO::FETCH_ASSOC);
					return $resultNum['rowNum'];
				}
				
				$municipalities = array();
				
					foreach($result as $row){
						//create province object
						$province = new Province();
						$province->setProvinceID($row['province_id']);
						$province->setProvinceCode($row['province_code']);
						$province->setProvinceName($row['province_name']);
						
						//create municipality object
						$municipality = new Municipality();
						$municipality->setMunicipalityID($row['municipality_id']);
						$municipality->setMunicipalityCode($row['municipality_code']);
						$municipality->setMunicipalityName($row['municipality_name']);
						$municipality->setProvince($province);
						$municipality->setTotalPropertyForSale($row['total_property_forsale']);
						$municipality->setTotalPropertyToRent($row['total_property_torent']);
						$municipality->setTotalPropertyOnShow($row['total_property_onshow']);
				
						array_push($municipalities, $municipality); //$municipalities[] = $municipality;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Read One Municipality at a time
		public function ReadOneMunicipality(){
			try{
				$query = "SELECT municipality_code, municipality_name
						  FROM municipalities
						  WHERE municipality_id = ?
						  LIMIT 0, 1";
				$statement = $this->conn->prepare($query);
				$statement->bindParam(1, $municipality_id);
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				
				$municipality = new Municipality();
				$municipality->setMunicipalityCode($row['municipality_code']);
				$municipality->setMunicipalityName($row['municipality_name']);
				
				return $municipality;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Gauteng
		public function getGautengMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '1'
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
		
		//Get All municipalities in Gauteng by ID
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
		
		//Get All municipalities in Eastern Cape
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
		
		//Get All municipalities in Eastern Cape
		public function getEsternCapeMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '2'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Western Cape
		public function getWesternCapeMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '3'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Western Cape by ID
		public function getWesternCapeMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '3'
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
		
		//Get All municipalities in Kwa-Zulu Natal
		public function getKwaZuluNatalMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '4'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Kwazulu Natal By ID
		public function getKwazuluNatalMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '4'
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
		
		//Get All municipalities in Limpopo
		public function getLimpopoMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '5'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Mpumalanga
		public function getMpumalangaMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '6'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Free State
		public function getFreeStateMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '7'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get municipality in Free State By ID
		public function getFreeStateMunicipality($province_id){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '$province_id'
						  AND p.province_id = '7'
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
		
		//Get All municipalities in North West
		public function getNorthWestMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '8'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get All municipalities in Northern Cape
		public function getNorthernCapeMunicipalities(){
			try{
				$query = "SELECT m.*, p.province_id, p.province_name 
						  FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE p.province_id = '9'
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
						
						array_push($municipalities, $municipality); //or $cities[] = $city;
					}
					
				return $municipalities;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		
		//Get total properties for sale in a municipality
		public function getMunicipalityNumPropertiesForSale($municipal_id){
			try{
				$query = "SELECT COUNT(property_id) AS property_id, property_status, municipalities.municipality_id, 
						  municipality_name, cities.city_id, city_name, suburbs.suburb_id, suburb_name						   
						  FROM properties LEFT JOIN suburbs 
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities 
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  WHERE municipalities.municipality_id = '$municipal_id'
						  AND property_status = 'For Sale'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				//Create Municipality Object
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityName($row['municipality_name']);
				
				//Create City Object
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				$city->setMunicipality($municipality);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
				
				$property_total = new Property();
				$property_total->setPropertyID($row['property_id']);
				$property_total->setSuburb($suburb);
				return $property_total;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get total properties to rent in a municipality
		public function getMunicipalityNumPropertiesToRent($municipality_id){
			try{
				$query = "SELECT COUNT(property_id) AS property_id, property_status, provinces.province_id, province_name, 
						  municipalities.municipality_id, municipality_name, cities.city_id, city_name,
						  suburbs.suburb_id, suburb_name 
						  FROM properties LEFT JOIN suburbs 
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities 
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces 
						  ON municipalities.province_id = provinces.province_id
						  WHERE municipalities.municipality_id = '$municipality_id'
						  AND property_status = 'To Rent'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				//Create Province Object
				$province = new Province();
				$province->setProvinceID($row['province_id']);
				$province->setProvinceName($row['province_name']);
				
				//Create Municipality Object
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityName($row['municipality_name']);
				$municipality->setProvince($province);
				
				//Create City Object
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				$city->setMunicipality($municipality);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
				
				$property_total = new Property();
				$property_total->setPropertyID($row['property_id']);
				$property_total->setSuburb($suburb);
				return $property_total;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get total properties for on show in a municipality
		public function getMunicipalityNumPropertiesOnShow($municipality_id){
			try{
				$query = "SELECT COUNT(property_id) AS property_id, property_status, provinces.province_id, province_name, 
						  municipalities.municipality_id, municipality_name, cities.city_id, city_name,
						  suburbs.suburb_id, suburb_name 
						  FROM properties LEFT JOIN suburbs 
						  ON properties.suburb_id = suburbs.suburb_id
						  LEFT JOIN cities 
						  ON suburbs.city_id = cities.city_id
						  LEFT JOIN municipalities
						  ON cities.municipality_id = municipalities.municipality_id
						  LEFT JOIN provinces 
						  ON municipalities.province_id = provinces.province_id
						  WHERE municipalities.municipality_id = '$municipality_id'
						  AND property_status = 'On Show'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				//Create Province Object
				$province = new Province();
				$province->setProvinceID($row['province_id']);
				$province->setProvinceName($row['province_name']);
				
				//Create Municipality Object
				$municipality = new Municipality();
				$municipality->setMunicipalityID($row['municipality_id']);
				$municipality->setMunicipalityName($row['municipality_name']);
				$municipality->setProvince($province);
				
				//Create City Object
				$city = new City();
				$city->setCityID($row['city_id']);
				$city->setCityName($row['city_name']);
				$city->setMunicipality($municipality);
				
				$suburb = new Suburb();
				$suburb->setSuburbID($row['suburb_id']);
				$suburb->setSuburbName($row['suburb_name']);
				$suburb->setCity($city);
				
				$property_total = new Property();
				$property_total->setPropertyID($row['property_id']);
				$property_total->setSuburb($suburb);
				return $property_total;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add Municupality
		public function addMunicupality(){
			try{
			 $municipality_id = isset($_POST["municipality_id"] ) ? $_POST["municipality_id"]: '';
			 $province_id = isset($_POST["province_id"]) ? $_POST["province_id"]: '';
			 $municipality_code = isset($_POST["municipality_code"]) ? $_POST["municipality_code"]: '';
			 $municipality_name = isset($_POST["municipality_name"]) ? $_POST["municipality_name"]: '';

			 $province = new Province();
			 $province->getProvince($province_id);
			 
			 $municiplality = new Municipality();
			 $municipality->setMunicipalityID($municipality_id);
			 $municipality->setProvince($province);
			 $municipality->setMunicipalityCode($municipality_code);
			 $municipality->setMunicipalityName($municipality_name);
			 
			 $municipality->getMunicipalityID();
			 $municipality->getProvince();
			 $municipality->getMunicipalityCode();
			 $municipality->getMunicipalityName();
			
			  
			  $query = "INSERT INTO municipalities (province_id, municipality_code, municipality_name)
			  			VALUES('$province_id', '$municipality_code', '$municipality_name')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Municupality
		public function deleteMunicupality(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM municipalities
							  WHERE municipality_id = '$municipality_id'";	
					$row_count = $this->conn->exec($query);
					header("location: municipalities.php");
					
					return $row_count;
				}else{
					$municipality_id = isset($_GET["municipality_id"] ) ? $_GET["municipality_id"]: ''; 
					$query = "SELECT municipality_name FROM municipalities
							  WHERE municipality_id = '$municipality_id'";	
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
										<strong><h3 class="box-title">Deleting Municipality</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $municipality_name . ' municipality ' . '</strong>?<br>
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
			
		//Update Municupality
		public function updateMunicupality(){
			try{					
				$municipality_id = isset($_POST["municipality_id"] ) ? $_POST["municipality_id"]: '';
				$province_id = isset($_POST["province_id"]) ? $_POST["province_id"]: '';
				$municipality_code = isset($_POST["municipality_code"]) ? $_POST["municipality_code"]: '';
				$municipality_name = isset($_POST["municipality_name"]) ? $_POST["municipality_name"]: '';
	
				$province = new Province();
				$province->getProvince($province_id);
				 
				$municiplality = new Municipality();
				$municiplality = new Municipality();
			 	$municipality->setMunicipalityID($municipality_id);
			 	$municipality->setProvince($province);
			 	$municipality->setMunicipalityCode($municipality_code);
			 	$municipality->setMunicipalityName($municipality_name);
				 
				$municipality->getMunicipalityID();
				$municipality->getProvince();
				$municipality->getMunicipalityCode();
				$municipality->getMunicipalityName();
				
				$query = "UPDATE municipalities
						  SET province_id	= :province_id,
							  municipality_code	= :municipality_code,
							  municipality_name	= :municipality_name,
						  WHERE municipality_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":province_id", $province_id);
				$statement->bindParam(":municipality_code", $municipality_code);
				$statement->bindParam(":municipality_name", $municipality_name);
				$statement->bindParam(":id", $municipality_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function readAll($from_record_num, $records_per_page){
			try{
				$query = "SELECT municipality_id, municipality_code, municipality_name FROM municipalities
						  ORDER BY municipality_name ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$statement = $this->conn->prepare( $query );
				$statement->execute();
			 
				return $statement;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Count all Municipality IDs
		public function countAll(){
			try{
				$query = "SELECT municipality_id FROM municipalities";
	 
				$statement =$this->conn->prepare( $query );
				$statement->execute();
			 
				$num = $statement->rowCount();
			 
				return $num;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function countAll_BySearch($search_term){
			try{
				// select query
				$query = "SELECT COUNT(*) as total_rows FROM municipalities m
						  LEFT JOIN provinces p
						  ON m.province_id = p.province_id
						  WHERE m.municipality_name LIKE ?";
			 
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
				
		//Get Municipality Records for pagination
		public function getRecords($from_record_num, $records_per_page){
			try{
				$query = "SELECT * FROM municipalities
						  ORDER BY municipality_id ASC
						  LIMIT {$from_record_num}, {$records_per_page}";
				$result = $this->conn->query( $query );
				$municiplalities  = array();
				
			 	foreach($result as $row){
				$municiplality = new Municipality();
				$municipality->setProvince($province);
				$municipality->setMunicipalityCode($row['municipality_code']);
				$municipality->setMunicipalityName($row['municipality_name']);
				$municiplalities[] = $municiplality;
				}
				return $municiplalities;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		
		//Read municipality by search term
		public function search($search_term, $from_record_num, $records_per_page){
			try{
				// select query
				$query = "SELECT p.province_name as province, m.municipality_id, m.municipality_name, p.province_id
						  FROM municipalities LEFT JOIN provinces p
								ON m.province_id = p.province_id
					WHERE
						m.municipality_name LIKE ? OR p.province_name LIKE ?
					ORDER BY
						m.municipality_name ASC
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
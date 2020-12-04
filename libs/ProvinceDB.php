<?php
	class ProvinceDB{
		private $conn;
		
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		
		//Get Province By ID
		public function getProvince($province_id){
			try{
				$query = "SELECT * FROM provinces
						  WHERE province_id = '$province_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
								
				$province = new Province();
				$province->setProvinceID($row['province_id']);
				$province->setProvinceCode($row['province_code']);
				$province->setProvinceName($row['province_name']);
				return $province;
			}catch(PDOException $e){
				echo $e->getMessage();
				exit();
			}
		}
		
		//Get All Provinces
		public function getProvinces(){
			try{
				$query = "SELECT * FROM provinces
						  ORDER BY province_id";
				$result = $this->conn->query($query);
				$provinces = array();
				foreach($result as $row){ 
					$province = new Province();
					$province->setProvinceID($row['province_id']);
					$province->setProvinceCode($row['province_code']);
					$province->setProvinceName($row['province_name']);
					$provinces[] = $province;
				}
				
				return $provinces;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		} 
		
		//Get All Provinces By Name
		public function getProvinceNames(){
			try{
				$query = "SELECT * FROM provinces ORDER BY province_name ASC";
				$result = $conn->query($query) or die($conn->error);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				//Count Total Number of Rows
				$row_count = $result->num_rows;
				
				//Create Province Object
				$province = new Province();
				$province->setProvinceID($row['province_id']);
				$province->setProvinceName($row['province_name']);
				
				return $province;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get total properties for sale in a province
		public function getProvinceNumPropertiesForSale($province_id){
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
						  WHERE provinces.province_id = '$province_id'
						  AND property_status = 'For Sale'";
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
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setSuburb($suburb);
				return $property;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get total properties to rent in a province
		public function getProvinceNumPropertiesToRent($province_id){
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
						  WHERE provinces.province_id = '$province_id'
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
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setSuburb($suburb);
				return $property;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Get total properties for on show in a province
		public function getProvinceNumPropertiesOnShow($province_id){
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
						  WHERE provinces.province_id = '$province_id'
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
				
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setSuburb($suburb);
				return $property;
				
				}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		//Add new Province
		public function addProvince(){
			try{
			 	$province_id = isset($_POST["province_id"] ) ? $_POST["province_id"]: '';
				$country_id = isset($_POST["country_id"]) ? $_POST["country_id"]: '';
				$province_code = isset($_POST["province_code"]) ? $_POST["province_code"]: '';
				$province_name = isset($_POST["province_name"]) ? $_POST["province_name"]: '';
	
				$country = new Country();
				$country->get($country_id);
				 
				$province = new Province();
				$province->setProvinceID($province_id);
				$province->setProvince($country);
				$province->setProvinceCode($province_code);
				$province->setProvinceName($province_name);
				 
				$province->getProvinceID();
				$province->getCountry();
				$province->getProvinceCode();
				$province->getProvinceName();
			
			  
			  $query = "INSERT INTO provinces (county_id, province_code, province_name)
			  			VALUES('$country_id', '$province_code', '$province_name')";
			  $row_count = $this->conn->exec($query);
			  return $row_count;
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		//Delete Province
		public function deleteProvince(){
			$emp_id = isset($_GET["emp_id"] ) ? $_GET["emp_id"]: ''; 
			try{
				$query = "SELECT type FROM employees 
						  WHERE emp_id = '$emp_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				
				if($row['type'] === 'admin'){
					if (isset($_POST['submit']) && $_POST['submit'] == "Yes") {
					$query = "DELETE FROM provinces
							  WHERE province_id = '$province_id'";	
					$row_count = $this->conn->exec($query);
					header("location: provinces.php");
					
					return $row_count;
				}else{
					$province_id = isset($_GET["province_id"] ) ? $_GET["province_id"]: ''; 
					$query = "SELECT province_name FROM provinces
							  WHERE province_id = '$province_id'";	
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
										<strong><h3 class="box-title">Deleting Province</h3></strong>
									 </div>
								     <div class="box-body"> 
										<p>
										  Are you sure you want to delete <strong>'
										  . $province_name . ' province ' . '</strong>?<br>
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
		
		//Update Province
		public function updateProvince(){
			try{					
				$province_id = isset($_POST["province_id"] ) ? $_POST["province_id"]: '';
				$country_id = isset($_POST["country_id"]) ? $_POST["country_id"]: '';
				$province_code = isset($_POST["province_code"]) ? $_POST["province_code"]: '';
				$province_name = isset($_POST["province_name"]) ? $_POST["province_name"]: '';
	
				$country = new Country();
				$country->get($country_id);
				 
				$province = new Province();
				$province->setProvinceID($province_id);
				$province->setProvince($country);
				$province->setProvinceCode($province_code);
				$province->setProvinceName($province_name);
				 
				$province->getProvinceID();
				$province->getCountry();
				$province->getProvinceCode();
				$province->getProvinceName();
				
				$query = "UPDATE provinces
						  SET country_id	= :country_id,
							  province_code	= :province_code,
							  province_name	= :province_name,
						  WHERE province_id	= :id";	
				$statement = $this->conn->prepare($query);
				
				$statement->bindParam(":country_id", $country_id);
				$statement->bindParam(":province_code", $province_code);
				$statement->bindParam(":province_name", $province_name);
				$statement->bindParam(":id", $province_id);
				
				//Execute the query
				if($statement->execute()){
					return true;
				}
			 
				return false;
	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getOneProvince(){ 
			$query = "SELECT * FROM provinces 
					  WHERE province_id = ?
					  LIMIT 0,1";
		 
			$stmt = $this->conn->prepare( $query );
			$stmt->bindParam(1, $this->province_id);
			$stmt->execute();
		 
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
			$province = new Province();
			$province->setProvinceID($row['province_id']);
			$province->setProvinceCode($row['province_code']);
			$province->setProvinceName($row['province_name']);
					
			return $province;
		}
	}
?>
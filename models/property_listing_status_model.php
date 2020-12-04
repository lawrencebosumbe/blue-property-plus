<?php
	Session::init();
	
	//class Property_Listing_Model
	class Property_Listing_Status_Model{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Add Property 
		public function addProperty(){
			
			//Try Block
			try{
				 //Assign Property Values
				 $property_type = isset($_POST["property_type"] ) ? $_POST["property_type"]: '';
				 $agent_id = isset($_SESSION["agent_id"] ) ? $_SESSION["agent_id"]: '';
				 $suburb = isset($_POST["suburb"] ) ? $_POST["suburb"]: ''; 
				 $city = isset($_POST["city"] ) ? $_POST["city"]: ''; 
				 $municipality = isset($_POST["municipality"] ) ? $_POST["municipality"]: '';
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
				 $property->setPropertyType($property_type);
				 $property->setAgent($agent_id);
				 $property->setSuburb($suburb);
				 $property->setCity($city);
				 $property->setMunicipality($municipality);
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
				 $property->getPropertyType();
				 $property->getAgent();
				 $property->getSuburb();
				 $property->getCity();
				 $property->getMunicipality();
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
			  
			  //if !empty				
			  if((!empty($agent_id)) || (!empty($suburb)) || (!empty($city)) || (!empty($municipality)) || (!empty($property_type)) || 
			  	 (!empty($street_no)) || (!empty($street_name)) ||(!empty($desc)) || (!empty($property_status)) || 
				 (!empty($num_bathrooms)) || (!empty($num_beds)) || (!empty($num_garages)) || (!empty($num_lounges)) || 
				 (!empty($air_con)) || (!empty($pool)) || (!empty($cottage)) || (!empty($price))){
				 if((isset($_POST["property_type"] ) ? $_POST["property_type"]: '') ||
				 	//agent_id must be disabled because it duplicates rows in form insert
				 	//(isset($_SESSION["agent_id"] ) ? $_SESSION["agent_id"]: '') ||
					(isset($_POST["suburb"] ) ? $_POST["suburb"]: '') ||
					(isset($_POST["city"] ) ? $_POST["city"]: '') ||
					(isset($_POST["municipality"] ) ? $_POST["municipality"]: '') ||
					(isset($_POST["street_no"] ) ? $_POST["street_no"]: '') ||
					(isset($_POST["street_name"] ) ? $_POST["street_name"]: '') ||
					(isset($_POST["desc"] ) ? $_POST["desc"]: '') ||
					(isset($_POST["property_status"] ) ? $_POST["property_status"]: '') ||
					(isset($_POST["num_bathrooms"] ) ? $_POST["num_bathrooms"]: '') ||
					(isset($_POST["num_beds"] ) ? $_POST["num_beds"]: '') ||
					(isset($_POST["num_garages"] ) ? $_POST["num_garages"]: '') || 
					(isset($_POST["num_lounges"] ) ? $_POST["num_lounges"]: '') ||
					(isset($_POST["air_con"] ) ? $_POST["air_con"]: '') ||
					(isset($_POST["pool"] ) ? $_POST["pool"]: '') ||
					(isset($_POST["cottage"] ) ? $_POST["cottage"]: '' ||
					(isset($_POST["price"] ) ? $_POST["price"]: ''))){	 
				  //Insert data inti Properties table
				  $query = "INSERT INTO properties (agent_id, suburb_id, city_id, municipality_id, property_type, property_status, 
				  			street_no, street_name, property_desc, num_bathrooms, num_beds, num_garages, 
						    num_lounges, air_con, pool, cottage, price)
							VALUES('$agent_id', '$suburb', '$city', '$municipality', '$property_type', '$property_status', 
								   '$street_no', '$street_name', '$desc', '$num_bathrooms', '$num_beds', '$num_garages', 
								   '$num_lounges', '$air_con', '$pool', '$cottage', '$price')";
				  $row_count = $this->conn->exec($query);
				  
				  //Retrieve the last inserted Property ID
				  $last_insert_property_id = $this->conn->lastInsertId(); 
				  
				  //if row_count						
				  if($row_count){
					  
					  //if property_status == fo sale
					  if($property_status == 'For Sale'){
						  $query = "UPDATE suburbs SET total_property_forsale = total_property_forsale + 1
								  WHERE suburb_id = '$suburb'";
						  $row_count = $this->conn->exec($query);
						
						  $sql = "UPDATE cities SET total_property_forsale = total_property_forsale + 1
								  WHERE city_id = '$city'";
						  $row_count = $this->conn->exec($sql);
						  
						  $sql_query = "UPDATE municipalities SET total_property_forsale = total_property_forsale + 1
								  WHERE municipality_id = '$municipality'";
						  $row_count = $this->conn->exec($sql_query);
						
						  //Check if the last inserted property ID exists	  
						  if($last_insert_property_id){
							
							//If the last property_id exists, make it equal to property ID  							  
							$property_id = $last_insert_property_id;
							
							//Check if previous sale listing exist
							/*
							$query_sel = "SELECT sale_listing_id, property_id, sale_listing_amount, discount_percent, total_listing
										  FROM sale_listings WHERE property_id = '$property_id'"; 
							$result = $this->conn->query($query_sel); 
							*/
							
							$query_sel = "SELECT property_id, agent_id, suburb_id FROM properties 
											  WHERE property_id = '$property_id'"; 
							$result = $this->conn->query($query_sel); 
							$row = $result->fetch(PDO::FETCH_ASSOC);
								
							$agent_id = $row['agent_id'];
							$suburb_id = $row['suburb_id'];
								
								
							
							$query_sel = "SELECT suburb_id FROM sale_listings WHERE suburb_id = '$suburb_id'"; 
							$result = $this->conn->query($query_sel); 
							
							// if result->rowCount()
							if($result->rowCount() > 0){
								$query = "UPDATE sale_listings SET total_listing = total_listing + 1
								          WHERE suburb_id = '$suburb_id'";
								$row_count = $this->conn->exec($query);
							}else{
								
								$sale_amount = 65;
								$discount = 0;
								$total_listing = 1;
							
								$sql = "INSERT INTO sale_listings (property_id, agent_id, suburb_id, sale_listing_amount, 
										discount_percent, total_listing)
									    VALUES('$property_id', '$agent_id', '$suburb_id', '$sale_amount', '$discount', 
									    '$total_listing')";
								$row_count = $this->conn->exec($sql);
							}							
							//End if result->rowCount()		
																											
						  }else{
								echo("Unable to insert or update data!"); 
						  }
						  //End Check if the last inserted property ID exists
						  
					   }												
					  //End if property_status	== for sale
					  
					  //if property_status == to rent
					  if($property_status == 'To Rent'){
						  $query = "UPDATE suburbs SET total_property_torent = total_property_torent + 1
								  WHERE suburb_id = '$suburb'";
						  $row_count = $this->conn->exec($query);
						
						  $sql = "UPDATE cities SET total_property_torent = total_property_torent + 1
								  WHERE city_id = '$city'";
						  $row_count = $this->conn->exec($sql);
						  
						  $sql_query = "UPDATE municipalities SET total_property_torent = total_property_torent + 1
								  WHERE municipality_id = '$municipality'";
						  $row_count = $this->conn->exec($sql_query);
						  
						  //Check if the last inserted property ID exists	  
						  if($last_insert_property_id){
							
							//If the last property_id exists, make it equal to property ID  							  
							$property_id = $last_insert_property_id;
							
							$query_sel = "SELECT property_id, agent_id, suburb_id FROM properties 
											  WHERE property_id = '$property_id'"; 
							$result = $this->conn->query($query_sel); 
							$row = $result->fetch(PDO::FETCH_ASSOC);
								
							$agent_id = $row['agent_id'];
							$suburb_id = $row['suburb_id'];
								
								
							
							$query_sel = "SELECT suburb_id FROM rental_listings WHERE suburb_id = '$suburb_id'"; 
							$result = $this->conn->query($query_sel); 
							
							// if result->rowCount()
							if($result->rowCount() > 0){
								$query = "UPDATE rental_listings SET total_listing = total_listing + 1
								          WHERE suburb_id = '$suburb_id'";
								$row_count = $this->conn->exec($query);
							}else{
								
								$rental_amount = 65;
								$discount = 0;
								$total_listing = 1;
							
								$sql = "INSERT INTO rental_listings (property_id, agent_id, suburb_id, rental_listing_amount, 
										discount_percent, total_listing)
									    VALUES('$property_id', '$agent_id', '$suburb_id', '$rental_amount', '$discount', 
									    '$total_listing')";
								$row_count = $this->conn->exec($sql);
							}							
							//End if result->rowCount()		
																											
						  }else{
								echo("Unable to insert or update data!"); 
						  }
						  //End Check if the last inserted property ID exists
						  
					   }												
					   //End if property_status	== to rent
					  
					   //if property_status == on show
					  if($property_status == 'On Show'){
						  $query = "UPDATE suburbs SET total_property_onshow = total_property_onshow + 1
								  WHERE suburb_id = '$suburb'";
						  $row_count = $this->conn->exec($query);
						
						  $sql = "UPDATE cities SET total_property_onshow  = total_property_onshow + 1
								  WHERE city_id = '$city'";
						  $row_count = $this->conn->exec($sql);
						  
						  $sql_query = "UPDATE municipalities SET total_property_onshow  = total_property_onshow + 1
								  WHERE municipality_id = '$municipality'";
						  $row_count = $this->conn->exec($sql_query);
						  
						  //Check if the last inserted property ID exists	  
						  if($last_insert_property_id){
							
							//If the last property_id exists, make it equal to property ID  							  
							$property_id = $last_insert_property_id;
							
							$query_sel = "SELECT property_id, agent_id, suburb_id FROM properties 
											  WHERE property_id = '$property_id'"; 
							$result = $this->conn->query($query_sel); 
							$row = $result->fetch(PDO::FETCH_ASSOC);
								
							$agent_id = $row['agent_id'];
							$suburb_id = $row['suburb_id'];
								
								
							
							$query_sel = "SELECT suburb_id FROM onshow_listings WHERE suburb_id = '$suburb_id'"; 
							$result = $this->conn->query($query_sel); 
							
							// if result->rowCount()
							if($result->rowCount() > 0){
								$query = "UPDATE onshow_listings SET total_listing = total_listing + 1
								          WHERE suburb_id = '$suburb_id'";
								$row_count = $this->conn->exec($query);
							}else{
								
								$onshow_amount = 65;
								$discount = 0;
								$total_listing = 1;
							
								$sql = "INSERT INTO onshow_listings (property_id, agent_id, suburb_id, onshow_listing_amount, 
										discount_percent, total_listing)
									    VALUES('$property_id', '$agent_id', '$suburb_id', '$onshow_amount', '$discount', 
									    '$total_listing')";
								$row_count = $this->conn->exec($sql);
							}							
							//End if result->rowCount()		
																											
						  }else{
								echo("Unable to insert or update data!"); 
						  }
						  //End Check if the last inserted property ID exists
						  
					   }												
					   //End if property_status	== on show
					   
					}
				  	//End if row_count
								   								   
			  		return $row_count;
				 }
				 //End if isset
				 
			  }
			  //End if !empty
			  
			}catch(PDOException $e){
				$e->getMessage();
			}
			//End Try Block
		}
		//End Add Property
	}
	//End class Property_Listing_Model
?>
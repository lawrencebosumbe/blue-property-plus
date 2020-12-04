<?php
	class Back_Office_Model{
		private $conn;		

		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}	
		
		//Get agent's payment
		public function getPayment(){
			$agent_id = isset($_GET['agent_id']) ? $_GET['agent_id']: "";
			try{
					$query = "SELECT a.*, p.property_id, p.street_no, p.street_name, s.suburb_id, s.suburb_name,
					          s.total_properties, l.sale_listing_id, l.sale_listing_amount, l.total_listing
							  FROM agents a
							  LEFT JOIN properties p
							  ON a.agent_id = p.agent_id
							  LEFT JOIN suburbs s
							  ON p.suburb_id = s.suburb_id
							  LEFT JOIN sale_listings l
							  ON a.agent_id = l.agent_id
							  WHERE a.agent_id = '$agent_id'";
					$result = $this->conn->query($query);
								
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

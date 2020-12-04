<?php
	class Index_Model extends Model{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		public function getRows($params=array()){
			try{
				$whereSQL = $add_sql = '';
				if(array_key_exists('keywords', $params) && !empty($params['keywords'])){
					$whereSQL = " WHERE sb.suburb_name LIKE '%".$params['keywords']."%' ";
					$whereSQL2 = " WHERE ct.city_name LIKE '%".$params['keywords']."%' ";
					$whereSQL3 = " WHERE mn.municipality_name LIKE '%".$params['keywords']."%' ";
					$whereSQL4 = " WHERE pr.province_name LIKE '%".$params['keywords']."%' ";
				}

				if(array_key_exists("order_by",$params)){
					$add_sql .= ' ORDER BY '.$conditions['order_by']; 
				}
				
				if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
					$add_sql .= ' LIMIT '.$params['start'].','.$params['limit']; 
				}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
					$add_sql .= ' LIMIT '.$params['limit']; 
				}
				
				$query = "(SELECT 'suburb' as type, sb.suburb_id as global_id, sb.suburb_name as global_name_1, ct.city_name as global_name_2, sb.suburb_id, sb.suburb_name, ct.city_id, ct.city_name FROM suburbs as sb LEFT JOIN cities as ct ON ct.city_id = sb.city_id ".$whereSQL." ORDER BY sb.suburb_name)
				UNION
				(SELECT 'city' as type, ct.city_id as global_id, ct.city_name as global_name_1, mn.municipality_name as global_name_2, ct.city_id, ct.city_name, mn.municipality_id, mn.municipality_name FROM cities as ct LEFT JOIN municipalities as mn ON mn.municipality_id = ct.municipality_id ".$whereSQL2." ORDER BY ct.city_name)
				UNION
				(SELECT 'municipality' as type, mn.municipality_id as global_id, mn.municipality_name as global_name_1, pr.province_name as global_name_2, mn.municipality_id, mn.municipality_name, pr.province_id, pr.province_name FROM municipalities as mn LEFT JOIN provinces as pr ON pr.province_id = mn.province_id ".$whereSQL3." ORDER BY mn.municipality_name)
				UNION
				(SELECT 'province' as type, pr.province_id as global_id, pr.province_name as global_name_1, '' as global_name_2, pr.province_id, pr.province_name, '' as municipality_id, '' as municipality_name FROM provinces as pr ".$whereSQL4." ORDER BY pr.province_name)
				".$add_sql;
				
				$result = $this->conn->query($query);
				$data = ($result->rowCount() > 0)?$result->fetchAll(pdo::FETCH_ASSOC):array();			
				return $data;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function getProvince($munc){
			$query = "SELECT pr.province_name FROM municipalities as mn LEFT JOIN provinces as pr ON pr.province_id = mn.province_id WHERE mn.municipality_name LIKE '%".$munc."%' ORDER BY LOCATE('".$munc."', mn.municipality_name) LIMIT 1";
			$result = $this->conn->query($query);
			if($result->rowCount() > 0){
				$res = $result->fetch(pdo::FETCH_ASSOC);
				return $res['province_name'];
			}else{
				return false;
			}
		}
		
		 
	}
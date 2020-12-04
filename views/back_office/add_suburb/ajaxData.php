<?php
	//CONNECT TO MariaDB DATABASE
	/*
	$host = "lawrencebosumbe16258.ipagemysql.com";
	$user = "blueproperty1";
	$pass = "blueproperty1";
	*/
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$conn = new mysqli($host, $user, $pass);
	
	mysqli_set_charset($conn, 'utf8');
	
	if ($conn->connect_error) {
		die ($conn->connect_error);
		$conn->Close();
	}
	
	//SELECT DATABASE
	mysqli_select_db($conn, 'propertydb');
	
	if(!empty($_POST['province_id'])){
		
		//FETCH ALL MUNICIPALITY DATA
		$query = "SELECT * FROM municipalities WHERE province_id = ".$_POST['province_id']." ORDER BY municipality_name ASC";
		$result = $conn->query($query) or die($conn->error);
		
		//COUNT TOTAL NUMBERS OF ROWS
		$row_count = $result->num_rows;
		
		//MUNICIPALITY OPTION LIST
		if($row_count > 0){
			echo '<option value="">Select Municipality</option>';
			while($row = $result->fetch_assoc()){ 
				echo '<option value="'.$row['municipality_id'].'">'.$row['municipality_name'].'</option>';
			}
		}else{
			echo '<option value="">Municipality not available</option>';
		}
	}elseif(!empty($_POST['municipality_id'])){
		
		//FETCH ALL CITY DATA
		$query = "SELECT * FROM cities WHERE municipality_id = ".$_POST['municipality_id']." ORDER BY city_name ASC";
		$result = $conn->query($query) or die($conn->error);
		
		//COUNT TOTAL NUMBERS OF ROWS
		$row_count = $result->num_rows;
		
		//CITY OPTION LIST
		if($row_count > 0){
			echo '<option value="">Select City</option>';
			while($row = $result->fetch_assoc()){ 
				echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
			}
		}else{
			echo '<option value="">city not available</option>';
		}
	}elseif(!empty($_POST['city_id'])){
		
		//FETCH ALL CITY DATA
		$query = "SELECT * FROM suburbs WHERE city_id = ".$_POST['city_id']." ORDER BY suburb_name ASC";
		$result = $conn->query($query) or die($conn->error);
		
		//COUNT TOTAL NUMBERS OF ROWS
		$row_count = $result->num_rows;
		
		//CITY OPTION LIST
		if($row_count > 0){
			echo '<option value="">Select Suburb</option>';
			while($row = $result->fetch_assoc()){ 
				echo '<option value="'.$row['suburb_id'].'">'.$row['suburb_name'].'</option>';
			}
		}else{
			echo '<option value="">suburb not available</option>';
		}
	}
?>
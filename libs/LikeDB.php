<?php
	class LikeDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}

		public function submitPostLike($Data){
			try{
				if(isset($_SESSION['emp_id']) && isset($Data['post_id'])){
					$emp_id = $_SESSION['emp_id'];
					$post_id = $Data['post_id'];
					$date = date("Y-m-d H:i:s", time());
					
					$query = "INSERT IGNORE likes(post_id, agent_id, emp_id, like_date)
							  VALUES('$post_id', 0, '$emp_id', '$date')";
					$result = $this->conn->query($query);
					
					if($result){
					  $query = "UPDATE posts SET total_likes = total_likes + 1 
								WHERE post_id = '$post_id'";
					  $result = $this->conn->query($query);
					  
					$Return = array();
					$Return['ResponseCode'] = 200;
					$Return['Message'] = "like successfully.";
					}else{
					$Return = array();
					$Return['ResponseCode'] = 511;
					$Return['Message'] = "Error : Please try again!";
					}
			
				echo json_encode($Return);
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function submitPostDisLike($Data){
	 		try{
				if(isset($_SESSION['emp_id']) && isset($Data['post_id'])){
					$emp_id = $_SESSION['emp_id'];
					$post_id = $Data['post_id'];
					$query = "DELETE from likes 
							 WHERE emp_id = '$emp_id' 
							 AND post_id = '$post_id'";
					$result = $this->conn->query($query);
					
					if($result){
						$query = "UPDATE posts SET total_likes = total_likes - 1 
								  WHERE post_id = '$post_id'";
						$result = $this->conn->query($query);
							 
					$Return = array();
					$Return['ResponseCode'] = 200;
					$Return['Message'] = "dislike successfully.";
					}else{
					$Return = array();
					$Return['ResponseCode'] = 511;
					$Return['Message'] = "Error : Please try again!";
					}
			
					echo json_encode($Return);
			
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
?>
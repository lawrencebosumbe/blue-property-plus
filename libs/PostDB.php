<?php
	class PostDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}

		public function getWallPost(){
			try{ 
				if(isset($_SESSION['emp_id'])){
					$emp_id = $_SESSION['emp_id'];
					$employees = new EmployeeDB();
					$employee = $employees->getEmployee($emp_id);
					$query = "SELECT p.*, e.firstname, e.lastname, e.image, l.like_id 
							  FROM posts p LEFT JOIN employees e 
							  ON e.emp_id  = p.emp_id 
							  LEFT JOIN likes l 
							  ON l.post_id = p.post_id 
							  AND l.emp_id = '$emp_id' 
							  GROUP BY p.post_id 
							  ORDER BY post_id DESC";
					$result = $this->conn->query($query);
							  
					$posts = array();
					
					foreach($result as $row){
					$post = new Post();
					$post->setPostID($row['post_id']);
					$post->setEmployee($employee);
					$post->setPostContent($row['post_content']);
					$post->setPostSubject($row['subject']);
					$post->setTotalLike($row['total_likes']);
					$post->setTotalComment($row['total_comments']);
					$post->setLikeID($row['like_id']);
					$post->setPostDate($row['post_date']);
					
					$posts[] = $post;
				}
				
				return $posts;
			}
			}catch(PDOException $e){
				$e->getMessage();
			}
		}

		/*
		public function getPosts(){
			try{ 
				$query = "SELECT p.*, e.firstname, e.lastname, e.image, 
						  a.firstname, a.lastname, a.image, l.like_id 
						  FROM posts p LEFT JOIN employees e 
						  ON e.emp_id  = p.emp_id 
						  LEFT JOIN agents a
						  ON a.agent_id = p.agent_id
						  LEFT JOIN likes l 
						  ON l.post_id = p.post_id 
						  AND l.emp_id = 'e.emp_id' 
						  GROUP BY p.post_id 
						  ORDER BY post_id DESC
						  LIMIT 3";
				$result = $this->conn->query($query);
							  
				$posts = array();
					
				foreach($result as $row){
				$employee = new Employee();
				$employee->setFirstname($row['firstname']);
				$employee->setLastname($row['lastname']);
				$employee->setImage($row['image']);
	
				$agent = new Agent();
				$agent->setAgentID($row['agent_id']);
				$agent->setFirstname($row['firstname']);
				$agent->setLastname($row['lastname']);
				$agent->setImage($row['image']);
				
				$post = new Post();
				$post->setPostID($row['post_id']);
				$post->setEmployee($employee);
				$post->setAgent($agent);
				$post->setPostContent($row['post_content']);
				$post->setPostSubject($row['subject']);
				$post->setTotalLike($row['total_likes']);
				$post->setTotalComment($row['total_comments']);
				$post->setLikeID($row['like_id']);
				$post->setPostDate($row['post_date']);
					
				$posts[] = $post;
				}
				
				return $posts;

			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		*/
		
		public function getAgentPosts(){
			try{ 
				$query = "SELECT p.*, a.firstname, a.lastname, a.image, l.like_id 
						  FROM posts p LEFT JOIN agents a
						  ON a.agent_id = p.agent_id
						  LEFT JOIN likes l 
						  ON l.post_id = p.post_id 
						  AND l.agent_id = 'a.agent_id' 
						  GROUP BY p.post_id 
						  ORDER BY post_id DESC
						  LIMIT 3";
				$result = $this->conn->query($query);
							  
				$posts = array();
					
				foreach($result as $row){
				$agent = new Agent();
				$agent->setAgentID($row['agent_id']);
				$agent->setFirstname($row['firstname']);
				$agent->setLastname($row['lastname']);
				$agent->setImage($row['image']);
	
				$post = new Post();
				$post->setPostID($row['post_id']);
				$post->setAgent($agent);
				$post->setPostContent($row['post_content']);
				$post->setPostSubject($row['subject']);
				$post->setTotalLike($row['total_likes']);
				$post->setTotalComment($row['total_comments']);
				$post->setLikeID($row['like_id']);
				$post->setPostDate($row['post_date']);
					
				$posts[] = $post;
				}
				
				return $posts;

			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		
		public function submitWallPost($Data){
			try{
				
				if(isset($Data['post_feed']) && isset($_SESSION['emp_id']) && isset($_SESSION['agent_id'])){
					$content = $Data['post_feed'];
					$subject = $Data['subject'];
					$emp_id  = $_SESSION['emp_id'];
					$agent_id  = $_SESSION['agent_id'];
					$date = date("Y-m-d H:i:s", time());
					
					$query = "INSERT IGNORE posts(emp_id, agent_id, post_content, subject, total_likes, 
							  total_comments, post_date)
							  VALUES('$emp_id', $agent_id, '$content', '$subject', 0, 0, '$date')";
					$result = $this->conn->query($query);
					
					if($result){
					$Return = array();
					$Return['ResponseCode'] = 200;
					$Return['Message'] = "post updated successfully.";
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
		
		//time ago function 
		public function timeAgo(){
			$time_ago = 0;
			$time_ago = strtotime($time_ago);
			$cur_time = time();
			$time_elapsed = $cur_time - $time_ago;
			$seconds = $time_elapsed;
			$minutes = round($time_elapsed / 60);
			$hours = round($time_elapsed / 3600);
			$days = round($time_elapsed / 86400);
			$weeks = round($time_elapsed / 604800);
			$months = round($time_elapsed / 2600640);
			$years = round($time_elapsed / 31207680);
			
			//seconds
			if($seconds <= 60){
				return "Just now";
			
			//minutes
			}else if($minutes <= 60){
				if($minutes == 1){
					return "one minute ago";
				}else{
					return "$minutes minutes ago";
				}
				
			//hours
			}else if($hours <= 24){
				if($hours == 1){
					return "an hour ago";
				}else{
					return "$hours hours ago";
				}
				
			//days
			}else if($days <= 7){
				if($days == 1){
					return "yesterday";
				}else{
					return "$days days ago";
				}
				
			//weeks
			}else if($weeks <= 4.3){
				if($weeks == 1){
					return "last week";
				}else{
					return "$weeks weeks ago";
				}
				
			//months
			}else if($months <= 12){
				if($months == 1){
					return "last month";
				}else{
					return "$months months ago";
				}
			
			//years
			}else{
				if($years == 1){
					return "1 year ago";
				}else{
					return "$years years ago";
				}
			}
		}
	}
?>
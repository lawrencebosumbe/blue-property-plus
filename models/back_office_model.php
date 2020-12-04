<?php
	class Back_Office_Model{
		private $conn;		

		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}	
		
		//Get agent posts
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
				echo $e->getMessage();
			}
		}
		
	}

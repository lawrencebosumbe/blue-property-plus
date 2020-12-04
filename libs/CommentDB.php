<?php
	class CommentDB{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		/*
		public function getPostComments($post_id){
			try{
				if(isset($_SESSION['emp_id'])){
					$emp_id = $_SESSION['emp_id'];
					$employees = new EmployeeDB();
					$employee = $employees->getEmployee($emp_id);
					$posts = new PostDB();
					$post = $posts->getWallPost();
					$query = "SELECT c.*,e.firstname, e.lastname, e.image 
							  FROM comments c LEFT JOIN employees e 
							  ON e.emp_id = c.emp_id 
							  WHERE c.post_id = '$post_id' 
							  ORDER BY c.comment_id DESC";
							  
					$result = $this->conn->query($query);
					
					$comments = array();
					
					foreach($result as $row){
						$comment = new Comment();
						$comment->setCommentID($row['comment_id']);
						$comment->setPost($post);
						$comment->setEmployee($employee);
						$comment->setComment($row['comment_content']);
						$comment->setCommentDate($row['comment_date']);
						
						$comments[] = $comment;
					}
					
					return $comments;
				}
			}catch(PDOException $e){
				echo $e->getMessage();	
			}
		}
		*/
		
		public function getAgentPostComments($post_id){
			try{
				if(isset($_SESSION['agent_id'])){
					$agent_id = $_SESSION['agent_id'];
					$agents = new AgentDB();
					$agent = $agents->getAgent($agent_id);
					$posts = new PostDB();
					$post = $posts->getWallPost();
					$query = "SELECT c.*, a.firstname, a.lastname, a.image 
							  FROM comments c LEFT JOIN agents a 
							  ON a.agent_id = c.agent_id 
							  WHERE c.post_id = '$post_id' 
							  ORDER BY c.comment_id DESC";
							  
					$result = $this->conn->query($query);
					
					$comments = array();
					
					foreach($result as $row){
						$comment = new Comment();
						$comment->setCommentID($row['comment_id']);
						$comment->setPost($post);
						$comment->setEmployee($agent);
						$comment->setComment($row['comment_content']);
						$comment->setCommentDate($row['comment_date']);
						
						$comments[] = $comment;
					}
					
					return $comments;
				}
			}catch(PDOException $e){
				echo $e->getMessage();	
			}
		}
		
		public function getPostComment($post_id){
			try{
				if(isset($_SESSION['emp_id'])){
					$emp_id = $_SESSION['emp_id'];
					$employees = new EmployeeDB();
					$employee = $employees->getEmployee($emp_id);
					$posts = new PostDB();
					$post = $posts->getWallPost();
					$query = "SELECT c.*,e.firstname, e.lastname, e.image, p.post_id 
							  FROM comments c LEFT JOIN employees e 
							  ON e.emp_id = c.emp_id 
							  LEFT JOIN posts p
							  ON c.post_id = p.post_id 
							  WHERE c.post_id = '$post_id' 
							  GROUP BY c.post_id
							  ORDER BY c.comment_id DESC";
							  
					$result = $this->conn->query($query);
					$row = $result->fetch(PDO::FETCH_ASSOC);

					$comment = new Comment();
					$comment->setCommentID($row['comment_id']);
					$comment->setPost($post);
					$comment->setEmployee($employee);
					$comment->setComment($row['comment_content']);
					$comment->setCommentDate($row['comment_date']);

					return $comment;
					
				}
			}catch(PDOException $e){
				echo $e->getMessage();	
			}
		}
		
		public function submitPostComment($Data){
			try{
					$emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : "";
					$comment = isset($Data['comment']) ? $Data['comment'] : "";
					$post_id = isset($Data['post_id']) ? $Data['post_id'] : "";
					$date = date("Y-m-d H:i:s", time());
					
					$query = "INSERT IGNORE comments(post_id, agent_id, emp_id, comment_content, comment_date)
							  VALUES('$post_id', 0, '$emp_id', '$comment', '$date')";
					$result = $this->conn->query($query);
					
					if($result){
						$query = "UPDATE posts SET total_comments = total_comments + 1 
								  WHERE post_id = '$post_id'";
					  	$result = $this->conn->query($query);
					$Return = array();
					$Return['ResponseCode'] = 200;
					$Return['Message'] = "comment submitted successfully.";
					}else{
					$Return = array();
					$Return['ResponseCode'] = 511;
					$Return['Message'] = "Error : Please try again!";
					}
		
					echo json_encode($Return);

			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
?>
<?php 
	$agents = new AgentDB();
	$posts = new PostDB();
	$post_comments = new CommentDB();
	$likes = new LikeDB();
		
	if(isset($_POST['action']) && $_POST['action'] != ''){	
		switch ($_POST['action']) {
			case 'post':
				$posts->submitWallPost($_POST);
				break;
			
			case 'like':
				$likes->submitPostLike($_POST);
				break;
			
			case 'dislike':
				$likes->submitPostDisLike($_POST);
				break;
			
			case 'comment':
				$post_comments->submitPostComment($_POST);
				break;
						
			default:
				return false;
				break;
			}	
	}
?>
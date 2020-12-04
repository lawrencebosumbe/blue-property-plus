<?php
 Session::init();
 
 $employee = new Employee();
 $employees = new EmployeeDB();
 
 //$agent_id = isset($_GET['agent_id']) ? $_GET['agent_id']: "";
 $agent = new Agent();
 $agents = new AgentDB();
 //$agent = $agents->getAgent($agent_id);
 
 $post = new Post();
 $posts = new PostDB();
 $post_data = $posts->getAgentPosts();
 
 $comment = new Comment();
 $post_comments = new CommentDB();

 $like = new Like();
 $likes = new LikeDB();
 
 $time = new PostDB();
 
 $properties = new PropertyDB();
 $property = new Property();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Back Office</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo URL; ?>public/back-office/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo URL; ?>public/back-office/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo URL; ?>public/back-office/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo URL; ?>public/back-office/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo URL; ?>public/back-office/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo URL; ?>public/back-office/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo URL; ?>public/back-office/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo URL; ?>public/back-office/css/blue-plus.css" rel="stylesheet" type="text/css" />
		<!-- Custom style -->
        <link href="<?php echo URL; ?>public/back-office/css/custom.css" rel="stylesheet" />
        <!-- Social Media style -->
        <link href="<?php echo URL; ?>public/back-office/css/social_media.css" rel="stylesheet" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo URL; ?>back-office" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               Blue Property Plus
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">       

                        <!-- User Account: style can be found in dropdown.less -->
                        
                        <?php //if (Session::get('agent_id') == true):?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
									<?php echo Session::get('firstname') . " " . Session::get('lastname'); ?> 
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo Session::get('image'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo Session::get('firstname') . " " . Session::get('lastname'); ?>
                                        <small>Member since <?php echo Session::get('date'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo URL; ?>back_office/logout" class="btn btn-default btn-flat">
                                        	Sign out
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <?php //endif; ?>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo Session::get('image'); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <?php if (Session::get('loggedIn') == true):?>
                        <div class="pull-left info">
                            <p><?php echo Session::get('firstname') . " " . Session::get('lastname') ; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo URL; ?>back-office">
                                <i class="fa fa-dashboard"></i> <span>Back Office</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="Admin/Reports/charts.html">
                                        <i class="fa fa-angle-double-right"></i>Listing Reports
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Reports/invoice.html"><i class="fa fa-angle-double-right"></i>Invoice</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Media</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li>
                                	<a href="Admin/Media/send_mail.html"><i class="fa fa-angle-double-right"></i>Send Email</a>
                                </li>
                                <li>
                                	<a href="Admin/Media/ads.html"><i class="fa fa-angle-double-right"></i>Advertise Here</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Property Listings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="<?php echo URL; ?>image_upload"><i class="fa fa-angle-double-right"></i>
                                    	Upload Images
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>property_listing_status"><i class="fa fa-angle-double-right"></i>
                                    	List Properties
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>payment">
                                    	<i class="fa fa-angle-double-right"></i> Payments
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>"><i class="fa fa-angle-double-right"></i> 	
                                		Manage Properties
                                    </a>
                               	</li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Property Location</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="<?php echo URL; ?>property_suburb"><i class="fa fa-angle-double-right"></i>
                                    	Suburbs
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>property_city"><i class="fa fa-angle-double-right"></i>
                                    	Cities
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>property_municipality">
                                    	<i class="fa fa-angle-double-right"></i> Municipalities
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>property_province"><i class="fa fa-angle-double-right"></i> 	
                                		Provinces
                                    </a>
                               	</li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-anchor"></i> <span>Control Panel</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="Admin/Control Panel/employees.php">
                                    	<i class="fa fa-angle-double-right"></i>Employees
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Control Panel/agents.php">
                                    	<i class="fa fa-angle-double-right"></i>Estate Agents
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Control Panel/privates.php">
                                    	<i class="fa fa-angle-double-right"></i>Private Users 
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Control Panel/properties.php">
                                    	<i class="fa fa-angle-double-right"></i>Properties
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Account</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="Admin/Account/profile.php">
                                    	<i class="fa fa-angle-double-right"></i>Profile
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Account/lockscreen.php">
                                    	<i class="fa fa-angle-double-right"></i>Lock Screen
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Account/help.php">
                                    	<i class="fa fa-angle-double-right"></i>Help Center 
                                    </a>
                                </li>
                                <li>
                                	<a href="Admin/Account/policy.php">
                                    	<i class="fa fa-angle-double-right"></i>Privacy and Policy
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Home
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo URL; ?>back-office/"><i class="fa fa-dashboard"></i>Back Office</a></li>
                        <li class="active">Home</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php foreach($properties->getPropertyIDs() as $property):?>
                                        	<?php 
												echo $property->getPropertyID();																					
											?>                                            
                                        <?php endforeach; ?>
                                    </h3>
                                    <p>
                                        Listings
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-home"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        53<sup style="font-size: 20px">%</sup>
                                    </h3>
                                    <p>
                                        Listing Report
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        44
                                    </h3>
                                    <p>
                                        Agents of your office
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                    
                        <!-- Left col -->
                        <section class="col-lg-8 connectedSortable">                                
                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">Post an article</h3>
                                </div>
                                <form action="" method="post" name="postForm">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject"
                                         placeholder="Subject"/>
                                    </div>
                                    <div>
                                        <textarea class="textarea form-control" placeholder="Write an article" name="post_feed" 
                                        id="post_feed" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; 
                                           border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-primary" id="btnpost" type="button"
                                     onClick="validatePost()" name="submit">
                                    	Post <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <!-- end quick email widget -->  
                                                      
                            <!-- quick email widget -->
                            <div class="feed_div" id="feed_div">
                            	<?php if($post_data): ?>
                                	<?php foreach($post_data as $post): ?>
                            			<div class="box">                                        
                                            <div class="box-header">
                                                <h3 class="box-title"><?php echo $post->getPostSubject(); ?></h3>
                                            </div>           
                                            <div class="box-body">
            								   <?php $comments = $post_comments->getAgentPostComments($post->getPostID()); ?>
                                               <div class="feed_box" id="postbox_<?php echo $post->getPostID(); ?>">
                                               
                                               		<div class="feed_left">
                                               	 		<p>
                                                			<img class="userimg" 
                                                            src="<?php echo $post->getAgent()->getImage();?>"/>
                                                 		</p>
                                                 		<p>
															<?php echo $post->getAgent()->getFirstname() . " " .
																	   $post->getAgent()->getLastname(); 
															?>
                                                        </p>
                                               		</div>
                                                    
                                               		<div class="feed_right">
                                                    	<p><?php echo $post->getPostContent(); ?></p>
                                                    	<div class="clear"></div>
                                                   		<?php if($comments): ?>
                                                        <div class="comment_div">
                                                            <?php foreach($comments as $comment): ?>
                                                                <div class="comment_ele">
                                                                    <p>
                                                                       <a class="link_btn" href="javascript:;">
                                                                       	  <img class="userimg" src="
																		  <?php echo $post->getAgent()->getImage();?>"/>
                                                                          <span>
                                                                          <?php 
																		  	echo $comment->getAgent()->getFirstname() . ' '; 
																			echo $comment->getAgent()->getLastname(); 
																		  ?>
                                                                          </span>
                                                                       </a>
                                                                    </p>
                                                                    <p class="comment"><?php echo $comment->getComment(); ?></p>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    	<?php endif; ?>
                                                    	<div class="clear"></div>  
                                                        <p>
                                                            <form id="commentform_<?php echo $post->getPostID(); ?>" 
                                                            method="post">
                                                                <input type="hidden" name="action" value="comment"/>
                                                                <input type="hidden" name="post_id" 
                                                                value="<?php echo $post->getPostID(); ?>"/>
                                                                <input class="input comment_input" type="text" 
                                                                name="comment" id="comment_<?php echo $post->getPostID(); ?>" 
                                                                placeholder="your comment"/>
                                                                <input class="btn-comment btn btn-primary" 
                                                                postid="<?php echo $post->getPostID(); ?>" 
                                                                type="button" name="sendbtn" value="Comment"/>
                                                            </form>
                                                        </p>                                      
                                            		</div>
                                               </div>
                                           </div>
                                           <div class="box-footer clearfix">
                                                <p class="likebox">
                                                   <?php echo '(' . $post->getTotalLike() . ')'; ?>&nbsp; people like this
                                                   <?php if($post->getLikeID() && $post->getLikeID() != ""): ?>
                                                      <a class="link_btn dis_like_btn"
                                                         postid="<?php echo $post->getPostID(); ?>" 
                                                         href="javascript:;"><img src="img/thumb_down_primary.jpg" 
                                                         class="thumb-down" />
                                                      </a>&nbsp;|&nbsp;
                                                   <?php else: ?>
                                                      <a class="link_btn like_btn" 
                                                         postid="<?php echo $post->getPostID(); ?>" 
                                                         href="javascript:;"><img src="img/thumb_primary.jpg" class="thumb-up" />
                                                      </a>&nbsp;|&nbsp;
                                                   <?php endif; ?>
                                                      <a class="link_btn" onclick='comment_focus(comment)' href="javascript:;">
                                                            Comment
                                                      </a>
                                                      <span><?php echo '( ' . $post->getTotalComment() . ' )'; ?></span>
                                                      <span><?php echo $time->timeAgo($post->getPostDate());?></span> 
                                               </p>
                                           </div>
                                       </div>
                            		<?php endforeach; ?>
								<?php endif; ?>
                            </div>
                            <!-- end quick email widget -->                                                               
                        </section>
                        <!-- /.Left col -->
                        
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-4 connectedSortable">
                                                                                 
                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <!--<script src="<?php //echo URL; ?>public/js1/jquery-2.1.3.min.js"></script>-->

        <script src="<?php echo URL; ?>public/back-office/js/jquery.min.js"></script>
		<script type='text/javascript'>
			$(document).ready(function(){
				
				$(".btn-comment").live("click",function(){
					var post_id = $(this).attr('postid');
					var comment = $("#comment_"+post_id).val();
					if(comment == ''){
						alert("comment can't be empty!");
						return false;
					}else{
						$.ajax({
							type: "POST",
							data: $('#commentform_'+post_id).serialize(),
							url: '<?php echo URL; ?>controllers/post_comment.php',
							dataType: 'json',
							success: function(response) {
								if(response.ResponseCode == 200){
									$('#postbox_'+post_id).load('index.php #postbox_'+post_id+' >*');
								}else{
									alert(response.Message);
								}
							}
						});
					}
				});
				$(".like_btn").live("click",function(){
					var post_id = $(this).attr('postid');        
					$.ajax({
							type: "POST",
							data: {'post_id':post_id,'action':'like'},
							url: '<?php echo URL; ?>post_comment',
							dataType: 'json',
							success: function(response) {
								if(response.ResponseCode == 200){
									$('#postbox_'+post_id).load('index.php #postbox_'+post_id+' >*');
								}else{
									alert(response.Message);
								}
							}
					}); 
				});
			
				$(".dis_like_btn").live("click",function(){
					var post_id = $(this).attr('postid');        
					$.ajax({
							type: "POST",
							data: {'post_id':post_id,'action':'dislike'},
							url: '<?php echo URL; ?>post_comment',
							dataType: 'json',
							success: function(response) {
								if(response.ResponseCode == 200){
									$('#postbox_'+post_id).load('index.php #postbox_'+post_id+' >*');
								}else{
									alert(response.Message);
								}
							}
					}); 
				});
			
				
				$("#btnpost").click(function(e){
					var post = $("#post_feed").val();
					var subject = $("#subject").val();
					if(post == ""){
						alert("Post Data can't be empty!");
						return false;
					}else if($("#post_feed").val().length < 100){
						alert("Post can't be less than 100 characters long");
						$("#post_feed").css('border', '2px solid red');
						return false;
					}else if(subject == ""){
						alert("Subject can't be empty!");
						return false;
					}else if($("#subject").val().length < 30){
						alert("subject can't be less than 30 characters long");
						$("#subject").css('border', '2px solid red');
						return false;
					}else{
						$.ajax({
							 type: "POST",
							 data: {'post_feed':post, 'subject':subject, 'action':'post'},
							 url: '<?php echo URL; ?>post_comment', 
							 dataType: 'json',
							 success: function(response) {
								 if(response.ResponseCode == 200){
									 $("#post_feed").val("");
									 $("#subject").val("");
									 $("#post_feed").css('border-color', '#66afe9');
									 $("#subject").css('border-color', '#66afe9');
									 $('#feed_div').load('index.php #feed_div');
								 }else{
									alert(response.Message);
								 }
							 }
						});            
					}					
					e.preventDefault();
				});
				
				$("#post_feed").blur(function(){
					if($(this).val().length >= 100){
						$(this).css('border-color', '#66afe9');
						return true;
					}
				});	
				
				$("#subject").blur(function(){
					if($(this).val().length >= 30){
						$(this).css('border-color', '#66afe9');
						return true;
					}
				});				
			});
		</script>

        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo URL; ?>public/back-office/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo URL; ?>public/back-office/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->

        <!-- AdminLTE App -->
        <script src="<?php echo URL; ?>public/back-office/js/Admin/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      	<script src="<?php echo URL; ?>public/back-office/js/Admin/dashboard.js" type="text/javascript"></script>   
        
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo URL; ?>public/back-office/js/Admin/demo.js" type="text/javascript"></script>

    </body>
</html>
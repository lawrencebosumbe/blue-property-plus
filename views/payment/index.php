<?php
 Session::init();
 
 $agent_id = Session::get('agent_id');
 $agent = new Agent();
 $agents = new AgentDB();
 //$agent = $agents->getAgent($agent_id);
 
 $saleListing = new SaleListing();
 $saleListings = new PaymentDB();
 $saleListing = $saleListings->getPayment($agent_id);
 
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
        
        <script type="text/javascript">
			// JavaScript Document
			/*
			function validatePost(){
				x = document.postForm;
				input = x.post_feed.value;
				if(input.length < 50){
					alert("You cannot post article with less than 50 chars.");
					return false;
				}else{
					return true;
				}
			}
			*/
		</script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
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
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Blue Property Plus Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
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
                            <a href="index.php">
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
                                	<a href="<?php echo URL; ?>property_listing"><i class="fa fa-angle-double-right"></i>
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
                        Payment
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Back Office</a></li>
                        <li class="active">Payment</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    	<!-- Left col -->
                        <section class="col-md-1 connectedSortable"> </section> 
                        <!-- end Left col -->
                        
                        <div class="col-md-5 col-xs-12">
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
                        <div class="col-md-5 col-xs-12">
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
                        <!-- right col -->
                        <section class="col-md-1 connectedSortable"> </section> 
                        <!-- end right col -->
                        
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
                        <section class="col-md-1 connectedSortable"> </section> 
                        <!-- end Left col -->
                        
                        <!-- mid col -->
                        <section class="col-md-10 connectedSortable">                                
                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-suitcase"></i>
                                    <h3 class="box-title">Payment Overview</h3>
                                </div>
                                <form action="" method="post" name="postForm">
                                <div class="box-body">
									<table class='table table-hover table-responsive table-condensed table-striped' style="width:100%">
                                    	<thead>
                                        	<tr>
                                                <th style="width:20%">Agent ID</th>
                                                <th style="width:20%">Agent Name</th>
                                                <th style="width:20%">Number of Listings</th>
                                                <th style="width:20%">Agency Name</th>
                                                <th style="width:20%">Payment Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<tr>
                                            	<td><?php echo Session::get('agent_id'); ?></td>
                                                <td><?php echo Session::get('firstname') . ' ' . Session::get('lastname'); ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php echo $saleListing->getSaleListingAmount(); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-primary" id="btnpost" type="button"
                                     onClick="validatePost()" name="submit">
                                    	Process Payment <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                                -->
                                <div class="box-footer clearfix">
                                    <a class="pull-right btn btn-primary" href="payment/payment">
                                    	Process Payment <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                                </form>

                            </div>
                            <!-- end quick email widget -->                                                               
                        </section>
                        <!-- /.mid col -->
                        
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-md-1 connectedSortable"> </section>
                        <!-- end right col -->
                        
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="public/js1/jquery-2.1.3.min.js"></script>
        <script src="public/back-office/js/jquery.min.js"></script>
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
							url: '../controllers/post_comment.php',
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
							url: '../controllers/post_comment.php',
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
							url: '../controllers/post_comment.php',
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
							 url: '../controllers/post_comment.php',
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
        <script src="public/back-office/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="public/back-office/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->

        <!-- AdminLTE App -->
        <script src="public/back-office/js/Admin/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      	<script src="public/back-office/js/Admin/dashboard.js" type="text/javascript"></script>   
        
        <!-- AdminLTE for demo purposes -->
        <script src="public/back-office/js/Admin/demo.js" type="text/javascript"></script>

    </body>
</html>
<?php
	//CONNECT TO MariaDB DATABASE
	$host = "lawrencebosumbe16258.ipagemysql.com";
	$user = "blueproperty1";
	$pass = "blueproperty1";
	
	$conn = new mysqli($host, $user, $pass);
	
	mysqli_set_charset($conn, 'utf8');
	
	if ($conn->connect_error) {
		die ($conn->connect_error);
		$conn->Close();
	}
	
	//SELECT DATABASE
	mysqli_select_db($conn, 'bluepropertyplus1');
	
	//FETCH ALL THE PROVINCES DATA
	$query = "SELECT * FROM provinces ORDER BY province_name ASC";
	$result = $conn->query($query) or die($conn->error);
	
	//COUNT TOTAL NUMBER OF ROWS
	$row_count = $result->num_rows;
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Back Office | Listings</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../public/back-office/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../public/back-office/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../public/back-office/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../public/back-office/css/blue-plus.css" rel="stylesheet" type="text/css" />
		<!-- Custom style -->
        <link href="../public/back-office/css/custom.css" rel="stylesheet" />       

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
            <a href="../public/back-office/index.php" class="logo">
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
                                                    <img src="../public/back-office/img/avatar3.png" class="img-circle" alt="User Image"/>
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
                                                    <img src="../public/back-office/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../public/back-office/img/avatar.png" class="img-circle" alt="user image"/>
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
                                                    <img src="../public/back-office/img/avatar2.png" class="img-circle" alt="user image"/>
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
                                                    <img src="../public/back-office/img/avatar.png" class="img-circle" alt="user image"/>
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
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
									<?php //echo $employee->getFirstname() . " " . $employee->getLastname(); ?> 
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../../../img/<?php //echo $employee->getImage(); ?>" class="img-circle" 
                                    alt="User Image" />
                                    <p>
                                        <?php //echo $employee->getFirstname() . " " . $employee->getLastname(); ?>
                                        <small>Member since <?php //echo $employee->getRegistrationDate(); ?></small>
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
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
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
                           <img src="../../public/back-office/img/<?php //echo $employee->getImage(); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                           <p><?php //echo $employee->getFirstname() . " " . $employee->getLastname(); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
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
                        <li>
                            <a href="../public/back-office/index.php">
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
                                	<a href="../public/back-office/Reports/charts.html">
                                    	<i class="fa fa-angle-double-right"></i>Listing Reports
                                     </a>
                                </li>
                                <li><a href="../public/back-office/Reports/invoice.html"><i class="fa fa-angle-double-right"></i>Invoice</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Media</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="../public/back-office/Media/send_mail.html"><i class="fa fa-angle-double-right"></i>Send Email</a>
                                <li>
                                	<a href="../public/back-office/Media/recent_posts.html">
                                    	<i class="fa fa-angle-double-right"></i>Recent Posts
                                    </a>
                                </li>
                                <li><a href="../public/back-office/Media/timeline.html"><i class="fa fa-angle-double-right"></i>Timeline</a></li>
                                <li><a href="../public/back-office/Media/ads.html"><i class="fa fa-angle-double-right"></i>Advertise Here</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Property Listings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li>
                                	<a href="../public/back-office/Properties/image_upload.html"><i class="fa fa-angle-double-right"></i> 
                                    	Upload Images
                                    </a>
                                </li>
                                <li><a href="properties.html"><i class="fa fa-angle-double-right"></i> List Properties</a></li>
                                <li>
                                	<a href="manage_properties.html">
                                    	<i class="fa fa-angle-double-right"></i> Manage Properties
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
                                	<a href="../public/back-office/Account/control_panel.php">
                                    	<i class="fa fa-angle-double-right"></i>Control Panel
                                    </a>
                                </li>
                                <li><a href="../public/back-office/Account/login.html"><i class="fa fa-angle-double-right"></i>Profile</a></li>
                                <li>
                                	<a href="../public/back-office/Account/lockscreen.html">
                                    	<i class="fa fa-angle-double-right"></i>Lock Screen
                                    </a>
                                </li>
                                <li>
                                	<a href="../public/back-office/Account/register.html">
                                    	<i class="fa fa-angle-double-right"></i>Help Center 
                                    </a>
                                </li>
                                <li>
                                	<a href="../public/back-office/Account/lockscreen.html">
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
                        List Properties
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Back Office</a></li>
                        <li><a href="#">Property Listings</a></li>
                        <li class="active">Listing Properties</li>
                    </ol>
                </section>
                
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                    	<!-- left column -->
                    	<div class="col-md-1"></div>
                        <!-- mid column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Upload Property Resources</h3>
         							<form id="regForm" action="index.php" method="post" enctype="multipart/form-data">                                          
                                        <!-- One "tab" for each step in the form: -->
                                        <div class="tab"><h3>Property Location</h3>
                                          <p>
                                          <input type="hidden" name="action" value="add_property" />  
                                                    <input type="hidden" name="property_id" 
                                                        value="<?php //$property->getPropertyID(); ?>" />          
                                          	<input type="hidden" name="action" value="add_property" />   
                                                    <input type="hidden" name="emp_id" 
                                                        value="<?php //$employee->getEmployeeID(); ?>" />
                                                    <input type="hidden" name="agent" 
                                                        value="<?php //$agent->getAgentID(); ?>" />
                                          	<label>Street</label>
                                          	<input placeholder="Street No" name="street_no" oninput="this.className = ''">
                                          </p>
                                          <p>
                                          	<input placeholder="Street Name" name="street_name" oninput="this.className = ''">
                                          </p>
                                          <p>
                                          	<label for="province">Province</label>
                                          	<select class="form-control" id="province">
                                                <option value="" selected="selected">Select Province</option>
                                                <?php
													if($row_count > 0){
														while($row = $result->fetch_assoc()){ 
															echo '<option value="'.$row['province_id'].'">'
																		.$row['province_name'].
																 '</option>';
														}
													}else{
														echo '<option value="">Province not available</option>';
													}
												?>
                                             </select>
                                          </p>
                                          <p>
                                             <label for="municipality">Municipality</label>
                                             <select class="form-control" name="municipality" id="municipality">
                                                 <option value="">Select Province First</option>
                                             </select>
                                          </p>
                                          <p>
                                             <label for="city">City</label>
                                             <select class="form-control" name="city" id="city">
                                                <option value="">Select Municipality First</option>
                                             </select>
                                          </p>
                                          <p>
                                             <label for="suburb">Suburb</label>
                                             <select class="form-control" name="suburb" id="suburb">
                                                <option value="">Select City First</option>
                                             </select>
                                          </p>
                                        </div>
                                        
                                        <div class="tab"><h3>Property Listing</h3>
                                          <p>
                                          	<label for="property_type">Property Type</label>
                                            <select class="form-control" name="property_type" id="property_type">
                                               <option value="" selected="selected">Select Property Type</option>
                                                  <?php //foreach($property_types->getPropertyTypes() as $property_type): ?>
                                                     <option value="<?php //echo $property_type->getPropertyTypeID();?>">
                                                     <?php //echo $property_type->getPropertyType(); ?>
                                                  <?php //endforeach; ?>
                                            </select>                                          
                                          </p>
                                          <p>
                                            <label for="property_status">Property Status</label>
                                            <select class="form-control" name="property_status" id="property_status">
                                                <option value="" selected="selected">Select Property Status</option>
                                                <option>For Sale</option>
                                                <option>To Rent</option>
                                            </select>
                                          </p>
                                          <p>
                                            <label for="price">Price</label>
                                               <input type="text" class="form-control" name="price" id="price" 
                                                 placeholder="Enter property price">
                                          </p>
                                          <p>
                                             <label for="property_range">Listing Range</label>
                                             <select class="form-control" name="property_range" id="property_range">
                                               <option value="" selected="selected"> Select Lising Range </option>
                                                  <?php //foreach($property_ranges->getRanges() as $property_range): ?>
                                                      <option  value="<?php //echo $property_range->getPropertyRangeID();?>">                                                          <?php //echo $property_range->getPropertyRangeDescription(); ?>
                                                      </option>
                                                 <?php //endforeach; ?>
                                              </select>
                                           </p>                        							
                                           <p>
                                              <label for="num_beds">Number of Bed Rooms</label>
                                              <select class="form-control" name="num_beds" id="num_beds">
                                                 <option value="" selected="selected">Select Number of rooms</option>
                                                 <option>0</option>
                                                 <option>1</option>
                                                 <option>2</option>
                                                 <option>3</option>
                                                 <option>4</option>
                                                 <option>5</option>
                                                 <option>6</option>
                                                 <option>7</option>
                                                 <option>8</option>
                                                 <option>9</option>
                                                 <option>10</option>
                                              </select>
                                            </p> 
                                            <p>
                                               <label for="num_garages">Number of Garages</label>
                                               <select class="form-control" name="num_garages" id="num_garages">
                                                   <option value="" selected="selected">
                                                   		Select Number of garages
                                                   </option>
                                                   <option>0</option>
                                                   <option>1</option>
                                                   <option>2</option>
                                                   <option>3</option>
                                                   <option>4</option>
                                                   <option>5</option>
                                                   <option>6</option>
                                                   <option>7</option>
                                                   <option>8</option>
                                                   <option>9</option>
                                                   <option>10</option>
                                               </select>
                                            </p> 
                                            <p>
                                               <label for="num_bathrooms">Number of Bathrooms</label>
                                               <select class="form-control" name="num_bathrooms" id="num_bathrooms">
                                                   <option value="" selected="selected">
                                                        Select Number of Bathrooms
                                                   </option>
                                                   <option>0</option>
                                                   <option>1</option>
                                                   <option>2</option>
                                                   <option>3</option>
                                                   <option>4</option>
                                                   <option>5</option>
                                                   <option>6</option>
                                                   <option>7</option>
                                                   <option>8</option>
                                                   <option>9</option>
                                                   <option>10</option>
                                               </select>
                                            </p>                                        
                                            <p>
                                               <label for="num_lounges">Number of Lounges</label>
                                               <select class="form-control" name="num_lounges" id="num_lounges">
                                                   <option value="" selected="selected">
                                                        Select Number of Lounges
                                                   </option>
                                                   <option>0</option>
                                                   <option>1</option>
                                                   <option>2</option>
                                                   <option>3</option>
                                                   <option>4</option>
                                                   <option>5</option>
                                                   <option>6</option>
                                                   <option>7</option>
                                                   <option>8</option>
                                                   <option>9</option>
                                                   <option>10</option>
                                               </select>
                                            </p> 
                                            <p>
                                                <label for="air_con">Air Conditioning</label>
                                                <select class="form-control" name="air_con" id="air_con">
                                                    <option value="" selected="selected">
                                                          Select Number of Air Con
                                                    </option>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                             </p>
                                             <p>
                                                <label for="pool">Existing Air Pool</label>
                                                <select class="form-control" name="pool" id="pool">
                                                    <option value="" selected="selected">
                                                         Select Number of Pool
                                                    </option>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                 </select>
                                             </p>  
                                             <p>
                                                 <label for="cottage">Existing Cottage</label>
                                                 <select class="form-control" name="cottage" id="cottage">
                                                 	<option value="" selected="selected">
                                                       Select Number of Cottage
                                                 	</option>
                                                 	<option>0</option>
                                                 	<option>1</option>
                                                 	<option>2</option>
                                                 	<option>3</option>
                                                 	<option>4</option>
                                                 	<option>5</option>
                                                </select>
                                              </p>  
                                              <p>
                                                 <label for="desc">Property Description</label>
                                                 <textarea class="form-control" name="desc" id="desc"
                                                        	placeholder="e.g. House for sale around Cape harbour">
                                                  </textarea>
                                              </p>
                                        </div>
                                        
                                        <div class="tab"><h3>Upload Property Images</h3>
                                          	  <p>
                                                 <label for="image1"> Upload Image 1:</label>
                                                       <input id="image1" name="image[]" placeholder="Upload image here" 
                                                       type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                 <label for="image2"> Upload Image 2:</label>
                                                      <input id="image2" name="image[]" placeholder="Upload image here" 
                                                      type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image3"> Upload Image 3:</label>
                                                      <input id="image3" name="image[]" placeholder="Upload image here" 
                                                       type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image4"> Upload Image 4:</label>
                                                      <input id="image4" name="image[]" placeholder="Upload image here" 
                                                      type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image5"> Upload Image 5:</label>
                                                       <input id="image5" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image6"> Upload Image 6:</label>
                                                        <input id="image6" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image7"> Upload Image 7:</label>
                                                        <input id="image7" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image8"> Upload Image 8:</label>
                                                        <input id="image8" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>                                                    
                                              <p>
                                                  <label for="image9"> Upload Image 9:</label>
                                                        <input id="image9" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                        <label for="image10"> Upload Image 10:</label>
                                                        <input id="image10" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                     <p>
                                                        <label for="image11"> Upload Image 11:</label>
                                                        <input id="image11" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image12"> Upload Image 12:</label>
                                                        <input id="image12" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image13"> Upload Image 13:</label>
                                                        <input id="image13" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p> 
                                                    <p>
                                                        <label for="image14"> Upload Image 14:</label>
                                                        <input id="image14" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p> 
                                                    <p>
                                                        <label for="image15"> Upload Image 15:</label>
                                                        <input id="image15" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image16"> Upload Image 16:</label>
                                                        <input id="image16" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p> 
                                                    <p>
                                                        <label for="image17"> Upload Image 17:</label>
                                                        <input id="image17" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image18"> Upload Image 18:</label>
                                                        <input id="image18" name="image[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                        </div>
                                        
                                        <div class="tab">Login Info:
                                           <p>
                                                  You can verify your entries by selected tabs below if you are
                                                  willing to make some changes.<br /><br />
                                                  Once you are done, You can proceed with the payment. 
                                                  Under Property Listings Menu, select Payments.<br /><br />
                                                        
                                                  By pressing submit, you comply to our terms and policy.
                                           </p>
                                           <p class="">
                                                    
                                                  <button id="registerButton" type="submit"   name="submit"  
                                                     title="Click On Payment Method"> Proceed
                                                  </button>
                                           </p>
                                        </div>
                                                                                                                       
                                        <div style="overflow:auto;">
                                          <div style="float:right;">
                                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                          </div>
                                        </div>
                                        
                                        <!-- Circles which indicates the steps of the form: -->
                                        <div style="text-align:center;margin-top:40px;">
                                          <span class="step"></span>
                                          <span class="step"></span>
                                          <span class="step"></span>
                                        </div>                                        
                                     </form>                                    
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                            </div><!-- /.box -->
								
                        </div><!--/.col (mid) -->
                        
     					<!-- left right -->
                    	<div class="col-md-1"></div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
         <!-- jQuery 2.0.2 -->
        <script src="../public/back-office/js/jquery-2.1.3.min.js"></script>
        <!-- Bootstrap -->
        <script src="../public/back-office/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Admin App -->
        <script src="../public/back-office/js/Admin/app.js" type="text/javascript"></script>
        <!-- Admin for demo purposes -->
        <script src="../public/back-office/js/Admin/demo.js" type="text/javascript"></script> 
        <!-- Sliding Form Tab -->
        <script src="../public/back-office/js/sliding.form.js" type="text/javascript"></script>
        <!-- Ajax Seleted Menu -->
        <!-- Ajax Form Submission -->
        <script type="text/javascript">
			$(document).ready(function(){
				$('#province').on('change',function(){
					var provinceID = $(this).val();
					if(provinceID ){
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'province_id='+provinceID ,
							success:function(html){
								$('#municipality').html(html);
								$('#city').html('<option value="">Select Municipality first</option>'); 
							}
						}); 
					}else{
						$('#municipality').html('<option value="">Select Province first</option>');
						$('#city').html('<option value="">Select Municipality first</option>'); 
					}
				});
				
				$('#municipality').on('change',function(){
					var municipalityID = $(this).val();
					if(municipalityID){
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'municipality_id='+municipalityID,
							success:function(html){
								$('#city').html(html);
							}
						}); 
					}else{
						$('#city').html('<option value="">Select Municipality first</option>'); 
					}
				});
				
				$('#city').on('change',function(){
					var cityID = $(this).val();
					if(cityID){
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'city_id='+cityID,
							success:function(html){
								$('#suburb').html(html);
							}
						}); 
					}else{
						$('#suburb').html('<option value="">Select City first</option>'); 
					}
				});
			});
		</script> 
        <script>
		var currentTab = 0; // Current tab is set to be the first tab (0)
			showTab(currentTab); // Display the current tab
			
			function showTab(n) {
			  // This function will display the specified tab of the form ...
			  var x = document.getElementsByClassName("tab");
			  x[n].style.display = "block";
			  // ... and fix the Previous/Next buttons:
			  if (n == 0) {
				document.getElementById("prevBtn").style.display = "none";
			  } else {
				document.getElementById("prevBtn").style.display = "inline";
			  }
			  if (n == (x.length - 1)) {
				document.getElementById("nextBtn").innerHTML = "Submit";
			  } else {
				document.getElementById("nextBtn").innerHTML = "Next";
			  }
			  // ... and run a function that displays the correct step indicator:
			  fixStepIndicator(n)
			}
			
			function nextPrev(n) {
			  // This function will figure out which tab to display
			  var x = document.getElementsByClassName("tab");
			  // Exit the function if any field in the current tab is invalid:
			  if (n == 1 && !validateForm()) return false;
			  // Hide the current tab:
			  x[currentTab].style.display = "none";
			  // Increase or decrease the current tab by 1:
			  currentTab = currentTab + n;
			  // if you have reached the end of the form... :
			  /*if (currentTab >= x.length) {
				//...the form gets submitted:
				document.getElementById("regForm").submit();
				return false;
			  }*/
			  // Otherwise, display the correct tab:
			  showTab(currentTab);
			}
			
			function validateForm() {
			  // This function deals with validation of the form fields
			  var x, y, i, valid = true;
			  x = document.getElementsByClassName("tab");
			  y = x[currentTab].getElementsByTagName("input");
			  y = x[currentTab].getElementsByTagName("select");
			  // A loop that checks every input field in the current tab:
			  for (i = 0; i < y.length; i++) {
				// If a field is empty...
				if (y[i].value == "") {
				  // add an "invalid" class to the field:
				  y[i].className += " invalid";
				  // and set the current valid status to false:
				  valid = false;
				}
			  }
			  // If the valid status is true, mark the step as finished and valid:
			  if (valid) {
				document.getElementsByClassName("step")[currentTab].className += " finish";
			  }
			  return valid; // return the valid status
			}
			
			function fixStepIndicator(n) {
			  // This function removes the "active" class of all steps...
			  var i, x = document.getElementsByClassName("step");
			  for (i = 0; i < x.length; i++) {
				x[i].className = x[i].className.replace(" active", "");
			  }
			  //... and adds the "active" class to the current step:
			  x[n].className += " active";
			}
	</script>
    </body>
</html>
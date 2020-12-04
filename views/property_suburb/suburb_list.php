<?php 
	require_once('util/paging_record_calc.php');
	$suburb = new Suburb();
	$suburbs = new SuburbDB();
	
	$h = "localhost";
	$u = "root";
	$p = "root";
	
	$conn = new MySQLi($h, $u, $p);
	mysqli_set_charset($conn, 'utf8');
	if($conn->connect_error){
		die($conn->connect_error);
		$conn->close();
	}
	
	//SELECT DATABASE
	mysqli_select_db($conn, 'propertydb');
	
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
                                    <img src="../img/<?php //echo $employee->getImage(); ?>" class="img-circle" alt="User Image" />
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
                                        <a href="Credentials/Employees/logout.php" class="btn btn-default btn-flat">
                                        	Sign out
                                        </a>
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
                            <img src="../img/<?php //echo $employee->getImage(); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php //echo $employee->getFirstname() . " " . $employee->getLastname() ; ?></p>

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
                                	<a href="<?php echo URL; ?>property_listing"><i class="fa fa-angle-double-right"></i>
                                    	List Properties
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>image_upload"><i class="fa fa-angle-double-right"></i>
                                    	Upload Images
                                    </a>
                                </li>                                
                                <li>
                                	<a href="<?php echo URL; ?>payments">
                                    	<i class="fa fa-angle-double-right"></i> Payments
                                    </a>
                                </li>
                                <li>
                                	<a href="<?php echo URL; ?>property_management"><i class="fa fa-angle-double-right"></i> 	
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
                        Suburb
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Back Office</a></li>
                        <li class="active">Suburbs</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                
                    <!-- Main row -->
                    <div class="row">
                    
                    	<!-- Left col -->
                    	<section class="col-lg-1 connectedSortable"></section><!-- Left col -->
                        
                        <section class="col-lg-10 connectedSortable">  
                            
                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">Listing of Suburbs</h3>
                                </div>
                                <div class="box-body">
                                    <table class='table table-hover table-responsive table-striped table-advance' width="100%">
                                    	<thead>
                                            <tr>
                                            	<th>No</th>
                                            	<th>Suburb Code</th>
                                                <th>Suburb Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php //foreach($this->getSuburbs as $suburb): ?>
                                            <?php foreach($suburbs->getRecords($from_record_num, $records_per_page) as $suburb): ?>
                                            	<tr>
                                                	<td width="5%"><?php echo $suburb->getSuburbID();?></td>
                                                    <td width="15%"><?php echo $suburb->getSuburbCode();?></td>
                                                    <td width="35%"><?php echo $suburb->getSuburbName();?></td>
                                                    <td width="45%">
                                                    	<a class="pull-right btn btn-danger delete" 
                                                          href="<?php echo URL; ?>property_suburb/deleteSuburb/<?php echo $suburb->
														  getSuburbID();?>">
                                                          <span class="glyphicon glyphicon-trash"> Delete </span>
                                                        </a>                                                    	
                                                        <a class="pull-right btn btn-info" 
                                                          href="<?php echo URL; ?>property_suburb/suburb_edit/<?php echo $suburb->
														  getSuburbID();?>">
                                                          <span class="glyphicon glyphicon-edit"> Update </span>
                                                        </a>
                                                        <a class="pull-right btn btn-primary" 
                                                          href="<?php echo URL; ?>property_suburb/suburb_single/<?php echo $suburb->
														  getSuburbID();?>">
                                                          <span class="glyphicon glyphicon-list"> Read </span>
                                                        </a>                                                        
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>          							
                                </div>
                                <div class="box-footer clearfix">
                                	<?php 
										$page_url = "suburb_list?";
										//$total_rows = $this->countAll; 
										$total_rows = $suburbs->countAll();																			
										require_once('util/pagination.php');										
									?>
                                </div>
                            </div>  
                            <!-- end quick email widget -->
                                                                                        
                        </section>
                        <!-- /.Left col -->
                        
                        <section class="col-lg-1 connectedSortable"></section><!-- right col -->
                        
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
        
        <!-- jQuery 2.0.2 -->
        <!--<script src="../public/back-office/js/jquery-2.1.3.min.js"></script>-->
        <script src="../public/back-office/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../public/back-office/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../public/back-office/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->

        <!-- AdminLTE App -->
        <script src="../public/back-office/js/Admin/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      	<script src="../public/back-office/js/Admin/dashboard.js" type="text/javascript"></script>   
        
        <!-- AdminLTE for demo purposes -->
        <script src="../public/back-office/js/Admin/demo.js" type="text/javascript"></script>

    </body>
</html>
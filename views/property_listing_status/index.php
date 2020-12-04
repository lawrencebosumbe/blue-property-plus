<?php
	Session::init();
	
	/*
	if (Session::get('loggedIn') == true){
		$agent_id = Session::get('agent_id');
	}*/
	/*	
	$h = "lawrencebosumbe16258.ipagemysql.com";
	$u = "blueproperty1";
	$p = "blueproperty1";
	*/
	
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
        <title>Back Office | Listings</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo URL; ?>public/back-office/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo URL; ?>public/back-office/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo URL; ?>public/back-office/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo URL; ?>public/back-office/css/blue-plus.css" rel="stylesheet" type="text/css" />
		<!-- Custom style -->
        <link href="<?php echo URL; ?>public/back-office/css/custom.css" rel="stylesheet" />      

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
            <a href="../../index.php" class="logo">
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
									<?php echo Session::get('firstname') . " " . Session::get('lastname'); ?>
                                    <i class="caret"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo URL; ?><?php echo Session::get('image'); ?>" class="img-circle" 
                                    alt="User Image" />
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
                                        <a href="<?php echo URL; ?>back_office/logout" class="btn btn-default btn-flat">Sign out</a>
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
                           <img src="<?php echo URL; ?><?php echo Session::get('image'); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                           <p><?php echo Session::get('firstname') . " " . Session::get('lastname'); ?></p>

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
                            <a href="../../index.php">
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
                                	<a href="../Reports/charts.html">
                                    	<i class="fa fa-angle-double-right"></i>Listing Reports
                                     </a>
                                </li>
                                <li><a href="../Reports/invoice.html"><i class="fa fa-angle-double-right"></i>Invoice</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Media</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="../Media/send_mail.html"><i class="fa fa-angle-double-right"></i>Send Email</a>
                                <li><a href="../Media/ads.html"><i class="fa fa-angle-double-right"></i>Advertise Here</a></li>
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
                                <i class="fa fa-gear"></i> <span>Account</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li>
                                	<a href="../Account/control_panel.php">
                                    	<i class="fa fa-angle-double-right"></i>Control Panel
                                    </a>
                                </li>
                                <li><a href="../Account/login.html"><i class="fa fa-angle-double-right"></i>Profile</a></li>
                                <li>
                                	<a href="../Account/lockscreen.html">
                                    	<i class="fa fa-angle-double-right"></i>Lock Screen
                                    </a>
                                </li>
                                <li>
                                	<a href="../Account/register.html">
                                    	<i class="fa fa-angle-double-right"></i>Help Center 
                                    </a>
                                </li>
                                <li>
                                	<a href="../Account/lockscreen.html">
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
                        Property Listings
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Back Office</a></li>
                        <li><a href="#">Property Listings</a></li>
                        <li class="active">Property Listings</li>
                    </ol>
                </section>
                
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                    	<!-- left column -->
                    	<div class="col-md-2"></div>
                        <!-- mid column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Upload Property Resources</h3>
         							<form id="regForm" action="property_listing_status/addProperty" method="post" 
                                    	enctype="multipart/form-data">                                          
                                        <!-- One "tab" for each step in the form: -->
                                        <div class="tab"><h3>Property Location</h3>
                                          <p>            
                                          	<!--<input type="hidden" name="agent_id" />-->
                                          	<label>Street</label>
                                          	<input placeholder="Street No" name="street_no" oninput="this.className = ''" required>
                                          </p>
                                          <p>
                                          	<input placeholder="Street Name" name="street_name" oninput="this.className = ''" required>
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
                                                  <option>Residential</option>
                                                  <option>Appartment/Flat</option>
                                                  <option>Townhouse</option>
                                                  <option>Office</option>
                                                  <option>Commercial</option>
                                                  <option>Industrial</option>
                                                  <option>Farms/Vacant Land</option>
                                            </select>                                          
                                          </p>
                                          <p>
                                            <label for="property_status">Property Status</label>
                                            <select class="form-control" name="property_status" id="property_status">
                                                <option value="" selected="selected">Select Property Status</option>
                                                <option>For Sale</option>
                                                <option>To Rent</option>
                                                <option>On Show</option>
                                            </select>
                                          </p>
                                          <p>
                                            <label for="price">Price</label>
                                               <input type="text" class="form-control" name="price" id="price" 
                                                 placeholder="Enter property price">
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
                                        <div class="tab">Process Listing:
                                           <p>
                                                  You can verify your entries by selected tabs below if you are
                                                  willing to make some changes.<br /><br />
                                                  Once you are done, You can proceed with the payment. 
                                                  Under Property Listings Menu, select Payments.<br /><br />
                                                        
                                                  By pressing submit, you comply to our terms and policy.
                                           </p>
                                           <p class="">
                                                    
                                                  <button id="registerButton" type="submit"   name="submit"  
                                                     title="Click On Payment Method"> List Property
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
                                        </div>                                        
                                     </form>                                    
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                            </div><!-- /.box -->
								
                        </div><!--/.col (mid) -->
                        
     					<!-- left right -->
                    	<div class="col-md-2"></div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo URL; ?>public/back-office/js/jquery-2.1.3.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo URL; ?>public/back-office/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Admin App -->
        <script src="<?php echo URL; ?>public/back-office/js/Admin/app.js" type="text/javascript"></script>
        <!-- Admin for demo purposes -->
        <script src="<?php echo URL; ?>public/back-office/js/Admin/demo.js" type="text/javascript"></script> 
        <!-- Sliding Form Tab -->
        <script src="<?php echo URL; ?>public/back-office/js/sliding.form.js" type="text/javascript"></script>
        <!-- Ajax Seleted Menu -->
        <!-- Ajax Form Submission -->
        <script type="text/javascript">
			$(document).ready(function(){
				$('#province').on('change',function(){
					var provinceID = $(this).val();
					if(provinceID ){
						$.ajax({
							type:'POST',
							url:'<?php echo URL; ?>views/back_office/add_suburb/ajaxData.php',
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
							url:'<?php echo URL; ?>views/back_office/add_suburb/ajaxData.php',
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
							url:'<?php echo URL; ?>views/back_office/add_suburb/ajaxData.php',
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
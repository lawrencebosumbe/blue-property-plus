<?php
Session::init();
	$property = new Property();
	$properties = new PropertyDB;
	ini_set('memory_limit','2048M');
	//$property = $this->image_upload;	
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
         							<form id="regForm" action="<?php echo URL; ?>image_upload/uploadImage" method="post" 
                                    	enctype="multipart/form-data">                                          
                                        <!-- One "tab" for each step in the form: -->                                        
                                        <div class="tab"><h3>Upload Property Images</h3>
                                        <p>Note: Only this image resolution will be uploaded: with: 1280px, height: 1024px.</p>
										<?php
										$pptImgUpStatus = Session::get('pptImgUpStatus'); //echo session_id();print_r($pptImgUpStatus);die('OKKKKKKKKK');
										if(!empty($pptImgUpStatus)){ ?>
										<div class="alert <?php echo $pptImgUpStatus['type']; ?>">
											<?php echo $pptImgUpStatus['msg']; ?>
										</div>
										<?php } ?>
                                        	  <p>
                                             <label for="property">Property</label>
                                             <p>
                                             	Note: Please, make sure that you select the correct street no, street name, suburb
                                                name, city name, municipality name, and province name
                                             </p>
                                             <select class="form-control" name="property" id="property">
                                                <option value="" selected="selected">Select Listed Property for the images</option>
                                                <?php foreach($properties->get_properties() as $property): ?>
                                                	<option value="<?php echo $property->getPropertyID(); ?>">
                                                    <?php 
													echo $property->getStreetNo() . ', ' . 
													$property->getStreetName() . ', ' . 
													$property->getSuburb()->getSuburbName() . ', ' .
													$property->getSuburb()->getCity()->getCityName() . ', ' .
												$property->getSuburb()->getCity()->getMunicipality()->getMunicipalityName() . ', ' . 	
							    			    $property->getSuburb()->getCity()->getMunicipality()->getProvince()->getProvinceName();
														?>
                                                    </option>
                                                <?php endforeach; ?>
                                             </select>
                                              </p>
                                          	  <p>
                                                 <label for="image1"> Upload Image 1 (1280x1024):</label>
                                                       <input id="image1" name="files[]" placeholder="Upload image here" 
                                                       type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                 <label for="image2"> Upload Image 2 (1280x1024):</label>
                                                      <input id="image2" name="files[]" placeholder="Upload image here" 
                                                      type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image3"> Upload Image 3 (1280x1024):</label>
                                                      <input id="image3" name="files[]" placeholder="Upload image here" 
                                                       type="file" autocomplete=off multiple />
                                              </p>
                                              
                                              <p>
                                                  <label for="image4"> Upload Image 4 (1280x1024):</label>
                                                      <input id="image4" name="files[]" placeholder="Upload image here" 
                                                      type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image5"> Upload Image 5 (1280x1024):</label>
                                                       <input id="image5" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image6"> Upload Image 6 (1280x1024):</label>
                                                        <input id="image6" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              
                                              <p>
                                                  <label for="image7"> Upload Image 7 (1280x1024):</label>
                                                        <input id="image7" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                  <label for="image8"> Upload Image 8 (1280x1024):</label>
                                                        <input id="image8" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>                                                    
                                              <p>
                                                  <label for="image9"> Upload Image 9 (1280x1024):</label>
                                                        <input id="image9" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                              </p>
                                              <p>
                                                        <label for="image10"> Upload Image 10 (1280x1024):</label>
                                                        <input id="image10" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                     <p>
                                                        <label for="image11"> Upload Image 11 (1280x1024):</label>
                                                        <input id="image11" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image12"> Upload Image 12 (1280x1024):</label>
                                                        <input id="image12" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image13"> Upload Image 13 (1280x1024):</label>
                                                        <input id="image13" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p> 
                                                    <p>
                                                        <label for="image14"> Upload Image 14 (1280x1024):</label>
                                                        <input id="image14" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p> 
                                                    <p>
                                                        <label for="image15"> Upload Image 15 (1280x1024):</label>
                                                        <input id="image15" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image16"> Upload Image 16 (1280x1024):</label>
                                                        <input id="image16" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image17"> Upload Image 17 (1280x1024):</label>
                                                        <input id="image17" name="files[]" placeholder="Upload image here" 
                                                        type="file" autocomplete=off multiple />
                                                    </p>
                                                    <p>
                                                        <label for="image18"> Upload Image 18 (1280x1024):</label>
                                                        <input id="image18" name="files[]" placeholder="Upload image here" 
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
                                                    > Proceed
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
				//document.getElementById("nextBtn").innerHTML = "Submit";
				document.getElementById("nextBtn").style.display = "none";
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
			  if (n == 1 && !validateForm()){
				alert('Please select property and at least one image.');
				return false;
			  }
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
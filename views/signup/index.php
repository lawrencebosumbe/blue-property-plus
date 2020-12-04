<?php
	//Get Province ID 
	$province_id = isset($_GET['province_id']) ? $_GET['province_id']: 1;
		
	// Construct Province Object
	$provinces = new ProvinceDB();
	$province = new Province();
	//Get Munipality ID 
	$municipality_id = isset($_GET['municipality_id']) ? $_GET['municipality_id'] : 1;
	
	$municipality = new Municipality();
	$municipalities = new MunicipalityDB();
	
	//Set Municipality ID to be read
	$municipality->setMunicipalityID($municipality_id);
	
	//Read the details of a municipality to be read
	$municipality = $municipalities->getMunicipality($municipality_id);	
	
	$city = new City();
	$cities = new CityDB();
	$city_id = isset($_GET['City_id']) ? $_GET['city_id'] : "";
	$city = $cities->getCity($city_id);
	
	$suburb = new Suburb();
	$suburbs = new SuburbDB();
	
	$property = new Property();	
	$properties = new PropertyDB();

	$post = new Post();
	$posts = new PostDB();
	
	$agency = new Agency();
	$agencies = new AgencyDB();
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
	//mysqli_select_db($conn, 'bluepropertyplus1');
	mysqli_select_db($conn, 'propertydb');
	
	//FETCH ALL THE PROVINCES DATA
	$query = "SELECT * FROM provinces ORDER BY province_name ASC";
	$result = $conn->query($query) or die($conn->error);
	
	//COUNT TOTAL NUMBER OF ROWS
	$row_count = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title>Sign Up</title>
<!--
 ---------------------------------------------------------------
       STYLES
 ---------------------------------------------------------------
 >
 
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.css">

<!-- HEADER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/header.css"/>

<!-- FOOTER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/footer.css"/>

<!-- BANNER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/province-banner.css"/>

<!-- JSSOR SLIDER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/jssor-slider.css"/>

<!-- ARROW BOX -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/arrow-box.css"/>

<!-- MAIN -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/styles.css"/>

<!-- MASTER STYLES -->   
<!--<link rel="stylesheet" href="../../css/master.css"/>-->

<!-- CAROUSEL SLIDER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/carousel-slider/slitslider/css/custom.css"/>
<link rel="stylesheet" href="<?php echo URL; ?>public/carousel-slider/slitslider/css/style.css"/>

<!-- OWL CAROUSEL -->
<link rel="stylesheet" href="<?php echo URL; ?>public/carousel-slider/owl-carousel/owl.carousel.css"/>
<link rel="stylesheet" href="<?php echo URL; ?>public/carousel-slider/owl-carousel/owl.theme.css"/>

<!-- FULL SCREEN SLIDER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/fullscreen-fonts/BebasNeue-webfont.eot" />
<link rel="stylesheet" href="<?php echo URL; ?>public/fullscreen-fonts/BebasNeue-webfont.svg" />
<link rel="stylesheet" href="<?php echo URL; ?>public/fullscreen-fonts/BebasNeue-webfont.ttf" />
<link rel="stylesheet" href="<?php echo URL; ?>public/fullscreen-fonts/BebasNeue-webfont.woff" />
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/fullscreen-demo.css" />
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/fullscreen-style.css" />
<script src="<?php echo URL; ?>public/js1/modernizr.custom.86080.js"></script>

<!-- ARROW BOX SIGN UP -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/arrow-box-signup.css"/>

<!-- BANNER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/banner.css"/>

</head>
<body id="page">
	<ul class="cb-slideshow">
    	<li><span>Image 01</span><div><h3>Flexibility</h3></div></li>
        <li><span>Image 02</span><div><h3>Connectivity</h3></div></li>
        <li><span>Image 03</span><div><h3>Cross-Design</h3></div></li>
        <li><span>Image 04</span><div><h3>Web-Artisan</h3></div></li>
        <li><span>Image 05</span><div><h3>Tech-Mobility</h3></div></li>
        <li><span>Image 06</span><div><h3>Cordova</h3></div></li>
    </ul>
        
	<!-- STICKY HEADER -->
	<header class="sticky">
    
        <!-- NAV -->
        <nav>
           <a href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/images/logo/logo-white.png" class="img-responsive"/></a>
           <div class="mobile-toggle"> 
               <span></span> 
               <span></span> 
               <span></span> 
           </div>
           <ul>
               <li><a href="<?php echo URL; ?>">Home</a></li>
               <li>
               	<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>'>Properties for sale</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>                    
                        <li>
                        	<a href='<?php echo URL; ?>on_show/'>Property On Show</a> 
                            <span>On show</span>
                        </li>                        
                    </ul>">
                   For Sale
                </a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>to_rent/'>Properties to rent</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>  
                    </ul>">
                   To Rent
                </a>
               </li>
               <li>
               		<a href="#community">
                   		Community
                	</a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>ads_for_sale/'>Advertise for sale</a> 
                            <span>Advertise your property for sale</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_to_rent/'>Advertise to rent</a> 
                            <span>Advertise your property to rent</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_on_show/'>Advertise on show</a> 
                            <span>Advertise your property on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq/'>About</a> 
                            <span>About Us</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
               <li><a href="<?php echo URL; ?>price_model/">Price Model</a></li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>login/'>Login</a> 
                            <span>Access property resources and meet the community</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>signup/'>Register property profile</a> 
                            <span>Register as agent as well as private for property listings</span>
                        </li>                        
                    </ul>">
                   Account
                </a>
               </li>
          </ul>          
        </nav>
        <!-- END NAV -->
        
	</header>
    <!-- END STICKY HEADER -->
    
    <!-- TOP HEADER -->
    <header class="top-header">
    
    	<!-- NAV -->
        <nav>
           <a href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/images/logo/logo.png" class="img-responsive"/></a>
           <div class="mobile-toggle"> 
               <span></span> 
               <span></span> 
               <span></span> 
           </div>
           <ul>
               <li><a href="<?php echo URL; ?>">Home</a></li>
               <li>
               	<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>'>Properties for sale</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>                    
                        <li>
                        	<a href='<?php echo URL; ?>on_show/'>Property On Show</a> 
                            <span>On show</span>
                        </li>                        
                    </ul>">
                   For Sale
                </a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>to_rent/'>Properties to rent</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>  
                    </ul>">
                   To Rent
                </a>
               </li>
               <li>
               		<a href="#community">
                   		Community
                	</a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>ads_for_sale'>Advertise for sale</a> 
                            <span>Advertise your property for sale</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_to_rent/'>Advertise to rent</a> 
                            <span>Advertise your property to rent</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_on_show/'>Advertise on show</a> 
                            <span>Advertise your property on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq/'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>about/'>About</a> 
                            <span>About Us</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
				<li><a href="<?php echo URL; ?>price_model/">Price Model</a></li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                		<li>
                        	<a href='<?php echo URL; ?>login/'>Login</a> 
                            <span>Access property resources and meet the community</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>signup/'>Register property profile</a> 
                            <span>Register as agent as well as private for property listings</span>
                        </li>                        
                    </ul>">
                   Account
                </a>
               </li>
          </ul>         
        </nav>
        <!-- END NAV -->
	</header>
    <!-- END TOP HEADER -->
    
    <!-- SECTION -->
    <div class="container">
    	<div class="row">
        	<h2>Sign as agent</h2>
            <p style="text-align:center">
                 <i style="color:red" class="glyphicon glyphicon-time"></i> Time estimated for registration is 2 minutes<br /> 
            </p>
        	<form method="post" action="<?php echo URL; ?>signup/addAgent">
				<div class="form-group">
                	<div class="col-lg-6">
                    	<input type="text" class="form-control" name="firstname" placeholder="First name" required 
                        data-bv-notempty-message="The first name is required and cannot be empty" tabindex="0" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="lastname" placeholder="Last name" required 
                        data-bv-notempty-message="The last name is required and cannot be empty" tabindex="1" />
                    </div>
                    </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="email" placeholder="Email" required 
                        data-bv-notempty-message="The email is required and cannot be empty" tabindex="2" />
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <input type="password" class="form-control" name="password" placeholder="Password" required 
                        data-bv-notempty-message="The password is required and cannot be empty" tabindex="3" />
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <input type="password" class="form-control" name="re-password" placeholder="Re Password" required 
                        data-bv-notempty-message="The re-password is required and cannot be empty" tabindex="4" />
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="phone" placeholder="Phone" required 
                        data-bv-notempty-message="The phone number is required and cannot be empty" tabindex="5" />
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="type" 
                        data-bv-notempty-message="agent type is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Agent Type</option>
                            <option>Estate Agent</option>
                            <option>Private</option>
                        </select>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-6">
                    	<!-- default selected option -->
                        <select class="form-control" name="gender" 
                        data-bv-notempty-message="The gender is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Gender</option>
                            <!-- gender array loop -->
                            <?php
								$gAr = array('Male', 'Female');
								foreach($gAr as $val){
									if($val == $gender){
										$selected = "selected";
									}else{
										$selected = "";
								}
							?>
                            <!-- end gender array loop --> 
                                    
                            <!-- selected gender value --> 
                            <option value="<?php echo $val?>" <?php echo $selected?>>
                               <?php echo $val?>
                            </option>
                           <?php
							}
						    ?>
                                    <!-- end selected gender value -->  
                        </select>                        
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="agency" 
                        data-bv-notempty-message="The agency is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Company</option>
                            <option>Private</option>
                            <?php foreach($agencies->getAgencies() as $agency): ?>
                                <option value="<?php echo $agency->getAgencyID(); ?>">
									<?php echo $agency->getAgencyName(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <select class="form-control" name="province" id="province" 
                        data-bv-notempty-message="The province is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Provice</option>
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
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <select class="form-control" name="municipality" id="municipality" 
                        data-bv-notempty-message="The municipality is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Municipality</option>
                        </select>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <select class="form-control" name="city" id="city" 
                        data-bv-notempty-message="The city is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select City</option>
                        </select>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-12">
                        <select class="form-control" name="suburb" id="suburb" 
                        data-bv-notempty-message="The suburb is required and cannot be empty" tabindex="6">
                        	<option value="" selected="selected">Select Suburb</option>
                        </select>
                    </div>
               </div>
               <div class="form-group">
                   <div class="col-lg-12">
                      <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                   </div>                  
               </div>
               <div class="term">
                 <input type="checkbox" checked /> <p>As you sign up you agree to our Terms ans Policy</p> 
              	</div>
               <p style="text-align:center">
                 <a href=""> Read our Terms ans Policy</a> 
           	   </p>
            </form>
    	</div>
    </div>
    <!-- END SECTION -->
    
    
    <!--
        ------------------------------------------------------------------------
        	JAVASCRIPT LIBRARIES
        -------------------------------------------------------------------------
        >
        
        <!-- jQuery 2.0.2 -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jquery-2.1.3.min.js"></script>
        
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
        
        <!-- BOOTSTRAP -->
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- BOOTSTRAP POPOVER -->
        <script>
			$(function () {
				 $('.example-popover').popover({
					container: 'body'
				 })
			})
				
			$(function () {
				  //$('[data-toggle="popover"]').popover({html:true});
				 $('[data-toggle="popover"]').popover();
			})
		</script>
        
        <!-- JQUERY SCROLL TOGGLE -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jquery.scroll-toggle.js"></script>
        
        <!-- JSSOR SLIDER -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jssor.slider-27.1.0.min.js"></script>
        
        <!-- JSSOR SLIDER ENGINE -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jssor.slider-engine.js"></script>
        
        <!-- FOOTER HEIGHT -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/footer-height.js"></script>
        
        <!-- REVOLUTION SLIDER -->
       <!-- <script src="../public/js/jquery-1.11.2.min.js"></script>-->
		<!--<script src="../public/js/bootstrap.min.js"></script>-->
		<script src="<?php echo URL; ?>public/js/jquery-ui.min.js"></script>
		<script src="<?php echo URL; ?>public/js/wow.min.js"></script>

		<!-- slider-pro-master -->
		<script src="<?php echo URL; ?>public/assets/slider-pro-master/js/jquery.sliderPro.min.js"></script>

		<script src="<?php echo URL; ?>public/assets/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<script src="<?php echo URL; ?>public/js/isotope.pkgd.min.js"></script>
		<script src="<?php echo URL; ?>public/js/jquery.placeholder.min.js"></script>
		<script src="<?php echo URL; ?>public/js/theme.js"></script>
        
        <!-- CAROUSEL SLIDER -->
       <script src="<?php echo URL; ?>public/carousel-slider/script.js"></script>
        
        <!-- OWL CAROUSEL -->
        <script src="<?php echo URL; ?>public/carousel-slider/owl-carousel/owl.carousel.js"></script>
        
        <!-- SERVICE GUIDE JAVASCRIPTS -->
        <script src="<?php echo URL; ?>public/service-guide/js/wow.js"></script>
        <script src="<?php echo URL; ?>public/service-guide/js/custom.js"></script>       
</body>
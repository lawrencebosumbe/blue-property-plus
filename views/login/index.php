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
	
	$agent = new Agent();
	$agents = new AgentDB();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title>Login</title>
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
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/arrow-box-login.css"/>

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
                        <li>
                        	<a href='<?php echo URL; ?>auction/'>Auction</a> 
                            <span>Bid a property on immediate deal</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies/agents/'>Find Agent</a> 
                            <span>Real estate professional for assistance</span>
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
                        	<a href='<?php echo URL; ?>to_rent'>Properties to rent</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>  
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies/agents'>Find Agent</a> 
                            <span>Real estate professional for assistance</span>
                        </li>
                    </ul>">
                   To Rent
                </a>
               </li>
               <li>
               		<a href="<?php echo URL; ?>back_office">
                   		Community
                	</a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                    	<li>
                        	<a href='<?php echo URL; ?>price_model'>Price Model</a> 
                            <span>Pay-on-Demand customized pricing model </span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>why_listing_with_us'>Why listing with us</a> 
                            <span>Out of the box flexi model of property revolution</span>
                        </li>
                		<li>
                        	<a href='<?php echo URL; ?>property_listing'>List your property</a> 
                            <span>List for sale, to rent or on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>service_guide'>Property Guide</a> 
                            <span>Decor, guides, inner city and neighbourhood </span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies'>Real Estate Agencies</a> 
                            <span>South African Real Estate agencies</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>app'>Application Software</a> 
                            <span>Own a customized Property App</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
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
                        	<a href='<?php echo URL; ?>on_show'>Property On Show</a> 
                            <span>On show</span>
                        </li>                        
                        <li>
                        	<a href='<?php echo URL; ?>auction'>Auction</a> 
                            <span>Bid a property on immediate deal</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies/agents'>Find Agent</a> 
                            <span>Real estate professional for assistance</span>
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
                        	<a href='<?php echo URL; ?>to_rent'>Properties to rent</a> 
                            <span>Spacious and fabulous properties in prime locations</span>
                        </li>  
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies/agents'>Find Agent</a> 
                            <span>Real estate professional for assistance</span>
                        </li>
                    </ul>">
                   To Rent
                </a>
               </li>
               <li>
               		<a href="<?php echo URL; ?>back_office">
                   		Community
                	</a>
               </li>
               <li>
               		<a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" data-trigger="focus"  data-container="body"
                data-html="true"
                data-content="
                	<ul>
                    	<li>
                        	<a href='<?php echo URL; ?>price_model'>Price Model</a> 
                            <span>Pay-on-Demand customized pricing model </span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>why_listing_with_us'>Why listing with us</a> 
                            <span>Out of the box flexi model of property revolution</span>
                        </li>
                		<li>
                        	<a href='<?php echo URL; ?>property_listing'>List your property</a> 
                            <span>List for sale, to rent or on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>service_guide'>Property Guide</a> 
                            <span>Decor, guides, inner city and neighbourhood </span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>agencies'>Real Estate Agencies</a> 
                            <span>South African Real Estate agencies</span>
                        </li>
                        <hr />
                        <li>
                        	<a href='<?php echo URL; ?>app'>Application Software</a> 
                            <span>Own a customized Property App</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
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
      

    <!-- CONTAINER -->
    <div class="container">  
        
        <!-- ROW -->
        <div class="row">
            <h2>Login as agent</h2>
            <p style="text-align:center">
                 Listing properties, post and comment articles 
            </p>

           <form method="post" class="form-horizontal" action="login/login">
               <div class="form-group">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="email" placeholder="Email" />
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-lg-12">
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                   </div>
               </div>                     
               <div class="form-group">
                   <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <!--<input type="submit" class="btn btn-primary btn-block" value="Login as Agent">-->
                  </div>
               </div>
               <p style="text-align:center">
                 <a href="<?php echo URL; ?>signup">Register Now</a> 
           	   </p>
           </form>
     </div>
     <!-- END ROW -->
           
 </div>
    
    <!--
        ------------------------------------------------------------------------
        	JAVASCRIPT LIBRARIES
        -------------------------------------------------------------------------
        >
        
        <!-- jQuery 2.0.2 -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jquery-2.1.3.min.js"></script>
		</script>
        <!-- BOOTSTRAP -->
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
        
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
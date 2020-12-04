<?php 	
	//Session::init();

	$property = new Property();
	$properties = new PropertyDB();
	
	$propertyImages = $this->umhlabuyalingana;
	$suburb = $this->getPropertySuburb;
	$agent = $this->getPropertyAgent;
	
	$suburbs = new SuburbDB();
	$sub = new Suburb();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title><?php //echo $suburb->getSuburbName(); ?></title>
<!--
 ---------------------------------------------------------------
       STYLES
 ---------------------------------------------------------------
 >
 
<!-- BOOTSTRAP -->
<!--<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.css"/>-->
<link href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HEADER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/header.css"/>

<!-- FOOTER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/footer.css"/>

<!-- MAIN -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/styles.css"/>

<!-- SERVICE GUIDE STYLES -->
<link href="<?php echo URL; ?>public/service-guide/css/style.css" rel="stylesheet"/>
<link href="<?php echo URL; ?>public/service-guide/css/default-animation.css" rel="stylesheet"> 
<link href="<?php echo URL; ?>public/service-guide/fonts/flaticon/flaticon.css" rel="stylesheet">
<link href="<?php echo URL; ?>public/service-guide/css/range-slider.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>public/service-guide/css/color.css" id="color-change">

<!-- PROPERTY CARD -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/card.css"/>
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/ads-card.css"/>

<!-- PROPERTY CARD SIDEBAR -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/card-sidebar.css"/>

<!-- BLUE PROPERTY -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/component-box.css"/>

<!-- LIGHT GALLERY -->
<link href="<?php echo URL; ?>public/lightgallery/css/lightgallery.css" rel="stylesheet">
<link href="<?php echo URL; ?>public/lightgallery/css/page.css" rel="stylesheet">

<!-- LIGHT GALLERY HEADER -->
<link href="<?php echo URL; ?>public/css1/lightgallery-home.css" rel="stylesheet">

</head>
<body>
	
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
                        	<a href='<?php echo URL; ?>to_rent'>Properties to rent</a> 
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
                        	<a href='<?php echo URL; ?>ads_to_rent'>Advertise to rent</a> 
                            <span>Advertise your property to rent</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_on_show'>Advertise on show</a> 
                            <span>Advertise your property on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>About</a> 
                            <span>About Us</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
               <li><a href="<?php echo URL; ?>price_model">Price Model</a></li>
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
                        	<a href='<?php echo URL; ?>to_rent'>Properties to rent</a> 
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
                        	<a href='<?php echo URL; ?>ads_to_rent'>Advertise to rent</a> 
                            <span>Advertise your property to rent</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>ads_on_show'>Advertise on show</a> 
                            <span>Advertise your property on show</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>FAQ</a> 
                            <span>Frequently Asked Questions</span>
                        </li>
                        <li>
                        	<a href='<?php echo URL; ?>faq'>About</a> 
                            <span>About Us</span>
                        </li>
                    </ul>">
                   Services
                </a>
               </li>
				<li><a href="<?php echo URL; ?>price_model">Price Model</a></li>
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
    
    <?php
	if(!empty($propertyImages)){
		$imageURLLarge = URL.$propertyImages[0]['image_location'];
		$propertyID = $propertyImages[0]['property']['property_id'];
		$propertyDesc = $propertyImages[0]['property']['property_desc'];
		$status = $propertyImages[0]['property']['property_status'];
		$propertyStreetNo = $propertyImages[0]['property']['street_no'];
		$propertyStreetName = $propertyImages[0]['property']['street_name'];
		$propertyPrice = $propertyImages[0]['property']['price'];
		$propertyBath = $propertyImages[0]['property']['num_bathrooms'];
		$propertyBed = $propertyImages[0]['property']['num_beds'];
		$propertyGarage = $propertyImages[0]['property']['num_garages'];
		$propertyLounge = $propertyImages[0]['property']['num_lounges'];
		$propertyAC = $propertyImages[0]['property']['air_con'];
		$propertyPool = $propertyImages[0]['property']['pool'];
		$propertyCottage = $propertyImages[0]['property']['cottage'];
		$firstname = $propertyImages[0]['property']['firstname'];
		$lastname = $propertyImages[0]['property']['lastname'];
		$phone = $propertyImages[0]['property']['phone'];
		$image = $propertyImages[0]['property']['image'];
	}
	?>
    
    <!-- SECTION -->   
    <section> 
    
    	<div class="container">
    
    	<!-- GALLERY WRAPPER -->
        <div class="gallery-wrapper">
        
        	<!-- ROW -->
            <div class="row lightgallery-header">
                	
               <!-- COLUMN -->
               <div class="col-md-8">
               		<h4 class="hd1"><?php echo $suburb->getCity()->getCityName(); ?></h4>
                    <p><?php echo $suburb->getSuburbName(); ?></p>
               </div>               
               <div class="col-md-4 price-tag">
                    <p><?php echo $status; ?></p>
                     <h3 class="hd2"><?php echo $propertyPrice; ?></h3>                        
               </div>
               <!-- END COLUMN -->
                    
           </div>
           <!-- END ROW -->
           
        </div>
        <!-- END GALLERY WRAPPER -->
        
    </div>  
    <section> 
    <!-- SECTION --> 
    
  	<!-- SECTION -->   
    <section>  
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="position-relative galleryTrigger item--category-4">
					<?php if(!empty($imageURLLarge)){ ?>
						<img src="<?php echo $imageURLLarge; ?>" class="responsive-img">
						<i class="glyphicon glyphicon-fullscreen sk-iconExpand"></i>
						<div class="text-center position-absolute pos">
							<span class="sk-imageCount"><i class="far fa-clone ml-2"></i> Photos <span class="sk-grey"><?php echo count($propertyImages); ?></span></span>
						</div>
					<?php } ?>
                    <span class="listing__plus"></span>
                </div>
                <div class="sk-heading">
                    <h4>Property ID: <span>bp-plus-<?php echo $propertyID; ?></span></h4>
                    <div class="sk-stat clearfix"> 
                      <?php echo $propertyStreetNo; ?> <span class="sk-grey pl-2 pr-1"><?php echo $propertyStreetName; ?> street, </span> 					<span class="sk-grey pl-2 pr-1"><?php echo $suburb->getSuburbName(); ?></span>
                      <!--<?php //echo $propertyBath; ?> <span class="sk-grey pl-2 pr-1">Baths</span> -->
                      <!--<?php //echo $propertyGarage; ?> <span class="sk-grey pl-2 pr-1">Garages</span>-->
                    </div>
                </div>
                
                <div class="info-table row">
                  <ul class="list-unstyled col-sm-4 pl-0">
                    <li><span class="sk-grey">Beds</span> <strong class="pl-3"><?php echo $propertyBed; ?></strong></li>
                    <li><span class="sk-grey">Bathroom</span> <strong class="pl-3"><?php echo $propertyBath; ?></strong></li>
                  </ul>
                  <ul class="list-unstyled col-sm-4">
                      <li><span class="sk-grey">Garages</span> <strong class="pl-3"><?php echo $propertyGarage; ?></strong></li>
                      <li><span class="sk-grey">Cottage</span> <strong class="pl-3"><?php echo $propertyCottage; ?></strong></li>
                      
                  </ul>
                  <ul class="list-unstyled col-sm-4">
                      <li><span class="sk-grey">Lounges</span> <strong class="pl-3"><?php echo $propertyLounge; ?></strong></li>
                      <li><span class="sk-grey">Pool</span> <strong class="pl-3"><?php echo $propertyPool; ?></strong></li>
                  </ul>
                </div>
                <div class="content">
                  <p><?php echo $propertyDesc; ?></p>
                  <h4 class="mt-3">Key Property Features</h4>
                  <div class="stat-data row pt-3">
                    <ul class="list-unstyled col-sm-4 col-6">
                      <li><span class="badge badge-light big-badge"><?php echo $propertyBed; ?></span>  Bedrooms</li>
                      <li><span class="badge badge-light big-badge"><?php echo $propertyBath; ?></span>  Bathrooms</li>
                      <li><span class="badge-type"><i class="glyphicon glyphicon-ok green"></i></span>  Covered Parking</li>
                    </ul>
                    <ul class="list-unstyled col-sm-4 col-6">
                        <li><span class="badge badge-light big-badge"><?php echo $propertyGarage; ?></span>  Garages</li>
                        <li><span class="badge badge-light big-badge"><?php echo $propertyLounge; ?></span>  Lounges</li>
                        <li><span class="badge-type"><i class="glyphicon glyphicon-ok green"></i></span>  Pet Friendly</li>
                      </ul>
                      <ul class="list-unstyled col-sm-4 col-6">
                          <li><span class="badge badge-light big-badge"><?php echo $propertyPool; ?></span>  Pool</li>
                        </ul>
                  </div>
                  
                </div>
               
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
               <aside class="banner-add d-flex flex-column justify-content-center align-items-center">
                  <div class="text-center pb-5">
                  	<figure>
                    	<img src="<?php echo URL; ?><?php echo $image; ?>" />
                    </figure>
                    <h5><?php echo $firstname . ' ' . $lastname; ?></h5>
                    <p>Agent</p>
                  </div>
                  <button class="btn phone" id="clickMe">
                  	<span class="glyphicon glyphicon-earphone"></span> 
                    <span id="toggleButton">Show Number</span>
                    <span id="disclaimer" style="display:none"><?php echo $phone; ?></span>
                  </button>
                  <div class="pt-5">
                      Property in <?php echo $suburb->getSuburbName(); ?> 
                    </div>
               </aside>
               <aside class="contact-agent mt-3">
                  <h4 class="text-center mb-3">Contact Agent</h4>
                  <form>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Your Details</label>
                        <input type="text" class="form-control" name="name" placeholder="Your name">
                        
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Your email">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Your phone number">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Your Message</label>
                          <textarea class="form-control" name="message" rows="3">Please contact me regarding this property</textarea>
                          
                      </div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-orange btn-block">Email Agent</button>
                      <!--<button type="submit" class="btn btn-callback">Call Me Back</button>-->
                      </div>
                    </form>
               </aside>
               <p class="mt-2">By sending you agree to <a href="#">terms and conditions</a></p>
            </div>
        </div>
        <hr class="mt-0">
    </div>
    </section>
    <!-- END SECTION -->   
 
    <section>
      <div class="container pt-3 no-gutter">
			<h3 class="text-center mb-4">Photo Gallery</h3>
			<div class="row text-center text-lg-left" id="lightgallery">
				<?php if(!empty($propertyImages)){ $i=0; foreach($propertyImages as $piRow){ $i++;
					$imageURL = URL.$piRow['image_location'];
					$imgResponsive = $imageURL.' 375, '.$imageURL.' 480, '.$imageURL.' 800';
					$desc = '<h4>'.$piRow['property']['street_name'].'</h4><p>'.trim($piRow['property']['property_desc']).'</p>';
				?>
				<div class="col-lg-4 col-md-4 col-xs-6 gallery-thumb" data-responsive="<?php echo $imgResponsive; ?>" data-src="<?php echo $imageURL; ?>" data-sub-html="<?php echo $desc; ?>">
				  <a href="<?php echo $imageURL; ?>" class="d-block mb-3 h-100">
						<img class="img-fluid img-thumbnail" src="<?php echo $imageURL; ?>" alt="">
				  </a>
				</div>
				<?php } } ?>
            </div>
      </div>
    </section>
    
    <section>
    
    	<!-- CONTAINER -->
    	<div class="container">
        
        	<!-- PROPERTIES LISTING -->
        	<div class="properties-listing similar-properties">
            	<h2>Similar Properties</h2>
           		
                 <!-- ROW -->
				
				<div class="row">
                	<?php foreach($properties->getUmhlabuyalinganaSimilarPropertyOnShow() as $property):
						$municpName = $property->getSuburb()->getCity()->getMunicipality()->getMunicipalityName();
						$municpSlug = str_replace('city of', '', strtolower($municpName));
						$municpSlug = str_replace('city', '', $municpSlug);
						$municpSlug = str_replace(' ', '_', trim($municpSlug));
						$subSingleURL = URL.'umhlabuyalingana/on_show_suburb/'.$property->getSuburb()->getSuburbID().'/';
						$citySingleURL = URL.'umhlabuyalingana/on_show_city/'.$property->getSuburb()->getCity()->getCityID().'/';
					?>
                    
                    <!-- COL -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    	<div class="properties item--category-4">
                        	<a href="<?php echo $subSingleURL; ?>">
                            <figure class="image-holder">
                                <img src="<?php echo URL; ?><?php echo $property->getImageLocation(); ?>"
                                alt="<?php echo $property->getImageAltText(); ?>"/>                      
                            </figure>
							</a>
                            <div class="list__cat">
                                <span class="label list__cat-label-4">On Show</span>
                                <span class="price">
                                    <?php echo 'R ' . substr($property->getPrice(), 0, 1) . ', '
                                                    . substr($property->getPrice(), 1, 3) . ', '
                                                    . substr($suburb->getPrice(), 4, 3); 
                                    ; ?>
                                </span>                                    
                           </div>
                           <div class="listing-title">
                               <a href="#" class="listing__plus"></a>
                               <h4><a href="<?php echo $subSingleURL; ?>"><?php echo $property->getPropertyType() . ' in ' . $property->getSuburb()->getSuburbName(); ?></a></h4>
                           </div>
                            <div class="listing__footer">
                               <figure>
                                  <img src="<?php echo URL; ?><?php  echo $property->getAgent()->getAgency()->getLogo(); ?>"/>
                               </figure>
                               <ul>
                                   <li>
                                        <span><?php  echo $property->getNumBed(); ?></span>
                           	            <img src="<?php echo URL; ?>public/images/properties/icons/icon-bed.png"/>
                                  </li>
                                  <li>
                                        <span><?php echo $property->getNumBathRoom(); ?></span>
                                        <img src="<?php echo URL; ?>public/images/properties/icons/icon-bath.png"/>
                                  </li>
                                  <li>
                                        <span><?php echo $property->getNumGarage(); ?></span>
                                        <img src="<?php echo URL; ?>public/images/properties/icons/icon-garage.png"/>
                                  </li>
                               </ul>
                                    <span><a href="<?php echo $citySingleURL; ?>" class="view-all">viewl all</a></span>
                           </div>
                           
                        </div>
                        
                    </div>
                    <!-- END COL -->
                    
                    <?php endforeach; ?>
    			</div>
                <!-- END ROW -->
                    
        	</div>
            <!-- END PROPERTIES LISTING -->
            
          </div>
          <!-- END CONTAINER -->

    </section>
    
    <div id="contacts"></div>
	<footer>
        
        <!-- CONTAINER -->
        <div class="container">
        	
            <!-- FOOTER LINKS -->
            <div class="footer-links">
            
                <!-- ROW -->
                <div class="row">    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="footer-links-ul">
                            <li class="footer-links__li">
                            <h4>Services</h4>
                            	<a href="<?php echo URL; ?>service_guide/">Property Guide</a><br/>                              
                              	<a href="<?php echo URL; ?>service_guide/inner_city">Inner Cities</a><br/>
                              	<a href="<?php echo URL; ?>service_guide/neighborhood">Neighboorhood</a><br/>
                                <a href="<?php echo URL; ?>price_model">Price Model</a><br/>                                
                                <a href="<?php echo URL; ?>faq">FAQ</a><br/>
                                <a href="<?php echo URL; ?>app">Real Estate App</a><br/>
                            </li>
        
                            <li class="footer-links__li">
                            <h4>Media</h4>
                            	<a href="<?php echo URL; ?>back_office">Recents Posts</a><br/>
                            	<a href="<?php echo URL; ?>login">Login</a><br/>
                            	<a href="<?php echo URL; ?>signup">Create an Account</a><br/>
                            </li>
                            
                            <li class="footer-links__li">
                            <h4>Properties</h4>
                            	<a href="<?php echo URL; ?>">For Sales</a><br/>
                              	<a href="<?php echo URL; ?>to_rent">To Rent</a><br/>
                              	<a href="<?php echo URL; ?>on_show">On Show</a><br/>   
                              	<a href="<?php echo URL; ?>back_office">List Your Property</a><br/>  
                                <a href="<?php echo URL; ?>why_list_with_us">Why Listing With Us</a><br/>  
                                <a href="<?php echo URL; ?>agencies">Estate Agents</a><br/>                     
                            </li>
                            
                            <li class="footer-links__li">
                            	<h4>About Us</h4>
                            	<a href="<?php echo URL; ?>about/">About Us</a><br/>
                              	<a href="<?php echo URL; ?>contact/">Contact Us</a><br/>
                            </li>
                         </ul>  
                     </div>           
                </div>
                <!-- ROW -->
            
            </div>
            <!-- FOOTER LINKS -->
            
        </div>
        <!-- END CONTAINER -->
        
         <!-- Social media -->
        <div class="container">
          	<div class="social">
                 <div class="row">
                     <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                         <ul class="social-logos">
                              <li class="social__item">
                                  <a href="#"><img src="<?php echo URL; ?>public/images/social/facebook.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="<?php echo URL; ?>public/images/social/twitter.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="<?php echo URL; ?>public/images/social/google-plus.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="<?php echo URL; ?>public/images/social/linkedin.png" alt=""></a>
                              </li>       
                         </ul>
                    </div>
                </div>
          	</div>
        </div>
        <!-- Social media / End -->
        
        <!-- Sponsors -->
        <div class="container">
        	<!--
          	<div class="sponsors">
          		<div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                     
                        <h6 class="sponsors-title">Our Sponsors:</h6>
                        <ul class="sponsors-logos">
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-visa.png" alt=""></a>
                          </li>
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-discover.png" alt=""></a>
                          </li>
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-paypal.png" alt=""></a>
                          </li>
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-skrill.png" alt=""></a>
                          </li>
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-westernunion.png" alt=""></a>
                          </li>
                          <li class="sponsors__item">
                            <a href="#"><img src="<?php echo URL; ?>public/images/sponsors/sponsor-payoneer.png" alt=""></a>
                          </li>
                        </ul>            
            		</div>
            	</div>
          	</div>
            -->
        </div>
        <!-- Sponsors / End -->
        
        <!-- BOTTOM FOOTER -->
        <div class="footer-secondary">
            <div class="container">
            
                <!-- ROW -->
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        	<p>Designed and Developed By Lawrence E Bosumbe &nbsp;&nbsp;| &nbsp;&nbsp;&copy; 2018 Blue Property Plus. All Rights Reserved</p>
                        </div>
                    </div>
                <!-- END ROW -->
                
            </div>
        </div>
        <!-- END BOTTOM FOOTER -->
    </footer>
	<!--
        ------------------------------------------------------------------------
        	JAVASCRIPT LIBRARIES
        -------------------------------------------------------------------------
        >
        
        <!-- JQUERY -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jquery-2.1.3.min.js"></script>
        
        <!-- LIGHT GALLERY -->
        <script type="text/javascript">
        $(document).ready(function(){
             $('#lightgallery').lightGallery();
             
             $('.galleryTrigger').on('click', function(){
                $('.gallery-thumb').trigger('click');
             });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function () {
            //Disable full page
            $("body").on("contextmenu",function(e){
                return false;
            });
            
            //Disable part of page
            $("#id").on("contextmenu",function(e){
                return false;
            });
        });
        </script>
        
        <!-- JQUERY UI -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jqueryUI.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/city-single/js/ads.js"></script>
        
        <!-- BOOTSTRAP -->
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.js"></script>
	        
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
        
        <!-- FOOTER HEIGHT -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/footer-height.js"></script>
             
        <!-- CAROUSEL SLIDER -->
       <script src="<?php echo URL; ?>public/carousel-slider/script.js"></script>
        
        <!-- OWL CAROUSEL -->
        <script src="<?php echo URL; ?>public/carousel-slider/owl-carousel/owl.carousel.js"></script>
             
        <script src="<?php echo URL; ?>public/lightgallery/js/lightgallery-all.min.js"></script>
        <script src="<?php echo URL; ?>public/lightgallery/lib/jquery.mousewheel.min.js"></script>
        <script>
        /*
            $(document).ready(function(){
                $("#clickMe").click(function() {
                    $("#showphone").hide('slow');
                    $("#phone").show('slow');
                });
            });
            */
            
            $(document).ready(function(){
              $('#toggleButton').click(function(){
                $('#disclaimer').toggle();
                
                if($('#disclaimer').is(':visible')) {
                  $(this).val('Hide');
                } else {
                  $(this).val('Show');
                }
              });
            });
        </script>
</body>
</html>
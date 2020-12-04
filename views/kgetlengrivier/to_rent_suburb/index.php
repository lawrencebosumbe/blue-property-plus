<?php 	
	$province_id = isset($_GET['province_id']) ? $_GET['province_id'] : "8";		
	$municipality_id = isset($_GET['municipality_id']) ? $_GET['municipality_id'] : "186";
	
	$municipality = new Municipality();
	$municipalities = new MunicipalityDB();
	
	$suburbs = new SuburbDB();
	$suburb = new Suburb();
	$suburb = $this->kgetlengrivier;
	
	$city = new City();
	$cities = new CityDB();
		
	$property = new Property();
	$properties = new PropertyDB();
	
	$property = new Ads();
	$properties = new AdsDB();
	
	/*
	 * Pagination Functionality
	 -------------------------------------------------------------
	 */
	$limit = 2;
    $offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;
    
    //get number of rows
    $rowCount = $suburbs->getPropertyBySuburbToRent($suburb->getSuburbID(), array('count'=>1));
    
    //initialize pagination class
    $pagConfig = array(
        'baseURL'=> URL.'kgetlengrivier/to_rent_suburb/'.$suburb->getSuburbID().'/',
        'totalRows'=>$rowCount,
        'perPage'=>$limit
    );
    $pagination =  new Pagination($pagConfig);
    
    //get rows
	$propertyData = $suburbs->getPropertyBySuburbToRent($suburb->getSuburbID(), array('limit'=>"$offset,$limit"));
	
	
	/*
	 * List Suburbs
	 */
	$suburbLimit = 15;
	$suburbRowCount = $suburbs->getCitySuburbs($city->getCityID(), array('count'=>1));
	$suburbData = $suburbs->getCitySuburbs($city->getCityID());
	
	/*
	 * List Cities
	 */
	$cityLimit = 15;
	$cityRowCount = $cities->getMunicipalityCities($municipality_id, array('count'=>1));
	$cityData = $cities->getMunicipalityCities($municipality_id);
	
	/*
	 * List Municipalities
	 */
	 
	$municLimit = 15;
	$municRowCount = $municipalities->getProvinceMunicipalities($province_id, array('count'=>1));
	$municData = $municipalities->getProvinceMunicipalities($province_id);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title><?php echo $suburb->getSuburbName(); ?></title>
<!--
 ---------------------------------------------------------------
       STYLES
 ---------------------------------------------------------------
 >
 
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.css"/>

<!-- HEADER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/header.css"/>

<!-- FOOTER -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/footer.css"/>

<!-- MAIN -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/styles.css"/>

<!-- CITY & SUBURB -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css1/city-suburbs-styles.css"/>
<link rel="stylesheet" href="<?php echo URL; ?>public/city-single/css/style.css"/>
<link rel="stylesheet" href="<?php echo URL; ?>public/city-single/css/ads.css"/>

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

<!-- CITY SINGLE STYLES -->
<link href="<?php echo URL; ?>public/city-single/css/style.css" rel="stylesheet"/>
<link href="<?php echo URL; ?>public/city-single/css/ads.css" rel="stylesheet"/>
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
    
    <!-- SECTION -->          
    <section class="pull-top-85">

    </section>
    <!-- END SECTION -->
    
    
     <!-- SECTION -->   
    <section>
       
       <!-- CONTAINER -->
    	<div class="container">
        
        	<!-- PROPERTIES LISTING -->
        	<div class="single-city-listing">
            	<!--<h2>Listed Properties</h2>-->
           		
            <!-- ROW -->
            <div class="row">   
            <!--         
            	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                	<ul>
                    	<li><a href="<?php echo URL; ?>back_office">List Your Property</a></li>
                        <li><a href="<?php echo URL; ?>">For Sale</a></li>
                        <li><a href="<?php echo URL; ?>to_rent">To Rent</a></li>
                        <li><a href="<?php echo URL; ?>on_show">On Show</a></li>
                        <li><a href="<?php echo URL; ?>service_guide/room_display">House Decor</a></li>
                        <li><a href="<?php echo URL; ?>back_office">Recent Posts</a></li>
                        <li><a href="<?php echo URL; ?>agencies">Find Estate Agent</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                	<ul>
                    	<li><a href="<?php echo URL; ?>price_model">Price Model</a></li>
                        <li><a href="<?php echo URL; ?>why_list_with_us">Why List With Us</a></li>
                        <li><a href="<?php echo URL; ?>faq">FAQ</a></li>
                    </ul>
                </div>
                -->
            </div>
            <!-- END ROW -->			

                <!-- ROW -->			
				<div class="row">
            
            		<!-- COL -->
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    	<div class="ads-card ads-card-torent"> 
                        	<h1>Properties to rent in <?php echo $suburb->getSuburbName(); ?></h1>
                        	<p>Central, Town and Suburbs</p>
                            <?php foreach($properties->getPropertyAdForSale() as $property):
								$municpName = $property->municipality_name;
								$municpSlug = str_replace('city of', '', strtolower($municpName));
								$municpSlug = str_replace('city', '', $municpSlug);
								$municpSlug = str_replace(' ', '_', trim($municpSlug));
								$subrURL = URL.$municpSlug.'/'.'city/'.$property->city_id.'/';
							?>
                                <figure class="image-holder">
                                     <img src="<?php echo URL; ?><?php echo $property->getAgent()->getAgency()->getLogo(); ?>"
                                           alt="<?php echo $property->getImageAltText(); ?>"/>                      
                                 </figure>
                            <?php endforeach; ?>
                            <!--<figure><img src="<?php //echo URL; ?>public/images/properties/logo/remax.png"/></figure>-->
                        </div>
                        <?php foreach($propertyData as $suburb): ?>
                        <!-- CARD -->
                        <div class="card">                            	
                        	<!-- CARD IMAGE -->
                            <div class="card-img item--category-2">
                                <figure>
                                    <a href="<?php echo URL; ?>kgetlengrivier/gallery/<?php echo $suburb->getPropertyID(); ?>">
                                    	<img src="<?php echo URL; ?><?php echo $suburb->getImageLocation(); ?>"/>
                                    </a>
                                </figure>
                                <span class="label list__cat-label-2">To Rent</span>
                                <span class="listing__plus"></span>
                            </div>
                            <!-- END CARD IMAGE -->
                            
                            <!-- CARD SECTION -->
                            <div class="card-section">                          	                                
                            	<!-- SECTION HEADER -->
                            	 <div class="card-header">
                                    <ul>
                                    	<li>
                                       		<figure>
                                           		<img src="<?php echo URL; ?><?php echo $suburb->getAgent()->getImage(); 
											 	?>" />
                                                 <figcaption>
													<?php echo $suburb->getAgent()->getFirstname() . '  ' . 
														$suburb->getAgent()->getLastname(); 
													?>
                                                  </figcaption>
                                            </figure>
                                       </li>
                                                                                          
                                    </ul>                                                        
                                  </div>
                                  <!-- END SECTION HEADER -->
                                  
                                  <!-- SECTION BODY -->
                                  <div class="card-body">
                                    <ul> 
                                    	<li>
											<?php echo 'R ' . substr($suburb->getPrice(), 0, 1) . ', '
                                                    . substr($suburb->getPrice(), 1, 3); 
											?>
                                        </li>                                       
                                        <li>
                                         	Propertyfor to rent. 
                                            <?php echo $suburb->getStreetNo() . ', ' . 
											$suburb->getStreetName() . '<br />' ; ?> 
                                         </li>
                                         <li>
											<?php echo $suburb->getSuburbName(); ?>
                                         </li>
                                    </ul>
                                  </div> 
                                  <!-- END SECTION BODY -->
                                  
                                  <!-- SECTION FOOTER -->                       
                                  <div class="card-footer">
                                    <ul>
                                        <li>
                             				<span><?php echo $suburb->getNumBed(); ?></span>
                                            <img src="<?php echo URL; ?>public/images/properties/icons/icon-bed.png" />
                                        </li>	
                                        <li>
                                        	<span><?php echo $suburb->getNumBathRoom(); ?></span>
                                        	<img src="<?php echo URL; ?>public/images/properties/icons/icon-bath.png" />
                                        </li>	
                                        <li>
                                        	<span><?php echo $suburb->getNumGarage(); ?></span>
                                        	<img src="<?php echo URL; ?>public/images/properties/icons/icon-garage.png" />
                                        </li>	
                                        <li class="card-img-footer">
                                            <img src="<?php echo URL; ?><?php  echo $suburb->getAgent()->getAgency()->getLogo(); ?>" />
                                        </li>	
                                    </ul>
                                  </div>
                                  <!-- END SECTION FOOTER -->                          
                            	
                            </div>  
      						<!-- END CARD SECTION -->
                            
                        </div>
                        <!-- END CARD -->
                    	<?php endforeach; ?>
                        <!-- display pagination links -->
							<?php echo $pagination->createLinks(); ?>
                        	<?php //echo "Put ads tag here!"; ?>
                        <?php //endif; ?>

                	</div>
                	<!-- END COL-->
                
                	<!-- COL -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    	<!-- CITY ITEM -->
                        <div class="city-item image-rotate wow zoomIn" data-wow-delay="300ms" data-wow-duration="500ms">
                        
                        	<!-- CITY TEXT -->
                            <div class="city-text">
                            	<h4>Towns</h4>
                                
                                <!-- LIST OF ALL CITIES HERE -->                                
                                <ul>
									<?php if(!empty($cityData)): $ci=0; foreach($cityData as $town): $ci++;?>
									<li>
                                    	<a href="<?php echo URL.'kgetlengrivier/to_rent_city/'.$town->getCityID(); ?>">
											<?php echo $town->getCityName(); ?>
                                        </a>
                                    	<span class="num-suburbs">
                                               <?php 
                                                  echo $town->getTotalPropertyToRent();
                                               ?>
                                        </span>
                                    </li>
									<?php
									if($ci == $cityLimit){
										echo '<div class="hideSuburbLi" style="display:none;">';
									}
									if(($cityRowCount > $cityLimit) && ($ci == $cityRowCount)){
										echo '</div>';
									}
									?>
									<?php endforeach; endif; ?>
									<?php if($cityRowCount > $cityLimit): ?>
                                    <li>
                                    	<a href="javascript:void(0);" class="showCity">Show all <?php echo $cityRowCount; ?> cities</a></li>
									<?php endif; ?>
                                </ul>                           
                            </div>
                            <!-- END CITY TEXT -->
                            
                        </div>                        
                        <!-- CITY ITEM -->
                        
                        <!-- CITY ITEM -->
                        <div class="city-item image-rotate wow zoomIn" data-wow-delay="300ms" data-wow-duration="500ms">
                        
                        	<!-- CITY TEXT -->
                            <div class="city-text">
                                <?php foreach($properties->getPropertyAdToRent() as $property):
									$municpName = $property->municipality_name;
									$municpSlug = str_replace('city of', '', strtolower($municpName));
									$municpSlug = str_replace('city', '', $municpSlug);
									$municpSlug = str_replace(' ', '_', trim($municpSlug));
									$subSinURL = URL.$municpSlug.'/'.'to_rent_suburb/'.$property->suburb_id.'/';
									$subrURL = URL.$municpSlug.'/'.'to_rent_city/'.$property->city_id.'/';
								?>                               
                           
                           		<!-- ITEM CATEGORY -->
                           		<div class="properties">
                                     <a href="<?php echo $subSinURL; ?>">
                                       	<figure class="image-holder">
                                            <img src="<?php echo URL; ?><?php echo $property->getImageLocation(); ?>"
                                                alt="<?php echo $property->getImageAltText(); ?>"/>                      
                                        </figure>
                                      </a>
                                      <span class="listing-title"></span>
                                      <span class="price">
                                           <?php echo 'R ' . substr($suburb->getPrice(), 0, 1) . ', '
                                                    . substr($suburb->getPrice(), 1, 3) 
													. substr($suburb->getPrice(), 1, 0); 
											?>
                                      </span>
                                      <h4>
                                      <a href="<?php echo $subSinURL; ?>">
                                        <?php echo $property->getPropertyType() . ' in ' . $property->getSuburb()->getSuburbName(); ?>
                                      </a>
                                      </h4>
                                      <div class="image-holder">
                                          <img src="<?php echo URL; ?><?php  echo $property->getAgent()->getAgency()->getLogo(); ?>"/>
                                      </div>
                               </div>>  
                               <!-- END ITEM CATEGORY -->
                                        
								<?php endforeach; ?>
                            </div>
                            <!-- END CITY TEXT -->
                            
                        </div>
                        <!-- END CITY ITEM -->
                        
                        <!-- CITY ITEM -->
                        <div class="city-item image-rotate wow zoomIn" data-wow-delay="300ms" data-wow-duration="500ms">
                        
                        	<!-- CITY TEXT -->
                            <div class="city-text">
                            	<h4>Municipalities in North West</h4>
                                
                                <!-- LIST OF ALL CITIES HERE -->                                
                                <ul>
                                	<?php echo ""; ?>
									<?php if(!empty($municData)): $mi=0; foreach($municData as $municipality): $mi++;?>
									<li>
                                    	<a href="<?php echo URL.'north_west/'.str_replace(' ', '_', trim($municipality->getMunicipalityName())); ?>">
											<?php echo $municipality->getMunicipalityName(); ?>
                                        </a>
                                    	<span class="num-suburbs">
                                               <?php 
                                                  echo $municipality->getTotalPropertyToRent();
                                               ?>
                                        </span>
                                    </li>
									<?php
									if($mi == $municLimit){
										echo '<div class="hideSuburbLi" style="display:none;">';
									}
									if(($municRowCount > $municLimit) && ($mi == $municRowCount)){
										echo '</div>';
									}
									?>
									<?php endforeach; endif; ?>
									<?php if($municRowCount > $municLimit): ?>
                                    <li>
                                    	<a href="javascript:void(0);" class="showMunicipality">
                                        	Show all <?php echo $municRowCount; ?> municipalities
                                        </a>
                                    </li>
									<?php endif; ?>
                                </ul> 
                                                           
                            </div>
                            <!-- END CITY TEXT -->
                            
                        </div>                        
                        <!-- CITY ITEM -->
                        
                        <!-- CITY ITEM -->
                        <div class="city-item image-rotate wow zoomIn" data-wow-delay="300ms" data-wow-duration="500ms">
                        
                        	<!-- CITY TEXT -->
                            <div class="city-text">
                            	<h4>Suburbs</h4>
                                
                                <!-- LIST OF ALL CITIES HERE -->                                
                                <ul>
									<?php if(!empty($suburbData)): $si=0; foreach($suburbData as $suburb): $si++;?>
									<li>
                                    	<a href="<?php echo URL.'kgetlengrivier/to_rent_suburb/'.str_replace('', '_', trim($suburb->getSuburbID())); ?>">
											<?php echo $suburb->getSuburbName(); ?>
                                        </a>
                                    	<span class="num-suburbs">
                                               <?php 
                                                  echo $suburb->getTotalPropertyToRent();
                                               ?>
                                        </span>
                                    </li>
									<?php
									if($si == $suburbLimit){
										echo '<div class="hideSuburbLi" style="display:none;">';
									}
									if(($suburbRowCount > $suburbLimit) && ($si == $suburbRowCount)){
										echo '</div>';
									}
									?>
									<?php endforeach; endif; ?>
									<?php if($suburbRowCount > $suburbLimit): ?>
                                    <li>
                                    	<a href="javascript:void(0);" class="showSuburb">Show all <?php echo $suburbRowCount; ?> suburbs</a></li>
									<?php endif; ?>
                                </ul>                           
                            </div>
                            <!-- END CITY TEXT -->
                            
                        </div>                        
                        <!-- CITY ITEM -->
                                                        
                        
					</div>
                    <!-- END COL -->
                    
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
		<script>
		$(document).ready(function(){
			
			<!-- SHOW SUBURB -->
			$(document).on("click", ".showSuburb", function(){
				$('.hideSuburbLi').slideDown();
				$(this).text('Show less');
				$(this).addClass('hideSuburb');
				$(this).removeClass('showSuburb');
			}); 
			
			<!-- HIDE SUBURB -->
			$(document).on("click", ".hideSuburb", function(){
				$('.hideSuburbLi').slideUp();
				$(this).text('Show all <?php echo $suburbRowCount; ?> suburbs');
				$(this).addClass('showSuburb');
				$(this).removeClass('hideSuburb');
			});
			
			<!-- SHOW CITIES -->
			$(document).on("click", ".showCity", function(){
				$('.hideSuburbLi').slideDown();
				$(this).text('Show less');
				$(this).addClass('hideCity');
				$(this).removeClass('showCity');
			}); 
			
			<!-- HIDE CITIES -->
			$(document).on("click", ".hideCity", function(){
				$('.hideSuburbLi').slideUp();
				$(this).text('Show all <?php echo $cityRowCount; ?> cities');
				$(this).addClass('showCity');
				$(this).removeClass('hideCity');
			}); 
			
			<!-- SHOW MUNICIPALITIES -->
			$(document).on("click", ".showMunicipality", function(){
				$('.hideSuburbLi').slideDown();
				$(this).text('Show less');
				$(this).addClass('hideMunicipality');
				$(this).removeClass('showMunicipality');
			}); 
			
			<!-- HIDE MUNICIPALITIES -->
			$(document).on("click", ".hideMunicipality", function(){
				$('.hideSuburbLi').slideUp();
				$(this).text('Show all <?php echo $municRowCount; ?> municipalities');
				$(this).addClass('showMunicipality');
				$(this).removeClass('hideMunicipality');
			});
		});
		</script>
        <!-- JQUERY UI -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jqueryUI.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/city-single/js/ads.js"></script>
        
        <!-- BOOTSTRAP -->
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.js"></script>
        
        <!--
        ------------------------------------------------------------------------
        	JAVASCRIPT LIBRARIES
        -------------------------------------------------------------------------
        >
        
        <!-- JQUERY -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/jquery-2.1.3.min.js"></script>
        
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
        
        <!-- FOOTER HEIGHT -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js1/footer-height.js"></script>
             
        <!-- CAROUSEL SLIDER -->
       <script src="<?php echo URL; ?>public/carousel-slider/script.js"></script>
        
        <!-- OWL CAROUSEL -->
        <script src="<?php echo URL; ?>public/carousel-slider/owl-carousel/owl.carousel.js"></script>
        
        <!-- SERVICE GUIDE JAVASCRIPTS -->
        <script src="<?php echo URL; ?>public/service-guide/js/wow.js"></script>
        <script src="<?php echo URL; ?>public/service-guide/js/custom.js"></script>
           
</body>
</html>
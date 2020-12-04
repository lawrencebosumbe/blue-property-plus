<?php		
	$provinces = new ProvinceDB();
	$province = new Province();
	
	$municipality = new Municipality();
	$municipalities = new MunicipalityDB();

	$city = new FreeStateProperty();
	$cities = new FreeStatePropertyDB();

	$suburb = new FreeStateProperty();
	$suburbs = new FreeStatePropertyDB();
	
	$property = new FreeStateProperty();	
	$properties = new FreeStatePropertyDB();

	$post = new Post();
	$posts = new PostDB();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title>Tokologo</title> 
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
    
    <!-- BANNER -->
    <div class="banner">               
        	<!-- JSSOR SLIDER -->
            <div style="position:relative;top:0;left:0;width:100%;height:100%;overflow:hidden;">
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:640px;overflow:
                hidden;
                visibility:hidden;">
                
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;
                text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" 
                    src="<?php echo URL; ?>public/images/img/spin.svg" />
                </div>
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:960px;height:640px;overflow:
                hidden;">
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/gauteng/jhb-slide-1.jpg" />              
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/gauteng/jhb-slide-2.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/gauteng/jhb-slide-3.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/gauteng/jhb-slide-4.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/gauteng/jhb-slide-5.jpg" />   
                    </div>
                </div>
                
                <!-- Bullet Navigator -->
                <div data-u="navigator" class="jssorb064" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" 
                data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div>
                
                <!-- Arrow Navigator -->
                <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" 
                data-scale="0.75" data-scale-left="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" 
                data-scale="0.75" data-scale-right="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- END JSSOR SLIDER -->
        
    </div>
    <!-- END BANNER -->
    
    <!-- SECTION -->   
    <section> 
    
    	<!-- CONTAINER -->
    	<div class="container">  
        	
            <!-- PROVINCE CONTAINER -->
        	<div class="province-container">
            	
                <h1 style="text-align:center">Tokologo</h1>
                <p style="text-align:center">
                    Gauteng is the smallest province in South Africa.  It is the place of gold located in the Highveld. 
                    Etymologically speaking, Gauteng is derived from Sotho name gauta meaning "gold".  In 1994, Gauteng was formed 
                    from part of the old Transvaal Province after South Africa's first multiracial elections. It has Pretoria as 
                    its administrative capital.<br />
                    
                    Gauteng is governed by the Gauteng Provincial Legislature elected by party-list proportional representation. 
                    The legislature elects one of its members as Premier of Gauteng to lead the executive, and the Premier appoints
                    an Executive Council of up to 10 members of the legislature to serve as heads of the various government 
                    departments. 
                </p>
                
                <h2>Popular Places</h2>
                
                <?php
					$municipalData = $municipalities->get_municipalities();
					if(!empty($municipalData)){ foreach($municipalData as $municRow){
					$municipalityName = $municRow->getMunicipalityName();
					$municipalitySlug = str_replace(' ', '_', strtolower($municipalityName));
				?>
                <!-- ROW -->
                <div class="row municipality"> 
                	<?php foreach($cities->getTokologoCities($municRow->getMunicipalityID()) as $city):
						$cityName = $city->getCityName();
						$citySlug = str_replace('city of', '', strtolower($cityName));
						$citySlug = str_replace('city', '', $citySlug);
						$citySlug = str_replace(' ', '_', trim($citySlug));
						$citySingleURL = URL.$municipalitySlug.'/'.'city/'.$city->getCityID().'/';
					?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                       <ul>
                          <li>
                          	<a href="<?php echo $citySingleURL; ?>"><?php echo $city->getCityName(); ?></a>
                            <span class="num-suburbs">
                               <?php 
                                  echo $city->getTotalPropertyForSale();
                               ?>
                         	</span>
                          </li>
                       </ul> 
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php } } ?>
                <!-- END ROW -->
                
                <h2>Suburbs</h2>
                
                <?php
					$municipalData = $municipalities->get_municipalities();
					if(!empty($municipalData)){ foreach($municipalData as $municRow){
					$municipalityName = $municRow->getMunicipalityName();
					$municipalitySlug = str_replace(' ', '_', strtolower($municipalityName));
				?>
                <!-- ROW -->
                <div class="row suburb"> 
                	<?php foreach($suburbs->getTokologoSubs($municRow->getMunicipalityID()) as $suburb):
						$suburbName = $suburb->getSuburbName();
						$suburbSlug = str_replace('city of', '', strtolower($suburbName));
						$suburbSlug = str_replace('city', '', $suburbSlug);
						$suburbSlug = str_replace(' ', '_', trim($suburbSlug));
						$suburbSingleURL = URL.$municipalitySlug.'/'.'suburb/'.$suburb->getSuburbID().'/';
					?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                       <ul>
                          <li>
                          	<a href="<?php echo $suburbSingleURL; ?>"><?php echo $suburb->getSuburbName(); ?></a>
                            <span class="num-suburbs">
                               <?php 
                                  echo $suburb->getTotalPropertyForSale();
                               ?>
                         	</span>
                          </li>
                       </ul> 
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php } } ?>
                <!-- END ROW -->                
                
            </div>
            <!-- END PROVINCE CONTAINER -->
            
        </div>
        <!-- END CONTAINER -->
        
    </section>    
    <!-- END SECTION -->  
    
    <!-- SECTION -->   
    <section class"content-bg-gray">
       
       <!-- CONTAINER -->
    	<div class="container">
        
        	<!-- PROPERTIES LISTING -->
        	<div class="properties-listing">
            	<h2>Listed Properties</h2>
           		
                 <!-- ROW -->
				
				<div class="row">
					<?php foreach($properties->getTokologoPropertyListImagesForSale() as $property):
						$municpName = $property->getSuburb()->getCity()->getMunicipality()->getMunicipalityName();
						$municpSlug = str_replace('city of', '', strtolower($municpName));
						$municpSlug = str_replace('city', '', $municpSlug);
						$municpSlug = str_replace(' ', '_', trim($municpSlug));
						$subSingleURL = URL.$municpSlug.'/'.'suburb/'.$property->getSuburb()->getSuburbID().'/';
						$citySingleURL = URL.$municpSlug.'/'.'city/'.$property->getSuburb()->getCity()->getCityID().'/';
					?>
                    
                    <!-- COL -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    
                    	<div class="properties item--category-1">
                        	<a href="<?php echo $subSingleURL; ?>">
                            <figure class="image-holder">
                                <img src="<?php echo URL; ?><?php echo $property->getImageLocation(); ?>"
                                alt="<?php echo $property->getImageAltText(); ?>"/>                      
                            </figure>
							</a>
                            <div class="list__cat">
                                <span class="label list__cat-label-1">Sales</span>
                                <span class="price">
                                    <?php echo 'R ' . substr($property->getPrice(), 0, 1) . ', '
                                                    . substr($property->getPrice(), 1, 3) . ', '
                                                    . substr($property->getPrice(), 4, 3) 
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
  <!-- END SECTION -->
  
  <!-- SECTION -->
    <section>
		
        <!-- CONTAINER -->
        <div class="container">
        
        	<!-- SOCIAL MEDIA -->
        	<div class="social-media">
            
                <h2>Recent posts and property trends</h2>

        		<!-- ROW -->
            	<div class="row">
            
            		<!-- RECENT POSTS -->
                    	<?php if($posts): ?>
						<?php foreach($posts->getAgentPosts() as $post): ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="blue-bottom-border">
                                <a href="#">
                                    <figure class="user-post">
                                    	<img src="<?php echo URL; ?><?php echo $post->getAgent()->getImage(); ?>"/>
                                    </figure>
                                    <span>
										<?php echo $post->getAgent()->getFirstname() . ' ' .
												   $post->getAgent()->getLastname();
										 ?>
                                    </span>                                 
                                </a>
                                <h4 class="subject-post"><?php echo substr($post->getPostSubject(), 0, 25) . '...'; ?></h4>
                                <p><?php echo substr($post->getPostContent(), 0, 100) . '...'; ?></p>
                                <div class="post-footer">
                                    <ul class="clearfix">
                                        <li><?php ?>  &nbsp;&nbsp;</li>
                                        <li>
                                        	<i class="icon-bubble"></i> 
											<?php echo 'Comments (' . $post->getTotalComment() . ')'; ?>&nbsp;&nbsp;
                                        </li>
                                        <li>
                                        	<i class="icon-thumbs-up"></i>
											<?php echo 'Likes (' . $post->getTotalLike() . ') ' ;?>&nbsp;&nbsp;
                                        </li>
                                    </ul>
                                </div>
                            </div>                           
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                	<!-- END RECENET POSTS -->          
                    
            	</div>
           		<!-- END ROW -->
                
            </div>
            <!-- END SOCIAL MEDIA -->
            
        </div>
        <!-- END CONTAINER -->
        
    </section>
    <!-- END SECTION -->
    
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
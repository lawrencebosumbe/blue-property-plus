<?php
	$provinces = new ProvinceDB();
	$province = new Province();
	$properties = new PropertyDB();
	$property = new Property();

	$post = new Post();
	$posts = new PostDB();
		
	$municipalities = new MunicipalityDB();
	$municipality = new Municipality();
?>
    
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
    
    <!-- BANNER -->
    <div class="banner">
		<div class="arrow-division"> 
       
              <div class="menu searchFormTab">
                <ul>
                    <li><a href="<?php echo URL; ?>" class="active">For Sale</a></li>
                    <li><a href="<?php echo URL; ?>to_rent/">To Rent</a></li>
                    <li><a href="<?php echo URL; ?>on_show/">On Show</a></li>
                    <li><a href="">Commercial</a></li>
                    <li><a href="">Services</a></li>
                </ul>
				<div class="searchFormContent">
					<form id="searchForm" name="body_property" action="" method="post">
						<div id="searchWrap">
							<div class="formField">
								<div class="blockContainer">
									<div id="autoSuggestInputDivkeyword" class="localityProjectKeyword">
										<input placeholder="Enter provinces, municipalities, cities, or suburbs..." class="cityLocProjectField keyword" autocomplete="off" id="homeSearchKeyword" name="homeSearchKeyword" value="" size="0">
									</div>
									<input type="hidden" name="searchID" id="searchID" value="">
									<input type="hidden" name="searchType" id="searchType" value="">
									<input type="hidden" name="searchGlobalName1" id="searchGlobalName1" value="">
									<input type="hidden" name="searchGlobalName2" id="searchGlobalName2" value="">
								</div>
							</div>
							<div class="formField btnContN">
								<input type="button" value="SEARCH" id="btnPropertySearch" class="searchBtn">
							</div>
			
							<div class="clearAll"></div>
						</div>                        
					</form>
				</div>
                <ul class="sub-menu">
                    <li><a href="<?php echo URL; ?>gauteng/johannesburg">Johannesburg</a></li>
                    <li><a href="<?php echo URL; ?>gauteng/pretoria">Pretoria</a></li>
                    <li><a href="<?php echo URL; ?>western_cape/cape_town">Cape Town</a></li>
                    <li><a href="<?php echo URL; ?>eastern_cape/east_london">East London</a></li>
                    <li><a href="<?php echo URL; ?>kwazulu_natal/durban">Durban</a></li>                       
                    <li><a href="<?php echo URL; ?>limpopo/polokwane">Polokwane</a></li>
                </ul>
        	 </div>            
      </div>
               
        	<!-- JSSOR SLIDER -->
            <div style="position:relative;top:0;left:0;width:100%;height:100%;overflow:hidden;">
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:640px;overflow:
                hidden;
                visibility:hidden;">
                
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;
                text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="images/img/spin.svg" />
                </div>
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:960px;height:640px;overflow:
                hidden;">
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/01.jpg" />              
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/02.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/03.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/04.jpg" />   
                    </div>
                    <div data-p="200.00">
                        <img data-u="image" src="<?php echo URL; ?>public/images/properties/05.jpg" />   
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
    <section class="content-bg-gray">
       
       <!-- CONTAINER -->
       <div class="container">
            
            <!-- PROPERTIES LISTING -->
        	<div class="properties-listing">
            
            	<h3>Listed properties for sale</h3>
                
                <!-- ROW -->				
				<div class="row">
                
                	<!-- FOREACH LOOP -->
                	<?php foreach($properties->getPropertyListImagesForSale() as $property):
						$municpName = $property->municipality_name;
						$municpSlug = str_replace('city of', '', strtolower($municpName));
						$municpSlug = str_replace('city', '', $municpSlug);
						$municpSlug = str_replace(' ', '_', trim($municpSlug));
						$subSinURL = URL.$municpSlug.'/'.'suburb/'.$property->suburb_id.'/';
						$subrURL = URL.$municpSlug.'/'.'city/'.$property->city_id.'/';
					?>
                    
                    <!-- COL- -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    	<!-- PROPERTIES -->
                    	<div class="properties item--category-1">
							<a href="<?php echo $subSinURL; ?>">
                            <figure class="image-holder">
                                <img src="<?php echo $property->getImageLocation(); ?>"
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
                                
                                <!-- LISTING TITLE -->
                                <div class="listing-title">
                                    <a href="#" class="listing__plus"></a>
                                    <h4>
                                    	<a href="<?php echo $subSinURL; ?>">
											<?php echo $property->getPropertyType() . ' in ' . 
											$property->getSuburb()->getSuburbName(); ?>
                                        </a>
                                    </h4>
                                </div>
                                <!-- END LISTING TITLE -->
                                
                                <!-- LISTING FOOTER -->
                                <div class="listing__footer">
                                    <figure>
                                        <img src="<?php echo URL; ?><?php  echo $property->getAgent()->getAgency()->getLogo(); ?>"/>
                                    </figure>
                                    <ul>
                                        <li>
                                            <span><?php  echo $property->getNumBed(); ?></span>
                                            <a href=""><img src="public/images/properties/icons/icon-bed.png"/></a>
                                        </li>
                                        <li>
                                            <span><?php echo $property->getNumBathRoom(); ?></span>
                                            <a href=""><img src="public/images/properties/icons/icon-bath.png"/></a>
                                        </li>
                                        <li>
                                            <span><?php echo $property->getNumGarage(); ?></span>
                                            <a href=""><img src="public/images/properties/icons/icon-garage.png"/></a>
                                        </li>
                                    </ul>
                                    <span><a href="<?php echo $subrURL; ?>" class="status__sales">viewl all</a></span>
                               </div>
                               <!-- END LISTING FOOTER -->
                               
                         </div>
                         <!-- END PROPERTIES -->
                            
                    </div>
                    <!-- END COL- -->
                    
                    <?php endforeach; ?>
                    <!-- END FOREACH LOOP -->
                    
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
         	<!--<div class="page-header"></div>-->
         
            <!-- PROPERTY LOCATION -->
            <div class="property-location">
                    
                <!-- ROW -->
                
                <h1>Property for sale in South Africa</h1>
				<?php
				$provinceData = $provinces->getProvinces();
				if(!empty($provinceData)){ foreach($provinceData as $prvRow){
				$provinceName = $prvRow->getProvinceName();
				$provinceSlug = str_replace(' ', '_', strtolower($provinceName));
				?>
                <p><a href="<?php echo URL.$provinceSlug; ?>/"><?php echo $provinceName;?></a></p> 
                <div class="row">               
                     
                        <?php foreach($municipalities->getMunicipalities($prvRow->getProvinceID()) as $municipality):
						$municpName = $municipality->getMunicipalityName();
						$municpSlug = str_replace('city of', '', strtolower($municpName));
						//$municpSlug = str_replace('city', '', $municpSlug);
						$municpSlug = str_replace(' ', '_', trim($municpSlug));
						?>              
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                           <ul>
                               <li><a href="<?php echo URL.$provinceSlug.'/'.$municpSlug; ?>/"><?php echo $municipality->getMunicipalityName(); ?></a></li>
                           </ul> 
                        </div>
                        <?php endforeach; ?>
            	</div>
            	<!-- END ROW -->
				<?php } } ?>
            </div>
            <!-- END PROPERTY LOCATION -->
            
         </div>
        <!-- END CONTAINER -->
     
    </section>
    <!-- END SECTION -->
    
	<!-- SECTION -->
     <section>
            <!-- PARALLAX -->
             <div class="parallax"></div>
             <!-- //PARALLAX -->
      </section>  
    <!-- END SECTION -->
               
	</section>
    <!-- END SECTION MAIN-SLIDER -->
    
    <!-- SECTION -->
    <section>        
         <!-- CONTAINER -->
         <div class="container">
            
            <!-- PROPERTY LISTING CONTAINER -->
            <div class="property-listing-container">  
                      
            <!-- ROW -->
            <div class="row">
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 property-listing">
                 	<figure>
                 		<img src="public/images/properties/001.jpg"/>
                    </figure>
                    <h2 class="text-x-tra-light-blue">Property For Sale</h2>
                    <p>	
                    	Listing your property<br />
                        for sale
                    </p>
                    <div class="bg-x-tra-light-blue"><a href="">List For Sale</a></div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 property-listing">
                 	<figure>
                 		<img src="public/images/properties/003.jpg"/>
                    </figure>
                    <h2 class="text-cat-label-2">Property To Rent</h2>
                    <p>	
                    	Listing your property<br />
                        to rent
                    </p>
                    <div class="bg-cat-label-2"><a href="">List To Rent</a></div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 property-listing">
                 	<figure>
                 	<img src="public/images/properties/002.jpg"/>
                    </figure>
                    <h2 class="text-cat-label-4">Property on Show</h2>                  
                    <p>	                    
                    	Listing your property<br />
                        on show
                        
                    </p>  
                    <h2 id="location"></h2>                  
                    <div class="bg-cat-label-4"><a href="">List on Show</a></div>                                       
                 </div>                 
            </div>
            <!-- END ROW -->
            
            </div>
            <!-- END PROPEERTY LISTING CONTAINER -->

       	</div>
        <!-- END CONTAINER -->
        
    </section>
    <!-- END SECTION -->
    
    <!-- SECTION -->
    <section id="community">
		
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

	<!-- SECTION -->   
    <section class="content-bg-gray">
    
    	<!-- CONTAINER -->
    	<div class="container">
        
        	<!-- ROW -->
            <div class="row">            
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <figure>
                    	<img src="public/images/responsive-devices/front-device.png"/>
                    </figure>
                     <h6><a href="#" class="listing__plus"></a></h6>
                </div>            
            </div>
            <!-- END ROW -->
            
    	</div>
        <!-- END CONTAINER -->
    </section>
    <!-- END SECTION -->
    
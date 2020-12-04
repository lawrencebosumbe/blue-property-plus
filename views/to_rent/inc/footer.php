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
                                  <a href="#"><img src="public/images/social/facebook.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="public/images/social/twitter.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="public/images/social/google-plus.png" alt=""></a>
                              </li>
                              <li class="social__item">
                                  <a href="#"><img src="public/images/social/linkedin.png" alt=""></a>
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
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.js"></script>
        
		<script src="<?php echo URL.'public/jquery-ui/jquery-ui.min.js'; ?>"></script>
        <script>
        function generateURL(type, global_id, global_name_1, global_name_2){
            global_name_1 = global_name_1.toLowerCase();
            global_name_1 = global_name_1.replace("city of", "");
            global_name_1 = global_name_1.replace("city", "");
            global_name_1 = global_name_1.trim();
            global_name_1 = global_name_1.replace(/\ /g, '_');
            global_name_2 = global_name_2.toLowerCase();
            global_name_2 = global_name_2.replace("city of", "");
            global_name_2 = global_name_2.replace("city", "");
            global_name_2 = global_name_2.trim();
            global_name_2 = global_name_2.replace(/\ /g, '_');
            switch(type){
                case 'province':
                    var url = '<?php echo URL; ?>'+global_name_1+'/';
                    break;
                case 'municipality':
                    var url = '<?php echo URL; ?>'+global_name_2+'/'+global_name_1+'/';
                    break;
                case 'city':
                    var url = '<?php echo URL; ?>'+global_name_2+'/city_single/'+global_id+'/';
                    break;
                case 'suburb':
                    var url = '<?php echo URL; ?>'+global_name_2+'/suburb_single/'+global_id+'/';
                    break;
                default:
                    var url = '<?php echo URL; ?>'+global_name_1+'/'+global_name_2+'/';
            }
            
            window.location.href = url;
        }
            
        
        $(document).ready(function(){
            $('#btnPropertySearch').on('click', function(){
                var homeSearchKeyword = $("#homeSearchKeyword").val();
                $.post( "<?php echo URL.'index/getProvince'; ?>", {municipality:homeSearchKeyword}, function( data ) {
                    var resp = jQuery.parseJSON( data );
                    if(resp.status == 1){
                        generateURL('', 0, resp.province_name, homeSearchKeyword);
                    }
                });
                
            });
            
            $( "#homeSearchKeyword" ).autocomplete({
                source: "<?php echo URL.'index/homeSearch'; ?>",
                minLength: 1,
                select: function(event, ui) {
                    event.preventDefault();
                    var value = ui.item.global_name_1+' in '+ui.item.global_name_2;
                    $("#homeSearchKeyword").val(value);
                    $("#searchID").val(ui.item.id);
                    $("#searchType").val(ui.item.type);
                    $("#searchGlobalName1").val(ui.item.global_name_1);
                    $("#searchGlobalName2").val(ui.item.global_name_2);
                    generateURL(ui.item.type, ui.item.id, ui.item.global_name_1, ui.item.global_name_2);
                }
            }).data("ui-autocomplete")._renderItem = function( ul, item ) {
            return $( "<li class='ui-autocomplete-srow'></li>" )
               .data( "item.autocomplete", item )
               .append( item.label )
               .appendTo( ul );
            };
        });
        </script>
        
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
        <!--<script src="public/js/jquery-1.11.2.min.js"></script>-->
		<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
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
        <script src="<?php echo URL; ?>public/service-guide/js/custom.js".js"></script>

$(document).ready(function ($) {

   var jssor_1_options = {
   	   $AutoPlay: true,
       $Idle: 30000,
       $SlideEasing: $Jease$.$InOutSine,
       $DragOrientation: 3,
       $ArrowNavigatorOptions: {
       $Class: $JssorArrowNavigator$
   },
              
   $BulletNavigatorOptions: {
       $Class: $JssorBulletNavigator$
      }
   };

   var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

   //make sure to clear margin of the slider container element
   jssor_1_slider.$Elmt.style.margin = "";

   //Responsive Coding
   
   var MAX_WIDTH = 3000;
   var MAX_HEIGHT = 3000;
   var MAX_BLEEDING = 1;

   function ScaleSlider() {
       var containerElement = jssor_1_slider.$Elmt.parentNode;
       var containerWidth = containerElement.clientWidth;

       if (containerWidth) {
           var originalWidth = jssor_1_slider.$OriginalWidth();
           var originalHeight = jssor_1_slider.$OriginalHeight();
		   var containerHeight = containerElement.clientHeight || originalHeight;
		   var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
           var expectedHeight = Math.min(MAX_HEIGHT || containerHeight, containerHeight);

           //scale the slider to expected size
           jssor_1_slider.$ScaleSize(expectedWidth, expectedHeight, MAX_BLEEDING);

           //position slider at center in vertical orientation
           jssor_1_slider.$Elmt.style.top = ((containerHeight - expectedHeight) / 2) + "px";

           //position slider at center in horizontal orientation
           jssor_1_slider.$Elmt.style.left = ((containerWidth - expectedWidth) / 2) + "px";
        }else {
           window.setTimeout(ScaleSlider, 30);
        }
   }

   ScaleSlider();

   $(window).bind("load", ScaleSlider);
   $(window).bind("resize", ScaleSlider);
   $(window).bind("orientationchange", ScaleSlider);
   
    //End Responsive Coding
            
});
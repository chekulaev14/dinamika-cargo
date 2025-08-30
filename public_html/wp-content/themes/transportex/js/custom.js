(function($) {
    "use strict";
    
    /* =================================
    ===         SCROLL TOP       ====
    =================================== */
    $(document).ready(function(){
		// <!--Smooth Page Scroll to Top-->
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.ta_upscr').fadeIn();
            } else {
                $('.ta_upscr').fadeOut();
            }
        }); 
    
        $('.ta_upscr').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
            		
	});
})(jQuery);
 
// /* =================================
// ===        STICKY HEADER        ====
// =================================== */ 
(function(){

    jQuery(document).ready(function() {
        jQuery(".header-sticky").sticky({ topSpacing: 0 }); 
    });
})(jQuery);
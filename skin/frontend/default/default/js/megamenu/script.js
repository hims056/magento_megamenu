var MS_Megamenu = {};

(function($) {

	$.noConflict();    

    MS_Megamenu = {

        mainMenuToggle: function() {           
			$('li.mmHandler').hover(function() {
				$('#megaMenu').toggle();
			})
        }, 

        subMenuToggle: function() {
        	$('#mainCategories ul li').hover(function() {        		
		    	var subMenuToShow = $("#subMenus").find("ul.submenu[data-rel='" + $(this).data('rel') + "']");
				MS_Megamenu.highlightElement(subMenuToShow, '.submenu');
			});
        },

        featuredProductToggle: function() {
        	$('#mainCategories li').on('mouseenter', function() {
        		var featuredProductToShow = $("#featuredProducts").children("div.product[data-rel='" + $(this).data('rel') + "']");
				
				if(featuredProductToShow.length == 0) {
					$('div.product').hide();
					return;
				}
				MS_Megamenu.highlightElement(featuredProductToShow);
        	});
        },

        highlightElement: function(el, elClass = null) {        	
        	el.show();
			el.siblings(elClass).hide();		
        }
    }
   
})(jQuery);


jQuery(document).ready(function(){	
	MS_Megamenu.mainMenuToggle(); 
	MS_Megamenu.subMenuToggle();
	MS_Megamenu.featuredProductToggle();
});
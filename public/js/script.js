"use strict";



/* ==== Jquery Functions ==== */
(function($) {
	

	$('[data-toggle="offcanvas"]').on("click", function () {
        $(".navbar-collapse").toggleClass("show");
    });

	const header = document.getElementById('siteheader');
	const scrollThreshold = 500;

	window.onscroll = () => window.pageYOffset > scrollThreshold ? header.classList.add('issticky') : header.classList.remove('issticky');

	
	
	/* ==== Testimonials Slider ==== */	
  	$(".testimonialsList").owlCarousel({      
	   loop:true,
		margin:30,
		nav:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			768:{
				items:1,
				nav:true
			},
			1170:{
				items:3,
				nav:true,
				loop:true
			}
		}
  	});
	
	/* ==== employerList Slider ==== */	
  	  function owlSlider(){
		var owl = $('.employerList'),
			dataGroupItem = owl.data('group-item'),
			owlItem = owl.find(".item-child").length;
		
			var groupNumber = owlItem / dataGroupItem;
			for(var i = 0; i < groupNumber; i++) {
			 owl.append('<div class="item-' + (i + 1) + '"></div>');
			  
			 var item = owl.children('.item-child');
			  var flag = 0;
			  item.each(function(){
				$(this).appendTo('.employerList .item-' + (i + 1));
				if(flag == (dataGroupItem - 1)) {
				  return false;
				}
				flag++;
			  });
			}
		
		owl.owlCarousel({
			loop:true,
			margin:15,
			responsiveClass:true,
			responsive:{
				0:{
					items: 1
				},
				767:{
				  items: 2
				},
				1170:{
					items: 5
				  }
			}
		});
	  }
	  
	  owlSlider();





	
	
	/* ==== Revolution Slider ==== */
	if($('.tp-banner').length > 0){
		$('.tp-banner').show().revolution({
			delay:6000,
	        startheight:550,
	        startwidth: 1140,
	        hideThumbs: 1000,
	        navigationType: 'none',
	        touchenabled: 'on',
	        onHoverStop: 'on',
	        navOffsetHorizontal: 0,
	        navOffsetVertical: 0,
	        dottedOverlay: 'none',
	        fullWidth: 'on'
		});
	}
	
	
	//Top search bar open/close
    if (!$('.srchbox').hasClass("searchStayOpen")) {
        $("#jbsearch").click(function() {
            $(".srchbox").addClass("openSearch");
            $(".additional_fields").slideDown();
        });


        $(".srchbox").click(function(e) {
            e.stopPropagation();
        });
    }

	

	window.onload = () => {
        $('#show_alert').modal('show');
    }
	
})(jQuery);




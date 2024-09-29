(function ($) {
 "use strict";
  /*----------------------------
 price-slider active
------------------------------ */
    var range = $('#slider-range');
    var amount = $('#amount');
    
	  range.slider({
	   range: true,
	   min: 2,
	   max: 300,
	   values: [ 2, 300 ],
	   slide: function( event, ui ) {
		amount.val(  ui.values[ 0 ] + " جنيه -" + ui.values[ 1 ] ) + " جنيه -";
	   }
	  });
	  amount.val( range.slider( "values", 0 ) + " جنيه -" +
	     range.slider( "values", 1 ) + " جنيه -");   		

 /*----------------------------
 jQuery MeanMenu
------------------------------ */
jQuery('#mobile-menu-active').meanmenu();


/*----------------------
	 Carousel Activation
	----------------------*/ 
 

 /*----------------------------
		Tooltip
    ------------------------------ */
    $('[data-toggle="tooltip"]').tooltip({
        animated: 'fade',
        placement: 'top',
        container: 'body'
    });
 /*----------------------------
  single portfolio activation
------------------------------ */ 

 /*----------------------------
	toggole active
     ------------------------------ */
	$( ".all_catagories" ).on("click", function() {
	  $( ".cat_mega_start" ).slideToggle( "slow" );
	});
	
	$( ".showmore-items" ).on("click", function() {
	  $( ".cost-menu" ).slideToggle( "slow" );
	});


 
/*----------------------
	New  Products Carousel Activation
	----------------------*/ 
  

 /*----------------------
	Hot  Deals Carousel Activation
	----------------------*/  
 
 /*---------------------
	 countdown
	--------------------- */
		$('[data-countdown]').each(function() {
		  var $this = $(this), finalDate = $(this).data('countdown');
		  $this.countdown(finalDate, function(event) {
			$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
		  });
		});

  
/*----------------------
	scrollUp 
	----------------------*/	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


/*----------------------
	New  Products home-page-2 Carousel Activation
	----------------------*/  
 
/*-----------------------------
	Category Menu toggle
	-------------------------------*/
    $('.expandable a').on('click', function() {
        $(this).parent().find('.category-sub').toggleClass('submenu-active'); 
        $(this).toggleClass('submenu-active');  
        return false;  
    });	
	
/*----------------------------
  MixItUp:
------------------------------ */
	$('#Container') .mixItUp();

 /*----------------------------
 magnificPopup:
------------------------------ */	
	 $('.magnify').magnificPopup({type:'image'});
	 
	 
/*-------------------------
  Create an account toggle function
--------------------------*/
	 $( "#cbox" ).on("click", function() {
        $( "#cbox_info" ).slideToggle(900);
     });
	 
	 
	  $( '#showlogin, #showcoupon' ).on('click', function() {
			 $(this).parent().next().slideToggle(600);
		 }); 
	 
		 /*-------------------------
		   accordion toggle function
		 --------------------------*/
		 $('.payment-accordion').find('.payment-accordion-toggle').on('click', function(){
		   //Expand or collapse this panel
		   $(this).next().slideToggle(500);
		   //Hide the other panels
		   $(".payment-content").not($(this).next()).slideUp(500);
	 
		 });
		 /* -------------------------------------------------------
		  accordion active class for style
		 ----------------------------------------------------------*/
		 $('.payment-accordion-toggle').on('click', function(event) {
			 $(this).siblings('.active').removeClass('active');
			 $(this).addClass('active');
			 event.preventDefault();
		 });
	 
	 
	 
	
  

})(jQuery); 
 

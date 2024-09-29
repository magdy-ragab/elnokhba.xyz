var newsIndex=0;
var slideNewsSpeed= 5000;
$(function(){
	
	$("#search_btn").click(function(){
		$("#search-form").slideToggle('fast');;
		return false;
	});
	
/* news scroller */
	slideNews(newsIndex);
	
/* slider index */
	 var _window_width= 1000;
	 var slider = new MasterSlider();
	 slider.setup('masterslidermain' , {
		width: _window_width,
		autoplay: true,
		height: 420,
		loop: true,
		space:0,
		fullwidth:true,
		autoHeight:false,
		layersMode: 'fill' ,
		view:"fade",
		layout: 'boxed',
		centerControls:true,
		fillMode: "center",
		controls : {
			arrows : {},
			bullets : {autohide:false}
		}
	});
	 slider.control('arrows');
	
});


function slideNews(_index)
{
	newsIndex++;
	if( newsIndex >= $('.marquee ul li').length ) newsIndex=0;
	
	if( $('.marquee ul li.active').length == 0 )
	{
		$('.marquee ul li:eq(0)').addClass('active');
	}else{
		$('.marquee ul li.active').removeClass('active');
		$('.marquee ul li:eq('+ newsIndex +')').addClass('active');
	}
	
	$('.marquee ul li').slideUp(500);
	$('.marquee ul li.active').slideDown(650);
	
	
	setTimeout( function(){
		
		slideNews(newsIndex);
	} , slideNewsSpeed );
}
$(function(){
	$.validate();
	 
	 
	var sh=screen.height;
	var sw=screen.width;
	if(sh>sw) hash_start=sw+","+sh;
	else hash_start=sh+","+sw;
	
	hash_start=hash_start+","+screen.colorDepth;
	
	$("#hash_start").val(hash_start);
        
 
   
        
    $("#display_method") . change( function() {
		var display_method = $(this) . val();
		var _src= base_url + 'assets/display-method/index-' + display_method + '.png';
		console.log(_src);
		$("#display_method_img").prop(
			'src',
			_src
		);
	} );

	if( $("#display_method").length ) {
		$("#display_method") . trigger('change');
	}
});
$(function(){

	$(".dynamic_tables").each( function(i, el){
		var _module= $( el ).data('module');
		var _order = $( el ).data('order');
		var _limit = $( el ).data('limit');
		var _o= $( el ).data('o');
		pobulate_table($("table#table_"+ _module ) ,_module,_order,_limit,_o);
	} );


	$(".select_order_by").change(function(){
		var _module= $(this).attr('id');
		var _ol= ($(this).val()).split(",");
		var _order= _ol[0];
		var _o= _ol[1];
		var _limit= $("table#table_"+ _module ).data('limit');
		pobulate_table( $("table#table_"+ _module ) ,_module,_order,_limit,_o)
	});
});


function pobulate_table(_table ,_module,_order,_limit,_o)
{
    if( _module== 'gallery' )
    {
        $(".widget_gallery").html('');    
    }else{
        $("#table_"+ _module+" tbody").remove() ;
        $("#table_"+ _module+" thead").after('<tbody></tbody>') ;
    }
	if( _module == 'gallery' )
	{
		var _url=_admin+"ajax/fillTables_gallery/"+ _module +"-" + _order +"-"+ _limit+"-"+_o;
	}else{
		var _url=_admin+"ajax/fillTables/"+ _module +"-" + _order +"-"+ _limit+"-"+_o;
	}
    
	$.ajax({
		json: true ,
		url:  _url ,
		async: false,
		success: function(ret)
		{
			ret= $.parseJSON(ret);
            console.log(ret);
			$(ret).each( function(j,elm){
				if( _module== 'gallery' )
				{
					$('.widget_gallery').append('<div class="gallery_item col-lg-3 col-md-4" style="background-image: url('+ _site +'/uploads/gallery/'+elm.thumbnail+')">'+
						'<div class="col-xs-6">'+
					 		'<span class="sizes">'+elm.h+"x"+elm.h + " ("+elm.size + ')</span>'+
					 	'</div>'+
						'<div class="col-xs-6 text-left">'+
							'<span class="gallery_edit">'+
							'<a href="'+_admin+'gallery/edit/'+ elm.ID +'"><i class="glyphicon glyphicon-pencil"></i></a> | '+
							'<a href="'+_site+'uploads/gallery/'+ elm.pic +'" target=_blank><i class="glyphicon glyphicon-fullscreen"></i></a>'+
							'</span>'+
						'</div>'+
						'<div class="col-xs-12 gallery_title">'+ elm.title +'</div>'+
					'</div>')  ;
				}else{
					$("#table_"+ _module+" tbody").append('<tr><td>'+ (j+1) +'</td><td>'+ elm.title +
						'</td><td>'+ elm.date_create +'</td><td>'+ elm.view +'</td><td><a href="'+ _admin + _module +'/edit/'+ elm.ID +'"><i class="glyphicon glyphicon-pencil"></i></a></td></tr>');
				}
			});
		}
	})

}

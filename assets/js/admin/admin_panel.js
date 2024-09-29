var _page_title= $('title').text();
$(function(){

	getNotifications();

        $("#changeOrderStatus").change(function(){
        $("#changeOrderStatus").prop("disbaled", "disbaled");
        var _id=$(this).data('id');
        var v=$(this).val();
        var _url=_admin+ "ajax/order_status" ;
	$.ajax({
		url: _url,
                "type": "POST",
                "data": "id="+_id+ "&v="+v ,
		async: false ,
		success: function( ret )
		{
                    if(ret != 1)
                    {
                        alert(ret);
                    }else{
                        $("#changeOrderStatus").prop("disbaled", "");
                    }
		}
	});
        });

	$("#module_chooser").change(function(){
		var _v= $(this).val();
		$("#module_chooser2").remove();
		if( _v == '**')
		{
			$("#url").val("**");
			$("#title").val("الرئيسية") ;
		}else if(_v == '**contacts'){
			$("#url").val("**contacts");
			$("#title").val("اتصل بنا") ;
		}else{
			$.getJSON({
				async: true ,
				url : _admin+'ajax/moduleChooser/'+ _v,
                dataType : 'json' ,
				success: function(ret)
				{
					console.log(ret.has_subs);
					if( ret.has_subs == 'N' )
					{
						$("#url").val( ret.url );
						$("#title").val( ret.title );
					}else{
						$("#row_chooser").after('<div class="row" id="module_chooser2"></div>');
						var _options= '';
						var j=0;
						_options+= '<option value="0">-- برجاء التحديد --</option>';
						if(ret.index!='N')
						{
							j++;
							_options+= '<option value="'+ ret.index.url +'" data-title="'+ret.index.title+'">'+ j +". " + ret.index.title +'</option>';
						}
						$(ret.subs).each( function(i, el){
							j++;
							_options+= '<option value="'+ el.url +'" data-title="'+el.title+'">'+ j+". " + el.title +'</option>';
						} );
						$("#module_chooser2").html('<label for="module2" class="col-md-3">برجاء التحديد</label>'+
								'<select class="col-md-9 form-control" name="module2" id="module2" onchange="getUrls(true)" data-validation="required" data-validation-error-msg="برجاء التحديد">'+
								_options +
								'</select>'
							);
						getUrls(false);
					}
				}
			});
		}
	});

	$("#contact_msg_do").click(function(){
		var _action= $("#contact_msg_actions").val();
		if( _action== 'reply' ) location.href= _admin+"contacts/reply/"+ $("#msg_id").val();
		if( _action== 'delete' ){
			$("#deleteModel").modal('show');
		}
	})

	$("button.del").click(function(){
		return window.confirm('حذف ?');
	})

	$("#checkAll").click(function(){
		$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});


	$("#uploadAllfiles").click(function(){
		_report_upload_error=0;
		$(".btn-add_images").each(function(e,elm){
			$(this).trigger('click');
		});
		_report_upload_error=1;
	})


	$('[data-toggle="tooltip"]').tooltip();

	// $('input[type=date]').datepicker({
		// format: 'yyyy-mm-dd'
	// });

	if($("#content") ){

	}

	$(".has_sub>a").click(function(){
		var el =$(this).parent().data('menuid');
		$("li[data-menuid='"+el+"'] ul").slideToggle('fast');
		return false;
	});


	$("#sidebar-toggle, #hideMenu").click(function(){
			$("#right-nev").toggleClass('active');
		return false;
	});


	$(".delCat").click(function(){
		var _id=$(this).data('id');
		var _title=$(this).data('title');
		if( $(this).data('controller') ) var _c= $(this).data('controller') ; else _c="cat";
		$("#deleteModel .modal-body span").html('<mark><em><b>"'+_title+'"</b></em></mark>');
		$("#delAction").click(function (){
            if( $(this).data('url') ) _url=$(this).data('url'); else _url=_admin+"/"+_c+"/del/"+_id;
			location.href=_url;
		})
	});
});






function getNotifications()
{
    /*var _url=_admin+ "ajax/adminjson" ;
	$.ajax({
		url: _url,
		async: false ,
        dataType: 'json',
		success: function( ret )
		{
			if( ret.admin== 0 )
			{
				location.href= _admin;
			}else if( ret.notifications_count>0 ){
				$("#notifications").remove();
				$('body').append('<div id="notifications" style="display: none"></div>');
				var _h= '';
				$.each(ret.alert, function(k, v) {
					_h += '<div class=cl><a href="'+v.url+'">'+ v.title +' <span class="badge badge-danger">'+ v.num +'</span></a></div>';
				});
				$("#notifications").html('<div class="row"><div class="col-xs-3 col-md-2 close_notifications">'+
						'<span class="glyphicon glyphicon-remove-circle" onclick="close_notifications();"></span>'+
				'</div><div class="col-xs-9 col-md-10">'+ _h +'</div></div>' );
				_page_title= $("title").text();
				$("title").text("إشعارات : " + ret.notifications_count);
				$("#notifications").fadeIn('fast');
			}
			$(".contact_count").html(ret.contact_count);
			setTimeout( function(){ getNotifications(); } , 10000 )
		}
	});*/
}

function close_notifications()
{
	$("title").text(_page_title);
	$("#notifications").fadeOut('fast', function(){
		$("#notifications").remove();
	});
}


function getUrls(report_error) {
	var _url= $("#module2").val();
	if(_url == 0)
	{
		if(report_error!=false)
			alert("لم تقم بالتحديد");
	}else{
		$("#url").val(_url);
		var _title= $("#module2 option:selected").data('title');
		$("#title").val( _title ) ;
	}
}
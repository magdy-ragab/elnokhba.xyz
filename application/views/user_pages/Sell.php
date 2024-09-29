<main id="pageContentArea">
<!--========================================
Page Head
===========================================-->
    <div class="blog-main-slider color-white text-center" style="">
        <div class="overlay"></div>
        <div class="container">
            <h2>بيع سلعة</h2>
        </div>
    </div>
 
<br>
 
<div class="container">

 <div class="col-sm-3 col-sm-push-9">
            <ul class="nav-email shadow mb-20">
		<li>
                    <a href="<?=base_url()?>productcp/index"><i class="fa fa-user"></i> بياناتي </a>
                </li>
                <li>
                    <a href="<?=base_url()?>sell/view">
                        <i class="fa fa-th-large"></i> منتجاتي  
                    </a>
                </li>
               
             
                <li class="active">
                    <a href="<?=base_url()?>sell/index"><i class="fa fa-tag"></i> اضف منتج</a>
                </li>
               
            </ul><!-- /.nav -->
        </div>
    
        <div class="col-sm-9 col-sm-pull-3">   
    
    <?php 
if($edit) {
	echo form_open_multipart( );
}else{
	echo form_open_multipart( );
}
if($edit){
	echo '<input type="hidden" name="id" value="'. $edit .'" />';
}
?>
<input type="hidden" name="meta[price]" id="meta_price" value="" />
<input type="hidden" name="meta[discount]" id="meta_discount" value="" />
<input type="hidden" name="meta[parent_id]" id="meta_parent_cat" value="" />
<div class="clearfix add-product-form">

    
    <h2 class="titles">اضافة منتج</h2>
    <p class="text-muted">بإضافة منتجك إلى الموقع فأنت توافق على  
        <a href="#">إتفاقية الاستخدام</a>
    </p>
		<div class="container-fluid">
			<?php
			if($uploads_error)
			{
				if(is_array($uploads_error))
				{
					echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>';
					foreach($uploads_error as $e) echo "{$e}<br />";
					echo '</div>';
				}else{
					echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>'.$uploads_error.'</div>';
				}
				
			}
            
			if( count( $error ) )
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>'.
				implode("", $error) . '</div>';
				
			}
            
            
            if(validation_errors())
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>'.
				validation_errors() . '</div>';
				
			}
			if($duplicated)
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				هذا الصفحة موجود من قبل</div>';
			}
			if($id)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة منتج
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل المنتج</div>';
			}
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم المنتج</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="اسم المنتج" />
				</div>
			</div>
		    
		    
		    <div class="row">
			<div class="form-group">
			    <label for="content" class="col-md-3">وصف مختصر للمنتج</label>
			    <textarea class="form-control col-md-9" name="content" id="content" data-validation="required" data-validation-error-msg="الوصف"><?php echo $row['content']?></textarea>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="form-group">
			    <label for="content" class="col-md-3">موعد التسليم بالايام</label>
			    <select class="form-control col-md-9" name="delivery" id="delivery">
				<?php for($i=1;$i<=90;$i++){ ?><option value="<?php echo $i ?>"><?php echo $i;?></option><?php } ?>
			    </select>
			</div>
		    </div>
		    
                    
                    <div class="row">
			<div class="form-group">
			    <label for="availble" class="col-md-3">المنتج متاح للشراء</label>
			    <div class="col-md-9"><input type="checkbox" name="availble" id="availble" value="Y"<?php if($row['availble']=='Y'){echo " checked";} ?>></div>
			</div>
		    </div>
                    
		    <div class="row">
			<div class="form-group">
			    <label for="content" class="col-md-3">شحن دولي</label>
			    <div class="col-md-9"><input type="checkbox" name="international_shipping" id="international_shipping" value="Y"<?php if($row['international_shipping']=='Y'){echo " checked";} ?>></div>
			</div>
		    </div>
		    
                    <?php
                    if(isset( $row['pic'] ))
                    {
                        ?>
                        <div class="row">
                            <div class="form-group col-md-3 col-md-push-3">
                                <img src="<?=$row['pic_path']?>" class="img-responsive img-rounded img-thumbnail" />
                            </div>
                        </div>
                        <?php
                    }
                    ?>
		    
                    <div class="row">
                        <div class="form-group">
                            <label for="pic" class="col-md-3">الصورة الرئيسية</label>
                            <input type="file" name="pic" class="col-md-9 form-control" id="pic">
                        </div>
                    </div>
                    
                    <?php 
                    for($i=1; $i<=4; $i++)
                    {
                        if(isset( $row['pics'][$i]['pic'] ))
                        {
                            ?>
                            <div class="row">
                                <div class="form-group col-md-3 col-md-push-3">
                                    <img src="<?=$row['pics'][$i]['pic_path']?>" class="img-responsive img-rounded img-thumbnail" />
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    <div class="row">
                        <div class="form-group">
                            <label for="pics_<?=$i?>" class="col-md-3">صورة #<?=$i?></label>
                            <input type="file" name="pics_<?=$i?>" class="col-md-9 form-control" id="pics_<?=$i?>">
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                    
			<div class="row">
				<div class="form-group">
					<label for="price" class="col-md-3">السعر</label>
					<input type="text" class="form-control col-md-9" name="meta[price]" id="price" value="<?php echo $row['price']?>" data-validation="required" data-validation-error-msg="السعر مطلوب" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="discount" class="col-md-3">السعر بعد الخصم</label>
					<input type="text" class="form-control col-md-9" name="meta[discount]" id="discount" value="<?php echo $row['discount']?>" />
				</div>
			</div>

                    <div class="row">
				<div class="form-group">
					<label for="cat" class="col-md-3">القسم</label>
                                        <select name="cat" id="cat1" class="form-control col-md-9" onchange="catChange();">
					    <?php echo $this->core_model->catList($row['parent_id']) ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="brand" class="col-md-3">الفئة</label>
					<select name="meta[brand]" id="brand" class="form-control col-md-9">
					    <?php foreach( $this->core_model->pages(array("module"=>'brands')) as $brand ){ ?>
                            <option value="<?php echo $brand->ID; ?>"><?php echo $brand->title ?></option>
                        <?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="country" class="col-md-3">الدولة</label>
					<select name="meta[country]" id="country" class="form-control col-md-9">
					    <?php foreach( $this->core_model->pages(array("module"=>'country')) as $country ){ 
                        $meta= unserialize($country->meta);
                        ?>
                            <option value="<?php echo $country->ID; ?>" data-currency='<?php echo $meta['coinCode'] ?>'
                            data-currencyname='<?php echo $meta['coinName'] ?>' data-usd="<?php echo $coins[$meta['coinCode']] ?>"><?php echo $country->title ?></option>
                        <?php } ?>
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-6">
					<label class="col-md-6">العملة</label>
					<div class="col-md-6 text-muted" id="coinName"></div>
				</div>
				<div class="form-group col-md-6">
                   <div class="col-md-12" id="coin_value"></div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6" id="priceLocalCointoUSD">
                    <label class="form-group col-md-6">السعر بالدولار</label>
                    <div class="col-md-6 text-muted" id="priceLocalCointoUSDValue"></div>
                </div>
                <div class="form-group col-md-6" id="discountLocalCointoUSD">
                    <label class="form-group col-md-6">الخصم بالدولار</label>
                    <div class="col-md-6 text-muted" id="discountLocalCointoUSDValue"></div>
                </div>
			</div>
			
			<div id="custom_fields"></div>
		</div>
	
	<div class="clearfix">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
	</div>
<?php form_close();?>


<script>
$(function(){
    ch();
    $("#country").change(function(){ch();});
    $("#price, #discount").keyup(function(){ch();});
});
    
var ch = function()
{
    $("#coinName").html('');
    $("#priceLocalCointoUSDValue,#discountLocalCointoUSDValue").html('');
    var _o= $("#country option:selected");
    var _coin= _o.data('currencyname');
    var _coinCode= _o.data('currency');
    var _v= _o.data('usd');
    $("#coinName").html(_coin);
    $("#coin_value").html("$1=<code>"+_v + "</code> "+_coin);
    if( $("#price").val() )
    {
        var p= parseFloat( $("#price").val() );
        $("#meta_price").val(parseFloat(p/_v).toFixed(2));
        $("#priceLocalCointoUSDValue").html( parseFloat(p/_v).toFixed(2)  );
    }
    if( $("#discount").val() )
    {
        var p= parseFloat( $("#discount").val() );
        $("#discountLocalCointoUSDValue").html( parseFloat(p/_v).toFixed(2) );
        $("#meta_discount").val(parseFloat(p/_v).toFixed(2));
    }
}

function catChange()
{
    var _data= $("#cat1 option:selected").data('id');
   if(! /\-/.test(_data) )
   {
       var _id= _data;
   }else{
       var _ids= (_data).split("-");
       var _id= _ids[0];
   }
   $("#meta_parent_cat").val(_id);
   $.ajax({
       url : "<?php echo base_url()."Ajax/getFields/"?>"+_id+"/<?=$edit?>"  ,
       success: function(ret)
       {
            $("#custom_fields").html(ret);
       }
   });
}
$("#cat1").change(function(){
   catChange();
});
    
    
$("#cat1").trigger('change');
</script>



</div></main>
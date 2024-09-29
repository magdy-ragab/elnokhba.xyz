<?php
echo form_open();
?>
<div class="container">
    <br>
    <h1>طلب إرجاع منتج</h1>
    <div class="row sellback">
	<?php if($back){ echo '<div class="alert alert-danger">تم تقديم طلب لإرجاء المنتج و سيتم التواصل معك قريباً جداً</div>'; } ?>
	<div class="col-md-1"><a href="<?=$prod['url']?>"><img src="<?=base_url()?>thumb.php?file=uploads/products/<?=$prod['pic']?>&w=200&h=250" class="img-responsive" alt="<?=$prod['title']?>"></a></div>
	<div class="col-md-11">
	    <h2><a href="<?=$prod['url']?>"><?=$prod['title']?></a></h2>
	    <p class="text-muted"><?=mb_substr(strip_tags($prod['content']), 0, 150, "utf-8")?></p>
	</div>
	<div class="pull-left col-md-3">
	    <a href="#" class="btn btn-danger col-md-12 sellBackBtn"> <span class="fa fa-remove"></span> إرجاع المنتج  *</a>
	</div>
    </div>
    <div class="clearfix"></div>
    <div class="row mt20 hiddenElement" id="reasonDiv">
	<label for="reason" class="col-md-3">سبب إرجاع المنتج</label>
	<div class="col-md-9"><textarea class="form-control" name="reason" id="reason"></textarea></div>
	<div class="clearfix"></div>
	<button class="mt20 col-md-7 col-md-push-4 btn-primary" type="submit" name="back_new" value="1">طلب إعادة المنتج</button>
    </div>
    <div class="clearfix"></div>
    <div class="text-muted">* برجاء ملاحظة ان إعادة المنتاج يخضع للشروط و الأحكام  </div>
</div>
<?php
echo form_close();

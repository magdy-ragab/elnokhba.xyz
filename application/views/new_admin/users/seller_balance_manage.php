<?php $cont = $this->router->fetch_class() ?>
<div class="page-header"><h1>عرض الأعضاء</h1></div>
<div class="row">
    <div class="col-md-12">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>الرصيد</li>
	</ul>
	
	
<div class="col-md-6 col-md-push-3 bg-warning">
    <?php echo form_open(base_url()."new_admin/users/seller_balance_manage");  ?>
    <div class="text-center">
	<h2>تفاصيل الرصيد</h2>
	
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="row">
	<div class="col-md-6 text-muted">الرصيد الحالي هو : <span class="badge"><?=$balance;?></span></div>
	<div class="col-md-6 text-left">
	    <input type="checkbox" name="withdraw" id="withdraw" value="Y" >
	    <span class="red"> تأكيد  سحب الرصيد  ؟	    </span>
	</div>
    </div>
    <p>
	<br />
	<label for="new_balance" id="new_balance_label" class="col-md-4">إرسال ارباح</label>
	<span class="btn-group col-md-8">
	<input class="col-md-9 form-control" type="text" name="new_balance" id="new_balance" value="0">
	<button name="new_balance_send" id="new_balance_send" class="col-md-3 form-control btn-primary">ارسال</button>
	</span>
    </p>
    <?php echo form_close();  ?>
</div>
	
	
<?php

?>
	
	
    </div>
</div>
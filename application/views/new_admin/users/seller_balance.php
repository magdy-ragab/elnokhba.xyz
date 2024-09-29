<?php $cont = $this->router->fetch_class() ?>
<div class="page-header"><h1>عرض الأعضاء</h1></div>
<div class="row">
    <div class="col-md-12">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>الرصيد</li>
	</ul>
	
	

<?php
if($_SESSION['please_check']) :
    echo '<div class="col-md-8 col-md-push-2"><div class="alert alert-danger">يجب الموافقة على تأكيد سحب الرصيد</div></div><div class="clearfix"></div>';
endif;
if($_SESSION['balance_error']) :
    echo '<div class="col-md-8 col-md-push-2"><div class="alert alert-danger">عفواً لايمكن ارسال هذا المبلغ</div></div><div class="clearfix"></div>';
endif;
if($_SESSION['success']) :
    echo '<div class="col-md-8 col-md-push-2"><div class="alert alert-success">تم تسجيل سحب المبلغ</div></div><div class="clearfix"></div>';
endif;
?>	
<div class="col-md-6 col-md-push-3 bg-warning">
    <?php echo form_open(base_url()."new_admin/users/seller_balance_manage/".$id);  ?>
    <div class="text-center">
	<h2>تفاصيل الرصيد</h2>
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="row">
	<div class="col-md-6 text-muted">الرصيد الحالي هو : <span class="badge"><?=$balance;?></span></div>
	<div class="col-md-6 text-left">
	    <input type="checkbox" name="withdraw" id="withdraw" value="Y" >
	    <label for="withdraw" class="red fwn"> تأكيد  سحب الرصيد  ؟	    </label>
	</div>
    </div>
    <p>
	<br />
	<label for="new_balance" id="new_balance_label" class="col-md-4">إرسال ارباح</label>
	<span class="btn-group col-md-8">
	<input class="col-md-9 form-control" type="text" name="new_balance" id="new_balance" value="0">
	<button name="new_balance_send" value="1" id="new_balance_send" class="col-md-3 form-control btn-primary">ارسال</button>
	</span>
    </p>
    <?php echo form_close();  ?>
</div>
	
<div class="clearfix"></div>
<?php
echo '<br />'.$this->shop->userInvoice($id);
?>
	
	
    </div>
</div>




<div id="deleteModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">حذف ؟</h4>
      </div>
      <div class="modal-body text-danger">
        <p>هل ترغب بحذف  <span></span> فعلا ؟</p>
      </div>
      <div class="modal-footer">
      	<div class="col-xs-6 text-right">
      		<button type="button" id="delAction" class="btn btn-danger">حذف</button>
      	</div>
      	<div class="col-xs-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
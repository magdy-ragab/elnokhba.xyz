<?php $cont = $this->router->fetch_class() ?><div class="page-header"><h1>الفواتير</h1></div>
<div class="row">
    <div class="col-md-12">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>الفواتير</li>
	</ul>
    </div>

</div>

<?php 
echo form_open(base_url()."new_admin/qr/invoince"); ?>
    <div class="col-md-6 col-md-push-3 bg-warning">
    <div class="text-center">
	<h2>رمز الفاتورة</h2>
    </div>
    <?php 
    if( $_SESSION['unavialble'] ) :
	echo '<div class="alert alert-danger">هذه الفاتورة غير متاحة</div>';
    endif;
    ?>
    <p>
	<label for="new_balance" id="new_balance_label" class="col-md-4">رمز الفاتورة</label>
	<p><span class="btn-group col-md-8">
	    <input value="<?php if( $_POST['invoince']){ echo $_POST['invoince'];} ?>" class="col-md-9 form-control" name="invoince" id="invoince" value="" data-validation="required" data-validation-error-msg="الرمز مطلوب" placeholder="رمز الفاتورة المشفر" type="text">
	    <button name="new_balance_send" value="1" id="new_balance_send" class="col-md-3 form-control btn-primary"> <span class="glyphicon glyphicon-search"></span> بحث   </button>
	</span></p>
    </p>
    </div>
<?php echo form_close(); 



if( isset($fullInvoince) && $fullInvoince!='' ) :
    echo '<div class="clearfix"></div>'. $fullInvoince;
endif;
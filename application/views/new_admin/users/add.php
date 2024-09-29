<?php $cont = $this->router->fetch_class() ?>
<div class="page-header"><h1>تعديل الأعضاء</h1></div>
<div class="row">
    <div class="col-md-12">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>تعديل الاعضاء</li>
	</ul>
    </div>
</div>


<div class="col-md-6">
    <div class="clearfix inputs rounded">
	<h2>تغيير البيانات</h2>
	<?php 
	if($_SESSION['worng_password']):
	    echo '<div class="alert alert-danger">كلمة المرور الحالية غير صحيحة</div>';
	endif;
	if($_SESSION['worng_file']):
	    echo '<div class="alert alert-danger">الملف لس صورة أو حجمه كبير</div>';
	endif;
	if($_SESSION['success']):
	    echo '<div class="alert alert-success">تم تغيير البيانات</div>';
	endif;

	echo form_open(base_url()."new_admin/edit_data/{$id}"); ?>
	<div class="form-group">
	<label for="username" class="col-md-3">اسم المستخدم</label>
	<input data-validation="required" data-validation-error-msg="اسم المستخدم مطلوب" type="text" class=" col-md-9 form-control" name="username" id="username" value="<?=$row['username']?>">
	</div>
	<div class="form-group">
	<label for="up" class="col-md-3">الصورة الشخصية</label>
	<input type="file" class=" col-md-9" name="up" id="up">
	</div>
	<div class="form-group">
	<label for="tel" class="col-md-3">الهاتف / الموبايل</label>
	<input data-validation="required" data-validation-error-msg="الهاتف/الموبايل  مطلوب" type="text" class="form-control col-md-9" name="tel" id="tel" value="<?=$row['tel']?>">
	</div>
	<div class="form-group">
	<label for="address" class="col-md-3">العنوان</label>
	<input data-validation="required" data-validation-error-msg="العنوان  مطلوب" type="text" class="form-control col-md-9" name="address" id="address" value="<?=$row['address']?>">
	</div>

	<p>
	    <button type="submit" name="save_setting" value="1" class="col-md-4 col-md-push-8 btn btn-primary">حفظ الإعدادات</button>
	</p>
	<?php echo form_close(); ?>
    </div>
</div>

<div class="col-md-6 bordered">
    <div class="clearfix inputs rounded">
	<h2>تغيير كلمة المرور</h2>
	<?php echo form_open(base_url()."new_admin/edit_password/{$id}");

	if($_SESSION['worng_password2']):
	    echo '<div class="alert alert-danger">كلمة المرور الحالية غير صحيحة</div>';
	endif;
	if($_SESSION['umatch_password']):
	    echo '<div class="alert alert-danger">كلمة المرور الجديدة و اعادتها غير متطابقة</div>';
	endif;
	if($_SESSION['success2']):
	    echo '<div class="alert alert-success">تم تغيير كلمة المرور</div>';
	endif;

	if($row['pic']):
	    ?>
	    <div class="col-md-9 col-md-push-2 col-xs-12"><img src="<?=base_url()."uploads/user/{$row['pic']}"?>" class="img-responsive img-rounded" /></div>
	    <div class="cl"></div>
	<?php
	endif;
	?>
	<p>
	<label for="pwd1" class="col-md-3">كلمة المرور الجديدة</label>
	<input data-validation="required" data-validation-error-msg="كلمة المرور الجديدة" type="password" class="form-control col-md-9" name="pwd1" id="pwd1">
	</p>

	<p>
	<label for="pwd2" class="col-md-3">إعادةكلمة  المرور </label>
	<input data-validation="required" data-validation-error-msg="إعادة كلمة المرور" type="password" class="form-control col-md-9" name="pwd2" id="pwd2">
	</p>

	<p>
	    <button type="submit" name="change_password" value="1" class="col-md-4 col-md-push-8 btn btn-primary">تغيير كلمة المرور</button>
	</p>
	<?php echo form_close(); ?>
    </div>
</div>

<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>المشرفين</li>
		</ul>
	</div>
</div>
<?php echo form_open( $this->core_model->admin_dir()."/".$cont."/edit_password/".$admin_data->ID);?>
<input type="hidden" name="word" value="<?php echo $cap['word']?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل كلمة المرور الخاصة بـ "<?php echo $admin_data->username; ?>"</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php if($wrong)
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>لم تنقل الحروف بشكل صحيح</div>';			
			}
			
			if($not_equal)
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>كلمة المرور غير مطابقة</div>';
			}
			
			
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>تم تغيير كلمة المرور</div>';
			}
			?>
			<div class="row">
				<label for="cap" class="col-md-6">
				لتأكيد تغيير كلمة المرور انقل هذه الحروف
				<?php echo $cap['image']?>
				</label>
				<input type="text" class="col-md-6 form-control" name="cap" id="cap" data-validation="required" data-validation-error-msg="انقل الحروف في الصورة" />
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="password1" class="col-md-3">كلمة المرور</label>
					<input type="password" class="form-control col-md-9" name="password1" id="password1" data-validation="required" data-validation-error-msg="كلمة المرور" />
				</div>
			</div>
			
			
			<div class="row">
				<div class="form-group">
					<label for="password2" class="col-md-3">إعادة كلمة المرور</label>
					<input type="password" class="form-control col-md-9" name="password2" id="password2" data-validation="required" data-validation-error-msg="إعادة كلمة المرور" />
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="change" value="1"> <span class="glyphicon glyphicon-lock"></span> تغيير كلمة المرور</button>
	</div>
</div>
<?php form_close();?>







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
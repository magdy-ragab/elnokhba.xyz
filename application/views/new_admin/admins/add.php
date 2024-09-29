<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة مشرف</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">المشرفين <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">إضافة مشرف</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض المشرفين</a></li>
		</ul>
	</div>
</div>

<?php 
if($edit) {
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/edit/".$edit);
}else{
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/add");
}
if($edit){
	echo '<input type="hidden" name="id" value="'. $edit .'" />';
	echo '<input type="hidden" name="old" value="'. $row->pic .'" />';
	echo '<input type="hidden" name="thumb" value="'. $row->thumbnail .'" />';
}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">المشرفين</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
			if($not_equal)
			{
				
					echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>كلمة المرور غير مطابقة</div>';
				
				
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
				يوجد مشرف بهذا البريد الإلكتروني</div>';
			}
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة المشرف/المدير
				<a href="'.$admin_dir.'/'.$this->router->fetch_class().'/add/" class="btn btn-primary btn-xs">إضافة مشرف جديد</a>
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل المشرف</div>';
			}
			?>
			<h4><strong>البيانات العامة</strong></h4>
			<div class="row">
				<div class="form-group">
					<label for="username" class="col-md-3">الاسم</label>
					<input type="text" class="form-control col-md-9" name="username" id="username" value="<?php echo $row->username?>" data-validation="required" data-validation-error-msg="الاسم" />
				</div>
			</div>
			
			
			<div class="row">
				<div class="form-group">
					<label for="email" class="col-md-3">البريد الإلكتروني</label>
					<input type="text" class="form-control col-md-9" name="email" id="email" value="<?php echo $row->email?>" data-validation="email" data-validation-error-msg="صيغة البريد الإلكتروني غير صحيحة" />
				</div>
			</div>
			
			<?php if(!$row->ID){ ?><div class="row">
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
			<?php }?>
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">الرتبة</label>
					<select class="form-control col-md-9" name="mode" id="mode">
						<option value="mod"<?php if($row->mode=='mod') echo " selected"; ?>>مشـرف</option>
						<option value="super"<?php if($row->mode=='super') echo " selected"; ?>>مدير</option>
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">حالة التفعيل</label>
					<select class="form-control col-md-9" name="active" id="active">
						<option value="Y"<?php if($row->active=='Y') echo " selected"; ?>>مفعل</option>
						<option value="N"<?php if($row->active=='N') echo " selected"; ?>>معطل</option>
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
				<h4><strong>الصلاحيات</strong></h4>
				<?php $modules= $this->core_model->modules_list();
				$adminmodules= explode(",", $row->modules);
				if(count($adminmodules)== 0) $adminmodules= array(); 
				foreach($modules as $m)
				{
					?><div class="col-md-4">
						<label for="m<?php echo $m->ID?>" class="col-md-7 col-xs-10"><?php echo $m->title?></label>
						<div class="col-md-5 col-xs-2">
						<input<?php if(in_array($m->module, $adminmodules)) echo " checked"; ?> type="checkbox" name="modules[<?php echo $m->module?>]" id="m<?php echo $m->ID ?>" value="<?php echo $m->module?>" /></div>
					</div><?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<a href="#" data-toggle="modal" data-target="#deleteModel">هل قرأت هذا التنبيه؟</a>
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php form_close();?>





<div id="deleteModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">إضافة مدير/مشرف</h4>
      </div>
      <div class="modal-body text-danger">
        <p class="red">
        	- برجاء ملاحظة انه بإضافة مدير أو مشرف للوحة التحكم فإنه ستمكن من تعديل أو اضافة محتويات في موقعك بدون  الرجوع لك <br />
        	- <strong>المدير</strong> له كل الصلاحيات حتى لو لم تقم بتحديد أي صلاحيات له <br />
        	- <strong>المشرف</strong> يتم إعطاؤه صلاحيات محددة تختارها بنفسك <br />
        	- لاتقم بإضافة أي مشرف او مدير إلا إذا كنت تثق به ، وذلك حفاظاً على موقعك <br />
        </p>
      </div>
      <div class="modal-footer">
     	<div class="col-xs-6 col-xs-offset-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
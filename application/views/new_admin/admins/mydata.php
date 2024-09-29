<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>تعديل بياناتي</li>
		</ul>
	</div>
	
</div>

<?php 
echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/mydata");
echo '<input type="hidden" name="old" value="'. $row->pic .'" />';
echo '<input type="hidden" name="cover" value="'. $row->cover.'" />';
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل بياناتي : <b><?php echo $row->username; ?></b></h4>
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
			
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم التعديل
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل المشرف</div>';
			}
			?>
			
			<br /> 
			
			<?php $this->core_model->cover();?>
			
			<div class="row">&nbsp;</div>
			
			<div class="row">
				<div class="form-group">
					<label for="username" class="col-md-3">الاسم</label>
					<input type="text" class="form-control col-md-9" name="username" id="username" value="<?php echo $row->username?>" data-validation="required" data-validation-error-msg="الاسم" />
				</div>
			</div>
			
			
			<div class="row">
				<div class="form-group">
					<label class="col-md-3">البريد الإلكتروني</label>
					<div class="col-md-9"><span class="stroked" data-toggle="tooltip" data-placement="bottom" title="لايمكنك تغيير الإيميل"><?php echo $row->email?></span></div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="form-group">
					<label for="pic" class="col-md-3">الصورة الشخصية </label>
					<input type="file" class="form-control col-md-9" name="pic" id="pic"  />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="cover" class="col-md-3">صورة الكوفر</label>
					<input type="file" class="form-control col-md-9" name="cover" id="cover"  />
				</div>
			</div>
			
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="edit" value="1" type="submit"> <span class="glyphicon glyphicon-check"></span> تعديل</button>
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
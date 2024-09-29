<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة عنصر</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">القائمة الرئيسية <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">إضافة عنصر</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض العناصر</a></li>
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
}
?>
<input type="hidden" name="content" id="content" value="<?php echo $row['content']?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $page_title?></h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
		<div class="alert alert-info dashed-border text-center"><i class="glyphicon glyphicon-alert red"></i>
		استعمل نجمتين (**) للدلالة على رابط الموقع الرئيسي  </div>
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
				هذا العنصر موجود من قبل</div>';
			}
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة العنصر
				<a href="'.$admin_dir.'/'.$this->router->fetch_class().'/add/" class="btn btn-primary btn-xs">إضافة عنصر جديد</a>
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل العنصر</div>';
			}
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم العنصر</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="عنوان الصفحة" />
				</div>
			</div>
			<div class="row" id="row_chooser">
				<label for="module" class="col-md-3">الرابط</label>
				<select name="module" id="module_chooser" class="form-control col-md-9" data-validation="required" data-validation-error-msg="برجاء التحديد">
				<option value="**">الرئيسية</option>
				<option value="**contacts">اتصل بنا</option>
				<optgroup label="من لوحة التحكم">
				<!-- <?php foreach($this->core_model->menuabel() as $m){  ?> -->
					<option value="<?php echo $m->module ?>"><?php echo $m->title?></option>
				<?php } ?>
				</optgroup>
				<optgroup label="من خارج لوحة التحكم">
					<option value="outside">كتابة الرابط</option>
				</optgroup>
				</select>
			</div>
			<div class="row">
				<div class="form-group mt-1">
					<label for="parent_id" class="col-md-3">قائمة فرعية من</label>
					<select name="parent_id" id="parent_id" class="form-control col-md-9">
					<option value="0">--</option>
					<?php
					$ar = ['parent_id'=>0];
					if( isset($edit) ) {
						$ar["ID!="] = $edit ;
					}
					$parent=$this->core_model->menu(
						$ar,
						1000,
						0,
						"menu_order",
						"asc"
					);
					// var_dump($row); die;
					
					foreach ($parent as $menu){ ?>
					<option <?php
						if( isset($row) && isset($row['parent_id']) && $row['parent_id']==$menu->ID){
							echo " selected";
						}?>
					value="<?=$menu->ID?>">|_ <?=$menu->title?></option>
					<?php }?>
					</select><!-- / .form-control -->
				</div><!-- / .form-control -->
			</div><!-- / .row -->

			<div class="row">
				<div class="form-group">
					<label for="url" class="col-md-3">رابط الصفحة</label>
					<input type="text" class="form-control col-md-9 ltr" name="url" id="url" value="<?php echo $row['url']?>" data-validation="required" data-validation-error-msg="رابط غير صحيح" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل الرابط</label>
					<select class="form-control col-md-9" name="active" id="active">
						<option value="Y">نعم</option>
						<option value="N">لا</option>
					</select>
				</div>
			</div>
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php echo form_close();?>
<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>وسائل التواصل</li>
		</ul>
	</div>
</div>

<?php echo form_open_multipart("new_admin/social");
$row2=json_decode(json_encode($row), true);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل وسائل التواصل الإجتماعي</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			
			
			
			<div class="row">
				<div class="form-group">
					<label for="facebook" class="col-md-3">صفحة الفيسبوك</label>
					<input type="text" class="form-control col-md-9" name="facebook" id="facebook" value="<?php echo $row->facebook ?>" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="twitter" class="col-md-3">توتير</label>
					<input type="text" class="form-control col-md-9" name="twitter" id="twitter" value="<?php echo $row->twitter ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="instagram" class="col-md-3">انستاجرام</label>
					<input type="text" class="form-control col-md-9" name="instagram" id="instagram" value="<?php echo $row->instagram ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="youtube" class="col-md-3">يوتيوب</label>
					<input type="text" class="form-control col-md-9" name="youtube" id="youtube" value="<?php echo $row->youtube ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="google-plus" class="col-md-3">جوجل+</label>
					<input type="text" class="form-control col-md-9" name="google-plus" id="google-plus" value="<?php echo $row2['google-plus'] ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="snapchat" class="col-md-3">سناب شات</label>
					<input type="text" class="form-control col-md-9" name="snapchat" id="snapchat" value="<?php echo $row->snapchat ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="linkedin" class="col-md-3">لنكدن</label>
					<input type="text" class="form-control col-md-9" name="linkedin" id="linkedin" value="<?php echo $row->linkedin ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="tiktok" class="col-md-3">تيك توك</label>
					<input type="text" class="form-control col-md-9" name="tiktok" id="tiktok" value="<?php echo $row->tiktok ?>" />
				</div>
			</div>
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="edit_settings" value="1"> <span class="glyphicon glyphicon-check"></span> تعـديــل</button>
	</div>
</div>
<?php echo form_close() ?>

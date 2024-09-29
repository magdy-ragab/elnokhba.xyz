<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li>الرد على الرسائل</li>
		</ul>
	</div>
</div>

<?php 
echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/reply/".$row->ID);
echo '<input type="hidden" name="content" value="'. $content .'" />';
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-9"><h4 class="panel-title">
				الرد على : <?php echo $row->subject?></h4>
			</div>
			<div class="col-md-3">
				<div class="btn-group col-md-12">
				<a class="btn btn-xs btn-success col-md-6" href='<?php echo base_url().$this->core_model->admin_dir(); ?>/contacts/read/<?php echo $row->ID?>'"><i class="glyphicon glyphicon-share-alt"></i> عودة</a>
				<button class="btn btn-xs btn-primary col-md-6" name="send" value="1"><i class="glyphicon glyphicon-ok"></i> إرسال</button>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
			
			if($sent)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم
				الرد على الرسالة
				</div>';
			}
			
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">عنوان الرسالة</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo "RE: " . $row->subject?>" data-validation="required" data-validation-error-msg="عنوان الرسالة" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="content" class="col-md-3">الرسالة</label>
					<div class="col-md-9 no-pad"><div class="summernote" id="summernote"><?php echo $content?></div></div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php form_close();?>
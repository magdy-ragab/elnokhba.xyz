<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة صورة</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الاسلايدر <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">إضافة صورة</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الصور</a></li>
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
	echo '<input type="hidden" name="old" value="'. $row['pic'] .'" />';
	echo '<input type="hidden" name="thumb" value="'. $row['thumbnail'] .'" />';
}
?>
<input type="hidden" name="content" id="content" value='<?php echo ($row['content'])?>' />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $page_title?></h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
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
			
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة الصورة
				<a href="'.$admin_dir.'/'.$this->router->fetch_class().'/add/" class="btn btn-primary btn-xs">إضافة صورة جديدة</a>
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الصورة</div>';
			}
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">عنوان الصورة</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="عنوان الصفحة" />
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">العنوان الفرعي</label>
					<input
						type="text"
						class="form-control col-md-9"
						name="content"
						id="content"
						value="<?php echo $row['content']?>" data-validation="required"
						data-validation-error-msg="العنوان الفرعي" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="up" class="col-md-3">صورة الخلفية</label>
					<input type="file" class="form-control <?php if($row['pic']){ echo "col-md-8";}else{echo 'col-md-9';} ?>" name="up" id="up" />
					<?php 
					if($row['pic']) echo '<div class="col-md-1 text-center"><a href="'.base_url().'/uploads/slider/'.$row['pic'].'" target="_blank"><img src="'.base_url().'uploads/slider/'.$row['thumbnail'].'" class="img-responsive img-rounded" /></a></div>';?>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل الصورة</label>
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
<?php form_close();?>
<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1>قائمة الطعام</h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة للقائمة</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown"><?php echo $titles[0] ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled"><?php echo $titles[0] ?></a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>"><?php echo $titles[1] ?></a></li>
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
if(in_array('content' , $has)){ 
?>
<input type="hidden" name="content" id="content" value='<?php echo ($row['content'])?>' />
<?php }?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $page_title?></h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
			if($no_upload)
			{

				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>لم تقم برفع صورة</div>';		
			}
			
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
				هذه الصورة موجود من قبل</div>';
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
				تم تعديل االصورة</div>';
			}
			?>
			<?php if(in_array('title' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">عنوان الصورة</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="عنوان الصورة" />
				</div>
			</div><?php }?>
			
			<?php if(in_array('pic' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="up" class="col-md-3">الصورة</label>
					<input<?php if($row['ID']) echo " disabled";?> type="file" class="form-control <?php if($row['pic']){ echo "col-md-8";}else{echo 'col-md-9';} ?>" name="up" id="up" />
					<?php 
					if($row['pic']) echo '<div class="col-md-1 text-center"><a href="'.base_url().'uploads/'.$this->router->fetch_class().'/'.$row['pic'].'" target="_blank"><img src="'.base_url().'uploads/'.$this->router->fetch_class().'/'.$row['thumbnail'].'" class="img-responsive img-rounded" /></a></div>';?>
				</div>
			</div><?php }?>
			<?php if(in_array('active' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل الصورة</label>
					<select class="form-control col-md-9" name="active" id="active">
						<option value="Y"<?php if($row['active']=='Y') echo " selected"; ?>>نعم</option>
						<option value="N"<?php if($row['active']=='N') echo " selected"; ?>>لا</option>
					</select>
				</div>
			</div><?php }?>

			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">السعر</label>
					<input type="decimal" class="form-control col-md-9" name="price" id="price" value="<?php echo $row['price']?>" data-validation="float" data-validation-error-msg="السعر يجب أن يكون ارقاماً" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="star" class="col-md-3">مميز (تعرض في الرئيسية)</label>
					<select class="form-control col-md-9" name="star" id="star">
						<option value="Y"<?php if($row['star']=='Y') echo " selected"; ?>>نعم</option>
						<option value="N"<?php if($row['star']=='N') echo " selected"; ?>>لا</option>
					</select>
				</div>
			</div>
			
			<?php if(in_array('content' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="content" class="col-md-3">التفاصيل</label>
					<div class="col-md-9 no-pad"><div class="summernote" id="summernote"><?php echo $row['content']?></div></div>
				</div>
			</div><?php }?>
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php form_close();?>
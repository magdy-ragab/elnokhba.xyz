<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة ترويج</li>
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
				هذا الترويج موجود من قبل</div>';
			}
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة الترويج
				<a href="'.$admin_dir.'/'.$this->router->fetch_class().'/add/" class="btn btn-primary btn-xs">إضافة ترويج جديدة</a>
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الترويج</div>';
			}
			?>
			<?php if(in_array('title' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">عنوان الخبر</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="عنوان الترويج" />
				</div>
			</div><?php }?>
			<?php if(in_array('date' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="news_date" class="col-md-3">تاريخ إنتهاء العرض </label>
					<input type="date" class="form-control col-md-9" name="news_date" id="news_date" value="<?php echo $row['news_date']?>" data-validation="required" data-validation-error-msg="تاريخ الترويج" />
				</div>
			</div><?php }?>
			
			<?php if(in_array('active' , $has)){ ?><div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل العرض</label>
					<select class="form-control col-md-9" name="active" id="active">
						<option value="Y"<?php if($row['active']=='Y') echo " selected";?>>نعم</option>
						<option value="N"<?php if($row['active']=='N') echo " selected";?>>لا</option>
					</select>
				</div>
			</div><?php }?>
			
		    <div class="row">
			<div class="form-group">
			    <label for="count" class="col-md-3">عدد المنتجات المتاح بيعها</label>
			    <select name="count" id="count" class="col-md-9 form-control">
				<?php for($i=1; $i<=20; $i++) { ?>
				<option value="<?=$i?>"<?php if($row['meta']==$i) echo " selected";?>><?=$i?></option>
				<?php } ?>
			    </select>
			</div>
		    </div>
		    
		    <div class="row">
			<div class="form-group">
			    <label for="cat" class="col-md-3">القسم</label>
			    <select name="cat" id="cat" class="form-control col-md-9">
				<?php echo $this->core_model->catList($row['parent_id']) ?>
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
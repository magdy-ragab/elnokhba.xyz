<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>الفئات</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الاقسام <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">اضافة قسم</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الاقسام</a></li>
		</ul>
	</div>
</div>

<?php 
if(!$cat['ID'])
{
?>
    <div class="row"><div class="col-md-12 col-mrgn"><button class="btn btn-danger col-md-2 col-md-offset-10" onclick="$('.hiddenElement').slideToggle('fast');">
    <i class="glyphicon glyphicon-plus"></i> إضافة فئة </button></div></div>
<?php 
    $formClass= array("class"=>"hiddenElement");
} else{
    $formClass= array();
}

if($cat[ID]) {
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/edit_brand/".$cat['ID']."/".$row['ID'],$formClass);
}else{
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/brands/".$parent,$formClass);
}

if($cat[ID]) {
	echo '<input type="hidden" name="id" value="'. $row['ID'] .'" />';
	echo '<input type="hidden" name="old" value="'. $row['pic'] .'" />';
	echo '<input type="hidden" name="thumb" value="'. $row['thumbnail'] .'" />';
}
echo '<input type="hidden" name="parent_id" value="'. $parent .'" />';
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">اضافة فئة</h4>
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
				هذا القسم موجود من قبل</div>';
			}
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة الفئة
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الفئة</div>';
			}
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم الفئة</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="اسم الفئة" />
				</div>
			</div>
			
			
			
			
			
			<div class="row">
				<div class="form-group">
					<label for="up" class="col-md-3">صورة الفئة</label>
					<input type="file" class="form-control <?php if($row['pic']){ echo "col-md-8";}else{echo 'col-md-9';} ?>" name="up" id="up" />
					<?php 
					if($row['pic']) echo '<div class="col-md-1 text-center"><a href="'.base_url().'uploads/'.$this->router->fetch_class().'/'.$row['pic'].'" target="_blank"><img src="'.base_url().'uploads/'.$this->router->fetch_class().'/'.$row['thumbnail'].'" class="img-responsive img-rounded" /></a></div>';?>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل الفئة</label>
					<select class="form-control col-md-9" name="active" id="active">
						<option value="Y">نعم</option>
						<option value="N">لا</option>
					</select>
				</div>
			</div>
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($cat['ID']) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($cat['ID']) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php echo form_close();?>





<?php
if(!$cat['ID']){ ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-8">الفئة</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
           foreach($this->core_model->pages( array("module"=>'brands', "parent_id"=>$parent ) ) as $row)
           {
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
				<a class="gray" href="javascript:;" onclick="$('#input_<?php echo $row->ID?>').slideToggle('fast')"><span class="glyphicon glyphicon-link"></span></a>
				<a class="gray" href="<?php  echo base_url()."brands/".$row->ID;?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>
				<b><?php echo $row->title;?></b> 
				<p class="myhidden ltr" id="input_<?php echo $row->ID?>"><input type="text" class="form-control" value="<?php echo base_url()."brands/".$row->ID; ?>" /></p>
				</td>
				<td class="text-center">
					<div class="btn-group">
					<a href="<?php echo $admin_dir; ?>/<?php echo $cont?>/edit_brand/<?php echo $row->parent_id ?>/<?php echo $row->ID ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> تعديل</a>
					<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="<?php echo $row->title?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
					</div>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
<?php } ?>




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
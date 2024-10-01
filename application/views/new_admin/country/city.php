<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>الدول</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الدول <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">اضافة دولة</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الدول</a></li>
		</ul>
	</div>
</div>

<?php 
if($edit) {
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/city_edit/".$edit);
}else{
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/city/".$country['ID']);
}
if($edit){
	echo '<input type="hidden" name="id" value="'. $edit .'" />';

}


echo '<input type="hidden" name="country" value="'. $country['ID'] .'" />';

?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">مدن دولة : <?php 
            if($country)
            {
                echo $country['title'];
            }
        ?></h4>
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
				تمت إضافة المدن
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل المدينة</div>';
			}
			?>
			<?php if($row['title']){ ?><div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">المدينة </label>
                    <input type="text" class="form-control col-md-9" name="title" id="title" data-validation="required" data-validation-error-msg="اسم المدينة" value="<?php echo $row['title']?>" />
				</div>
			</div><?php }else{ ?>
               <div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">المدن <a href="#" data-toggle="modal" data-target="#deleteModel"><i class="glyphicon glyphicon-question-sign red"></i></a></label>
                    <textarea class="form-control col-md-9" name="title" id="title" data-validation="required" data-validation-error-msg="اسم المدينة"><?php echo $row['title']?></textarea>
				</div>
			</div>
            <?php } ?>
			
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php echo form_close();?>



<?php
if(!$row['ID']){ 
//pages($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
echo form_open( $this->core_model->admin_dir()."/country/save_order"); 
?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-7">المدينة</th>
				<th class="col-xs-2">الترتيب</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($this->core_model->pages(array("module"=>'city', "parent_id"=>$country['ID']), 1000,0, "p_order", "asc") as $row)
			{
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<b><?php echo $row->title;?></b> 
				</td>
				<td>
					<select name="menu_order[<?php echo $row->ID?>]" id="menu_order_<?php echo $row->ID?>" class="form-control">
					<?php
					for($i=1; $i<=80; $i++) 
					{
					?><option value="<?php echo $i?>"<?php if($row->p_order==$i) echo " selected"; ?>><?php echo $i;?></option> <?php
					}
					?>
					</select>
				</td>
				<td class="text-center">
					<div class="btn-group">
					<a href="<?php echo $admin_dir; ?>/<?php echo $cont?>/city_edit/<?php echo $row->ID ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> تعديل</a>
					<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="<?php echo $row->title?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
					</div>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="4" class="text-left">
					<button class="btn btn-primary" type="submit" name="save_order" value="1">حفظ الترتيب</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php 
echo form_close();;
} ?>







<div id="deleteModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">المدن</h4>
      </div>
      <div class="modal-body text-danger">
        <p class="red">يمكنك ادخال عدة مدن مرة واحدة بكتابة كل مدينة في سطر مستقل <stron>مثال</stron></p>
<pre>الرياض
الدمام
الموضوع
المدينة
</pre>
     
      </div>
      <div class="modal-footer">
     	<div class="col-xs-6 col-xs-offset-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>إضافة قسم</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الاقسام <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">اضافة حقل</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الحقول</a></li>
		</ul>
	</div>
</div>

<?php 
if($row['ID']) {
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/edit_field/".$row['ID']);
}else{
	echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/fields/".$cat['ID']);
}
if($edit){
	echo '<input type="hidden" name="id" value="'. $row['ID'] .'" />';
}


?>

<input type="hidden" name="parent_id" id="parent_id" value='<?php echo ($cat['ID'])?>' />
<input type="hidden" name="module" id="module" value='products' />

    <div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
		 اضافة حقول
		:
		<?php echo $cat['title']; ?>
		</h4>
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
			
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة الحقل
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الحقل</div>';
			}
			?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم الحقل</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="اسم الحقل" />
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="input_type" class="col-md-3">نوع الحقل</label>
					<select class="form-control col-md-9" name="input_type" id="input_type" data-validation="required" data-validation-error-msg="نوع الحقل مطلوب">
                       <option value="text"<?php if($row['input_type']== 'text') echo ' selected';?>>مربع نصي</option>
                       <option value="textarea"<?php if($row['input_type']== 'textarea') echo ' selected';?>>مربع نصي كبير</option>
                       <!-- <option value="editor"<?php if($row['input_type']== 'editor') echo ' selected';?>>محرر كامل (لوحة التحكم فقط)</option> -->
                       <option value="numbers"<?php if($row['input_type']== 'numbers') echo ' selected';?>>ارقام فقط</option>
                       <!-- <option value="pic"<?php if($row['input_type']== 'pic') echo ' selected';?>>صورة</option> -->
                       <option value="date"<?php if($row['input_type']== 'date') echo ' selected';?>>تاريخ</option>
                       <option value="color"<?php if($row['input_type']== 'color') echo ' selected';?>>تحديد لون</option>
                    </select>
				</div>
			</div>
			
			<div class="row fieldOption text-v textarea-v editor-v numbers-v date-v">
				<div class="form-group">
					<label for="default_value" class="col-md-3">القيمة الافتراضية</label>
					<input type="text" class="form-control col-md-9" name="default_value" id="default_value" value="<?php echo $row['default_value']?>" />
				</div>
			</div>
			
			
			<div class="row fieldOption text-v textarea-v editor-v numbers-v date-v">
				<div class="form-group">
					<label for="searchable" class="col-md-3">تضمين في البحث ؟</label>
					<select class="form-control col-md-9" name="searchable" id="searchable">
						<option value="N"<?php if($row['searchable']== 'N') echo ' selected';?>>لا</option>
						<option value="Y"<?php if($row['searchable']== 'Y') echo ' selected';?>>نعم</option>
					</select>
				</div>
			</div>
			
			<div class="row fieldOption text-v textarea-v editor-v numbers-v pic-v date-v color-v">
				<div class="form-group">
					<label for="input_required" class="col-md-3">حقل إجباري؟</label>
					<select class="form-control col-md-9" name="input_required" id="input_required">
						<option value="N"<?php if($row['input_required']== 'N') echo ' selected';?>>لا</option>
						<option value="Y"<?php if($row['input_required']== 'Y') echo ' selected';?>>نعم</option>
					</select>
				</div>
			</div>
			
			<div class="row fieldOption text-v textarea-v editor-v numbers-v date-v color-v">
				<div class="form-group">
					<label for="error_msg" class="col-md-3">رسالة الخطأ </label>
					<input type="text" class="form-control col-md-9" name="error_msg" id="error_msg" value="<?php echo $row['error_msg']?>" />
				</div>
			</div>
			
			<div class="row fieldOption numbers-v">
				<div class="form-group">
					<label for="number_min" class="col-md-3">القيمة اكبر من</label>
					<input type="number" class="form-control col-md-3" name="number_min" id="number_min" value="<?php echo $row['number_min']?>" />
					<label for="number_max" class="col-md-3 text-center">القيمة اصغر من</label>
					<input type="number" class="form-control col-md-3" name="number_max" id="number_max" value="<?php echo $row['number_max']?>" />
				</div>
			</div>
			
			<div class="row fieldOption pic-v">
				<div class="form-group">
					<label for="pic_thumb" class="col-md-2">عمل نسخة مصغرة</label>
					<div class="col-md-1"><input type="checkbox" name="pic_thumb" id="pic_thumb" value="Y"></div>
					<input type="number" class="form-control col-md-3" name="thumb_width" id="thumb_width" value="<?php echo $row['thumb_width']?>" />
					<label for="number" class="col-md-3 text-center">: عرضxطول</label>
					<input type="number" class="form-control col-md-3" name="thumb_height" id="thumb_height" value="<?php echo $row['thumb_height']?>" />
				</div>
			</div>
			
			<!--<div class="row fieldOption date-v">
				<div class="form-group">
					<label for="no_prev_date" class="col-md-3">لاتقبل تاريخاً سابق لليوم</label>
					 <div class="col-md-9"><input type="checkbox" name="no_prev_date" id="no_prev_date" value="Y"<?php if($row['no_prev_date']== 'Y') echo ' checked';?> /></div>
				</div>
			</div>-->
			
			<div class="row fieldOption color-v">
				<div class="form-group">
					<label for="multi_color" class="col-md-3">إمكانية تحديد أكثر من لون</label>
					 <div class="col-md-9"><input type="checkbox" name="multi_color" id="multi_color" value="Y"<?php if($row['multi_color']== 'Y') echo ' checked';?> /></div>
				</div>
			</div>
			
			
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($row['ID']) echo 'edit_field'; else echo 'add_field';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($row['ID']) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php echo form_close();?>



<?php echo form_open_multipart( $this->core_model->admin_dir()."/{$cont}/save_order"); ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-4">الحقل</th>
				<th class="col-xs-2">النوع</th>
				<th class="col-xs-2">الترتيب</th>
				<th class="col-xs-1">اجباري</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
		<?php $j=1;
        foreach( $this->core_model->fieldList($cat['ID']) as $row ) {
        ?>
		<tr>
            <td><?php echo $j++; ?></td>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $this->core_model->field_translate_type($row->input_type);?></td>
            <td><select name="menu_order[<?php echo $row->ID?>]" id="menu_order_<?php echo $row->ID?>" class="form-control">
                <?php
                for($i=1; $i<=30; $i++) 
                {
                ?><option value="<?php echo $i?>"<?php if($row->input_order==$i) echo " selected"; ?>><?php echo $i;?></option> <?php
                }
                ?>
                </select>
            </td>
            <td><?php if($row->input_required=='N') {
                echo 'لا';
                }else{
                    echo 'نعم';
                    if($row->error_msg)
                    {
                        echo ' <span data-toggle="tooltip" title="'.$row->error_msg.'"><i class="red glyphicon glyphicon-exclamation-sign"></i></span>' ;
                    }
                }?></td>
		    <td class="text-center">
					<div class="btn-group">
					<a href="<?php echo $admin_dir; ?>/<?php echo $cont?>/edit_field/<?php echo $row->ID ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> تعديل</a>
					<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="<?php echo $row->title?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
					</div>
				</td>
		</tr>
       <?php } ?>
       <tr>
           <td colspan="6"><button class="btn btn-primary fl" name="save_menu" value="1"> <span class="glyphicon glyphicon-repeat"></span> تغيير الترتيب</button></td>
       </tr>
        </tbody>
    </table>
</div>
<?php echo form_close(); ?>

<script>
$(".row.fieldOption").hide(1);
$( function(){
    $("#input_type").change(function(){
       getFieldProperties()
    });
    getFieldProperties();
});
    
function getFieldProperties()
{
    $(".row.fieldOption").slideUp(1);
    $(".row."+ $("#input_type").val()+"-v").slideDown(50);
}
</script>












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
      		<button type="button" id="delAction" data-url="<?php echo base_url()."new_admin/category/del_field/{$row->ID}" ?>" class="btn btn-danger">حذف</button>
      	</div>
      	<div class="col-xs-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
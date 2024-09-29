<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1>أكواد الخصم</h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>أكواد الخصم</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الأكواد <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">اضافة كود</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الأكواد</a></li>
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

if(in_array('content' , $has)){ 
?>
<input type="hidden" name="content" id="content" value='<?php echo ($row['content'])?>' />
<?php }?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">اضافة كود خصم</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
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
				تمت إضافة الكود
				<a href="'.$admin_dir.'/'.$this->router->fetch_class().'/add/" class="btn btn-primary btn-xs">اضافة كود جديد</a>
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الكود</div>';
			}
			?>
			<div class="row">
			    <div class="form-group">
				<label for="title" class="col-md-3">اسم الكود</label>
				<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="اسم الكود" />
			    </div>
			</div>
		    
		    
			<div class="row">
			    <div class="form-group">
				<label for="title" class="col-md-3">رمز الكود</label>
				<input type="text" class="form-control col-md-9" name="code" id="code" value="<?php echo $row['title']?>" data-validation="required" data-validation-error-msg="الكود" />
			    </div>
			</div>
		    
			<div class="row">
			    <div class="form-group">
				<label for="title" class="col-md-3">نسبة الخصم</label>
				<select class="form-control col-md-9" name="discount" id="discount">
				    <?php for($i=5; $i<=95; $i+=5){ ?>
				    <option value="<?=$i?>"><?=$i?>%</option>
				    <?php } ?>
				</select>
			    </div>
			</div>
		    
		    
			
			<?php if(in_array('active' , $has)){ ?><div class="row">
    			<div class="form-group">
			    <label for="active" class="col-md-3">تفعيل ؟</label>
			    <select class="form-control col-md-9" name="active" id="active">
				<option value="Y"<?php if($row['active']=='Y') echo ' selected'; ?>>نعم</option>
				<option value="N"<?php if($row['active']=='N') echo ' selected'; ?>>لا</option>
			    </select>
				</div>
			</div><?php }?>
			
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php form_close();?>






<div id="deleteModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اضافة دولة</h4>
      </div>
      <div class="modal-body text-danger">
        <p class="red">- رمز الدولة يتكون من حرفين باللغة الانجليزية و هو يمثل معرف فريد لها، مثل</p>
        <table>
                <tr>
                    <td width=150><kbd>sa</kbd> السعودية</td>
                    <td width=150><kbd>ae</kbd> الامارات</td>
                </tr><tr>
                    <td><kbd>eg</kbd> مصر</td>
                    <td><kbd>ye</kbd> اليمن</td>
                </tr>
            </table>
      </div>
      <div class="modal-footer">
     	<div class="col-xs-6 col-xs-offset-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
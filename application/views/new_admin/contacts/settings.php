<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>

<?php echo form_open("new_admin/contacts/settings"); ?>

<!-- <label for="map" class="col-md-3">كود خريطة جوجل</label>
<input type="text" name="map" id="map" class="col-md-9 control-form" value='<?php echo $row->map;?>' /> -->

<div class="h20"></div>

<label for="content" class="col-md-3">نص الصفحة</label>
<textarea class="col-md-9 form-control" name="content" id="content"><?php echo $row->contact_data?></textarea>

<button name="save_contact_data" type="submit" value="1" class="form-control btn btn-primary col-md-6 col-md-offset-6">تعديل البيانات</button>
<?php echo form_close();?>





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
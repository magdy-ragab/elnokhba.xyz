<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
		 data-toggle="dropdown"><?php echo $page_title ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo $admin_dir?>/<?php echo $cont?>/add">إضافة عنصر</a></li>
			<li class="disabled"><a href="<?php echo $admin_dir?>/<?php echo $cont?>/view">عرض العناصر</a></li>
		</ul>
	</div>
</div>
<?php echo form_open( $this->core_model->admin_dir()."/".$cont."/save_order"); ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-8">عنوان الصفحة</th>
				<th class="col-xs-2">الترتيب</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->core_model->menu(['parent_id'=>0]) as $row){ 
				$this->load->view(
					"new_admin/menu/menu-row", [
						"row"=>$row,
						"admin_dir"=>$admin_dir,
						"cont"=>$cont,
						"sub"=> false
					]);
			} ?>
			<tr>
				<td colspan="4" class="text-left">
					<button class="btn btn-primary" type="submit" name="save_order" value="1">حفظ الترتيب</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>

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
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
			<li><a href="<?php echo $admin_dir?>/<?php echo $cont?>/add">إضافة صورة</a></li>
			<li class="disabled"><a href="<?php echo $admin_dir?>/<?php echo $cont?>/view">عرض الصور</a></li>
		</ul>
	</div>
</div>
<?php echo form_open( $this->core_model->admin_dir()."/".$cont."/save_order"); ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-7">الصورة</th>
				<th class="col-xs-2">الترتيب</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($this->core_model->sliders(array(),1000,0,"slider_order","asc") as $row)
			{
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
				<a class="gray" href="javascript:;" onclick="$('#input_<?php echo $row->ID?>').slideToggle('fast')"><span class="glyphicon glyphicon-picture"></span></a>
				<a class="gray" href="<?php echo base_url()."uploads/slider/".$row->pic ?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>
				<b><?php echo $row->title;?></b> 
				<p><small class="text-muted"><?php echo mb_substr( strip_tags($row->content), 0,50,"utf-8");?></small></p>
				<p class="myhidden ltr" id="input_<?php echo $row->ID?>"><img src="<?php echo base_url()."uploads/slider/".$row->thumbnail ?>" /></p>
				</td>
				<td>
					<select name="slider_order[<?php echo $row->ID?>]" id="menu_order_<?php echo $row->ID?>" class="form-control">
					<?php
					for($i=0; $i<=30; $i++) 
					{
					?><option value="<?php echo $i?>"<?php if($row->slider_order==$i) echo " selected"; ?>><?php echo $i;?></option> <?php
					}
					?>
					</select>
				</td>
				<td class="text-center">
					<div class="btn-group">
					<a href="<?php echo $admin_dir; ?>/<?php echo $cont?>/edit/<?php echo $row->ID ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> تعديل</a>
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
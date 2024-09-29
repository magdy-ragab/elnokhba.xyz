<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1>قائمة الطعام</h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li><?php echo $titles[1] ?></li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
		 data-toggle="dropdown"><?php echo $page_title ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo $admin_dir?>/<?php echo $cont?>/add"><?php echo $titles[0] ?></a></li>
			<li class="disabled"><a href="<?php echo $admin_dir?>/<?php echo $cont?>/view"><?php echo $titles[1] ?></a></li>
		</ul>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-5">الصورة</th>
				<th class="col-xs-4">الخصائص</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($this->core_model->pages(array("module"=>$cont)) as $row)
			{
				$meta= unserialize($row->meta);
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<a class="gray" href="javascript:;" onclick="$('#input_<?php echo $row->ID?>').slideToggle('fast')"><span class="glyphicon glyphicon-link"></span></a>
				<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
				<b><?php echo $row->title;?></b> 
				<p class="myhidden ltr" id="input_<?php echo $row->ID?>"><a href="<?php echo base_url()."uploads/gallery/".$row->pic ?>" target="_blank"><img src="<?php echo base_url()."uploads/gallery/".$row->thumbnail ?>" class="img-responsive" /></a></p>
				</td>
				<td><?php echo "الطول و العرض : {$meta['w']}x{$meta['h']}<br />الحجم:{$meta['size']}<br />النوع:{$meta['type']}<br />تاريخ الرفع : {$row->date_create}"; ?>
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
		</tbody>
	</table>
</div>









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
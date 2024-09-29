<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1>اكواد الخصم</h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>اكواد الخصم</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
		 data-toggle="dropdown">اكواد الخصم <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo $admin_dir?>/<?php echo $cont?>/add">اكواد الخصم</a></li>
			<li class="disabled"><a href="<?php echo $admin_dir?>/<?php echo $cont?>/view">عرض الاكواد</a></li>
		</ul>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-3">الكود</th>
				<th class="col-xs-3">الرمز</th>
				<th class="col-xs-2">النسبة</th>
				<th class="col-xs-2">مرات الاستخدام</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($this->core_model->pages(array("module"=>'discountcode')) as $row)
			{
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
				<?=$row->title;?>
				</td>
				<td><input type="text" class="hiddenBorders" value="<?=$row->content;?>"  onClick="this.setSelectionRange(0, this.value.length)"></td>
				<td><?=$row->meta;?> <a href="<?=$admin_dir."/".$cont."/states/".$row->ID;?>" class="btn-info btn-xs"> الاحصائيات </a></td>
				<td><?=$row->view;?></td>
				<td class="text-center">
					<div class="btn-group">
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
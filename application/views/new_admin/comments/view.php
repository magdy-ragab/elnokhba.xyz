<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-5">التعليق</th>
				<th class="col-xs-2">المنتج</th>
				<th class="col-xs-2">المعلق</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$where=array("module"=>'comment');
			if($id) $where['uid']=$id;
			foreach ($this->core_model->pages($where) as $row)
			{
			    $prod=$this->db->where("ID='{$row->parent_id}'")->get("pages")->row();
			    $user=$this->db->where("ID='{$row->uid}'")->get("user")->row();
			?>
			<tr>
				<td class="text-center"><?php echo ++$table_index; ?></td>
				<td>
				<p><small class="text-muted"><?php echo mb_substr( strip_tags($row->content), 0,50,"utf-8");?></small></p>
				</td>
				<td><a href="<?php echo $this->shop->productURL($row->parent_id)?>"><?php echo $prod->title?></a>
				<td><a href="<?php echo base_url()."new_admin/users/edit/{$user->ID}";?>"><?php echo $user->username?></a>
				</td>
				<td class="text-center">
				    <div class="btn-group">
					<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="التعليق رقم <?php echo "({$table_index})";?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
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
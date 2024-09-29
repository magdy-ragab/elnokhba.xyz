<?php $cont = $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title ?></h1></div>
<div class="row">
    <div class="col-md-10">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li><?php echo $page_title; ?></li>
	</ul>
    </div>
    <div class="col-md-2 hidden-xs">
	<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
	   data-toggle="dropdown"><?php echo $page_title ?> <span class="caret"></span></a>
	<ul class="dropdown-menu">
	    <li><a href="<?php echo $admin_dir ?>/<?php echo $cont ?>/add"><?php echo $titles[0] ?></a></li>
	    <li class="disabled"><a href="<?php echo $admin_dir ?>/<?php echo $cont ?>/view"><?php echo $titles[1] ?></a></li>
	</ul>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
	<thead>
	    <tr>
		<th class="col-xs-1">#</th>
		<th class="col-xs-7">المنتج</th>
		<th class="col-xs-2">البائع</th>
		<th class="col-xs-2">إجراءات</th>
	    </tr>
	</thead>
	<tbody>
	    <?php
	    foreach ( $this->db->where(array("promotion"=>$id))->get("promotion_product")->result() as $row) {
		$prod= $this->core_model->product_data($row->productid);
		$user= $this->db->where(array("ID"=>$row->uid))->get("user")->row()
		?>
    	    <tr>
    		<td class="text-center"><?php echo ++$table_index; ?></td>
    		<td>
		    <a href="<?=base_url();?>new_admin/products/edit/<?=$prod['ID']?>"><strong><?php echo $prod['title']; ?></strong></a>
    		</td>
    		<td>
		    <?php echo $user->username."<br /><a href='mailto:{$user->email}'>{$user->email}</a>";?>
    		</td>
    		<td class="text-center">
    		    <div class="btn-group">
    			<button type="button" data-controller="<?php echo $cont ?>_del_prod" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID ?>" data-title="<?php echo $prod['title'];?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
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
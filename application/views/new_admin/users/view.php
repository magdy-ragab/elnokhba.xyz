<?php $cont = $this->router->fetch_class() ?>
<div class="page-header"><h1>عرض الأعضاء</h1></div>
<div class="row">
    <div class="col-md-12">
	<ul class="breadcrumb">
	    <li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
	    <li>عرض الاعضاء</li>
	</ul>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
	<thead>
	    <tr>
		<th>#</th>
		<th>المستخدم</th>
		<th>المشتريات</th>
		<th>التعليقات</th>
		<th>اجراءات</th>
	    </tr>
	</thead>
	<tbody>
	    <?php $i=1;
	    foreach( $this->shop->userList("`user_type`='user'") as $row ) :
		$net= $this->shop->userBuyedValue($row->ID);
		//var_dump($net);
		?>
	    <tr>
    		<td><?php echo $i; ?></td>
    		<td><?php echo "{$row->username}"?></td>
    		<td><?php echo $net['lastPrice'];?></td>
		<td><a href="<?= base_url()."new_admin/comments/user/{$row->ID}"?>" class="btn btn-info btn-xs">التعليقات </a></td>
		<td class="text-center">
		    <div class="btn-group">
			<button type="button" data-controller="<?php echo $cont?>" class="delCat btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel" data-id="<?php echo $row->ID?>" data-title="<?php echo $row->title?>"><span class="glyphicon glyphicon-trash"></span> حذف</button>
		    </div>
		</td>
    	    </tr>
	    <?php $i++;
	    endforeach; ?>
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
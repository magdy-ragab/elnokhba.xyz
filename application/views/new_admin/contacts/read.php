<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>


<div class="row msg-heading">
	<h2 class="contactus_title col-md-6"><?php echo $row->name ." &lt;<a href=\"mailto:{$row->email}\">{$row->email}</a>&gt;";?></h2>
	<div class="col-md-6">
			<div class="btn-group fl">
				<button class="btn btn-primary" onclick='location.href= _admin+"contacts/reply/<?php echo $row->ID?>";'>الرد على الرسالة</button>
				<button class="btn btn-danger" onclick='$("#deleteModel").modal("show");'>حذف الرسالة</button>
			</div>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-4">
			<?php if( $row->mobile ) { ?>
				<a href="tel:<?php echo $row->mobile?>">
					<span class="glyphicon glyphicon-phone"></span>
					<?php echo $row->mobile?>
				</a>
			<?php } ?>
		</div>
		<div class="col-md-4"><?php echo $row->subject?></div>
		<div class="col-md-4">
			<span class="glyphicon glyphicon-calendar gray"></span>
			<?php echo $row->dateline;?>
		</div>
	</div>
	<div class="panel-body">
		
			<div class="text-muted">الرسالة</div>
			<div class="clearfix"><?php echo nl2br($row->message); ?></div>
		
	</div>
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
        <p>هل ترغب بحذف  <span>هذه الرسالة</span> فعلا ؟</p>
      </div>
      <div class="modal-footer">
      	<div class="col-xs-6 text-right">
      		<button type="button" id="delThis" onclick="location.href='<?php echo base_url().$this->core_model->admin_dir(); ?>/contacts/del/<?php echo $row->ID?>'" class="btn btn-danger">حذف</button>
      	</div>
      	<div class="col-xs-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">عودة</button>
      	</div>
      </div>
    </div>

  </div>
</div>
<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>

<?php echo form_open("new_admin/contacts/index"); ?>
<div class="row">
	<div class="col-xs-10 col-md-5 col-md-offset-7 col-xs-offset-2 text-left">
		<div class="btn-group">
			<button class="btn btn-xs btn-danger del" name="del" value="1">حذف المحدد</button>
		</div>
	</div>
</div>
<?php
if(null!==($this->input->post("del")))
{
	foreach( $this->input->post('sel') as $k )
	{
		$this->db->where("`ID`='{$k}'");
		$this->db->delete("contact");
	}
	echo '<div class="alert alert-danger fade in">
            <a href="#" data-dismiss="alert" aria-label="close" class="close">&times;</a>
            <span>تم الحذف</span>
        </div>';
}
?>
<div class="table-responsive comics-table">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-7">
				<div class="col-xs-1">
					<input type="checkbox" id="checkAll" />
				</div>
				<div class="col-xs-11">
				المرسل
				</div>
				</th>
				<th class="col-xs-2">تاريخ اﻹرسال</th>
				<th class="col-xs-2">إجراءات</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$limit=50;
			$table_index=0;
			foreach ($this->core_model->contacts( intval($this->input->get('start')*$limit) ) as $row)
			{
			?>
			<tr>
				<td class="text-center"><?php $table_index++; echo ($table_index+(intval($this->input->get('start'))*$limit)) ; ?></td>
				<td>
					<div class="col-xs-1"><input type="checkbox" name="sel[<?php echo $row->ID?>]" value="<?php echo $row->ID?>" /></div>
					<div class="col-xs-11">
						<span class="glyphicon glyphicon-eye-<?php echo($row->readed=='N')?"open":"close";?>"></span>
						<b><a href="<?php echo base_url().$this->core_model->admin_dir() ?>/contacts/read/<?php echo $row->ID; ?>"><?php echo $row->subject;?></a></b><br />
						<small class="text-muted"><?php echo mb_substr( strip_tags($row->message), 0,50,"utf-8");?></small></div>
				</td>
				<td>
					<?php echo $row->dateline;?>
				</td>
				<td class="text-center">
					<div class="btn-group">
					<a href="<?php echo base_url().$this->core_model->admin_dir() ?>/contacts/read/<?php echo $row->ID; ?>" role="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> قراءة</a>
					</div>
				</td>
			</tr>
			<?php
			}
			?>
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
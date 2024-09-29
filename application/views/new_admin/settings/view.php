<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>


<div class="table-responsive comics-table">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th class="col-xs-9">
				البحث
				</th>
				<th class="col-xs-2">تاريخ </th>
			</tr>
		</thead>
		<tbody>
			<?php
			$limit=50;
			$table_index=0;
			foreach ($this->core_model->search_archive() as $row)
			{
			?>
			<tr>
				<td class="text-center"><?php $table_index++; echo ($table_index+(intval($this->input->get('start'))*$limit)) ; ?></td>
				<td><?php echo $row->query;?></td>
				<td>
					<?php echo $row->dateline;?>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

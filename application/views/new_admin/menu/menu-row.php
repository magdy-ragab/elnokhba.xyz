
<tr>
	<td>
		<div class="<?=((isset($sub) && $sub == 'true')?"border-right border-right-5 pr-1 mr-1 pt-1_5 my--1 h5em text-muted":"text-primary")?>">
		<span class="gray glyphicon glyphicon-eye-<?php echo($row->active=='Y')?"open":"close";?>"></span>
		<a class="gray" href="javascript:;" onclick="$('#input_<?php echo $row->ID?>').slideToggle('fast')"><span class="glyphicon glyphicon-link"></span></a>
		<a class="gray" href="<?php echo $row->url ?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>
		<b><?php echo ((isset($sub) && $sub == 'true')?"|_ ":"").  $row->title;?></b> 
		<div class="myhidden ltr" id="input_<?php echo $row->ID?>"><input type="text" class="form-control" value="<?php echo $row->url ?>"  disabled /></div>
		</div>
	</td>
	<td>
		<select
			name="menu_order[<?php echo $row->ID?>]"
			id="menu_order_<?php echo $row->ID?>"
			class="form-control">
		<?php
		for($i=0; $i<=100; $i++) 
		{
		?><option value="<?php echo $i?>"<?php if($row->menu_order==$i) echo " selected"; ?>><?php echo $i;?></option> <?php
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
if ( $row->has_subs === 'Y'  ) {
	foreach ($this->core_model->menu(['parent_id'=>$row->ID]) as $rowx){ 
		$this->load->view(
			"new_admin/menu/menu-row", [
				"row"=>$rowx,
				"admin_dir"=>$admin_dir,
				"cont"=>$cont,
				"sub"=>true
			]
		);
	}
}
?>
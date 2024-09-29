<?php $cont = $this->router->fetch_class(); ?><div class="page-header">
	<h1><?php echo $page_title ?></h1>
</div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
			<li>إضافة منتج</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle"
			data-toggle="dropdown"><?php echo $titles[0] ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add"; ?>"
					class="disabled"><?php echo $titles[0] ?></a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view"; ?>"><?php echo $titles[1] ?></a></li>
		</ul>
	</div>
</div>

<?php
if ($edit) {
	echo form_open_multipart($this->core_model->admin_dir() . "/" . $cont . "/edit/" . $edit);
} else {
	echo form_open_multipart($this->core_model->admin_dir() . "/" . $cont . "/add");
}
if ($edit) {
	echo '<input type="hidden" name="id" value="' . $edit . '" />';
}

if( isset($row['pic'])) echo form_hidden('old_pic', $row['pic']);
if( isset($row['thumbnail'])) echo form_hidden('old_thumb', $row['thumbnail']);
?>
<input type="hidden" name="meta[price]" id="meta_price" value="" />
<input type="hidden" name="meta[discount]" id="meta_discount" value="" />
<input type="hidden" name="meta[parent_id]" id="meta_parent_cat" value="" />
<input type="hidden" name="cat_chain" id="cat_chain" value="<?=$row['cat_chain']?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $page_title ?></h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
		if ($uploads_error) {
		if (is_array($uploads_error)) {
			echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>';
			foreach ($uploads_error as $e)
			echo "{$e}<br />";
			echo '</div>';
		} else {
			echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' . $uploads_error . '</div>';
		}
		}

		if (isset($error) && is_array($error) && count($error)) {
		echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
		implode("", $error) . '</div>';
		}


		if (validation_errors()) {
		echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
		validation_errors() . '</div>';
		}
		if ($duplicated) {
		echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				هذا المنتتج موجود من قبل</div>';
		}
		if ($id) {
		echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة منتج
				</div>';
		}
		if ($updated) {
		echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل المنتج</div>';
		}
		?>
			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم المنتج</label>
					<input type="text" class="form-control col-md-9" name="title" id="title"
						value="<?php echo $row['title'] ?>" data-validation="required"
						data-validation-error-msg="اسم المنتج" />
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="code" class="col-md-3">كود المنتج</label>
					<input type="text" class="form-control col-md-9" name="code" id="code"
						value="<?php echo $row['code'] ?>" />
				</div>
			</div>
			

			<div class="row">
				<div class="form-group">
					<label for="content" class="col-md-3">وصف مختصر للمنتج</label>
					<textarea name="content" id="content"
						class="form-control col-md-9"
						><?=$row['content'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="full_content" class="col-md-3">مواصفات المنتج</label>
					<textarea name="full_content" id="full_content"
						class="form-control col-md-9"
						><?=$row['full_content'];?></textarea>
				</div>
			</div>

			<?php
if (isset($row['thumbnail_path']) && $row['thumbnail_path']) {
	?>
			<div class="row">
				<div class="form-group col-md-3 col-md-push-3">
					<img src="<?= $row['thumbnail_path'] ?>" class="img-responsive img-rounded img-thumbnail" />
				</div>
			</div>
			<?php
}
?>

			<div class="row">
				<div class="form-group">
					<label for="pic" class="col-md-3">الصورة الرئيسية</label>
					<input type="file" name="pic" class="col-md-9 form-control" id="pic">
				</div>
			</div>

			<?php
for ($i = 1; $i <= 4; $i++) {
	if (isset($row['pics'][$i]['pic'])) {
	?>
			<div class="row">
				<div class="form-group col-md-3 col-md-push-3">
					<img src="<?= $row['pics'][$i]['pic_path'] ?>" class="img-responsive img-rounded img-thumbnail" />
				</div>
			</div>
			<?php
	}
	?>
			<div class="row">
				<div class="form-group">
					<label for="pics_<?= $i ?>" class="col-md-3">صورة #<?= $i ?></label>
					<input type="file" name="pics_<?= $i ?>" class="col-md-9 form-control" id="pics_<?= $i ?>">
				</div>
			</div>
			<?php
}
?>

			<div class="row">
				<div class="form-group">
					<label for="price" class="col-md-3">السعر</label>
					<input type="text" class="form-control col-md-9" name="meta[price]" id="price"
						value="<?php echo $row['price'] ?>" />
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="rate" class="col-md-3">التقييم</label><!-- / .col-md-3 -->
					<select name="rate" id="rate" class="form-control col-md-9">
						<option <?php 
							if(isset($row) && isset($row['rate']) && $row['rate']==5){
								echo " selected";
							} ?> value="5">5</option>
						<option <?php 
							if(isset($row) && isset($row['rate']) && $row['rate']==4){
								echo " selected";
							} ?> value="4">4</option>
						<option <?php 
							if(isset($row) && isset($row['rate']) && $row['rate']==3){
								echo " selected";
							} ?> value="3">3</option>
						<option <?php 
							if(isset($row) && isset($row['rate']) && $row['rate']==2){
								echo " selected";
							} ?> value="2">2</option>
						<option <?php 
							if(isset($row) && isset($row['rate']) && $row['rate']==1){
								echo " selected";
							} ?> value="1">1</option>
					</select><!-- / .form-control col-md-9 -->
				</div><!-- / .form-group -->
			</div><!-- / .row -->
			
			
			<div class="row">
				<div class="form-group">
					<label for="active" class="col-md-3">تفعيل</label>
					<select name="active" id="active" class="form-control col-md-9">
						<option value="Y" <?php if ($row['active'] == 'Y') echo ' selected'; ?>>نعم</option>
						<option value="N" <?php if ($row['active'] == 'N') echo ' selected'; ?>>لا</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="cat" class="col-md-3">القسم</label>
					<select name="cat" id="cat" class="form-control col-md-9">
						<?php echo $this->core_model->catList($row['parent_id']) ?>
					</select>
				</div>
			</div>
			
			

			<div id="custom_fields"></div>
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if ($edit)
	echo 'edit_news';
else
	echo 'add_news';
?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if ($edit)
	echo 'تـعديــل';
else
	echo 'إضـافــة';
?></button>
	</div>
</div>
<?php form_close(); ?>


<script>
$(function() {
	ch();
	$("#country").change(function() {
		ch();
	});
	$("#price, #discount").keyup(function() {
		ch();
	});
});

var ch = function() {

}


$("#cat").change(function() {
	var _data = $("#cat option:selected").data('id');
	$("input#cat_chain").val(_data);
	if (!/\-/.test(_data)) {
		var _id = _data;
	} else {
		var _ids = (_data).split("-");
		var _id = _ids[0];
	}
	$("#meta_parent_cat").val(_id);
	$.ajax({
		url: "<?php echo base_url() . "new_admin/Ajax/getFields/" ?>" + _id + "/<?= $edit ?>",
		success: function(ret) {
			$("#custom_fields").html(ret);
		}
	});
});


$("#cat").trigger('change');
</script>
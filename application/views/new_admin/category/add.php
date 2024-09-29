<?php $cont = $this->router->fetch_class(); ?>
<div class="page-header">
	<h1><?php echo $page_title ?></h1>
</div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
			<li>إضافة قسم</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button"
			class="btn btn-primary btn-block dropdown-toggle"
			data-toggle="dropdown">
				الاقسام <span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li class="disabled">
				<a
					href="<?php echo "{$admin_dir}/{$cont}/add"; ?>"
					class="disabled">
						اضافة قسم
				</a>
			</li>
			<li>
				<a
					href="<?php echo "{$admin_dir}/{$cont}/view"; ?>">
					عرض الاقسام
				</a>
			</li>
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
	echo '<input type="hidden" name="old" value="' . $row['pic'] . '" />';
	echo '<input type="hidden" name="thumb" value="' . $row['thumbnail'] . '" />';
}

if (in_array('content', $has)) {
?>
	<input type="hidden" name="content" id="content" value='<?php echo ($row['content']) ?>' />
<?php } ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?=$page_title?></h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
			if ($uploads_error) {
				if (is_array($uploads_error)) {
					echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>';
					foreach ($uploads_error as $e) echo "{$e}<br />";
					echo '</div>';
				} else {
					echo '<div class="alert alert-danger fade in">
					<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
						$uploads_error .
					'</div>';
				}
			}
			if (validation_errors()) {
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>' .
					validation_errors() . '</div>';
			}
			if ($duplicated) {
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				هذا القسم موجود من قبل</div>';
			}
			if ($inserted) {
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تمت إضافة القسم
				<a href="' . $admin_dir . '/' . $this->router->fetch_class() .
					'/add/" class="btn btn-primary btn-xs">إضافة قسم جديد</a>
				</div>';
			}
			if ($updated) {
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل القسم</div>';
			}
			?>
			<?php if (in_array('title', $has)) { ?><div class="row">
					<div class="form-group">
						<label for="title" class="col-md-3">اسم القسم</label>
						<input
							type="text" 
							class="form-control col-md-9"
							name="title"
							id="title"
							value="<?php echo $row['title'] ?>"
							data-validation="required"
							data-validation-error-msg="اسم القسم" />
					</div>
				</div><?php } ?>

			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">القسم الرئيسي</label>
					<select class="form-control col-md-9" name="parent_id" id="parent_id">
						<option value="0">-- تحديد كقسم رئيسي --</option>
						<?php echo $this->core_model->catList($row['parent_id']) ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="keywords" class="col-md-3">Keywords</label>
					<input type="text"
						class="form-control col-md-9"
						name="keywords"
						id="keywords"
						value="<?php echo $row['keywords'] ?>"
						data-validation="required"
						data-validation-error-msg="keywords" />
				</div>
			</div>


			<div class="row">
				<div class="form-group">
					<label for="description" class="col-md-3">description</label>
					<input
						type="text"
						class="form-control col-md-9"
						name="description"
						id="description"
						value="<?php echo $row['description'] ?>"
						data-validation="required"
						data-validation-error-msg="description" />
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="up" class="col-md-3">صورة القسم</label>
					<input
						type="file"
						class="form-control <?=($row['pic']) ?
							"col-md-8" :"col-md-9";?>"
						name="up"
						id="up" />
					<?php
					if ($row['pic']) {
						echo '<div class="col-md-1 text-center">
							<a href="' . base_url() .
								'uploads/' .
								$this->router->fetch_class() .
								'/' .
								$row['pic'] .
								'" target="_blank">
									<img src="' .
										base_url() .
										'uploads/' .
										$this->router->fetch_class() . '/' .
										$row['pic'] . 
									'"
									class="img-responsive img-rounded" />
							</a>
							</div>';
					} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="up2" class="col-md-3">الصورة المصغرة</label>
					<input
						type="file"
						class="form-control <?=($row['thumbnail'])?
						"col-md-8":"col-md-9"?>"
						name="up2"
						id="up2" />
					<?php
					if ($row['thumbnail']) {
						echo '<div class="col-md-1 text-center">
							<a href="' . base_url() . 'uploads/' . $this->router->fetch_class() .
							'/' . $row['thumbnail'] . '" target="_blank">
								<img src="' . base_url() . 'uploads/' .
									$this->router->fetch_class() . '/' . $row['thumbnail'] .
									'" class="img-responsive img-rounded" />
							</a>
						</div>';
					} ?>
				</div>
			</div>

			<div class="form-group">
				
				<?php if (in_array('active', $has)) { ?><div class="row">
						<div class="form-group">
							<label for="active" class="col-md-3">تفعيل القسم</label>
							<select class="form-control col-md-9" name="active" id="active">
								<option value="Y">نعم</option>
								<option value="N">لا</option>
							</select>
						</div>
					</div><?php } ?>

			</div>
		</div>
	</div>
		<div class="panel-footer">
			<button
				class="btn btn-primary fl"
				name="<?=(isset($edit))?'edit_news':'add_news';?>"
				value="1">
					<span class="glyphicon glyphicon-check"></span>
					<?=$page_title?>
			</button>
		</div>
	</div>
	<?php form_close(); ?>
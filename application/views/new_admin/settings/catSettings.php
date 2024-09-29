<?php $cont = $this->router->fetch_class(); ?><div class="page-header">
	<h1><?php echo $page_title ?></h1>
</div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir ?>/admin_index">الرئيسية</a></li>
			<li>اﻹعدادات</li>
		</ul>
	</div>
</div>

<?php echo form_open_multipart("new_admin/settings/catSettings") ?>
<input type="hidden" name="oldfav" id="oldfav" value="<?php echo $row->fav ?>" />
<input type="hidden" name="oldnews_img" id="oldnews_img" value="<?php echo $row->news_img ?>" />
<input type="hidden" name="oldsite_image" id="oldsite_image" value="<?php echo $row->site_image ?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل الاقسام</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<div class="row text-muted stroked">
				<div class="col-xs-6"><strong>القسم</strong></div>
				<div class="col-xs-1"><strong>الرئيسية</strong></div>
				<div class="col-xs-5 text-center">
					<strong>الترتيب</strong>
				</div>
			</div>
			<br>
			<?php
			if ($error) {
				echo '<div class="alert alert-danger">';
				foreach ($error as $e)
					echo "{$e} <br>";
				echo '</div>';
			}
			if (validation_errors()) {
				echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
			}



			//($ar= array(), $limit= 1000, $start=0, $oder_by_feild="ID", $order_desc_asc="desc")
			foreach ($this->core_model->pages(array("parent_id" => 0, "module" => "category"), 1000, 0, "p_order", "asc") as $row) {
			?>
				<div class="row">
					<div class="form-group">
						<label for="title" class="col-xs-6"><?= $row->title ?></label>
						<div class="col-xs-1">
							<input type="checkbox" class="form-control" name="option[title][<?= $row->ID ?>]" id="title_<?= $row->ID ?>" value="<?php echo $row->ID ?>" <?php if (is_array($cat_settings['title']) && in_array($row->ID, $cat_settings['title'])) echo ' checked'; ?> />
						</div>
						<div class="col-xs-5">
							<div class="col-md-6">
								الترتيب
							</div>
							<select class="col-md-6 form-control" name="option[order][<?= $row->ID ?>]" id="order_<?= $row->ID ?>">
								<?php for ($i = 1; $i <= 50; $i++) { ?><option value="<?= $i ?>" <?php if (isset($cat_settings['order'][$row->ID]) && $cat_settings['order'][$row->ID] == $i) echo " selected" ?>><?= $i ?></option><?php } ?>
							</select>
						</div>

					</div>
				</div>
			<?php } ?>



		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="edit_settings" value="1"> <span class="glyphicon glyphicon-check"></span> تعـديــل</button>
	</div>
</div>
<?php echo form_close() ?>
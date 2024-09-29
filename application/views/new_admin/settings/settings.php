<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>اﻹعدادات</li>
		</ul>
	</div>
</div>

<?php echo form_open_multipart("new_admin/settings") ?>
<input type="hidden" name="oldfav" id="oldfav" value="<?php echo $row->fav?>" />
<input type="hidden" name="oldnews_img" id="oldnews_img" value="<?php echo $row->news_img?>" />
<input type="hidden" name="oldsite_image" id="oldsite_image" value="<?php echo $row->site_image?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل اﻹعدادات</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">

			<?php if($error){ echo '<div class="alert alert-danger">';
			foreach ($error as $e) echo "{$e} <br>";
			echo '</div>';}
			if(validation_errors()){
				echo '<div class="alert alert-danger">'. validation_errors() .'</div>';
			}
			
			if ( isset($saved) && $saved == TRUE  ) {
				echo '<div class="alert alert-success">
					تم حفظ اﻹعدادت.
					<a href="'.base_url().'" target="site_preview">عرض الموقع</a>
				</div>';
			}
			?>

			<div class="row">
				<div class="form-group">
					<label for="title" class="col-md-3">اسم الموقع</label>
					<input type="text" class="form-control col-md-9" name="title" id="title" value="<?php echo $row->title ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="news_img" class="col-md-3">صورة الأخبار</label>
					<div class="col-md-1"><a href="<?php echo base_url() ?>uploads/site/<?php echo $row->news_img ?>"><img src="<?php echo base_url() ?>uploads/site/<?php echo $row->news_img ?>" class="img-responsive" /></a></div>
					<input type="file" class="form-control col-md-8" name="news_img" id="news_img" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="favicon" class="col-md-3">favicon</label>
					<div class="col-md-1"><a href="<?php echo base_url() ?>uploads/site/<?php echo $row->fav ?>"><img src="<?php echo base_url() ?>uploads/site/<?php echo $row->fav ?>" class="img-responsive" /></a></div>
					<input type="file" class="form-control col-md-8" name="favicon" id="favicon" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="image" class="col-md-3">اللوجو</label>
					<div class="col-md-1">
						<a
							href="<?php echo base_url() ?>uploads/site/<?php echo $row->site_image ?>"><img src="<?php echo base_url() ?>uploads/site/<?php echo $row->site_image ?>" class="img-responsive" /></a></div>
					<input type="file" class="form-control col-md-8" name="image" id="image" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="keywords" class="col-md-3">meta keywords</label>
					<input type="text" class="form-control col-md-9" name="keywords" id="keywords" value="<?php echo $row->keywords ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="description" class="col-md-3">meta description</label>
					<input type="text" class="form-control col-md-9" name="description" id="description" value="<?php echo $row->description ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="product_limit" class="col-md-3">عدد المنتجات في الصفحة</label>
					<input type="number"
						class="form-control col-md-9" name="product_limit" id="product_limit"
						min=9 max=99
						value="<?php echo $row->product_limit ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="product_limit" class="col-md-3">لون الموقع</label>
					<div class="col-md-9">
						<div class="row">
							<div class="col-sm-4">
								<label for="color_theme_red">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'red') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_red"
										value="red">
										<span class="theme_color_select"
											style="background-color:#661511"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_green">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'green') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_green"
										value="green">
										<span class="theme_color_select"
											style="background-color:#11661c"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_blue">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'blue') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_blue"
										value="blue">
										<span class="theme_color_select"
											style="background-color:#111766"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_teal">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'teal') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_teal"
										value="teal">
										<span class="theme_color_select"
											style="background-color:#116662"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_brown">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'brown') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_brown"
										value="brown">
										<span class="theme_color_select"
											style="background-color:#2C838D"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_fushia">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'fushia') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_fushia"
										value="fushia">
										<span class="theme_color_select"
											style="background-color:#66115b"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_fushia2">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'fushia2') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_fushia2"
										value="fushia2">
										<span class="theme_color_select"
											style="background-color:#551166"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_brown2">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'brown2') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_brown2"
										value="brown2">
										<span class="theme_color_select"
											style="background-color:#b49432"></span>
								</label>
							</div><!-- / col-sm-4 -->
							<div class="col-sm-4">
								<label for="color_theme_gray">
									<input <?php if( isset($row) && isset($row->color_theme) && $row->color_theme== 'gray') echo " checked"; ?>
										type="radio"
										name="color_theme"
										id="color_theme_gray"
										value="gray">
										<span class="theme_color_select"
											style="background-color:#333"></span>
								</label>
							</div><!-- / col-sm-4 -->
						</div><!-- / .row -->
						
					</div><!-- / .col-md-9 -->
				</div>
			</div>


			<?php /* <h3>اسعار الشحن</h3>
			<div class="row">
				<div class="form-group">
					<label for="shipping_size_0" class="col-md-3">منتجات صغيرة</label>
					<input type="number"
						class="form-control col-md-9" name="shipping_size_0" id="shipping_size_0"
						value="<?php echo $row->shipping_size_0 ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="shipping_size_1" class="col-md-3">منتجات متوسطة</label>
					<input type="number"
						class="form-control col-md-9" name="shipping_size_1" id="shipping_size_1"
						value="<?php echo $row->shipping_size_1 ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="shipping_size_2" class="col-md-3">منتجات كبيرة</label>
					<input type="number"
						class="form-control col-md-9" name="shipping_size_2" id="shipping_size_2"
						value="<?php echo $row->shipping_size_2 ?>" />
				</div>
			</div>

			<?php /* <div class="row">
				<div class="form-group">
					<label for="display-method">طريقة عرض المنتجات</label>
					<select name="display_method" id="display_method" class="form-control">
						<option <?php
							if ($row->display_method==1) echo " selected";
							?> value="1">1</option>
						<option <?php
							if ($row->display_method==2) echo " selected";
							?> value="2">2</option>
						<option <?php
							if ($row->display_method==3) echo " selected";
							?> value="3">3</option>
						<option <?php
							if ($row->display_method==4) echo " selected";
							?> value="4">4</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<img src="<?=base_url('assets/display-method/index-1.png');?>"
					class="img-responsive" loading=lazy id=display_method_img>
				</div>
			</div>*/?>


		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="edit_settings" value="1">
			<span class="glyphicon glyphicon-check"></span> تعـديــل
		</button>
	</div>
</div>
<?php echo form_close() ?>


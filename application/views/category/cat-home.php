<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li><a href="<?= base_url('categories') ?>">الاقسام</a></li>
				</ul>
			</div>
			<h1>عرض الاقسام</h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="">
</div>


<div class="container margin_60_35">
			<div class="main_title">
				<h2>اقسام الموقع</h2>
				<span>منتجات مميزة</span>
				<p>تشكيلة واسعة من المنتجات التي تلبي جميع الاذواق و الالوان</p>
			</div>
			<div class="row small-gutters">
			<?php foreach ( $home_cats as $cat ) { ?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
							<a href="<?=base_url($cat->ID)?>">
								<img
									class="img-fluid lazy category-pic"
									src="<?=$this->shop->shop_img(
										"uploads/category/{$cat->thumbnail}"
									)?>"
									alt="<?=$cat->title?>">
							</a>
						</figure>
						<a href="<?=base_url($cat->ID)?>">
							<h3><?=$cat->title?></h3>
						</a>
					</div>
					<!-- /grid_item -->
				</div>
			<?php }?>
			</div><!-- ./ row -->
</div><!-- / .container -->
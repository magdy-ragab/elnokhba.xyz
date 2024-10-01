<div id="carousel-home" dir=ltr>
			<div class="owl-carousel owl-theme">
			<?php foreach ($this->core_model->sliders() as $row) { ?>
				<div
				class="owl-slide cover"
				style="background-image: url(<?= base_url() . "uploads/slider/" . $row->pic; ?>);">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-right white">
										<h2 class="owl-slide-animated owl-slide-title"><?=$row->title?></h2>
										<p class="owl-slide-animated owl-slide-subtitle">
											<?=$row->content?>
										</p>
										<div class="owl-slide-animated owl-slide-cta">
											<a
												class="btn_1"
												href="tel:966574474837"
												role="button">
												طلب زيارة مندوب مجانا
												<span class="fa fa-phone"></span>
											</a>
											<a
												class="btn_1"
												href="tel:966574474837"
												role="button">
												راسلنا على الواتساب
												<span class="fa fa-whatsapp"></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/owl-slide-->
				<?php }?>
			</div>
			<div id="icon_drag_mobile"></div>
		</div>
		<!--/carousel-->

		<div class="container mt-4 home-btns">
			<div class="row">
				<div class="col-4">
					<div class="info-block">
						<div class="info-block-img-cont">
							<img
								src="<?=base_url("theme/icons/Icon-2-123x123.webp")?>"
								class="img-responsive"
								alt="">
						</div><!-- / .info-block-img-cont -->
						<div class="info-block-data">
							<h2>صيانة مجانية</h2>
							<p>فترة صيانة مجانية 5 سنوات</p>
						</div><!-- / .info-block-data -->
					</div><!-- / .info-block -->
				</div><!-- / .col-4 -->
				<div class="col-4">
					<div class="info-block">
						<div class="info-block-img-cont">
							<img
								src="<?=base_url("theme/icons/Icon-1-123x123.webp")?>"
								class="img-responsive"
								alt="">
						</div><!-- / .info-block-img-cont -->
						<div class="info-block-data">
							<h2>شحن سريع</h2>
							<p>توصيل سريع وآمن مع خدمة التركيب.</p>
						</div><!-- / .info-block-data -->
					</div><!-- / .info-block -->
				</div><!-- / .col-4 -->
				<div class="col-4">
					<div class="info-block">
						<div class="info-block-img-cont">
							<img
								src="<?=base_url("theme/icons/Icon-3-123x123.webp")?>"
								class="img-responsive"
								alt="">
						</div><!-- / .info-block-img-cont -->
						<div class="info-block-data">
							<h2>مفروشات الرياض للارضيات و المفروشات</h2>
							<p>نقدم خدمة فك وتركيب مجاناً لمدة سنة</p>
						</div><!-- / .info-block-data -->
					</div><!-- / .info-block -->
				</div><!-- / .col-4 -->
			</div><!-- / .row -->
		</div><!-- / .container -->
		
		<div class="container margin_60_35">
			<div class="row small-gutters home_cats">
			<?php foreach ( $home_4_cats as $cat ) { ?>
				<div class="col-6 home_cats_item">
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
						<a href="<?=base_url($cat->ID)?>" class="shop_now d-sm-none">
							تسوق الان
						</a>
					</div>
					<!-- /grid_item -->
				</div>
			<?php }?>
				
				<!-- /col -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

		<div class="featured lazy" data-bg="url(<?=base_url("theme/img/")?>featured_home.jpg)">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
				<div class="container margin_60">
					<div class="row justify-content-center justify-content-md-start">
						<div class="col-lg-6 wow" data-wow-offset="150">
							<h3>مندوبنا جاهز لخدمتك</h3>
							<p>جاهزين لخدمتك 7 ايام في الاسبوع؛ 24 ساعة في اليوم</p>
							<div class="feat_text_block text-center">
								<a
									class="btn_1"
									href="tel:966574474837"
									role="button">
									طلب زيارة مندوب مجانا
									<span class="fa fa-phone"></span>
								</a>
								<a
									class="btn_1"
									href="tel:966574474837"
									role="button">
									راسلنا على الواتساب
									<span class="fa fa-whatsapp"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /featured -->

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>منتجات جديدة</h2>
				<!-- <span>منتجات مميزة</span> -->
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				<?php foreach ( $last as $row ) { ?>
				<div class="item">
					<div class="grid_item">
						<?php if( isset($row->code) && $row->code){ ?>
						<span class="ribbon new"><?=$row->code?></span>
						<?php }?>
						<figure>
						<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
								<img
									class="img-responsive"
									src="<?=$this->shop->shop_img(
										"uploads/products/{$row->thumbnail}"
									)?>"
									alt="<?=$row->title?>">
							</a>
						</figure>
						<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
							<h3><?=$row->title?></h3>
						</a>
						<?php if($row->price) { ?>
							<span class="new_price"><?="{$row->price}"?></span>
						<?php }?>
						<div class="rating text-center">
							<?php for($i=1; $i<= $row->rate; $i++) {
								echo '<i class="icon-star voted"></i>';
							}
							for($j=$i; $j<=5; $j++) {
								echo '<i class="icon-star"></i>';
							}
							?>
						</div>
						<div class="call-us-products">
							<a href="tel:966574474837"
								class="btn btn-sm btn-primary fa fa-phone"></a>
							&nbsp;
							<a href="https://wa.me/966574474837"
								class="btn btn-sm btn-primary fa fa-whatsapp"></a>
						</div>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
				<?php }?>
			</div>
			<!-- /products_carousel -->
		</div>
		<!-- /container -->

		<?php foreach ( $home_cats_order as $cat){
		if ( count($cat->products) ){ ?>
			<div class="container margin_60_35">
				<div class="main_title">
					<div class="row ov">
						<div class="col-9">
							<h2><?=$cat->title?></h2>
						</div><!-- / .col-9 -->
						<div class="col-3 text-left">
							<a href="<?=base_url($cat->ID)?>"class="btn_1">
								عرض
								<span class="fa fa-chevron-left"></span><!-- / .fa -->
							</a>
						</div><!-- / .col-3 -->
					</div><!-- / .row -->
				</div>
				<div class="owl-carousel owl-theme products_carousel">
					<?php foreach ( $cat->products as $row ) { ?>
					<div class="item">
						<div class="grid_item">
							<?php if( isset($row->code) && $row->code){ ?>
							<span class="ribbon new"><?=$row->code?></span>
							<?php }?>
							<figure>
								<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
									<img
										class="img-responsive"
										src="<?=$this->shop->shop_img(
											"uploads/products/{$row->thumbnail}"
										)?>"
										alt="<?=$row->title?>">
								</a>
							</figure>
							<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
								<h3><?=$row->title?></h3>
							</a>
							<div class="price_box">
								<?php if($row->price) { ?>
								<span class="new_price"><?="{$row->price}"?></span>
								<?php }?>
							</div>
							<div class="rating text-center">
								<?php for($i=1; $i<= $row->rate; $i++) {
									echo '<i class="icon-star voted"></i>';
								}
								for($j=$i; $j<=5; $j++) {
									echo '<i class="icon-star"></i>';
								}
								?>
							</div>
							<div class="call-us-products">
								<a href="tel:966574474837"
									class="btn btn-sm btn-primary fa fa-phone"></a>
								&nbsp;
								<a href="https://wa.me/966574474837"
									class="btn btn-sm btn-primary fa fa-whatsapp"></a>
							</div>
						</div>
						<!-- /grid_item -->
					</div>
					<!-- /item -->
					<?php }?>
				</div>
				<!-- /products_carousel -->
			</div>
			<!-- /container -->
		<?php
		}
		} ?>

		
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>المواضيع</h2>
				<span>آخر أخبارنا</span>
			</div>
			<div class="row">
				<?php foreach( $this->core_model->news(['active'=>"Y"],6) as $news ){
					$date=$this->Hijri->GregorianToHijri($news->news_data);
					$month=$this->Hijri->monthName($date[0]);
					?>
				<div class="col-md-6 col-lg-4">
					<a class="box_news" href="<?=base_url("news/{$news->ID}")?>">
						<figure>
							<img src="<?=$this->shop->shop_img("uploads/news/{$news->thumbnail}")?>"
							data-src="<?=$this->shop->shop_img("uploads/news/{$news->thumbnail}")?>"
							alt="<?=$news->title?>" width="400" height="266" class="lazy">
							<figcaption><strong><?=$date[1]?></strong><?=$month?></figcaption>
						</figure>
						<ul>
							<li><?=$date[1].' '.$month.' '.$date[2]." هـ "?></li>
						</ul>
						<h4><?=$news->title?></h4>
						<p><?=word_limiter(strip_tags($row->content),30)?></p>
					</a>
				</div>
				<!-- /box_news -->
				<?php }?>

			</div>
			<!-- /row -->
		</div>
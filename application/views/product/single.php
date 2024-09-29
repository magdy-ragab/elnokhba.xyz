<?php 
if (!$single['ID']) {
	show_404();
} else {
?>
<div class="container">
	<nav class="breadcrumb">
		<ol>
			<li class="breadcrumb-item"><a href="<?= base_url() ?>">الرئيسية</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('categories') ?>">الاقسام</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url($cat['ID']) ?>"><?=$cat['title']?></a></li>
			<li class="breadcrumb-item active"><?= $single['title'] ?></li>
		</ol>
	</nav>
</div><!-- / .container -->




<div class="container">
	
<div class="row mt-4">
	<div class="col-12">
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<div class="addthis_inline_share_toolbox"></div>
		<script
			type="text/javascript"
			src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-640c7510b9b4dcd7"></script>
	</div><!-- / .col-12 -->
	<div class="col-3">
		<?php if( 
			isset($next_prev) &&
			isset($next_prev['prev']) &&
			$next_prev['prev'] &&
			isset($next_prev['prev']->ID)
		){?>
			<a href="<?=base_url(
				"{$next_prev['prev']->parent_id}/{$next_prev['prev']->ID}.html"
			)?>">
				<span class="fa fa-chevron-right p-3 border border-2 hover"></span>
			</a>
		<?php }?>
	</div><!-- / .col-3 -->
	<div class="col-6">
		<h2 class="sb-title text-center"><?php echo $single['title'] ?></h2>
	</div><!-- / .col-6 -->
	<div class="col-3 text-left">
		<?php if(
			isset($next_prev) &&
			isset($next_prev['next']) &&
			$next_prev['next'] &&
			isset($next_prev['next']->ID)
		){?>
		<a href="<?=base_url(
			"{$next_prev['next']->parent_id}/{$next_prev['next']->ID}.html"
		)?>">
			<span class="fa fa-chevron-left p-3 border border-2 hover"></span>
		</a>
		<?php } ?>
	</div><!-- / .col-3 -->
</div><!-- / .row -->

	<div class="row">

		<div class="col-lg-6">
			<div class="mb-1 product-img-cont">
				<div class="row">
					<div class="col-9 p-0">
						<a href="" id="lightboxOpen">
							<img src="<?= $this->shop->shop_img(
								"uploads/products/{$single['pic']}",
								"theme/img/bg_cat.jpg"
							) ?>"
							class="img-fluid"
							alt="<?= $single['title'] ?>">
						</a>
					</div><!-- / .col-9 -->
					<div class="col-3 p-0">
						<div class="product-img p-1">
							<a href="<?= $this->shop->shop_img(
									"uploads/products/{$single['pic']}",
									"theme/img/bg_cat.jpg"
									) ?>"
									id="pic_0"
									data-lightbox="product">
								<img
									class="img-fluid img-rounded active"
									src="<?= $this->shop->shop_img(
										"uploads/products/{$single['thumbnail']}",
										"theme/img/bg_cat.jpg"
										) ?>"
								/>
							</a>
						</div><!-- / .product-img -->
						<?php
						if(
							isset($single['pics']) &&
							is_array($single['pics']) &&
							count($single['pics'])
						) {
							$pic_index=0;
							foreach($single['pics'] as $pic){
								++$pic_index;
								?>
								<div class="product-img p-1">
									<a href="<?= $this->shop->shop_img(
										"uploads/products/{$pic['pic']}",
										"theme/img/bg_cat.jpg"
										) ?>"
										id="pic_<?php echo $pic_index?>"
										data-lightbox="product">
										<img
											class="img-fluid img-rounded"
											src="<?=base_url(
												"uploads/products/".$pic['thumbnail']
											)?>"
											/>
									</a>
								</div><!-- / .product-img -->
							<?php 
							} 
						} ?>
					</div><!-- / .col-3 -->
				</div><!-- / .row -->
			</div><!-- / .row mb-1 product-img-cont -->
		</div><!-- ./ co-lg-6 -->

		<div class="col-lg-6">
			<div class="row">
				<div class="col">
					<?php $this->shop->displayStars($single['rate']); ?>
				</div><!-- / .col -->
			</div><!-- ./ row -->
			<p><?php echo nl2br($single['content']); ?></p>
			<a href="tel:966574474837"
				class="btn-cart fa fa-phone"></a>
			<a href="https://wa.me/966574474837"
				class="btn-cart fa fa-whatsapp"></a>
		</div><!-- ./ co-lg-6 -->
		<?php if ($single['full_content']) { ?>
			<div class="col-12">
				<hr>
				<?php echo nl2br($single['full_content']);?>
			</div><!-- / .col-12 -->
		<?php } ?>
	</div><!-- / .row -->

	<?php if ( count( (array) $similar ) > 0 ) { ?>
	<div class="row mt-4">
		<div class="col-12">
			<hr>
		</div><!-- / .col-12 -->
		<h4 class="col-12">منتجات مشابهة</h4>
		<?php
		foreach ($similar as $similar_single) { 
			echo '<div class="col-6 col-md-6 col-lg-3">';
			$this->load->view("includes/product-item", ["row" => $similar_single]);
			echo '</div><!-- / .col-6 col-md-6 col-lg-3 -->';
		} ?>
	</div><!-- / .row -->
	<?php }?>

</div>

<script>
	/*$(".product-img img") .click( function () {
		var _src= $(this).data('src');
		$("#main-pic").attr('href', _src);
		$("#main-pic img").attr('src', _src);
		$(".product-img-cont img").removeClass('active');
		$(this).addClass('active');
		return false;
	})*/
</script>

<?php } ?>

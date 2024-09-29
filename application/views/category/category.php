<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li><a href="<?= base_url('categories') ?>">الاقسام</a></li>
					<li><?= $row->title ?></li>
				</ul>
			</div>
			<h1><?= $row->title ?></h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"uploads/category/{$row->pic}",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="<?= $row->title ?>">
</div>

<div class="container">
<div class="row">
	<div class="col-lg-3 col-md-12">
		<h5 class="sb-title mt-2 py-4 m-0">الأقسام</h5>
		<ul class="list-group">
			<?php foreach ($cats as $aside_cat) { ?>
				<li class="list-group-item">
					<a href="<?= base_url($aside_cat->ID) ?>"  class='<?php
						if ($catid == $aside_cat->ID) {
							echo "text-primary";
						}else{
							echo "text-muted";
						}?>'>
						<?= $aside_cat->title ?>
					</a>
				</li>
			<?php } ?>
		</ul>

		<div class="sb-widget">
			<div class="sb-product">
				<h5 class="sb-title">منتجات أخرى</h5>
				<div class="row">
				<?php foreach ($random as $rand) { 
						echo '<div class="col-12">';
						$this->load->view("includes/product-item2", ["row" => $rand]);
						echo "</div>";
					} ?>					
				</div><!-- / .row -->
			</div>
		</div>
	</div>
	<div class="col-lg-9 col-md-12 col-sm-12 col-12">
		<div class="row mt-5">
			<?php
			if ( count( $rows ) == 0 ) {
				?>
				<div class="col">
				<p class="text-muted p-5 m-5 text-center">لا تتوفر اي منتجات في هذا القسم</p>
				</div><!-- / .col -->
				<?php
			}
			foreach ($rows as $row) { 
				echo '<div class="col-6 col-md-6 col-lg-3">';
				$this->load->view("includes/product-item", ["row" => $row]);
				echo '</div><!-- / .col-6 col-md-6 col-lg-3 -->';
			} ?>

		</div>
		<div class="row">
			<div class="col-md-12"><?= $this->pagination->create_links(); ?></div>
		</div>
		
	</div>
</div>


</div><!-- / .container -->
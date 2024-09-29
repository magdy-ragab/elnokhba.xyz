<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li><a href="<?= base_url('categories') ?>">الاقسام</a></li>
					<li>البحث</li>
				</ul>
			</div>
			<h1>البحث عن "<em><?=$this->input->post('q')?></em>"</h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="<?= $row->title ?>">
</div>

		
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">
			<div class="row mt-5">
			<?php
			if ( count( $rows ) == 0 ) {
				?>
				<div class="col">
				<p class="text-muted p-5 m-5 text-center">لم نجد اي نتيجة للبحث</p>
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
	</div>
</div>

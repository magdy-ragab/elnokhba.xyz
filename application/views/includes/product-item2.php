
	<div class="item">
		<div class="grid_item">
			<div class="row">
				<div class="col-5 col-md-6 col-lg-4">
					<figure>
						<?php if( isset($row->code) && $row->code){ ?>
							<span class="ribbon new"><?=$row->code?></span>
						<?php }?>
						<a href="<?=base_url($row->url)?>">
							<img
								class="img-responsive img-fluid"
								src="<?=$this->shop->shop_img("uploads/products/$row->thumbnail")?>"
								data-src="<?=$this->shop->shop_img("uploads/products/$row->thumbnail")?>"
								alt="<?=$row->title?>">
						</a>
					</figure>
				</div><!-- / .col-5 col-md-6 col-lg-4 -->
				<div class="col-7 col-md-6 col-lg-8">
					<div class="rating text-center">
						<?php for($i=1; $i<= $row->rate; $i++) {
							echo '<i class="icon-star voted"></i>';
						}
						for($j=$i; $j<=5; $j++) {
							echo '<i class="icon-star"></i>';
						}
						?>
					</div>
					<a href="<?=base_url($row->url)?>">
						<h3><?=$row->title?></h3>
					</a>
					<?php if( $row->price ) { ?>
					<div class="price_box">
						<span class="new_price"><?="{$row->price} رس"?></span>
					</div>
					<?php }?>
				</div><!-- / .col-7 col-md-6 col-lg-8 -->
			</div><!-- / .row -->
		</div>
		<!-- /grid_item -->
	</div>

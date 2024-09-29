
	<div class="item">
		<div class="grid_item">
			<?php if( isset($row->code) && $row->code){ ?>
			<span class="ribbon new"><?=$row->code?></span>
			<?php }?>
			<figure>
				<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
					<img
						class="img-responsive img-fluid"
						src="<?=$this->shop->shop_img("uploads/products/$row->thumbnail")?>"
						alt="<?=$row->title?>">
				</a>
			</figure>
			<a href="<?=base_url("{$row->parent_id}/{$row->ID}.html")?>">
				<h3><?=$row->title?></h3>
			</a>
			<div class="price_box">
				<?php if( $row->price ) { ?>
					<span class="new_price"><?="{$row->price}"?></span>
				<?php } ?>
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

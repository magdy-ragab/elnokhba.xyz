<div class="product-item-3">
	<a href="<?=$row['url']?>" class="product-item-3__main">
		<img
			src="<?=base_url("uploads/products/{$row['thumbnail']}") ?>"
				class="image-responsive"
				loading=lazy
				alt="<?=$row['title'];?>" />
		<?php if($row['code']){?><span class="price-code">
		    <?=$row['code'];?>
		</span><?php } ?>
		<span
			class="product-title">
			<?=character_limiter($row['title'], 50);?>
		</span>
		<span class="price-stars">
			<span>
				<?php if($row['discount'] ) { ?>
					<span class="main-price spical-price"><?=$row['discount']?> جنيه</span><br>
					<del class="spical-price text-muted"><?=$row['price']?> جنيه</del>
				<?php }else{ ?>
					<span class="main-price spical-price"><?=$row['price']?> جنيه</span><br>
					&nbsp;
				<?php }?>
			</span>
			<span>
				<?php $this->shop->displayStars($row['votes'])?>
			</span>
		</span>
	</a>
	<div class="cart-wish">
			<a class="add_to_wishlist wish-container"
				href="#"
				rel="nofollow"
				data-productid="<?=$row['ID'];?>"
				data-product-type="external"
				data-toggle="tooltip"
				title="اضافة الى المفضلة"
				>
				<span class="fa fa-heart"></span>
			</a>
			<a
				class="cart-container button_act add2cartBtn"
				data-id="<?=$row['ID']?>"
				href="#"
				rel=nofollow
				data-toggle=tooltip
				title="قم باضافة المنتج الى السلة">
				<i class="fa fa-cart-plus"></i>
			</a>
	</div>
</div>
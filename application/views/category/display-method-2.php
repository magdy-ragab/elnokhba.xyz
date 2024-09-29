<div class="col-xs-12 col-sm-4 col-md-4 product-item-2">
				<div class="all-pros all-pros-3 all-pros-latest">
					<div class="text-center">
						<a
							href="<?=$row['url']?>" class="color1 product-title">
							<?=character_limiter($row['title'], 40);?>
						</a>
					</div>
					<div class="sinle_pic">
						<a href="<?=$row['url']?>">
						<img
							src="<?=base_url("uploads/products/{$row['thumbnail']}") ?>"
								loading=lazy
								alt="<?=$row['title'];?>" />
						</a>
					</div>
					<div class="product_content">
						<div class="usal_pro">

							<div class="col-xs-6">
								<?php if($row['discount'] ) { ?>
									<span class="main-price spical-price"><?=$row['discount']?> جنيه</span><br>
									<del class="spical-price text-muted"><?=$row['price']?> جنيه</del>
								<?php }else{ ?>
									<span class="main-price spical-price"><?=$row['price']?> جنيه</span><br>
									&nbsp;
								<?php }?>
							</div>
							<div class="col-xs-3">
								<a class="add_to_wishlist"
									href="#"
									rel="nofollow"
									data-productid="<?=$row['ID'];?>"
									data-product-type="external"
									data-toggle="tooltip"
									title="اضافة الى المفضلة"
									data-original-title="اضافة الى المفضلة">
											<i class="fa fa-heart"></i>
								</a>
							</div>
							<div class="col-xs-3">
								<a
									class="button_act add2cartBtn"
									data-id="<?=$row['ID']?>"
									href="#"
									data-toggle="tooltip"
									title="قم باضافة المنتج الى السلة">
									<i class="fa fa-cart-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php 
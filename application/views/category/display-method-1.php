<div class="col-md-4 col-sm-6">
	<div class="all-pros all-pros-3 all-pros-latest">
		<?php if($row['code']){?><div class="single_product">
		    <span><?=$row['code'];?></span>
		</div><?php } ?>
		<?php if($row['discount']){?><div class="single_product_3 ">
		    <span>خصم</span>
		</div><?php } ?>
		<div class="sinle_pic">
		    <a href="<?=$row['url']?>">
		     <img src="<?=base_url()."thumb.php?file=uploads/products/".$row['pic']?>&w=300&h=140" alt="<?=$row['title'];?>" />
		    </a>
		</div>
		<div class="product_content">
		    <div class="usal_pro">
			<div class="product_name_2">
			    <h2>
				<a href="<?=$row['url']?>"><?=mb_substr($row['title'],0, 40, "utf-8");?></a>
			    </h2>
			</div>
			<div class="product_price">
			    <div class="price_rating">
				<?php for($i=20; $i<=$row['rate']; $i+=20){ ?>
				    <i class="fa fa-star rated"></i>
				<?php }
				for($j=$i; $j<=100; $j+=20){?>
				    <i class="fa fa-star not-rated" aria-hidden="true"></i>
				<?php } ?>
			    </div>
			</div>
			<div class="price_box">
				<?php if($row['discount'] ) { ?>
					<span class="spical-price"><?=$row['discount']?> جنيه</span><br>
					<del class="spical-price text-muted"><?=$row['price']?> جنيه</del>
				<?php }else{ ?>
					<span class="spical-price"><?=$row['price']?> جنيه</span><br>
					&nbsp;
				<?php }?>
			</div>
			<?php if($editMode==false){?>
			<div class="last_button_area">
			    <ul class="add-to-links clearfix">
				<li class="addwishlist">
				    <div class="yith-wcwl-add-button show" >
					<a class="add_to_wishlist" href="#" rel="nofollow" data-productid="<?=$row['ID'];?>" data-product-type="external" data-toggle="tooltip" title="" data-original-title="اضافة الى المفضلة"><i class="fa fa-heart"></i></a>
				    </div>
				</li>
				<li>
				    <div class="new_act">
					<a class="button_act add2cartBtn" data-id="<?=$row['ID']?>" href="#" data-toggle="tooltip" title="قم باضافة المنتج الى السلة">اضف الى السلة</a>
				    </div>
				</li>
				<?php /*<li class="addcompare">
				    <div class="woocommerce product compare-button">
					<a class="compare button" href="#" data-product_id="<?=$row['ID']?>" rel="nofollow" data-toggle="tooltip" title="" data-original-title="اضافة الى المقارانات"><i class="fa fa-refresh"></i></a>
				    </div>
				</li>
				*/ ?>
			    </ul>
			</div>
			<?php }else{ ?>
			    <div class="last_button_area">
				<ul class="add-to-links clearfix">
				   <li>
					<div class="new_act">
					    <a class="button_act" href="<?=base_url()."profile/edit/{$row['ID']}";?>">تعديل  </a>
					</div>
				    </li>
				</ul>
			    </div>
			<?php }
		    ?>
		    </div>
		</div>
	    </div>
    </div>

<div class="product-item-4">
    <div class="chevron">
        <span class="fa fa-chevron-left"></span>
    </div>
    <div class="product-title"><a href="<?=$row['url']?>" class="color1">
        <?=character_limiter($row['title'], 100);?>
    </a></div>

    <div class="price-container"><?php if($row['discount'] ) { ?>
        <span class="main-price spical-price"><?=$row['discount']?> جنيه</span><br>
        <del class="spical-price text-muted"><?=$row['price']?> جنيه</del>
    <?php }else{ ?>
        <span class="main-price spical-price"><?=$row['price']?> جنيه</span><br>
        &nbsp;
    <?php }?></div>

    <div class="wish-container"><a class="add_to_wishlist2" href="#" rel="nofollow"
        data-productid="<?=$row['ID'];?>" data-product-type="external"
        data-toggle="tooltip" title="اضافة الى المفضلة"
        data-original-title="اضافة الى المفضلة">
        <i class="fa fa-heart"></i>
    </a></div>

    <div class="cart-container">
        <a class="add2cartBtn"
            data-id="<?=$row['ID']?>" href="#" data-toggle="tooltip"
            title="قم باضافة المنتج الى السلة">
            <i class="fa fa-cart-plus"></i>
    </a></div>

</div>
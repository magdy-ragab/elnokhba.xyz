<div class="shop_area">
    <div class="container">
	<div class="row">
	    <div class="col-md-12">
		<div class="shop_menu">
		    <ul class="cramb_area cramb_area_2 ">
			<li><a href="index.html">الرئيسية /</a></li>
			<li><a href="#">سلة التسوق</a></li>
		    </ul>
		</div>
	    </div>
	</div>
    </div>
</div>
<!-- shop area end-->
<div class="shopping_cart">
    <div class="container">
	<div class="row">
	    <div class="col-md-12">
		<div class="account_heading account_heading_ah">
		    <h1>سلة التسوق</h1>
		</div>
	    </div>
	</div>





<div class="col-sm-12">

<div class="col-md-4">
    <h4>  اضغط على هذا الزر ليتم تحويلك الى صفحة الدفع  </h4>
    <form action="https://www.<?= ($this->core_model->get_settings('sandbox') == 'Y') ? 'sandbox.' : '' ?>paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="return" value="<?= base_url() ?>paymentPaypal/paypal">
	<input type="hidden" name="business" value="<?php echo $this->core_model->get_settings('email') ?>">
	<input type="hidden" name="item_name" value="one time payment">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="lc" value="EG">
	<input type="hidden" name="email" value="<?= $user_data->email ?>">
	<input type="hidden" name="first_name" value="<?= $cart_cache_data->fname; ?>">
	<input type="hidden" name="last_name" value="<?= $cart_cache_data->lname; ?>">
	<input type="hidden" name="custom" value="<?php echo $cart_cache_data->cart_id; ?>" />
	<input type="hidden" name="amount" value="<?=$rate*intval($cart_cache_data->price); ?>"> 
	<input type="hidden" name="currency_code" value="USD">
	<div class="text-left">
	    <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
	</div>
    </form>
    
    <div class="row">
	<h4>بيانات الشحن</h4>
    </div>
    <div class="row">
    	    <div class="col-md-5 text-muted">الاسم الاول</div>
	    <div class="col-md-7">: <?= $post['fname'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted">اسم العائلة</div>
	    <div class="col-md-7">: <?= $post['lname'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted">البريد الالكتروني</div>
	    <div class="col-md-7">: <?= $post['email'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted">العنوان</div>
	    <div class="col-md-7">: <?= nl2br($post['address']); ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted">الهاتف</div>
	    <div class="col-md-7">: <?= $post['phone'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted">المدينة</div>
	    <div class="col-md-7">: <?= $post['city'] ?></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-5 text-muted"> ملاحظات</div>
	    <div class="col-md-7">: <?= nl2br($post['notes']) ?></div>
    	</div>
</div>

    <div class="your-order col-md-8">
			    <div class="text-left"><a href="<?= base_url()?>cart.html" class="text-danger"> عودة لســلة التسوق &raquo; </a></div>
    			    <h3 class="new_text_doc">ملخص سلة التسوق</h3>
    			    <div class="your-order-table table-responsive">
    				<table>
    				    <thead>
    					<tr>
    					    <th class="product-name">المنتج</th>
    					    <th class="product-total">الاجمالي</th>
    					</tr>
    				    </thead>
    				    <tbody>
					    <?php
					    $total = 0;
					    foreach ($_SESSION['cart'] as $k => $v) {
						$row = $this->core_model->product_data($k);
						if ($row[ID]) {
						    if ($row['discount']) {
							$price = $row['discount'];
						    } else {
							$price = $row['price'];
						    }
						    $total += $price;
						    ?>
	    					<tr class="cart_item">
	    					    <td class="product-name">
							    <?= $row['title'] ?>   <strong class="product-quantity">× <?= $v['count']; ?></strong>
	    					    </td>
	    					    <td class="product-total">
	    						<span class="amount"><?= $v['count'] * $price ?> جنيه</span>
	    					    </td>
	    					</tr>
						<?php }
					    }
					    ?>
    				    </tbody>
    				    <tfoot>
    					<tr class="cart-subtotal">
    					    <th> الاجمالي</th>
    					    <td><span class="amount_new"><?= $total; ?> جنيه</span></td>
    					</tr>
					    <?php if (isset($_SESSION['cart']['code']['discount'])) {
						$newprice = round((($total * $_SESSION['cart']['code']['discount']) / 100), 2);
						?>
						<tr class="cart-subtotal">
						    <th> كود الخصم</th>
						    <td><span class="amount_new"><?= $_SESSION['cart']['code']['discount'] ?>%</span> (<?= $newprice ?> جنيه)</td>
						</tr>
						<tr class="cart-subtotal">
						    <th> الاجمالي بعد كود الخصم</th>
						    <td><span class="amount_new"><?= $total - $newprice; ?> جنيه</span></td>
						</tr>
    <?php } ?>
    				    </tfoot>
    				</table>
    			    </div>
    			    <!--   payment method accordion-->
    			    
    			</div>
    		    </div>	


	    
	    
	
</div></div>
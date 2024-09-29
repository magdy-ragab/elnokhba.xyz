<?php $total_price = 0; ?>
<div class="shop_area">
    <div class="container">
	<div class="row">
	    <div class="col-md-12">
		<div class="shop_menu">
		    <ul class="cramb_area cramb_area_2 ">
			<li><a href="<?=base_url()?>">الرئيسية /</a></li>
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
		<div class="row">
			<?php if(!$_SESSION['cart']){
			    $this->shop->alert("<h2>سلة التسوق فارغة</h2>", 'error');
			}else{ ?>
				<form method="post" class="col-md-6 col-lg-8">
			    <div class="wishlist-table wishlist-table-2 table-responsive">
					<table>
						<thead>
							<tr>
									<th class="product-remove"><span class="nobr"></span></th>
									<th class="product-thumbnail product-thumbnail-2"></th>
									<th class="product-name product-name_2"><span class="nobr">المنتج</span></th>
									<th class="product-price"><span class="nobr"> السعر </span></th>
									<!-- <th class="product-price"><span class="nobr"> الشحن </span></th> -->
									<th class="product-stock-stauts"><span class="nobr"> الكمية </span></th>
									<th class="product-add-to-cart"><span class="nobr">الاجمالي</span></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_price = 0;
								$mainPrice = 0;
								$mainDiscount = 0;
								$shipping_price=['45'];
								if (isset($_SESSION['cart']) && is_array($_SESSION)) {
									foreach ($_SESSION['cart'] as $id => $v) {
									{
									$id= intval($id);
									if($id != 'code')
									{
										$row = $this->core_model->product_data($id);
										$shipping =  ($row['shipping_size'] ? $row['shipping_size'] : 1) ;
										// $shipping_price[] = $this->shop->getShippingPrice($shipping);
										if ($row['discount']) {
											$subPrice = $row['discount'];
										} else {
											$subPrice = $row['price'];
										}
										if ($row['discount']) {
											$total_price += $v['count']*$row['discount'];
										} else {
											$total_price += $v['count']*$row['price'];
										}
										$mainPrice += $v['count']*$subPrice;
										$mainDiscount += $v['count']*$row['discount'];
										if($row['discount']){
											$totalDiscount += ($v['count']*($row['price']-$row['discount'])) ;
										}
										if ( $id ) {
											?>
											<tr class="cartRow_<?= $id ?>">
												<td
													class="product-remove product-remove_2">
														<a href="javascript:delCart('<?= $id ?>')">×</a>
												</td>
												<td
													class="product-thumbnail product-thumbnail-2">
														<a href="#">
															<img src="<?= $row['thumbnail_path'] ?>" alt="<?= $row['title'] ?>">
														</a>
												</td>
												<td
													class="product-name product-name_2">
														<a href="<?= $row['url']; ?>"> <?= $row['title']; ?></a>
												</td>
												<td
													class="product-price">
														<span class="amount-list amount-list-2">
															<?php if ($row['discount']) {
																echo "<del class='red'>{$row['price']}</del> {$row['discount']}";
															} else {
																	echo $row['price'];
															} ?> جنيه
														</span>
												</td>
												<!--<td>
													<?=end($shipping_price)?>
												</td> -->
												<td class="product-stock-status">
													<div class="latest_es_from_2">
															<input type="number" name="productCount[<?= $id ?>]"
																value="<?= $_SESSION['cart'][$id]['count'] ?>">
													</div>
												</td>
												<td class="product-price">
													<span class="amount-list amount-list-2">
														<?= $subPrice * $_SESSION['cart'][$id]['count'] ?> جنيه</span>
												</td>
											</tr>
									<?php
									}
								}
									}
									}
							}
							?>
				    </tbody>
				    <tfoot>

				    </tfoot>
				</table>
				<div class="coupon">
				    <button type="submit" name="updateCartCounts" value="1"
							class="button_act btn-tip float-left">تحديث سلة التسوق</button>
				</div>
			    </div>
			</form>
			<div class="col-md-6 col-lg-4">
				<div class="cart_totals ">
				    <table class="shop_table shop_table_responsive">
							<tbody>
									<tr class="cart-subtotal">
										<th>السعر الاجمالي</th>
										<td data-title="Subtotal">
												<span class="woocommerce-Price-amount amount">
													<span class="woocommerce-Price-currencySymbol"></span>
													<?= $total_price ?> جنيه
												</span>
										</td>
								</tr>
									<tr class="cart-subtotal">
										<th>الشحن</th>
										<td data-title="Subtotal">
												<span class="woocommerce-Price-amount amount">
													<span class="woocommerce-Price-currencySymbol"></span>
													<?= array_sum($shipping_price) ?> جنيه
												</span>
										</td>
									</tr>
									<tr class="cart-subtotal">
										<th>الخصم</th>
										<td data-title="Subtotal">
												<span class="woocommerce-Price-amount amount">
													<span class="woocommerce-Price-currencySymbol"></span>
													<?= $totalDiscount ?> جنيه
											</span>
										</td>
								</tr>
								<tr class="order-total">
									<th>الاجمالي</th>
									<td data-title="Total">
											<strong>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol"></span>
														<?= ($total_price ) + array_sum($shipping_price) ?> جنيه
													</span>
										</strong>
									</td>
								</tr>
							</tbody>
						</table>
				    <div class="wc-proceed-to-checkout">
							<a class="button_act button_act-tc float-left"
								href="<?= base_url() ?>cart/shipment">	الذهاب الى صفحة الدفع</a>
				    </div>
				</div>
			</div>
		<?php } ?>



		</div>
	</div>
</div>






<!-- shop area start-->
<div class="shop_area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="shop_menu">
					<ul class="cramb_area cramb_area_2 ">
						<li><a href="index.html">الرئيسية /</a></li>
						<li><a href="#">الدفع</a></li>
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
					<h1>الدفع</h1>
				</div>
			</div>
		</div>
		<!-- coupon-area start -->
		<div class="coupon-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="coupon-accordion">
							<!-- ACCORDION START -->
							<div id="checkout-login" class="coupon-content">
								<div class="coupon-info">

									<form action="#">
										<p class="form-row-first">
											<label>أسم المستخدم او البريد الالكتروني <span class="required">*</span></label>
											<input type="text" />
										</p>
										<p class="form-row-last">
											<label>كلمة المرور <span class="required">*</span></label>
											<input type="text" />
										</p>
										<p class="form-row">
											<input type="submit" class="button" value="تسجيل الدخول" />
											<label>
												<input type="checkbox" /> تذكرني
											</label>
										</p>
										<p class="lost-password">
											<a href="#">فقدت كلمة المرور؟</a>
										</p>
									</form>
								</div>
							</div>
							<!-- ACCORDION END -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<?php
if (isset($flash)) {
	if ($flash == 'apply') {
		echo '<div class="container"><div class="alert alert-success">تم تطبيق الكود بنجاح</div></div>';
	} else if ($flash == 'NotCode') {
		echo '<div class="container"><div class="alert alert-danger">هذا الكود غير موجود</div></div>';
	} else if ($flash == 'unActive') {
		echo '<div class="container"><div class="alert alert-danger">هذا الكود منتهي</div></div>';
	}
}
?>
<div class="checkout-area">
	<div class="container">
		<div class="row">
			<div class="new_chek_cart col-md-12">
				<?php if (!isset($_SESSION['i'])) { ?>
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="<?= base_url() ?>login/login" class="shipmentLogin" id="login">
							<h3> تسجيل الدخول</h3>
							<?php
								if ($email_error) {
									$this->shop->alert('عفواً هذه البيانات غير صحيحة', 'error');
								}
								?>
							<input type="email" class="form-control mb-4"
								name="usermail" placeholder="البريد الالكتروني" id="username"
								data-validation="required,email"
								data-validation-error-msg="برجاء ادخال بريد الكتروني" value="<?php
																																																																																		if (isset($_POST['usermail'])) {
																																																																																			echo $_POST['usermail'];
																																																																																		}
																																																																																		?>">
							<input type="password" class="form-control mb-4"
								name="password" placeholder="كلمة المرور" id="password"
								data-validation="required"
								data-validation-error-msg="كلمة المرور مطلوبة">
							<input type="hidden" name="back" value="<?= base_url() . "cart/shipment" ?>">
							<input type="submit" class="col-md-2" name="submit_login" value="تسجيل الدخول" class="btn-blue btn">
							<p class="text-right mt-4 mb-4">
								<a href="<?php echo base_url('login') ?>" class="lost">تسجيل عضوية مجانية</a>
							</p>
						</form>
					</div>
					<!--column-->
				</div>
				<!--row-->
				<?php } else {
				?>

				<form action="<?= base_url() ?>cart/saveShipmentData" method="post" class=row>
					<div class="col-md-6">
						<div class="checkbox-form">
							<h3>بيانات الدفع</h3>
							<div class="row">


								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>الاسم الاول <span class="required">*</span></label>
										<input type="text" placeholder="" name="fname" id="fname" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>الاسم الاخير <span class="required">*</span></label>
										<input type="text" placeholder="" name="lname" id="lname" />
									</div>
								</div>

								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>البريد الالكتروني <span class="required">*</span></label>
										<input type="email" placeholder="" name="email" id="email" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>رقم الهاتف <span class="required">*</span></label>
										<input type="text" placeholder="" name="phone" id="phone" />
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>العنوان <span class="required">*</span></label>
										<input type="text" placeholder="من فضلك ادخل عنوانك بالتفصيل" name="address" id="address" />
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>المدينة / المحافظة <span class="required">*</span></label>
										<input type="text" placeholder="المدينة / المحافظة " name="city" id="city" />
									</div>
								</div>
							</div>
							<div class="different-address">
								<div class="ship-different-title">
									<h3>
										<label>معلومات اضافية</label>
									</h3>
								</div>

								<div class="order-notes">
									<div class="checkout-form-list">
										<label>ملاحظات</label>
										<textarea id="notes" name="notes" cols="30" rows="10"
											placeholder="ملاحظات عن طلبك, على سبيل المثال معلومات عن التوصيل."></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="your-order">
							<div class="text-left"><a href="<?= base_url() ?>cart.html" class="text-danger"> عودة لســلة التسوق
									&raquo; </a></div>
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
												if ($row['ID']) {
													if ($row['discount']) {
														$price = $row['discount'];
													} else {
														$price = $row['price'];
													}
													$total += $v['count'] * $price;
											?>
										<tr class="cart_item">
											<td class="product-name">
												<?= $row['title'] ?> <strong class="product-quantity">× <?= $v['count']; ?></strong>
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
											<th> الشحن</th>
											<td><span class="amount_new"><?= $this->shop->getShippingPrices(); ?> جنيه</span></td>
										</tr>
										<tr class="cart-subtotal">
											<th> الاجمالي</th>
											<td><span class="amount_new">
													<?= $total+$this->shop->getShippingPrices(); ?> جنيه</span>
											</td>
										</tr>
										<?php if (isset($_SESSION['cart']['code']['discount'])) {
												$newprice = round((($total * $_SESSION['cart']['code']['discount']) / 100), 2);
											?>
										<tr class="cart-subtotal">
											<th> كود الخصم</th>
											<td><span class="amount_new">
													<?= $_SESSION['cart']['code']['discount'] ?>%</span>
												(<?= $newprice ?> جنيه)
											</td>
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
							<div class="payment-method">
								<input type="hidden" name="paymethod" id="paymethod" value="onhome">
								<div class="payment-accordion">

									<h3 class="payment-accordion-toggle active" data-paymethod="onhome"> الدفع عند الاستلام</h3>
									<div class="payment-content">
										<p>قم بالدفع عند استلام المنتج</p>
										<p>تعد هذه هي الطريقة المثلى لمن لايملك حساباً بنكياً أو ماستركارد أو فيزا أو حساب باي باي</p>
									</div>

								</div>
								<div class="also-new_btn clearfix">
									<button type="submit" class="button_act button_act-ssp float-left" name="save_data" value=1>التقدم
										للدفع</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- checkout-area end -->
<!--=======Page Content Area=========-->
<main id="pageContentArea">
	<header class="page-head text-center">
		<div class="blog-main-slider">
			<div class="overlay"></div>
			<div class="container">
				<h2>تسجيل عضوية</h2>
				<p>من هنا يمكنك تسجيل عضوية جديدة</p>
			</div>
		</div>
	</header>

	<!--========================================
add products content
===========================================-->
	<div class="container">
		<div class="product-overview pt-50 pb-50">
			<div class="row">
				<div class="col-xs-12 col-sm-12 login-page text-center">

				<form method="post" action="<?= base_url() ?>register/registerUser" id="registr">
							<h3> تسجيل عضوية</h3>
							<?php
							if (isset($email_error_) && $email_error_ == 1) {
								$this->shop->alert('هذا البريد الالكتروني موجود من قبل', 'error');
							}
							if ( isset($errors) ) {
								$this->shop->alert($errors , 'error');
							}
							?>
							<div class="mb-4">
								<input type="text" name="username" class="form-control"
									placeholder="اسم المستخدم"
									data-validation="required"
									data-validation-error-msg="برجاء ادخال الاسم" id="username">
							</div>
							<div class="mb-4">
								<input type="password" name="password" class="form-control"
									placeholder="كلمة المرور"
									id="password" data-validation="required"
									data-validation-error-msg="برجاء ادخال كلمة المرور">
							</div>
							<div class="mb-4">
								<input type="email" name="email" class="form-control"
									placeholder="البريد الالكتروني"
									id="email" data-validation="required,email"
									data-validation-error-msg="برجاء ادخال البريد الالكتروني">
							</div>
							<div class="mb-4">
								<input type="submit" name="submit_register2"
									value="تسجيل عضوية"
									class="btn btn-primary">
							</div>
						</form>


				</div>
				<!--row-->
			</div>
			<!--product overview-->
		</div>
		<!--container-->

	</div>
	<!--page-contentArea-->
</main>
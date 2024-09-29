<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?= base_url("theme/") ?>css/checkout.css" rel="stylesheet">


<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li>تواصل معنا</li>
				</ul>
			</div>
			<h1>تواصل معنا</h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="تواصل معنا">
</div>




<?php
if (isset($inserted)) {
?>
	<div class="container-fluid bg_gray">
		<div class="row justify-content-center" dir=rtl>
			<div class="col-md-5">
				<div id="confirm">
					<div class="icon icon--order-success svg add_bottom_15">
						<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
							<g fill="none" stroke="#8EC343" stroke-width="2">
								<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
								<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
							</g>
						</svg>
					</div>
					<h2>تم اﻹرسال</h2>
					<p>سيتم التواصل معك قريباً جداً</p>
				</div>
			</div>
		</div>
	</div><?php
		}  ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-4">
				<div class="all_cntnt">
					<div class="frm_content frm_content_2">
						<h2>اترك رسالتك</h2>
						<p>يمكنك مراسلتنا من خلال استخدام الاستمارة التالية</p>
					</div>
					<?php
					if (isset($errors)) {
						echo '<div class="mb-4">
							<div class="alert alert-danger mt-4">' . 
								$errors . '
							</div>
						</div>';
					}
					?>
					<form class="side_right" method=post>
						<div class="al_form-fields al_form-fields-2">
							<p><input class="form-control" type="text" placeholder="اسمك الكريم" required name="uname"></p>
							<p><input class="form-control" type="number" placeholder="الجوال/الهاتف/الواتس" required name="mobile"></p>
							<p><input class="form-control" type="email" placeholder="البريد الإلكتروني" required name="email"></p>
							<p><input class="form-control" type="text" placeholder="موضوع الرسالة" required name="subject"></p>
							<p><textarea type="text" placeholder="الرسالة" required name="message" class="form-control"></textarea></p>
						</div>
						<div class="form-action form-action-2">
							<div class="new_act new_act_3">
								<button type="submit" name="send-contact" value=1 class="btn_1">إرسال</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li>404</li>
				</ul>
			</div>
			<h1>الصفحة المطلوبة غير موجودة</h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="">
</div>

<article class="container mt-5">

	<h1>خطأ 404</h1>
	<p>
		الصفحة التي تحاول الوصول إليها غير موجودة. إذا كنت اتبعت رابط بالخطأ.
		يمكنك <a href="<?=base_url('contacts')?>">التواصل</a> مع اﻹدارة..
	</p>

</article>

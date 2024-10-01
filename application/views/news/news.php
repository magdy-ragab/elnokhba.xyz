<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li><a href="<?= base_url('news') ?>">المواضيع</a></li>
					<li><?php echo $page['title']?></li>
				</ul>
			</div>
			<h1><?=$page['title']?></h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"uploads/news/{$page['pic']}",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="">
</div>


<!-- single -->

	<div class="container">
	
		<h2 class="sb-title"><?php echo $page['title'] ?></h2>
		<div class="single-left">
			<p>نشر في <span><?php $d= explode(" ",$page['date_create']); echo $this->Hijri->toArabicDateFull($d[0]) ?></span></p>
		</div>
		<div class="single-right">
			<p><?php echo nl2br($page['content']); ?></p>
		</div>
	</div>

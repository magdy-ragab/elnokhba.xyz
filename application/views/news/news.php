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
	<?php if( isset($page['pic']) && $page['pic']) { ?>
		<img src="<?= $this->shop->shop_img(
			"uploads/news/{$page['pic']}",
			"theme/img/bg_cat.jpg"
		) ?>" class="img-fluid" alt="<?=$page['title']?>">
	<?php }?>
</div>


<!-- single -->

	<div class="container pb-4">
	
		<h2 class="sb-title"><?php echo $page['title'] ?></h2>
		<div class="single-left">
			<p class="text-left">نشر في <span><?php $d= explode(" ",$page['date_create']); echo $this->Hijri->toArabicDateFull($d[0]) ?></span></p>
		</div>
		<div class="single-right">
			<p><?php echo nl2br($page['content']); ?></p>
		</div>
	</div>


<style>
	.sb-title {
		font-size: 18pt;
		font-weight: bold;
		margin-bottom: 15px;
		color: #116662;
	}
	.breadcrumbs ul li::after {
		transform: none !important;
		content: ">";
		margin-right: 5px;
	}
	.single-right {
		font-size: 1.3em;
	}
</style>
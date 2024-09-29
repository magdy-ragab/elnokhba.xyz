<div class="top_banner">
	<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="<?= base_url() ?>">الرئيسية</a></li>
					<li><a href="<?= base_url('news') ?>">الاخبار</a></li>
				</ul>
			</div>
			<h1>اﻷخبار</h1>
		</div>
	</div>
	<img src="<?= $this->shop->shop_img(
					"uploads/news/{$page['pic']}",
					"theme/img/bg_cat.jpg"
				) ?>" class="img-fluid" alt="">
</div>

<div class="container mt-5">
	<div class="row">
		<?php foreach( $this->core_model->news(['active'=>"Y"],6000) as $news ){
			$date=$this->Hijri->GregorianToHijri($news->news_data);
			$month=$this->Hijri->monthName($date[0]);
			?>
		<div class="col-md-6 col-lg-4">
			<a class="box_news" href="<?=base_url("news/{$news->ID}")?>">
				<figure>
					<img src="<?=$this->shop->shop_img("uploads/news/{$news->thumbnail}")?>"
					data-src="<?=$this->shop->shop_img("uploads/news/{$news->thumbnail}")?>"
					alt="<?=$news->title?>" width="400" height="266" class="lazy">
					<figcaption><strong><?=$date[1]?></strong><?=$month?></figcaption>
				</figure>
				<ul>
					<li><?=$date[1].' '.$month.' '.$date[2]." هـ "?></li>
				</ul>
				<h4><?=$news->title?></h4>
				<p><?=word_limiter(strip_tags($row->content),30)?></p>
			</a>
		</div>
		<!-- /box_news -->
		<?php }?>

	</div>
	<!-- /row -->
</div><!-- / .container -->